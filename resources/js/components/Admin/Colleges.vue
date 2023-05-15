<template>
    <div>
        this is user colleges
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
