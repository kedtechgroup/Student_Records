<template>
    <div>
        <div class="row" v-if="showCreateForm">
            <div class="col-md-6 offset-md-2">
                <form class="card" @submit.prevent="createTeacher">
                    <div class="card-header bg-transparent">
                        <h6 class="card-title">Add Teacher</h6>
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
                <form class="card" @submit.prevent="updateTeacher">
                    <div class="card-header bg-transparent">
                        <h6 class="card-title">Update Teacher Details</h6>
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

        <div class="row" v-if="!showCreateForm && !showUpdateForm">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-0">
                    <div class="card-header header-elements-sm-inline bg-transparent py-2">
                        <h6 class="card-title">Teachers</h6>
                        <div class="header-elements">
                            <button class="btn btn-sm btn-outline bg-indigo-400 text-indigo-400 border-indigo-400"
                                    @click.prevent="viewCreateForm">
                                <i class="icon-plus3"></i> Teachers
                            </button>


                        </div>

                    </div>

                    <my-vuetable api-url="/teachers"
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
                                           @click.prevent="viewUpdateForm(props.rowData, props.rowIndex)">
                                            <i class="icon-pencil6"></i> Update
                                        </a>

                                        <a href="#" class="dropdown-item"
                                           @click.prevent="deleteTeacher(props.rowData, props.rowIndex)">
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
                }),

                showCreateForm: false,
                showUpdateForm: false,

            }
        },

        methods: {
            hideForm() {
                this.showCreateForm = false;
                this.showUpdateForm = false;
                this.form.reset();
            },

            viewCreateForm() {
                this.showCreateForm = true;
            },

            viewUpdateForm(rowData) {
                this.form.populate(rowData);
                this.showUpdateForm = true;
            },

            createTeacher() {
                this.form.post('/teachers')
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            },

            updateTeacher() {
                this.form.put('/teachers/' + this.form.id)
                    .then(response => {

                        setTimeout(() => {
                            this.showUpdateForm = false;
                        }, 1500);

                        toast.success(response.message)
                    })
                    .catch(error => toast.error(error.response.data.message))
            },

            deleteTeacher(rowData) {
                window.httpClient.delete('/teachers/' + rowData.id)
                    .then(response => {
                        this.$refs.table.$refs.vuetable.reload();
                        toast.warning(response.data.message)
                    })
                    .catch(error => toast.error(error.response.data.message))
            }
        }
    }
</script>

<style scoped>

</style>
