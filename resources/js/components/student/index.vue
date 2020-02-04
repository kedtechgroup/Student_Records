<template>
    <div>
        <div class="row" v-if="showCreateForm">
            <div class="col-md-6 offset-md-2">
                <form class="card" @submit.prevent="createStudent">
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

                        <div class="form-group">
                            <label for="gender">Class</label>
                            <select name="gender" id="gender" v-model="form.class_id" class="form-control">
                                <option value="MALE" v-for="c in classes" v-bind:value="c.id"> {{ c.name }}</option>

                            </select>

                            <span class="form-text text-danger"
                                  v-if="form.errors.has('gender')"
                                  v-text="form.errors.first('gender')">
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

                </form>
            </div>
        </div>
        <div class="row" v-if="!showCreateForm">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-0">
                    <div class="card-header header-elements-sm-inline bg-transparent py-2">
                        <h6 class="card-title">Students</h6>
                        <div class="header-elements">
                            <button class="btn btn-sm btn-outline bg-indigo-400 text-indigo-400 border-indigo-400"
                                    @click.prevent="viewCreateForm">
                                <i class="icon-user-plus"></i> Student
                            </button>


                        </div>

                    </div>

                    <my-vuetable api-url="/students"
                                 :fields="fields"
                                 ref="table"
                                 :append-params="moreParams">

                        <template slot="actions" slot-scope="props">
                            <div class="list-icons custom-actions">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown">
                                        <i class="icon-menu"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"
                                           @click.prevent="edit(props.rowData, props.rowIndex)">
                                            <i class="icon-pencil6"></i> Update
                                        </a>

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
    export default {

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
                        name: 'gender',
                    },

                    {
                        name: 'email'
                    },
                    {
                        name: 'dob',
                        title: 'Date of Birth'
                    },
                    {
                        name: 'status'
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
                    name: '',
                    dob: '',
                    email: '',
                    gender: '',
                    class_id: ''
                }),

                showCreateForm: false,

                classes: [],
            }
        },

        mounted() {
            this.getClasses();
        },

        methods: {
            hideForm() {
                this.showCreateForm = false;
                this.form.reset();
            },

            viewCreateForm() {
                this.showCreateForm = true;
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
            }
        }
    }
</script>

<style scoped>

</style>
