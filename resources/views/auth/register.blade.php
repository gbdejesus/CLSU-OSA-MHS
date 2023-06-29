@extends('layouts.app')

@section('content')
<script>
    // Attach event listener to the "COLLEGE" select element
    const collegeSelect = document.getElementById('collegeSelect');
    const courseSelect = document.getElementById('courseSelect');

    collegeSelect.addEventListener('change', function () {
        const selectedCollegeId = this.value;

        // Clear previous options
        courseSelect.innerHTML = '';

        // Make an AJAX request to fetch courses
        fetch(`/courses/${selectedCollegeId}`)
            .then(response => response.json())
            .then(courses => {
                // Populate the "COURSE" select element with fetched courses
                courses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.id;
                    option.text = course.name;
                    courseSelect.appendChild(option);
                });
            });
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card" style="color: black; font-family: 'Poppins', sans-serif;">
                <div class="card-header" style="font-size: 30px; font-weight: 600">{{ __('REGISTER') }}</div>
                <br>
                Form with asterisk (*) are required to filled to register.
                <div class="card-body" style="font-weight: 550; font-size: 14px; text-align: left;">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-6">

                                <!--NAME-->
                                <div class="form-group row mt-4">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FULL NAME ') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="First name M.I. Last Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!--EMAIL-->
                                <div class="form-group row mt-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('EMAIL ADDRESS ') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your clsu2 email address" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!--PASSWORD-->
                                <div class="form-group row mt-2">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('PASSWORD ') }}<span class="text-danger">*</span></label>

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
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('CONFIRM PASSWORD ') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <!--IMAGE-->
                                <div class="form-group row mt-4" >
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('2x2 PICTURE ') }}<span class="text-danger">*</span></label>

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
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('PHONE NUMBER ') }}<span class="text-danger">*</span></label>

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
                                    <label for="student-id" class="col-md-4 col-form-label text-md-right">{{ __('COLLEGE ') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                    <!-- <label for="college">College</label> -->
    <!-- <select id="college" name="college" class="form-control" onchange="fetchCourses()">
        <option value="">Select College</option>
        <option value="agriculture" {{ old('college') == 'College of Agriculture' ? 'selected' : '' }}>College of Agriculture</option>
        <option value="engineering" {{ old('college') == 'College of Engineering' ? 'selected' : '' }}>College of Engineering</option>
    </select> -->
                                        <select id="college" class="form-control @error('college') is-invalid @enderror" name="college" onchange="fetchCourses()" required autocomplete="college">
                                            <option value="" selected disabled>Select College</option>
                                            <option value="College of Agriculture" {{ old('college') == 'College of Agriculture' ? 'selected' : '' }}>College of Agriculture</option>
                                            <option value="College of Arts and Social Sciences" {{ old('college') == 'College of Arts and Social Sciences' ? 'selected' : '' }}>College of Arts and Social Sciences</option>
                                            <option value="College of Business Administration and Accountancy" {{ old('college') == 'College of Business Administration and Accountancy' ? 'selected' : '' }}>College of Business Administration and Accountancy</option>
                                            <option value="College of Education" {{ old('college') == 'College of Education' ? 'selected' : '' }}>College of Education</option>
                                            <option value="College of Engineering" {{ old('college') == 'College of Engineering' ? 'selected' : '' }}>College of Engineering</option>
                                            <option value="College of Fisheries" {{ old('college') == 'College of Fisheries' ? 'selected' : '' }}>College of Fisheries</option>
                                            <option value="College of Home Science and Industry" {{ old('college') == 'College of Home Science and Industry' ? 'selected' : '' }}>College of Home Science and Industry</option>
                                            <option value="College of Veterinary Science and Medicine" {{ old('college') == 'College of Veterinary Science and Medicine' ? 'selected' : '' }}>College of Veterinary Science and Medicine</option>
                                            <option value="College of Science" {{ old('college') == 'College of Science' ? 'selected' : '' }}>College of Science</option>
                                            <option value="University Science High School" {{ old('college') == 'University Science High School' ? 'selected' : '' }}>University Science High School</option>
                                            <option value="Agricultural Science and Technology School" {{ old('college') == 'Agricultural Science and Technology School' ? 'selected' : '' }}>Agricultural Science and Technology School</option>
                                            <option value="Graduate Studies" {{ old('college') == 'Graduate Studies' ? 'selected' : '' }}>Graduate Studies</option>
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
                                    <label for="student-id" class="col-md-4 col-form-label text-md-right">{{ __('STUDENT ID ') }}<span class="text-danger">*</span></label>

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
                                        <!-- <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" placeholder="e.g. BSIT" name="course" value="{{ old('course') }}" required autocomplete="course"> -->
                                        <!-- <select id="course" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" autocomplete="course"> -->
                                <!-- <label for="course">Course</label> -->
                                <select id="course" name="course" class="form-control">
                                    <option value="{{ old('course')}}">Select Course</option>
                                </select>                                            
                                        <!-- <option value="" selected disabled>Select Courses</option>
                                            <option value="" disabled>College of Agriculture</option>
                                            <option value="BSAb" {{ old('course') == 'BSAb' ? 'selected' : '' }}>Bachelor of Science in Agribusiness</option>
                                            <option value="BSA" {{ old('course') == 'BSA' ? 'selected' : '' }}>Bachelor of Science in Agriculture</option>
                                            <option value="" disabled>College of Arts and Social Sciences</option>
                                            <option value="BAFil"  {{ old('course') == 'BAFil' ? 'selected' : '' }}>Bachelor of Arts in Filipino</option>
                                            <option value="BALit"  {{ old('course') == 'BALit' ? 'selected' : '' }}>Bachelor of Arts in Literature</option>
                                            <option value="BASS"  {{ old('course') == 'BASS' ? 'selected' : '' }}>Bachelor of Arts in Social Sciences</option>
                                            <option value="BSDC"  {{ old('course') == 'BSDC' ? 'selected' : '' }}>Bachelor of Science in Development Communication</option>
                                            <option value="BSPsych"  {{ old('course') == 'BSPsych' ? 'selected' : '' }}>Bachelor of Science in Psychology</option>
                                            <option value="" disabled>College of Business Administration and Accountancy</option>
                                            <option value="BSAc"  {{ old('course') == 'BSAc' ? 'selected' : '' }}>Bachelor of Science in Accountancy</option>
                                            <option value="BSBA"  {{ old('course') == 'BSBA' ? 'selected' : '' }}>Bachelor of Science in Business Administration</option>
                                            <option value="BSEntrep"  {{ old('course') == 'BSEntrep' ? 'selected' : '' }}>Bachelor of Science in Entrepreneurship</option>
                                            <option value="BSMA"  {{ old('course') == 'BSMA' ? 'selected' : '' }}>Bachelor of Science in Management Accounting</option>
                                            <option value="" disabled>College of Education</option>
                                            <option value="BCAEd"  {{ old('course') == 'BCAEd' ? 'selected' : '' }}>Bachelor of Culture and Arts Education</option>
                                            <option value="BECEd"  {{ old('course') == 'BECEd' ? 'selected' : '' }}>Bachelor of Early Childhood Education</option>
                                            <option value="BEEd"  {{ old('course') == 'BEEd' ? 'selected' : '' }}>Bachelor of Elementary Education</option>
                                            <option value="BPEd"  {{ old('course') == 'BPEd' ? 'selected' : '' }}>Bachelor of Physical Education</option>
                                            <option value="BSEd"  {{ old('course') == 'BSEd' ? 'selected' : '' }}>Bachelor of Secondary Education</option>
                                            <option value="BTLEd"  {{ old('course') == 'BTLEd' ? 'selected' : '' }}>Bachelor of Technology and Livelihood Education</option>
                                            <option value="" disabled>College of Engineering</option>
                                            <option value="BSABE"  {{ old('course') == 'BSABE' ? 'selected' : '' }}>Bachelor of Science in Agricultural and Biosystem Engineering</option>
                                            <option value="BSCE"  {{ old('course') == 'BSCE' ? 'selected' : '' }}>Bachelor of Science in Civil Engineering</option>
                                            <option value="BSIT"  {{ old('course') == 'BSIT' ? 'selected' : '' }}>Bachelor of Science in Information Technology</option>
                                            <option value="BSMet"  {{ old('course') == 'BSMet' ? 'selected' : '' }}>Bachelor of Science in Meteorology</option>
                                            <option value="" disabled>College of Fisheries</option>
                                            <option value="BSF"  {{ old('course') == 'BSF' ? 'selected' : '' }}>Bachelor of Science in Fisheries</option>
                                            <option value="" disabled>College of Home Science and Industry</option>
                                            <option value="BSFT"  {{ old('course') == 'BSFT' ? 'selected' : '' }}>Bachelor of Science in Food Technology</option>
                                            <option value="BSFTT"  {{ old('course') == 'BSFTT' ? 'selected' : '' }}>Bachelor of Science in Fashion and Textile Technology</option>
                                            <option value="BSHM"  {{ old('course') == 'BSHM' ? 'selected' : '' }}>Bachelor of Science in Hospitality Management</option>
                                            <option value="BSTM"  {{ old('course') == 'BSTM' ? 'selected' : '' }}>Bachelor of Science in Tourism Management</option>
                                            <option value="" disabled>College of Science</option>
                                            <option value="BSBio"  {{ old('course') == 'BSBio' ? 'selected' : '' }}>Bachelor of Science in Biology</option>
                                            <option value="BSChem"  {{ old('course') == 'BSChem' ? 'selected' : '' }}>Bachelor of Science in Chemistry</option>
                                            <option value="BSES"  {{ old('course') == 'BSES' ? 'selected' : '' }}>Bachelor of Science in Environmental Sciences</option>
                                            <option value="BSMath"  {{ old('course') == 'BSMath' ? 'selected' : '' }}>Bachelor of Science in Mathematics</option>
                                            <option value="BSStat"  {{ old('course') == 'BSStat' ? 'selected' : '' }}>Bachelor of Science in Statistics</option>
                                            <option value="" disabled>College of Veterinary Medicine</option>
                                            <option value="DVM" {{ old('course') == 'DVM' ? 'selected' : '' }}>Doctor of Veterinary Medicine</option> -->
                                        </select>

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
                                    <label for="year-level" class="col-md-4 col-form-label text-md-right" >{{ __('YEAR LEVEL ') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <select id="year_level" class="form-control @error('year-level') is-invalid @enderror" name="year_level" value="{{ old('year_level') }}" required autocomplete="year_level">
                                            <option value="" selected disabled>Select year</option>
                                            <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('year_level') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('year_level') == '6' ? 'selected' : '' }}>6</option>
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
                                    <label for="section" class="col-md-4 col-form-label text-md-right">{{ __('SECTION ') }}<span class="text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <select id="section" class="form-control @error('section') is-invalid @enderror" name="section" value="{{ old('section') }}" required autocomplete="section">
                                            <option value="" selected disabled>Select dash</option>
                                            <option value="1" {{ old('section') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('section') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('section') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('section') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('section') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ old('section') == '6' ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ old('section') == '7' ? 'selected' : '' }}>7</option>
                                            <option value="8" {{ old('section') == '8' ? 'selected' : '' }}>8</option>
                                            <option value="9" {{ old('section') == '9' ? 'selected' : '' }}>9</option>
                                        </select>
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
<script>
function fetchCourses() {
    var collegeSelect = document.getElementById('college');
    var courseSelect = document.getElementById('course');
    var collegeValue = collegeSelect.value;

    // Clear the existing options in the course select element
    courseSelect.innerHTML = '<option value="">Select Course</option>';

    if (collegeValue === 'College of Agriculture') {
        // If "College of Agriculture" is selected, add the corresponding course options
        var agricultureCourses = {
            'BSAb': 'Bachelor of Science in Agribusiness',
            'BSA': 'Bachelor of Science in Agriculture',
        };

        for (var course in agricultureCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = agricultureCourses[course];
            courseSelect.appendChild(courseOption);
        }
    } 
    else if (collegeValue === 'College of Arts and Social Sciences') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BAFil': 'Bachelor of Arts in Filipino',
            'BALit': 'Bachelor of Arts in Literature',
            'BASS': 'Bachelor of Arts in Social Sciences',
            'BSDC': 'Bachelor of Science in Development Communication',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Engineering') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BSABE': 'Bachelor of Science in Agricultural and Biosystem Engineering',
            'BSCE': 'Bachelor of Science in Civil Engineering',
            'BSIT': 'Bachelor of Science in Information Technology',
            'BSMet': 'Bachelor of Science in Metreology',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Business Administration and Accountancy') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BSAc': 'Bachelor of Science in Accountancy',
            'BSBA': 'Bachelor of Science in Business Administration',
            'BSEntrep': 'Bachelor of Science in Entrepreneurship',
            'BSMA': 'Bachelor of Science in Management Accounting',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Education') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BCAEd': 'Bachelor of Culture and Arts Education',
            'BECEd': 'Bachelor of Early Childhood Education',
            'BEEd': 'Bachelor of Elementary Education',
            'BPEd': 'Bachelor of Physical Education',
            'BSEd': 'Bachelor of Secondary Education',
            'BTLEd': 'Bachelor of Technology and Livelihood Education',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Fisheries') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BSF': 'Bachelor of Science in Fisheries',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Home Science and Industry') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BSFT': 'Bachelor of Science in Food Technology',
            'BSFTT': 'Bachelor of Science in Fashion and Textile Technology',
            'BSHM': 'Bachelor of Science in Hospitality Management',
            'BSTM': 'Bachelor of Science in Tourism Management',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Science') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'BSBio': 'Bachelor of Science in Biology',
            'BSChem': 'Bachelor of Science in Chemistry',
            'BSES': 'Bachelor of Science in Environmental Sciences',
            'BSMath': 'Bachelor of Science in Mathematics',
            'BSStat': 'Bachelor of Science in Statistics',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'College of Veterinary Science and Medicine') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'DVM': 'Doctor of Veterinary Medicine',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'University Science High School') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'N/A': 'Not Applicable',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'Agricultural Science and Technology School') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'N/A': 'Not Applicable',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
    else if (collegeValue === 'Graduate Studies') {
        // If "College of Engineering" is selected, add the corresponding course options
        var engineeringCourses = {
            'MSAgEcon': 'Master of Science in Agricultural Economics',
            'MSAgEn': 'Master of Science in Agricultural Engineering',
            'MSAnSci': 'Master of Science in Animal Science',
            'MSAqua': 'Master of Science in Aquaculture',
            'MSBio': 'Master of Science in Biology',
            'MSBEd': 'Master of Science in Biology Education',
            'MSCEd': 'Master of Science in Chemistry Education',
            'MSCP': 'Master of Science in Crop Protection',
            'MSCS': 'Master of Science in Crop Science',
            'MSDC': 'Master of Science in Development Communication',
            'MSEd': 'Master of Science in Education',
            'MSEM': 'Master of Science in Environmental Management',
            'MSGS': 'Master of Science in Grain Science',
            'MSGC': 'Master of Science in Guidance and Counselling',
            'MSRD': 'Master of Science in Rural Development',
            'MSSS': 'Master of Science in Soil Science',
            'MALL': 'Master of Arts in Language and Literature',
            'MSRES': 'Master of Science in Renewable Energy Systems (DOTUni)',
            'MVS': 'Master of Veterinary Studies',
            'MAM': 'Master in Agribusiness Management',
            'MBio': 'Master in Biology',
            'MChem': 'Master in Chemistry',
            'MEM': 'Master in Environmental Management (DOTUni)',
            'MLGM': 'Master in Local Government Management (DOTUni)',
            'DPAgEng': 'Doctor of Philosophy in Agricultural Engineering',
            'DPAgEnto': 'Doctor of Philosophy in Agricultural Entomology',
            'DPAnSci': 'Doctor of Philosophy in Animal Science',
            'DPAqua': 'Doctor of Philosophy in Aquaculture',
            'DPBio': 'Doctor of Philosophy in Biology',
            'DPCS': 'Doctor of Philosophy in Crop Science',
            'DPDC': 'Doctor of Philosophy in Development Communication',
            'DPDEd': 'Doctor of Philosophy in Development Education',
            'DPEM': 'Doctor of Philosophy in Environmental Management',
            'DPPB': 'Doctor of Philosophy in Plant Breeding',
            'DPRD': 'Doctor of Philosophy in Rural Development',
            'DPSS': 'Doctor of Philosophy in Soil Science',
            'DPSFS': 'Doctor of Philosophy in Sustainable Food Systems by Research Program (DOTUni)',
        };

        for (var course in engineeringCourses) {
            var courseOption = document.createElement('option');
            courseOption.value = course;
            courseOption.text = engineeringCourses[course];
            courseSelect.appendChild(courseOption);
        }
    }
}

</script>
@endsection
