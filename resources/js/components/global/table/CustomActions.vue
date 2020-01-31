<!--
  - Copyright (c) 2019.  medic@medic.org
  -
  - This file is part of Medic.
  -
  - Medic is free software: you can redistribute it and/or modify
  -  it under the terms of the GNU General Public License as published by
  -  the Free Software Foundation, either version 3 of the License, or
  -  (at your option) any later version.
  -
  -  Medic is distributed in the hope that it will be useful,
  -  but WITHOUT ANY WARRANTY; without even the implied warranty of
  -  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  -  GNU General Public License for more details.
  -
  -  You should have received a copy of the GNU General Public License
  -  along with Medic. If not, see <http://www.gnu.org/licenses/>.
  -->
<template>
    <div class="list-icons custom-actions">
        <div class="list-icons-item dropdown">
            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown">
                <i class="icon-menu"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">VIEW</div>

                <a href="#"
                   class="dropdown-item"
                   @click.prevent="viewLoginHistory(rowData, rowIndex) ">
                    <i class="icon-enter2"></i> Login History
                </a>

                <a href="#"
                   class="dropdown-item"
                   @click.prevent="itemAction('view-item', rowData, rowIndex)">
                    <i class="icon-history"></i> Audit Trail
                </a>

                <div class="dropdown-header">MANAGE</div>
                <a href="#"
                   class="dropdown-item"
                   @click="updateUser(rowData, rowIndex) ">
                    <i class="icon-user"></i>Details
                </a>
                <a href="#" class="dropdown-item"><i class="icon-key"></i> Permission</a>

                <a href="#"
                   class="dropdown-item"
                   @click="resetPassword(rowData, rowIndex) ">
                    <i class="icon-unlocked"></i> Reset Password
                </a>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-danger"><i class="icon-user-block"></i> Deactivate</a>
                <a href="#" class="dropdown-item text-danger"><i class="icon-trash"></i> Delete</a>
            </div>
        </div>
    </div>

    <!--<div class="custom-actions">-->
    <!--<button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="icon icon-pen"></i></button>-->
    <!--<button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="icon icon-pen"></i></button>-->
    <!--<button class="btn btn-sm" @click="itemAction('delete-item', rowData, rowIndex)"><i class="icon icon-pen"></i></button>-->
    <!--</div>-->
</template>

<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            },
            rowIndex: {
                type: Number
            }
        },
        mounted() {
            console.log('hi')
        },
        methods: {
            itemAction(action, data, index) {
                console.log('custom-actions: ' + action, data.name, index)
            },

            updateUser(rowData, rowIndex) {
                window.open('/users/' + rowData.id + '/edit');
            }
            ,
            viewLoginHistory(rowData, rowIndex) {
                window.open('/users/' + rowData.id + '/login-history');
            },

            resetPassword(rowData, rowIndex) {
                window.httpClient.post('/users/' + rowData.id + '/default-password')
                    .then(resp => toast.success(resp.data.success.message))
                    .catch(error => {
                        toast.error('Something went wrong: ' + error)
                    });
            }
        }
    }
</script>

<style>
    .custom-actions button.ui.button {
        padding: 8px 8px;
    }

    .custom-actions button.ui.button > i.icon {
        margin: auto !important;
    }
</style>
