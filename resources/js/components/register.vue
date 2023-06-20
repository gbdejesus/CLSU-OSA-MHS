<template>
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
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FULL NAME *') }}</label>

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
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('EMAIL ADDRESS *') }}</label>

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
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('PASSWORD *') }}</label>

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
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('CONFIRM PASSWORD *') }}</label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <!--IMAGE-->
                                <div class="form-group row mt-4" >
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('2x2 PICTURE *') }}</label>

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
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('PHONE NUMBER *') }}</label>

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
                                    <label for="student-id" class="col-md-4 col-form-label text-md-right">{{ __('COLLEGE *') }}</label>

                                    <div class="col-md-8">
                                        <!-- <select id="college" class="form-control @error('college') is-invalid @enderror" name="college" value="{{ old('college') }}" required autocomplete="college">
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
                                        </select> -->
                                        <select v-model="selectedCollege" @change="fetchCourses">
                                            <option v-for="college in colleges" :value="college.id" :key="college.id">{{ college.name }}</option>
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
                                    <label for="student-id" class="col-md-4 col-form-label text-md-right">{{ __('STUDENT ID *') }}</label>

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
                                        <!-- <select id="course" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" autocomplete="course">
                                            <option value="" selected disabled>Select Courses</option>
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
                                            <option value="DVM" {{ old('course') == 'DVM' ? 'selected' : '' }}>Doctor of Veterinary Medicine</option>
                                        </select> -->

                                        <select v-model="selectedCourse">
                                          <option v-for="course in courses" :value="course.id" :key="course.id">{{ course.name }}</option>
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
                                    <label for="year-level" class="col-md-4 col-form-label text-md-right" >{{ __('YEAR LEVEL *') }}</label>

                                    <div class="col-md-6">
                                        <select id="year_level" class="form-control @error('year-level') is-invalid @enderror" name="year_level" value="{{ old('year_level') }}" required autocomplete="year_level">
                                            <option value="" selected disabled>Select year</option>
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                            <option value="6" >6</option>
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
                                    <label for="section" class="col-md-4 col-form-label text-md-right">{{ __('SECTION *') }}</label>

                                    <div class="col-md-6">
                                        <select id="section" class="form-control @error('section') is-invalid @enderror" name="section" value="{{ old('section') }}" required autocomplete="section">
                                            <option value="" selected disabled>Select dash</option>
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                            <option value="6" >6</option>
                                            <option value="7" >7</option>
                                            <option value="8" >8</option>
                                            <option value="9" >9</option>
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
<!-- 
Modal
<select v-model="selectedCollege" @change="fetchCourses">
  <option v-for="college in colleges" :value="college.id" :key="college.id">{{ college.name }}</option>
</select>

<select v-model="selectedCourse">
  <option v-for="course in courses" :value="course.id" :key="course.id">{{ course.name }}</option>
</select>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</template>

<script>
  export default {
    data() {
      return {
        modalShow: false,
        Name: 'Red Abiera III',
      }
    }
  }
</script>-->
</template>
<script>
export default {
    data() {
        return {
            colleges: [],
            selectedCollege: null,
            courses: [],
            selectedCourse: null,
        };
    },
    mounted() {
        // Fetch the list of colleges when the component is mounted
        this.fetchColleges();
    },
    methods: {
        fetchColleges() {
            // Make an AJAX request to fetch the colleges
            axios.get('/api/colleges')
                .then(response => {
                    this.colleges = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        fetchCourses() {
            // Make an AJAX request to fetch the courses based on the selected college
            axios.get(`/courses/${this.selectedCollege}`)
                .then(response => {
                    this.courses = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>