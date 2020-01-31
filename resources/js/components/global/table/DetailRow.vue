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
    <div @click="onClick">
        <div class="inline field">
            <label>Name: </label>
            <span>{{rowData.name}}</span>
        </div>
        <div class="inline field">
            <label>Email: </label>
            <span>{{rowData.email}}</span>
        </div>
        <div class="inline field">
            <label>Nickname: </label>
            <!--<span>{{rowData.nickname}}</span>-->
        </div>
        <div class="inline field">
            <label>Birthdate: </label>
            <!--<span>{{rowData.birthdate}}</span>-->
        </div>
        <div class="inline field">
            <label>Gender: </label>
            <!--<span>{{rowData.gender}}</span>-->
        </div>
    </div>
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
        methods: {
            onClick (event) {
                console.log('my-detail-row: on-click', event.target)
            }
        },
    }
</script>

<style scoped>

</style>
