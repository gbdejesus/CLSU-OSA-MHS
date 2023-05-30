@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card" style="color: black; font-family: 'Poppins', sans-serif;">
                <div class="card-header" style="font-size: 30px; font-weight: 600">{{ __('REGISTER') }}</div>

                <div class="card-body" style="font-weight: 550; font-size: 14px; text-align: left; margin-left:50px;">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-6">

                                <!--NAME-->
                                <div class="form-group row mt-4">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FULL NAME') }}</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your full name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!--EMAIL-->
                                <div class="form-group row mt-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('EMAIL ADDRESS') }}</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your clsu email address" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!--PASSWORD-->
                                <div class="form-group row mt-2">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('PASSWORD') }}</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!--CONFIRM PASSWORD-->
                                <div class="form-group row mt-2">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('CONFIRM PASSWORD') }}</label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <!--IMAGE-->
                                <div class="form-group row mt-4" >
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('PROFILE PICTURE') }}</label>

                                    <div class="col-md-6">
                                        <input id="avatar" type="file" class="form-control
                                            @error('avatar') is-invalid @enderror" name="avatar"
                                               value="{{ old('avatar') }}" required autocomplete="avatar" autofocus>
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!--PHONE-->
                                <div class="form-group row mt-2" >
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('PHONE NUMBER') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your phone number" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row form-group mt-4">
                            <div class="col-md-6">
                                <!--COLLEGE-->
                                <div class="form-group row mt-2">
                                    <label for="student-id" class="col-md-4 col-form-label text-md-right">{{ __('COLLEGE') }}</label>

                                    <div class="col-md-8">

                                        <select id="college" class="form-control @error('college') is-invalid @enderror" name="college" value="{{ old('college') }}" required autocomplete="college">
                                            <option value="" selected disabled>SELECT COLLEGE</option>
                                            <option value="UNIVERSITY SCIENCE HIGH SCHOOL">UNIVERSITY SCIENCE HIGH SCHOOL</option>
                                            <option value="AGRICULTURAL SCIENCE AND TECHNOLOGY SCHOOL">AGRICULTURAL SCIENCE AND TECHNOLOGY SCHOOL</option>
                                            <option value="COLLEGE OF AGRICULTURE">COLLEGE OF AGRICULTURE</option>
                                            <option value="COLLEGE OF ARTS AND SOCIAL SCIENCES">COLLEGE OF ARTS AND SOCIAL SCIENCES</option>
                                            <option value="COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY">COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY</option>
                                            <option value="COLLEGE OF EDUCATION">COLLEGE OF EDUCATION</option>
                                            <option value="COLLEGE OF ENGINEERING">COLLEGE OF ENGINEERING</option>
                                            <option value="COLLEGE OF FISHERIES">COLLEGE OF FISHERIES</option>
                                            <option value="COLLEGE OF HOME SCIENCE AND INDUSTRY">COLLEGE OF HOME SCIENCE AND INDUSTRY</option>
                                            <option value="COLLEGE OF VETERINARY SCIENCE AND MEDICINE">COLLEGE OF VETERINARY SCIENCE AND MEDICINE</option>
                                            <option value="COLLEGE OF SCIENCE">COLLEGE OF SCIENCE</option>
                                            <option value="GRADUATE STUDIES">GRADUATE STUDIES</option>
                                        </select>

                                        @error('college')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">

                                <!--STUDENT ID-->
                                <div class="form-group row mt-2">
                                    <label for="student-id" class="col-md-4 col-form-label text-md-right">{{ __('STUDENT ID') }}</label>

                                    <div class="col-md-8">
                                        <input id="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" placeholder="xx-xxxx" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id">

                                        @error('student_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--COURSE-->
                                <div class="form-group row mt-2">
                                    <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('COURSE') }}</label>
                                    <div class="col-md-8">
                                        <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" placeholder="e.g. BSIT" name="course" value="{{ old('course') }}" required autocomplete="course">

                                        @error('course')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <!--YEAR LEVEL-->
                                <div class="form-group row mt-2" >
                                    <label for="year-level" class="col-md-4 col-form-label text-md-right" >{{ __('YEAR LEVEL') }}</label>

                                    <div class="col-md-6">
                                        <select id="year_level" class="form-control @error('year-level') is-invalid @enderror" name="year_level" value="{{ old('year_level') }}" required autocomplete="year_level">
                                            <option value="" selected disabled>SELECT YEAR</option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
                                            <option value="5th">5th</option>
                                            <option value="6th">6th</option>
                                        </select>
                                        @error('year_level')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--SECTION-->
                                <div class="form-group row mt-2" >
                                    <label for="section" class="col-md-4 col-form-label text-md-right">{{ __('SECTION') }}</label>

                                    <div class="col-md-6">
                                        <input id="section" type="text" class="form-control @error('section') is-invalid @enderror" placeholder="Enter your dash" name="section" value="{{ old('section') }}" autocomplete="section">

                                        @error('section')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--REGISTER BUTTON-->
                        <div class="form-group row mt-5 mb-4">
                            <div class="col-md-3 offset-md-9">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('REGISTER') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
