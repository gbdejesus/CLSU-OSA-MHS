<template>
    <div>
        <div class="container">
            <div class="text-center" v-if="loading">
                <div class="spinner-grow" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row justify-content-center" v-if="!loading">
                <div class="col-12 col-sm-8 col-lg-6" style="font-family: 'General Sans', sans-serif;">
                    <!-- Section Heading-->
                    <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h2>CLSU Mental Health Providers</h2>
                        <p style="font-size: 16px;">The Guidance Services Unit of OSA is providing online and telecounseling services for all CLSU students.
                            Counselors and mental health professionals can be reached by students through this website.<br><br></p>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="!loading">
                <!-- Single Advisor-->
                <div class="col-12 col-sm-6 col-lg-3" v-for="(counselor, index) in counselors" data-backdrop="static"
                     type="button" data-toggle="modal" data-target="#select-counselor">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Team Thumb-->
                        <div class="advisor_thumb">
                            <img :src="counselor.image" :alt="counselor.name" style="height: 200px; width: 200px;">
                        </div>
                        <!-- Team Details-->
                        <div class="single_advisor_details_info">
                            <h6>{{ counselor.name }}</h6>
                            <p class="designation"> {{ counselor.email }} </p>
                            <p class="designation"> {{ counselor.college }} </p>
                            <p class="designation"> {{ counselor.phone }} </p>
                        </div>
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
            counselors: [],
            evaluations: [],
            apiResponse: {
                data: null,
                success: false,
                show: false
            },
            loading: true,
            selectedCounselor: {
                name: ''
            },

        }
    },
    mounted() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.getCounselors();
    },
    methods: {
        getCounselors: function () {
            axios.get('/api/counselors')
                .then(response => {
                    this.counselors = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                })
        },
    }


}
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}
body {
    margin-top:20px;
    background:#eee;
}
.single_advisor_profile {
    cursor: pointer;
    position: relative;
    margin-bottom: 50px;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    z-index: 1;
    border-radius: 15px;
    -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
    box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
}
.single_advisor_profile .advisor_thumb {
    position: relative;
    z-index: 1;
    border-radius: 15px 15px 0 0;
    margin: 0 auto;
    padding: 30px 30px 0 30px;
    background-color: #fcd602;
    overflow: hidden;
}
.single_advisor_profile .advisor_thumb::after {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    position: absolute;
    width: 150%;
    height: 80px;
    bottom: -45px;
    left: -25%;
    content: "";
    background-color: #ffffff;
    -webkit-transform: rotate(-15deg);
    transform: rotate(-15deg);
}
@media only screen and (max-width: 575px) {
    .single_advisor_profile .advisor_thumb::after {
        height: 160px;
        bottom: -90px;
    }
}
.single_advisor_profile .advisor_thumb .social-info {
    position: absolute;
    z-index: 1;
    width: 100%;
    bottom: 0;
    right: 30px;
    text-align: right;
}
.single_advisor_profile .advisor_thumb .social-info a {
    font-size: 14px;
    color: #020710;
    padding: 0 5px;
}
.single_advisor_profile .advisor_thumb .social-info a:hover,
.single_advisor_profile .advisor_thumb .social-info a:focus {
    color: #fcd602;
}
.single_advisor_profile .advisor_thumb .social-info a:last-child {
    padding-right: 0;
}
.single_advisor_profile .single_advisor_details_info {
    height: 160px;
    position: relative;
    z-index: 1;
    padding: 20px;
    text-align: right;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    border-radius: 0 0 15px 15px;
    background-color: #ffffff;
    color: black;
}
.single_advisor_profile .single_advisor_details_info::after {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    position: absolute;
    z-index: 1;
    width: 50px;
    height: 3px;
    background-color: #fcd602;
    content: "";
    top: 12px;
    right: 30px;
}
.single_advisor_profile .single_advisor_details_info h6 {
    margin-bottom: 0.25rem;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
}
@media only screen and (min-width: 768px) and (max-width: 991px) {
    .single_advisor_profile .single_advisor_details_info h6 {
        font-size: 14px;
    }
}
.single_advisor_profile .single_advisor_details_info p {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    margin-bottom: 0;
    font-size: 14px;
}
@media only screen and (min-width: 768px) and (max-width: 991px) {
    .single_advisor_profile .single_advisor_details_info p {
        font-size: 12px;
    }
}
.single_advisor_profile:hover .advisor_thumb::after,
.single_advisor_profile:focus .advisor_thumb::after {
    background-color: #14964c;
}
.single_advisor_profile:hover .advisor_thumb .social-info a,
.single_advisor_profile:focus .advisor_thumb .social-info a {
    color: #ffffff;
}
.single_advisor_profile:hover .advisor_thumb .social-info a:hover,
.single_advisor_profile:hover .advisor_thumb .social-info a:focus,
.single_advisor_profile:focus .advisor_thumb .social-info a:hover,
.single_advisor_profile:focus .advisor_thumb .social-info a:focus {
    color: #ffffff;
}
.single_advisor_profile:hover .single_advisor_details_info,
.single_advisor_profile:focus .single_advisor_details_info {
    background-color: #14964c;
}
.single_advisor_profile:hover .single_advisor_details_info::after,
.single_advisor_profile:focus .single_advisor_details_info::after {
    background-color: #ffffff;
}
.single_advisor_profile:hover .single_advisor_details_info h6,
.single_advisor_profile:focus .single_advisor_details_info h6 {
    color: #ffffff;
}
.single_advisor_profile:hover .single_advisor_details_info p,
.single_advisor_profile:focus .single_advisor_details_info p {
    color: #ffffff;
}
clsu-osa-info { color: #7c795d; font-family: 'Trocchi', serif; font-size: 45px; font-weight: normal; line-height: 48px; margin: 0; }
</style>
