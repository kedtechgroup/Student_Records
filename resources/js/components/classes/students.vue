<template>
    <div>

        <ResultsViewerForm v-if="showResultsViewer"/>

        <div class="row" v-if="showResultsCreateForm">
            <results-create-form :selected-class="selectedStudentClass" @close-form="hideForm"/>
        </div>

        <div class="row" v-if="showCreateForm">
            <div class="col-md-6 offset-md-2">
                <form class="card" @submit.prevent="createStudent">
                    <div class="card-header bg-transparent">
                        <h6 class="card-title">Add Student</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="form.name" id="name">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('name')"
                                  v-text="form.errors.first('name')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="admission_no">Admission No</label>
                            <input type="text" class="form-control" v-model="form.admission_no" id="admission_no">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('admission_no')"
                                  v-text="form.errors.first('admission_no')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="example@example.com"
                                   v-model="form.email" id="email">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('email')"
                                  v-text="form.errors.first('email')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" v-model="form.gender" class="form-control">
                                <option value="MALE">MALE</option>
                                <option value="MALE">FEMALE</option>
                            </select>

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('gender')"
                                  v-text="form.errors.first('gender')">
                            </span>

                        </div>


                        <div class="form-group">
                            <label for="gender">Date Of Birth</label>
                            <date-picker :value="form.dob" @on-change="onDateChange"/>

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('dob')"
                                  v-text="form.errors.first('dob')">
                            </span>

                        </div>

                        <!--<div class="form-group">-->
                        <!--<label for="gender">Class</label>-->
                        <!--<v-select v-model="form.classes_id"-->
                        <!--:options="classes"-->
                        <!--label="name"-->
                        <!--:reduce="option => option.id"-->
                        <!--/>-->

                        <!--<span class="form-text text-danger"-->
                        <!--v-if="form.errors.has('gender')"-->
                        <!--v-text="form.errors.first('gender')">-->
                        <!--</span>-->

                        <!--</div>-->

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

                </form>
            </div>
        </div>

        <div class="row" v-if="showUpdateForm">
            <div class="col-md-6 offset-md-2">
                <form class="card" @submit.prevent="updateStudent">
                    <div class="card-header bg-transparent">
                        <h6 class="card-title">Update Student Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="form.name" id="name">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('name')"
                                  v-text="form.errors.first('name')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="admission_no">Admission No</label>
                            <input type="text" class="form-control" v-model="form.admission_no" id="admission_no">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('admission_no')"
                                  v-text="form.errors.first('admission_no')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="example@example.com"
                                   v-model="form.email" id="email">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('email')"
                                  v-text="form.errors.first('email')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" v-model="form.gender" class="form-control">
                                <option value="MALE">MALE</option>
                                <option value="MALE">FEMALE</option>
                            </select>

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('gender')"
                                  v-text="form.errors.first('gender')">
                            </span>

                        </div>


                        <div class="form-group">
                            <label for="gender">Date Of Birth</label>
                            <date-picker :value="form.dob" @on-change="onDateChange"/>

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('dob')"
                                  v-text="form.errors.first('dob')">
                            </span>

                        </div>

                        <!--<div class="form-group">-->
                        <!--<label for="gender">Class</label>-->
                        <!--<v-select v-model="form.classes_id"-->
                        <!--multiple-->
                        <!--:options="classes"-->
                        <!--label="name"-->
                        <!--:reduce="option => option.id"-->
                        <!--/>-->

                        <!--<span class="form-text text-danger"-->
                        <!--v-if="form.errors.has('classes')"-->
                        <!--v-text="form.errors.first('classes')">-->
                        <!--</span>-->

                        <!--</div>-->

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

                </form>
            </div>
        </div>

        <div class="row" v-if="!showCreateForm && !showUpdateForm && !showResultsCreateForm && !showResultsViewer">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-0">
                    <div class="card-header header-elements-sm-inline bg-transparent py-2">
                        <h6 class="card-title">Students</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#"
                                       data-toggle="dropdown"
                                       aria-expanded="false"
                                       class="list-icons-item dropdown-toggle"><i
                                        class="icon-menu7"></i></a>
                                    <div x-placement="bottom-start" class="dropdown-menu">
                                        <a @click.prevent="viewCreateForm" href="#" class="dropdown-item"> <i
                                            class="icon-user-plus"></i> Add Student </a>
                                        <div class="dropdown-divider"></div>

                                        <a @click.prevent="$emit('close-students')" href="#" class="dropdown-item"> <i
                                            class="icon-cross3"></i> Close </a>

                                    </div>
                                </div>
                            </div>

                            <!--<button class="btn btn-sm btn-outline bg-indigo-400 text-indigo-400 border-indigo-400"-->
                            <!--@click.prevent="viewCreateForm">-->

                            <!--</button>-->


                        </div>

                    </div>

                    <my-vuetable :api-url="url"
                                 :fields="fields"
                                 ref="table"
                                 :append-params="moreParams">

                        <template slot="name" slot-scope="props">
                            <div class="media">
                                <div class="mr-2">
                                    <a href="">
                                        <img src="/global_assets/images/placeholders/placeholder.jpg"
                                             width="40" height="40" class="rounded-circle" alt="">
                                    </a>
                                </div>

                                <div class="media-body align-self-center">
                                    <span class="font-weight-semibold">{{ props.rowData.student.name}}</span>
                                    <div class="text-muted font-size-sm">
                                        Admission No: {{ props.rowData.student.admission_no }}
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template slot="actions" slot-scope="props">
                            <div class="list-icons custom-actions">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown">
                                        <i class="icon-menu"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"
                                           @click.prevent="viewShowResultsCreateForm(props.rowData, props.rowIndex)">
                                            <i class="icon-plus3"></i> Enter Result
                                        </a>

                                        <a href="#" class="dropdown-item"
                                           @click.prevent="viewUpdateForm(props.rowData, props.rowIndex)">
                                            <i class="icon-pencil6"></i> Update
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="#" class="dropdown-item"
                                           @click.prevent="viewResults(props.rowData, props.rowIndex)">
                                            <i class="icon-eye4"></i> View Results
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="#" class="dropdown-item"
                                           @click.prevent="deleteStudent(props.rowData, props.rowIndex)">
                                            <i class="icon-trash text-danger"></i> Delete
                                        </a>

                                    </div>
                                </div>
                            </div>

                        </template>
                    </my-vuetable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ResultsCreateForm from './resultsCreateForm'
    import ResultsViewerForm from './resultsViewerForm'

    export default {
        components: {
            ResultsCreateForm,
            ResultsViewerForm
        },

        props: {
            selectedClass: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                url: '/classes/' + this.selectedClass.id + '/students',

                fields: [
                    {
                        name: '__sequence',
                        title: '#',
                        titleClass: 'text-right',
                        dataClass: 'text-right',
                    },
                    {
                        name: '__slot:name',
                    },
                    {
                        name: 'student.gender',
                        title: 'Gender'
                    },
                    {
                        name: 'student.email',
                        title: 'Email'
                    },
                    {
                        name: 'student.dob',
                        title: 'Date of Birth'
                    },

                    {
                        name: '__slot:actions',
                        title: '',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    }
                ],

                moreParams: {},

                form: new Form({
                    id: '',
                    name: '',
                    dob: '',
                    email: '',
                    gender: '',
                    classes_id: [],
                    admission_no: ''
                }),

                showCreateForm: false,
                showResultsCreateForm: false,
                showUpdateForm: false,
                showResultsViewer: false,

                classes: [],

                subjects: [],

                gender: [
                    'MALE',
                    'FEMALE'
                ],

                selectedStudentClass: {}
            }
        },

        mounted() {
            this.getClasses();
        },

        methods: {
            hideForm() {
                this.showCreateForm = false;
                this.showUpdateForm = false;
                this.showResultsCreateForm = false;
                this.form.reset();
                this.resultForm.reset();
            },

            viewCreateForm() {
                this.form.classes_id.push(this.selectedClass.id);
                this.showCreateForm = true;
            },

            viewShowResultsCreateForm(rowData) {
                Object.assign(this.selectedStudentClass, rowData);
                this.showResultsCreateForm = true;
            },

            viewUpdateForm(rowData) {

                this.form.populate(rowData.student);

                this.showUpdateForm = true;
            },

            viewResults(rowData) {
                this.showResultsViewer = true;
            },

            getClasses() {
                window.httpClient.get('/classes')
                    .then(response => this.classes = response.data.data)
                    .catch(error => console.log(error))
            },

            onDateChange(date, dateStr) {
                this.form.dob = dateStr;
            },

            createStudent() {
                this.form.post('/students')
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            },

            createResult() {
                this.resultForm.post('/results')
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            },

            updateStudent() {
                this.form.put('/students/' + this.form.id)
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            },

            deleteStudent(rowData) {
                window.httpClient.delete('/students/' + rowData.id)
                    .then(response => {
                        this.$refs.table.$refs.vuetable.reload();
                        toast.success(response.data.message)
                    })
                    .catch(error => toast.error(error.response.data.message))
            },

        }
    }
</script>

<style scoped>

</style>
