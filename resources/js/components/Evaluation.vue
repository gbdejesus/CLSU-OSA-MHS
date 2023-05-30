<template>
    <div ref="notifier">
        <div class="alert alert-success" v-if="apiResponse.show && apiResponse.success">
            <strong>Success!</strong> Your assessment has been successfully submitted.
        </div>
        <div class="alert alert-danger" v-if="apiResponse.show && !apiResponse.success">
            <strong>Warning!</strong> Oops, something went wrong. Please try again later.
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10" style="font-size: 20px; text-align: left;">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Question</th>
                        <th class="text-center">Disagree</th>
                        <th class="text-center">Neutral</th>
                        <th class="text-center">Agree</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(evaluation, index) in evaluations">
                        <td>{{ evaluation.description }}</td>
                        <td class="text-center">
                            <div class="form-check-inline">
                                <label class="form-check-label" style="font-size: 16px">
                                    <input type="radio" class="form-check-input"
                                           :name="'evaluation-'+evaluation.id + '-' + 'disagree'"
                                           :value="1"
                                           v-model="evaluation.answer">
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check-inline">
                                <label class="form-check-label" style="font-size: 16px">
                                    <input type="radio" class="form-check-input"
                                           :name="'evaluation-'+evaluation.id + '-' + 'neutral'"
                                           :value="2"
                                           v-model="evaluation.answer">
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check-inline">
                                <label class="form-check-label" style="font-size: 16px">
                                    <input type="radio" class="form-check-input"
                                           :name="'evaluation-'+evaluation.id + '-' + 'agree'"
                                           :value="3"
                                           v-model="evaluation.answer">
                                </label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-success mt-4 mb-3" style="width: 200px; padding: 20px; font-size: 15px;" @click="saveAssessment">
            Submit Assessment
        </button>
    </div>
</template>

<script>

export default {
    components: {},

    data: function () {
        return {
            evaluations: [],
            apiResponse: {
                data: null,
                success: false,
                show: false
            },
        }
    }
    ,
    props: {
        userId: {
            required: true
        }
    },

    mounted() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.getEvaluationItems();
    },
    methods: {
        getEvaluationItems: function () {
            axios.get('/api/items')
                .then(response => {
                    this.evaluations = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        saveAssessment: function () {
            this.scrollToTop();
            this.apiResponse.show = false;
            axios.post('/api/save', {
                userId: this.userId,
                data: this.evaluations
            })
                .then(response => {
                    this.apiResponse.data = response.data.data;
                    this.apiResponse.success = response.data.success;
                    this.apiResponse.show = true;
                    if (this.apiResponse.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        scrollToTop: function () {
            let to = this.moveToDown
                ? this.$refs.notifier.offsetTop - 60
                : 0

            window.scroll({
                top: to,
                left: 0,
                behavior: 'smooth'
            })

            this.moveToDown = !this.moveToDown
        }

    }


}
</script>

<style lang="scss" scoped>
.chat-app {
    display: flex;
}
</style>
