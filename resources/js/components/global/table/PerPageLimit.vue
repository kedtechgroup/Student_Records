<!--
  - Copyright (c) 2020.  medic@medic.org
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
    <div class="dataTables_length" id="DataTables_Table_0_length">
        <label><span>Show:</span>
            <select name="DataTables_Table_0_length"
                    aria-controls="DataTables_Table_0"
                    v-model="perPage"
                    @change="changeLimit"
                    aria-hidden="true">
                <option v-for="l in limits" v-bind:value="l"> {{ l }} </option>
            </select>
        </label>
    </div>
</template>


<script>

    export default {
        data() {
            return {
                perPage: 50,

                limits: [25, 50, 75, 100, 200]
            }
        },

        methods: {
            changeLimit() {
                this.$emit('limit-changed', this.perPage)
            }
        }
    }
</script>

<style scoped>

</style>
