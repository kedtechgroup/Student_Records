<template>
    <div class="row">
        <div class="col-md-6 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="gender">Year</label>
                        <v-select v-model="form.year_id"
                                  label="name"
                                  :options="years"
                                  :reduce="option => option.id"
                        />

                        <span class="form-text text-danger"
                              v-if="form.errors.has('year_id')"
                              v-text="form.errors.first('year_id')">
                        </span>

                    </div>

                    <div class="form-group">
                        <label for="gender">Term</label>
                        <v-select v-model="form.term_id"
                                  label="name"
                                  :options="terms"
                                  :reduce="option => option.id"
                        />

                        <span class="form-text text-danger"
                              v-if="form.errors.has('gender')"
                              v-text="form.errors.first('gender')">
                         </span>

                    </div>

                    <div class="form-group">
                        <label for="gender">Exam</label>
                        <v-select v-model="form.exam_id"
                                  label="name"
                                  :options="exams"
                                  :reduce="option => option.id"
                        />

                        <span class="form-text text-danger"
                              v-if="form.errors.has('exam_id')"
                              v-text="form.errors.first('exam_id')">
                        </span>

                    </div>
                </div>

                <div
                    class="card-footer d-flex justify-content-between align-items-center ">

                    <button type="submit" class="btn btn-outline-danger" @click.prevent="hideForm">
                        <i class="icon-cross2"></i> Cancel
                    </button>

                    <button type="submit" v-if="this.form.processing"
                            class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400">
                        Processing...
                        <i class="icon-spinner3 spinner ml-2"></i>
                    </button>

                    <button type="submit" v-else
                            class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400">
                        Submit
                        <i class="icon-paperplane ml-2"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    year_id: '',
                    term_id: '',
                    exam_id: ''
                }),

                years: [],
                terms: [],
                exams: []
            }
        },

        mounted() {
            this.getYears();
            this.getTerms();
            this.getExams();
        },

        methods: {
            getYears() {
                window.httpClient.get('/years')
                    .then(response => this.years = response.data.data)
                    .catch(error => console.log(error))
            },

            getTerms() {
                window.httpClient.get('/terms')
                    .then(response => this.terms = response.data.data)
                    .catch(error => console.log(error))
            },

            getExams() {
                window.httpClient.get('/exams')
                    .then(response => this.exams = response.data.data)
                    .catch(error => console.log(error))
            },
        }

    }
</script>

<style scoped>

</style>
