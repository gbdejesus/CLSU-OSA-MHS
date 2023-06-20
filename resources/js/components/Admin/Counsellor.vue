<template>
    <div>
        <h2 style="margin-left: 0.3em;">Counsellor Management</h2>
        <br>
        <br>
        <div class="card-body" v-if="isSearch">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input class="form-control" placeholder="Name" id="name" type="text" v-model="searchData.name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input class="form-control" placeholder="Email" id="email" type="email"
                               v-model="searchData.email">
                    </div>
                </div>
                <!-- <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" v-model="searchData.role">
                            <option value="" selected disabled>Select Role</option>
                            <option value="ADMIN">Admin</option>
                            <option value="CLIENT">Client</option>
                            <option value="COUNSELOR">Counselor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 pull-right">
                    <button type="button" class="btn btn-outline-primary btn-block" @click="newUser()">Add User</button>
                </div> -->
                <div class="col-md-2 pull-right">
                    <button type="button" class="btn btn-outline-info btn-block" @click="search()">Search</button>
                </div>
            </div>
            <br>
            <br>
            <div class="row mt-5">
                <table class="table table-hover" v-if="results.length >= 1" style="table-layout: auto;">
                    <thead>
                    <tr>
                        <th scope="col" style="font-weight: bolder;"></th>
                        <th scope="col" style="font-weight: bolder;">Name</th>
                        <th scope="col" style="font-weight: bolder;">Email</th>
                        <th scope="col" style="font-weight: bolder;">Affiliate</th>
                        <th scope="col" style="font-weight: bolder;">Phone</th>
                        <!-- <th scope="col" style="font-weight: bolder;">Course</th>
                        <th scope="col" style="font-weight: bolder;">Year & Section</th> -->
                        <!-- <th scope="col" style="font-weight: bolder;">Role</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(result, index) in results" :key="index">
                        <td>
                            <div class="user">
                                <div class="photo" style="width: 70px; clip-path: circle();">
                                    <img :src="result.image" style="border-radius: 50%;">
                                </div>
                            </div>
                        </td>
                        <td style="vertical-align: middle;">
                            {{ result.name }}
                        </td>
                        <td style="vertical-align: middle;"> {{ result.email }}</td>
                        <td style="vertical-align: middle;"> {{ result.college }}</td>
                        <td style="vertical-align: middle;"> {{ result.phone }}</td>
                        <!-- <td style="vertical-align: middle;"> {{ result.course }}</td>
                        <td style="vertical-align: middle;"> {{ result.year_level }} - {{ result.section }}</td> -->
                        <!-- <td style="vertical-align: middle;">
                            <button class="btn btn-info btn-xs btn-fill" v-if="result.role === 'ADMIN'">
                                Admin
                            </button>
                            <button class="btn btn-success btn-xs btn-fill" v-if="result.role === 'COUNSELOR'">
                                Counselor
                            </button>
                            <button class="btn btn-warning btn-xs btn-fill" v-if="result.role === 'CLIENT'">
                                Client
                            </button>
                        </td> -->
                        <td style="vertical-align: middle;">
                            <div class="flex-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-outline-success mr-2" @click="view(result.id)">
                                        <i class="glyphicon fa fa-eye"></i>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-outline-danger mr-2" data-toggle="modal"
                                        data-target="#confirm-delete" @click="toDelete = result, prepareToDelete()">
                                        <i class="glyphicon fa fa-archive"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-hover" v-else>
                    <tbody>
                    <tr>
                        <td colspan="5" align="center"><i>Search no match found.</i></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="confirm-delete" data-backdrop="false">
                <div class="modal-dialog" style="margin-top: 200px;">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirm Archive</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="alert alert-success" v-if="apiResponse.show && apiResponse.success">
                                <strong>Success!</strong> {{ apiResponse.message }}
                            </div>
                            <div class="alert alert-danger" v-if="apiResponse.show && !apiResponse.success">
                                <strong>Warning!</strong> Oops, something went wrong. Please try again later.
                            </div>
                            <span v-if="!apiResponse.show">
                                Are you sure to archive {{ toDelete.name }} ({{ toDelete.role }})?
                            </span>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <div v-if="!apiResponse.show && !apiResponse.success">
                                <button type="button" class="btn btn-success" @click="softDelete(toDelete.id)">Yes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                            </div>
                            <div v-if="apiResponse.show && apiResponse.success">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="resetForm">
                                    Close
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="card-body" v-else>
            <div class="alert alert-warning" v-if="confirmPasswordError">
                <strong>Passwords do not match.</strong>
            </div>
            <div class="alert"
                 :class="{ 'alert-success' : apiResponse.success, 'alert-warning' : !apiResponse.success }"
                 v-if="apiResponse.show">
                <div v-if="!apiResponse.success">
                    <h4>Errors in Validation: </h4>
                    <div v-if="Array.isArray(apiResponse.message)">
                        <ul v-for="error in apiResponse.message">
                            <li>{{ error }}</li>
                        </ul>
                    </div>
                    <div v-else>
                        <li>{{ apiResponse.message }}</li>
                    </div>
                </div>
                <div v-else>
                    Success!
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <img class="twoByTwoPic float-right" :src="profile.image" alt="no saved image"
                         style="max-height: 200px; max-width: 200px; margin-bottom: 10px; border-radius: 50%;"
                         v-if="hasPicture">
                    <div class="form-group">
                        <label for="name">Image: </label>
                        <div class="custom-file">
                            <input type="file" class="form-control border ml-2" id="upload-picture"
                                   accept=".jpg,.jpeg,.png" @change="imgChange($event)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-2 mb-2">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input class="form-control" id="name" type="text" v-model="profile.name">
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <div class="form-group">
                        <label for="phone">Phone: </label>
                        <input class="form-control" id="phone" type="text" v-model="profile.phone">
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input class="form-control" id="email" type="text" v-model="profile.email">
                    </div>
                </div>
            </div>
            <div class="row mb-4" v-if="mode === 'create'">
                <div class="col-md-2 mb-2">
                    <div class="form-group">
                        <label for="name">Password: </label>
                        <input class="form-control" id="name" type="password" v-model="profile.password">
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <div class="form-group">
                        <label for="phone">Confirm Password: </label>
                        <input class="form-control" id="phone" type="password" v-model="profile.confirmPassword">
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="role">Role: </label>
                        <div class="select">
                            <select class="form-control form-select" id="role" v-model="profile.role">
                                <option value="ADMIN">ADMIN</option>
                                <option value="COUNSELOR">COUNSELOR</option>
                                <option value="CLIENT">CLIENT</option>
                            </select>
                            <span class="focus"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4" v-if="profile.role === 'COUNSELOR' || profile.role === 'CLIENT'">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="college">College: </label>
                        <div class="select">
                            <select class="form-control form-select" id="college" v-model="profile.college">
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
                            </select>
                            <span class="focus"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4" v-if="profile.role === 'CLIENT'">
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="student-id">Student ID: </label>
                        <input class="form-control" id="student-id" type="text" v-model="profile.student_id">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="course">Course: </label>
                        <input class="form-control" id="course" type="text" v-model="profile.course">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="year-level">Year Level: </label>
                        <input class="form-control" id="year-level" type="text" v-model="profile.year_level">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="section">Section: </label>
                        <input class="form-control" id="section" type="text" v-model="profile.section">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-block btn-outline-primary btn-md btn-block"
                                @click="save()">Save
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-info btn-md btn-block" @click="resetForm()">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {},
    components: {},
    data: function () {
        return {
            mode: 'create',
            image: null,
            isSearch: true,
            searchData: {
                name: '',
                email: '',
                role: 'COUNSELOR'
            },
            results: [],
            profile: {
                name: null,
                email: null,
                password: null,
                confirmPassword: null,
                profile_image: null,
                phone: null,
                college: null,
                student_id: null,
                course: null,
                section: null,
                year_level: null,
                role: null,
            },
            apiResponse: {
                data: null,
                success: false,
                show: false
            },
            hasPicture: false,
            file: null,
            confirmPasswordError: false,
            showError: false,
            toDelete: { name: '', role: '' },
            showModal: false,
        }
    },
    mounted () {
        this.search();
    },
    computed: {},
    methods: {
        search: function () {
            axios.post('/api/management/search', this.searchData)
                .then(response => {
                    this.results = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        newUser: function () {
            this.isSearch = false;
            this.mode = 'create';
            this.profile = {
                name: "",
                role: "",
                password: "",
                email: "",
                phone: null,
                profile_image: "",
                created_at: "",
                updated_at: ""
            };
        },
        view: function (id) {
            axios.get('/api/management/show/' + id)
                .then(response => {
                    this.profile = response.data;
                    this.isSearch = false;
                    this.hasPicture = true;
                    this.mode = 'view';
                })
                .catch(error => {
                    console.log(error);
                })
        },
        prepareToDelete: function () {
            this.apiResponse = {
                data: null,
                success: false,
                show: false
            }
        },
        softDelete: function (id) {
            axios.post('/api/management/delete/' + id)
                .then(response => {
                    this.apiResponse = {
                        response: response.data.response,
                        message: response.data.message,
                        success: response.data.success,
                        show: true
                    };
                    if (response.data.success) {
                        this.search();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        save: function () {
            let data = this.profile;
            if (this.profile.password === this.profile.confirmPassword) {
                this.confirmPasswordError = false;
                data.mode = this.mode;
                axios.post('/api/management/save', data)
                    .then(response => {
                        if (response.data.success) {
                            this.profile = response.data.response;
                            this.apiResponse = {
                                response: response.data.response,
                                message: response.data.message,
                                success: response.data.success,
                                show: true
                            };
                            this.isSearch = true;
                            this.upload();
                            this.search();
                        } else {
                            this.apiResponse = {
                                response: response.data,
                                message: response.data.message,
                                success: response.data.success,
                                show: true
                            };
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            } else {
                this.confirmPasswordError = true;
            }
        },
        imgChange(e) {
            this.file = e.target.files[0];
            this.profile.image = URL.createObjectURL(this.file);
            URL.revokeObjectURL(this.file);
            this.hasPicture = true;
        },
        upload: function () {
            let form = new FormData();

            let id = this.apiResponse.response.id ? this.apiResponse.response.id : this.profile.id;
            form.set('profileId', id);
            form.set('file', this.file);
            axios.post('/api/management/upload', form).then(response => {
            }).catch(error => {

            });
        },
        resetForm: function () {
            this.isSearch = true;
            this.image = null;
            this.hasPicture = false;
            this.file = null;
            this.toDelete = { name: '', role: '' }
        },
        closeModal: function () {
            this.showModal = false;
        },

    }


}
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}

[type="file"] {
    width: 50%;
    min-width: 14ch;
}

[type="file"]::file-selector-button {
    //width: 100%;
    //margin-inline-end: 0;
    //padding: 0.6rem;
    //background-color: lightblue;
    //color: smoke;
    //border: none;
    //border-radius: 0;
    //text-transform: uppercase;
}
</style>
