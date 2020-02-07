<template>
    <div class="col-md-6 offset-md-2">
        <form class="card" @submit.prevent="updateClass">
            <div class="card-header bg-transparent">
                <h6 class="card-title">Update Class Details</h6>
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

                <button type="submit" class="btn btn-outline-danger" @click.prevent="$emit('close-form')">
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
            classes: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                form: new Form({
                    id: '',
                    name: '',
                    stream_id: '',
                    // teacher_id: '',
                    code: ''
                }),

                // classes: [],
                streams: [],
                teachers: []
            }
        },

        created() {
            this.getStreams();
            // this.getTeachers();

            this.form.populate(this.classes);
            this.form.stream_id = this.classes.stream.id;
            this.form.teacher_id = this.classes.teacher.id
        },

        methods: {
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

            updateClass() {
                this.form.put('/classes/' + this.form.id)
                    .then(response => {
                        toast.success(response.message);
                        setTimeout(() => {
                            this.$emit('close-form');
                        }, 2000);

                    })
                    .catch(error => toast.error(error.response.data.message))
            },

        }
    }
</script>

<style scoped>

</style>
