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

    <div class="dataTables_filter">
        <label>
            <span>Filter:</span>

            <input type="text"
                   v-model="filterText"
                   class="form-control"
                   @keyup.enter="doFilter"
                   placeholder="Type to filter...">
        </label>
        <button class="btn btn-sm btn-primary" @click.prevent="doFilter">Search</button>
<!--        <button class="btn btn-sm btn-default" @click.prevent="resetFilter">Reset</button>-->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                filterText: ''
            }
        },
        methods: {
            doFilter() {
                this.$emit('filter-set', this.filterText);
            },
            resetFilter() {
                this.filterText = '';
                this.$emit('filter-reset')
            }
        }
    }
</script>
<style>
    .filter-bar {
        padding: 10px;
    }
</style>
