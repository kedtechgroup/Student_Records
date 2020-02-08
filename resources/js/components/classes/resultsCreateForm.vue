<template>
    <div class="col-md-6 offset-md-2">
        <form class="card" @submit.prevent="createResults">
            <div class="card-header bg-transparent">
                <h6 class="card-title">Add Result</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="gender">Term</label>
                    <v-select v-model="resultForm.term_id"
                              :options="terms"
                              label="name"
                              :reduce="option => option.id"
                    />

                    <span class="form-text text-danger"
                          v-if="resultForm.errors.has('term_id')"
                          v-text="resultForm.errors.first('term_id')">
                    </span>

                </div>

                <div class="form-group">
                    <label for="gender">Exam</label>
                    <v-select v-model="resultForm.exam_id"
                              :options="exams"
                              label="name"
                              :reduce="option => option.id"
                    />

                    <span class="form-text text-danger"
                          v-if="resultForm.errors.has('exam_id')"
                          v-text="resultForm.errors.first('exam_id')">
                    </span>

                </div>

                <div class="form-group">
                    <label for="gender">Subject</label>
                    <v-select v-model="resultForm.subject_id"
                              :options="subjects"
                              label="name"
                              :reduce="option => option.id"
                    />

                    <span class="form-text text-danger"
                          v-if="resultForm.errors.has('subject_id')"
                          v-text="resultForm.errors.first('subject_id')">
                    </span>

                </div>

                <div class="form-group">
                    <label for="marks">Marks</label>
                    <input type="text" class="form-control" v-model="resultForm.marks" id="marks">

                    <span class="form-text text-danger"
                          v-if="resultForm.errors.has('marks')"
                          v-text="resultForm.errors.first('marks')">
                    </span>

                </div>


            </div>

            <div
                class="card-footer d-flex justify-content-between align-items-center ">

                <button type="submit" class="btn btn-outline-danger" @click.prevent="$emit('close-form')">
                    <i class="icon-cross2"></i> Cancel
                </button>

                <button type="submit" v-if="this.resultForm.processing"
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

        </form>
    </div>
</template>

<script>
    export default {
        props: {
            selectedClass: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                resultForm: new Form({
                    id: '',
                    subject_id: '',
                    term_id: '',
                    exam_id: '',
                    marks: '',
                    class_student_id: this.selectedClass.id
                }),

                subjects: [],
                terms: [],
                exams: [],

            }
        },

        mounted() {
            this.getSubjects();
            this.getTerms();
            this.getExams();
        },

        methods: {
            getSubjects() {
                window.httpClient.get('/subjects')
                    .then(response => this.subjects = response.data.data)
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

            createResults() {
                this.resultForm.post('/results')
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            }
        }
    }
</script>

<style scoped>

</style>
