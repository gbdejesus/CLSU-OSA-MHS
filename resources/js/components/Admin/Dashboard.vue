<template>
    <div>
        this is admin dashboard
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
body{
    margin-top:20px;
    background:#eee;
}
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');

body{
    background-color: #000;
    font-family: 'Open Sans', sans-serif;
}

.container h1{
    color: #fff;
    //text-align: center;
}

details {
    background-color: #d0db7247;
    color: #fff;
    font-size: 1.5rem;
    border-radius: 3px;
}

summary {
    padding: .5em 1.3rem;
    list-style: none;
    display: flex;
    justify-content: space-between;
    transition: height 1s ease;
}

summary::-webkit-details-marker {
    display: none;
}

summary:after {
    content: "\002B";
}

details[open] summary {
    border-bottom: 1px solid #aaa;
    margin-bottom: .5em;
}

details[open] summary:after {
    content: "\00D7";
}

details[open] div {
    padding: .5em 1em;
}
.faq-details {
    font-size: 16px;
}
</style>
