<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <h3>CLIENTS</h3>
                <table class="table table-hover" style="table-layout: auto;">
                    <thead>
                    <tr>
                        <th scope="col" style="font-weight: bolder;"></th>
                        <th scope="col" style="font-weight: bolder;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="client in clients">
                        <td style="vertical-align: middle; text-transform: capitalize;">
                            {{ client.college }}
                        </td>
                        <td style="vertical-align: middle;"> {{ client.total }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">

                <h3>COUNSELORS</h3>
                <table class="table table-hover" style="table-layout: auto;">
                    <thead>
                    <tr>
                        <th scope="col" style="font-weight: bolder;"></th>
                        <th scope="col" style="font-weight: bolder;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="counselor in counselors">
                        <td style="vertical-align: middle; text-transform: capitalize;">
                            {{ counselor.college }}
                        </td>
                        <td style="vertical-align: middle;"> {{ counselor.total }}</td>
                    </tr>
                    </tbody>
                </table>
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
            clients: clientsCount,
            counselors: counselorsCount
        }
    },
    mounted () {},
    methods: {}


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
    font-size: 40px;
}
</style>
