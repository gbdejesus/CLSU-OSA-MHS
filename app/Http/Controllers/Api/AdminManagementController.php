<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Image;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminManagementController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $params = array_filter($request->all());

        $profile = User::select('*')->orderBy('id', 'DESC');

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
     * @return array|JsonResponse
     */
    public function save(Request $request)
    {
        $rules = [
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users',
            'role' => 'in:CLIENT,COUNSELOR,ADMIN',
        ];

        if (isset($request->id)) {
            $rules['email'] = "required|email|unique:users,email,$request->id";
        }

        if ($request['mode'] === 'create') {
            $rules['password'] = 'required|min:6';
        }

        switch ($request['role']) {
            case 'CLIENT':
                $rules['college'] = 'required';
                $rules['student_id'] = 'required|unique:users';
                $rules['course'] = 'required';
                $rules['year_level'] = 'required';
                $rules['section'] = 'required';
                break;
            case 'COUNSELOR':
                $rules['college'] = 'required';
                break;
        }

        $validator = Validator::make($request->all(), $rules);

        $response = [];
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->all();
            return $response;
        } else {
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
            if ($request['mode'] === 'create') {
                $profile->password = Hash::make($request->password);
            }
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

            if ($profile) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => $successMessage,
                        'response' => $profile
                    ]);
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Something went wrong.. Please try again later!'
                    ]
                );
            }
        }
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

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('flash_title', 'Success');
        Session::flash('flash_message', 'User has been archived Successfully!');

        return response()->json(['success' => true, 'message' => 'User has been archived Successfully!','response' => $user]);
    }
}
