<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Image;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => 'required|max:35|unique:users',
            'email' => ['required', 'max:255', 'email', 'regex:/(.*)@(clsu2.edu)\.ph/i', 'unique:users'],
            'role' => 'in:CLIENT,COUNSELOR,ADMIN',
            'phone' => 'required|max:11',
            'student_id' => ['required', 'unique:users'],
            'course' => 'required',
            'year_level' => 'required',
            'section' => 'required',
        ]);
    }
    // public function register(Request $request)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'college' => 'required',
    //         'course' => 'required',
    //         // Include other form field validations
    //     ]);
    // }
    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'two_fa_verified' => 0,
            'role' => 'CLIENT',
            'phone' => $data['phone'],
            'student_id' => $data['student_id'],
            'college' => $data['college'],
            'course' => $data['course'],
            'section' => $data['section'],
            'year_level' => $data['year_level'],
            'email' => $data['email'],
            'evaluated' => 0,
            'password' => Hash::make($data['password']),
        ]);

        if (request()->hasfile('avatar')) {
            $image = Image::where('profileId', $user->id)->first();
            if (is_null($image)) {
                $image = new Image();
            }
            $image->profileId = $user->id;
            $image->filename = request()->avatar->getClientOriginalName();

            $path = request()->avatar->getRealPath();
            $data = base64_encode(file_get_contents($path));
            $base64 = 'data:' . request()->avatar->getClientMimeType() . ';base64,' . $data;
            $image->content = $base64;
            $image->save();
        }

        $this->sendTwoFactorEmail($user);

        return $user;
    }

    public function getCoursesByCollege(Request $request, $collegeId)
    {
        $courses = Course::where('college_id', $collegeId)->get();
        return response()->json($courses);
    }

    public function sendTwoFactorEmail($user)
    {
        $code = mt_rand(100000, 999999);
        $emailParams = [
            'code' => $code,
            'name' => $user->name
        ];
        Mail::send('mail', $emailParams, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Two-Factor Authentication (2FA) - CLSU-OSA: MENTAL HEALTH SUPPORT');
            $message->from('clsu.mhs@gmail.com', 'CLSU-OSA: MENTAL HEALTH SUPPORT');
        });

        $user->two_fa_code = $code;
        $startTime = date("Y-m-d H:i:s");
        $user->two_fa_expiry = date('Y-m-d H:i:s', strtotime('+20 minutes', strtotime($startTime)));
        $user->two_fa_verified = 0;
        $user->save();
    }
}
