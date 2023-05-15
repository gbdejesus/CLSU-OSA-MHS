<template>
    <div ref="notifier">
        <div class="alert alert-success" v-if="apiResponse.show && apiResponse.success">
            <strong>Success!</strong> Your assessment has been successfully submitted.
        </div>
        <div class="alert alert-danger" v-if="apiResponse.show && !apiResponse.success">
            <strong>Warning!</strong> Oops, something went wrong. Please try again later.
        </div>
        <div v-for="(evaluation, index) in evaluations" style="margin-bottom: 15px;">
            <div class="form-check">
                <label class="form-label">
                    <h4> {{ index + 1 }}. {{ evaluation.description }} </h4>
                </label>
            </div>
            <div class="form-check-inline" v-for="option in evaluation.options">
                <label class="form-check-label" style="font-size: 16px">
                    <input type="radio" class="form-check-input"
                           :name="'evaluation-'+evaluation.id + '-' + option.label"
                           :value="option.value"
                           v-model="evaluation.answer">
                    {{ option.label }}
                </label>
            </div>
        </div>
        <button type="button" class="btn btn-success mt-4 mb-3" style="width: 200px;" @click="saveAssessment">
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
