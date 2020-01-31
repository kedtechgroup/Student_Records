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
    <ul class="pagination">
        <li :class="{'prev disabled': isOnFirstPage}">
            <a href="" class="page-link" @click.prevent="loadPage('prev')">
                <span>&laquo;</span>
            </a>
        </li>

        <template v-if="notEnoughPages">
            <li v-for="n in totalPage" :class="{'page-item active': isCurrentPage(n)}">
                <a class="page-link" @click.prevent="loadPage(n)" v-html="n"></a>
            </li>
        </template>
        <template v-else>
            <li v-for="n in windowSize" :class="{'page-item active': isCurrentPage(windowStart+n-1)}" >
                <a class="page-link" @click.prevent="loadPage(windowStart+n-1)" v-html="windowStart+n-1">Next</a>
            </li>
        </template>

        <li :class="{'page-item disabled': isOnLastPage}">
            <a href="" class="page-link" @click.prevent="loadPage('next')">
                <span>&raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
    import VuetablePaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin'

    export default {
        mixins: [VuetablePaginationMixin]
    }
</script>

