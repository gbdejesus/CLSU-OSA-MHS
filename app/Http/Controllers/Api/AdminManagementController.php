<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Image;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $params = array_filter($request->all());

        $profile = User::select('*');

        if (isset($request->name)) {
            $profile->where('name', 'like', '%'.$request->name.'%');
        }

        if (isset($request->role)) {
            $profile->where('role', 'like', '%'.$request->role.'%');
        }

        if (isset($request->phone)) {
            $profile->where('phone', 'like', '%'.$request->phone.'%');
        }

        if (isset($request->email)) {
            $profile->where('email', 'like', '%'.$request->email.'%');
        }

        $response = $profile->get()->toArray();

        foreach ($response as $key => $value) {
            $image = Image::where('profileId', $value['id'])->first();
            if (! is_null($image)) {
                $response[$key]['image'] = $image['content'];
            }
        }

        return response()->json($response);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $profile = User::findOrFail($id)->toArray();
        $image = Image::where('profileId', $profile['id'])->first();
        if (! is_null($image)) {
            $profile['image'] = $image['content'];
        }

        return response()->json($profile);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request)
    {
        $duplicate = User::where('email', $request->email)->get();
        $successMessage = 'Profile has been successfully created!';
        $profile = new User();
        if (isset($request->id)) {
            $successMessage = 'Profile has been successfully updated!';
            $profile = User::findOrFail($request->id);
            foreach ($duplicate as $dup) {
                if ($dup->id !== $request->id) {
                    return response()->json(['success' => false, 'message' => 'Email is already existed.']);
                }
            }
        } else {
            if (count($duplicate) >= 1) {
                return response()->json(['success' => false, 'message' => 'Email is already existed.']);
            }
        }

        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->role = $request->role;
        $profile->college = $request->college;
        $profile->student_id = $request->student_id;
        $profile->course = $request->course;
        $profile->year_level = $request->year_level;
        $profile->section = $request->section;
        $profile->profile_image = $request->profile_image;
        $profile->evaluated = $request->role === 'COUNSELOR' ? 0 : 1;
        $profile->evaluation_score = null;
        $profile->save();

        if ($profile)
            return response()->json(
                [
                    'success' => true,
                    'message' => $successMessage,
                    'response' => $profile
                ]);
        else
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Something went wrong.. Please try again later!'
                ]
            );
    }

    public function upload(Request $request)
    {
        $image = Image::where('profileId', $request->profileId)->first();

        if (is_null($image)) {
            $image = new Image();
        }
        $image->profileId = $request->profileId;
        $image->filename = $request->file('file')->getClientOriginalName();

        $path = $request->file('file')->getRealPath();
        $data = base64_encode(file_get_contents($path));
        $base64 = 'data:' . $request->file('file')->getClientMimeType() . ';base64,' . $data;
        $image->content = $base64;
        $image->save();

        return response()->json(['success' => true, 'message' => 'Image uploaded successfully!','response' => $image]);
    }
}
