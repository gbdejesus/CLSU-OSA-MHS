<template>
    <div>
        <div class="card-body" v-if="isSearch">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input class="form-control" placeholder="Name" id="name" type="text" v-model="searchData.name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input class="form-control" placeholder="Email" id="email" type="email" v-model="searchData.email">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" v-model="searchData.role">
                            <option value="" selected disabled>Select Role</option>
                            <option value="ADMIN">Admin</option>
                            <option value="CLIENT">Client</option>
                            <option value="COUNSELOR">Counselor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary btn-block" @click="newUser()">Add User</button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-info btn-block" @click="search()">Search</button>
                </div>
            </div>
            <div class="row mt-5">
                <table class="table table-hover" v-if="results.length >= 1">
                    <thead>
                    <tr style="font-weight: bolder;">
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(result, index) in results" :key="index">
                        <td>
                            <img :src="result.profile_image" alt="" style="max-height: 100px;" v-if="result.profile_image">
                            <img :src="result.image" alt="" style="max-height: 100px;" v-else>
                        </td>
                        <td style="vertical-align: middle;"> {{ result.name }} </td>
                        <td style="vertical-align: middle;"> {{ result.email }} </td>
                        <td style="vertical-align: middle;">
                            <span class="badge" style="background: blue;" v-if="result.role === 'ADMIN'">
                                ADMIN
                            </span>
                            <span class="badge" style="background: green;" v-if="result.role === 'COUNSELOR'">
                                COUNSELOR
                            </span>
                            <span class="badge" style="background: yellow; color: black;" v-if="result.role === 'CLIENT'">
                                CLIENT
                            </span>
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="flex-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-block btn-outline-success mr-2" @click="view(result.id)">View</button>
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
        </div>
        <div class="card-body" v-else>
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Image: </label>
                        <div class="custom-file">
                            <img class="twoByTwoPic float-right" :src="profile.image" alt="no saved image" style="height: 200px; width: auto;" v-if="hasPicture">
                            <!--                            <label class="float-left" for="upload-picture">Image</label>-->
                            <input type="file" class="form-control-file border ml-2" id="upload-picture" accept=".jpg,.jpeg,.png" @change="imgChange($event)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input class="form-control" id="name" type="text" v-model="profile.name">
                    </div>
                </div>
                <div class="col-md-3 mb-2" v-if="!profile.id">
                    <div class="form-group">
                        <label for="name">Password: </label>
                        <input class="form-control" id="password" type="password" v-model="profile.password">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="middle-name">Email: </label>
                        <input class="form-control" id="email" type="text" v-model="profile.email">
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="middle-name">Role: </label>
                        <div class="select">
                            <select class="form-select" v-model="profile.role">
                                <option value="ADMIN">ADMIN</option>
                                <option value="COUNSELOR">COUNSELOR</option>
                                <option value="CLIENT">CLIENT</option>
                            </select>
                            <span class="focus"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="middle-name">Phone: </label>
                        <input class="form-control" id="phone" type="text" v-model="profile.phone">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-block btn-outline-primary btn-md btn-block" @click="save()">Save</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-info btn-md btn-block" @click="resetForm()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {},

    data: function () {
        return {
            image: null,
            isSearch: true,
            searchData: {
                name: '',
                email: '',
                role: ''
            },
            results: [],
            profile: {
                name: null,
                email: null,
                password: null,
                profile_image: null,
                phone: null,
                role: null,
            },
            apiResponse: {
                data: null,
                success: false,
                show: false
            },
            hasPicture: false,
            file: null,
        }
    }
    ,
    props: {},

    mounted() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.search();
    },
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
                })
                .catch(error => {
                    console.log(error);
                })
        },
        save: function () {

            axios.post('/api/management/save', this.profile)
                .then(response => {
                    if (response.data.success) {
                        this.profile = response.data.response;
                        this.apiResponse = {
                            response: response.data.response,
                            message: response.data.message,
                            success: response.data.success,
                            show: true
                        };
                        this.search();
                        alert('Update Success');
                    }
                    // this.profile = response.data.response;
                    this.isSearch = true;
                    if (this.apiResponse.success) {
                        this.upload();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        imgChange (e) {
            this.file = e.target.files[0];
            this.profile.image = URL.createObjectURL(this.file);
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
    width: 100%;
    margin-inline-end: 0;
    padding: 0.6rem;
    background-color: lightblue;
    color: smoke;
    border: none;
    border-radius: 0;
    text-transform: uppercase;
}
</style>
