<template>
    <div>
        <students :selected-class="selectedClass" v-if="showStudents" @close-students="hideForm"/>

        <div class="row" v-if="showCreateForm">
            <div class="col-md-6 offset-md-2">
                <form class="card" @submit.prevent="createClass">
                    <div class="card-header bg-transparent">
                        <h6 class="card-title">Add Class</h6>
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
                            <label for="code">Code</label>
                            <input type="text" class="form-control" v-model="form.code" id="code">

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('code')"
                                  v-text="form.errors.first('code')">
                            </span>

                        </div>

                        <div class="form-group">
                            <label for="gender">Stream</label>
                            <v-select v-model="form.stream_id"
                                      :options="streams"
                                      label="name"
                                      :reduce="option => option.id"
                            />

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('stream_id')"
                                  v-text="form.errors.first('stream_id')">
                                </span>

                        </div>

                        <!--<div class="form-group">-->
                        <!--<label for="gender">Teacher</label>-->
                        <!--<v-select v-model="form.teacher_id"-->
                        <!--:options="teachers"-->
                        <!--label="name"-->
                        <!--:reduce="option => option.id"-->
                        <!--/>-->

                        <!--<span class="form-text text-danger"-->
                        <!--v-if="form.errors.has('teacher_id')"-->
                        <!--v-text="form.errors.first('teacher_id')">-->
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
            <update-form :classes="selectedClass" @close-form="hideForm"/>
        </div>

        <div class="row" v-if="!showCreateForm && !showUpdateForm && !showStudents">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-0">
                    <div class="card-header header-elements-sm-inline bg-transparent py-2">
                        <h6 class="card-title">Classes</h6>
                        <div class="header-elements">
                            <div data-v-69ae6ed4="" class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#"
                                       data-toggle="dropdown"
                                       aria-expanded="false"
                                       class="list-icons-item dropdown-toggle"><i
                                        class="icon-menu7"></i></a>
                                    <div x-placement="bottom-start" class="dropdown-menu">
                                        <a @click.prevent="viewCreateForm" href="#" class="dropdown-item"> <i
                                            class="icon-plus3"></i> Add Class </a>
                                        <a @click.prevent="viewCreateForm" href="#" class="dropdown-item"> <i
                                            class="icon-user-plus"></i> Add Student </a>
                                        <div class="dropdown-divider"></div>

                                    </div>
                                </div>
                            </div>

                            <!--<button class="btn btn-sm btn-outline bg-indigo-400 text-indigo-400 border-indigo-400"-->
                            <!--@click.prevent="viewCreateForm">-->

                            <!--</button>-->


                        </div>

                    </div>

                    <my-vuetable api-url="/classes"
                                 :fields="fields"
                                 ref="table"
                                 :append-params="moreParams">

                        <template slot="actions" slot-scope="props">
                            <div class="list-icons custom-actions">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0"
                                       data-toggle="dropdown">
                                        <i class="icon-menu"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a @click.prevent="viewStudentsTable(props.rowData)" href="#"
                                           class="dropdown-item"> <i
                                            class="icon-eye4"></i> View Students </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="#" class="dropdown-item"
                                           @click.prevent="viewUpdateForm(props.rowData, props.rowIndex)">
                                            <i class="icon-pencil6"></i> Update
                                        </a>

                                        <a href="#" class="dropdown-item"
                                           @click.prevent="deleteClass(props.rowData, props.rowIndex)">
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
    import UpdateForm from './updateForm'
    import Students from './students'

    export default {
        components: {
            UpdateForm,
            Students
        },

        data() {
            return {
                fields: [
                    {
                        name: '__sequence',
                        title: '#',
                        titleClass: 'text-right',
                        dataClass: 'text-right',
                    },
                    {
                        name: 'name',
                    },
                    {
                        name: 'code',
                    },
                    {
                        name: 'stream.name',
                        title: 'Stream'
                    },
                    {
                        name: 'student_count',
                        title: 'Students',
                        titleClass: 'text-right',
                        dataClass: 'text-right',
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
                    code: '',
                    stream_id: '',
                    teacher_id: '',
                }),

                showCreateForm: false,
                showUpdateForm: false,
                showStudents: false,

                classes: [],
                streams: [],
                teachers: [],

                selectedClass: {}
            }
        },

        mounted() {
            this.getStreams();
            this.getTeachers();
        },

        methods: {
            hideForm() {
                this.showCreateForm = false;
                this.showUpdateForm = false;
                this.showStudents = false;
                this.form.reset();
            },

            viewCreateForm() {
                this.showCreateForm = true;
            },

            viewUpdateForm(rowData) {
                Object.assign(this.selectedClass, rowData);

                this.showUpdateForm = true;
            },

            viewStudentsTable(rowData) {
                Object.assign(this.selectedClass, rowData);
                this.showStudents = true;
            },

            getStreams() {
                window.httpClient.get('/streams')
                    .then(response => this.streams = response.data.data)
                    .catch(error => console.log(error))
            },

            getTeachers() {
                window.httpClient.get('/teachers')
                    .then(response => this.teachers = response.data.data)
                    .catch(error => console.log(error))
            },


            onDateChange(date, dateStr) {
                this.form.dob = dateStr;
            },

            createClass() {
                this.form.post('/classes')
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            },


            deleteClass(rowData) {
                window.httpClient.delete('/classes/' + rowData.id)
                    .then(response => {
                        this.$refs.table.$refs.vuetable.reload();
                        toast.success(response.data.message)
                    })
                    .catch(error => toast.error(error.response.data.message))
            }
        }
    }
</script>

