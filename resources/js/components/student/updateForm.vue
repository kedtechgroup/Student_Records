<template>
    <div class="col-md-6 offset-md-2">
        <form class="card" @submit.prevent="updateStudent">
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
                    <v-select v-model="form.classes_id"
                              multiple
                              :options="classes"
                              label="name"
                              :reduce="option => option.id"
                    />

                    <span class="form-text text-danger"
                          v-if="form.errors.has('classes')"
                          v-text="form.errors.first('classes')">
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
</template>

<script>
    export default {
        props: {
            student: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                form: new Form({
                    id: '',
                    name: '',
                    dob: '',
                    email: '',
                    gender: '',
                    classes_id: []
                }),

                classes: [],

                gender: [
                    'MALE',
                    'FEMALE'
                ],
            }
        },

        mounted() {
            this.form.populate(this.student);
            this.getClasses();
        },

        methods: {
            getClasses() {
                window.httpClient.get('/classes')
                    .then(response => this.classes = response.data.data)
                    .catch(error => console.log(error))
            },

            updateStudent() {
                this.form.put('/students/' + this.form.id)
                    .then(response => toast.success(response.message))
                    .catch(error => toast.error(error.response.data.message))
            },

            onDateChange(date, dateStr) {
                this.form.dob = dateStr;
            },
        }
    }
</script>

<style scoped>

</style>
