<template>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card mb-0">
                <div class="card-header header-elements-sm-inline bg-transparent py-2">
                    <h6 class="card-title">Students</h6>
                    <div class="header-elements">
                        <div class="list-icons ml-3">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false"></a>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="#" class="dropdown-item" @click.prevent="showForm"><i
                                        class="icon-plus3"></i> Add Student </a>
                                </div>
                            </div>
                        </div>

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
                                       @click.prevent="showBranchForm(props.rowData, props.rowIndex)">
                                        <i class="icon-plus3"></i> Add Branch
                                    </a>

                                </div>
                            </div>
                        </div>

                    </template>
                </my-vuetable>
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
                        name: 'updated_at',
                        title: 'Updated'
                    },
                    {
                        name: '__slot:actions',
                        title: '',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    }
                ],

                moreParams: {},
            }
        },

        method: {}
    }
</script>

<style scoped>

</style>
