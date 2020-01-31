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
    <div>
        <div class="datatable-header">

            <filter-bar v-on:filter-set="onFilterSet"
                        v-on:filter-reset="onFilterReset"
            />

            <per-page v-on:limit-changed="onLimitSet"/>

        </div>
        <vuetable ref="vuetable"
                  :api-url="apiUrl"
                  :http-fetch="httpFetch"
                  :fields="fields"
                  pagination-path=""
                  :perPage="perPage"
                  :row-class="onRowClass"
                  :css="css.table"
                  :sort-order="sortOrder"
                  :multi-sort="true"
                  :detail-row-component="detailRowComponent"
                  :append-params="appendParams"
                  @vuetable:cell-clicked="onCellClicked"
                  @vuetable:pagination-data="onPaginationData">
            <template :slot="slotName" slot-scope="props"
                      v-for="slotName in $scopedSlots?Object.keys($scopedSlots):null">

                <slot :name="slotName"
                      :row-data="props.rowData"
                      :row-index="props.rowIndex"
                      :row-field="props.rowField">
                </slot>

            </template>

        </vuetable>

        <div class="datatable-footer">
            <vuetable-pagination-info ref="paginationInfo"/>

            <vuetable-pagination-bootstrap
                ref="pagination"
                :css="css.pagination"
                class="dataTables_paginate paging_simple_numbers"
                @vuetable-pagination:change-page="onChangePage"
            />

        </div>

    </div>

</template>

<script>
    import Vuetable from 'vuetable-2'
    import VuetablePaginationBootstrap from './VuetablePagination'
    import VuetablePaginationInfo from './VuetablePaginationInfo'
    import CssConfig from './VuetableCssConfig'
    import CustomActions from './CustomActions'
    import FilterBar from './FilterBar'
    import DetailRow from './DetailRow'
    import PerPageLimit from './PerPageLimit'

    Vue.component('custom-actions', CustomActions);
    Vue.component('my-detail-row', DetailRow);
    Vue.component('filter-bar', FilterBar);
    Vue.component('per-page', PerPageLimit);

    export default {
        components: {
            Vuetable,
            VuetablePaginationBootstrap,
            VuetablePaginationInfo,
        },

        props: {
            // perPage: {
            //     default() {
            //         return 40
            //     },
            // },
            apiUrl: {
                type: String,
                required: true
            },
            fields: {
                type: Array,
                required: true
            },
            sortOrder: {
                type: Array,
                default() {
                    return []
                }
            },
            appendParams: {
                type: Object,
                default() {
                    return {}
                }
            },
            onRowClass: {
                default() {
                    return null
                }
            },
            detailRowComponent: {
                type: String
            }
        },

        data() {
            return {
                css: CssConfig,
                perPage: 50,
                // appendParams: {}
                // moreParams: {}  // <----
            }
        },

        render(h) {
            return h(
                'div',
                {
                    class: {ui: true, container: true}
                },
                [
                    h('filter-bar'),
                    this.renderVuetable(h),
                    this.renderPagination(h)
                ]
            )
        },

        mounted() {
            this.$on('filter-set', eventData => this.onFilterSet(eventData));
            this.$on('filter-reset', eventData => this.onFilterReset(eventData));
            this.$on('limit-changed', eventData => this.onLimitSet(eventData));
        },

        methods: {
            renderVuetable(h) {
                return h(
                    'vuetable',
                    {
                        ref: 'vuetable',
                        props: {
                            apiUrl: this.apiUrl,
                            fields: this.fields,
                            paginationPath: "",
                            perPage: this.perPage,
                            multiSort: true,
                            sortOrder: this.sortOrder,
                            appendParams: this.appendParams,
                            detailRowComponent: this.detailRowComponent,
                            css: this.css.table,
                        },
                        on: {
                            'vuetable:cell-clicked': this.onCellClicked,
                            'vuetable:pagination-data': this.onPaginationData,
                        },
                        scopedSlots: this.$vnode.data.scopedSlots
                    }
                );
            },

            renderPagination(h) {
                return h(
                    'div',
                    {class: {'vuetable-pagination': true}},
                    [
                        h('vuetable-pagination-info', {ref: 'paginationInfo', props: {css: this.css.paginationInfo}}),
                        h('vuetable-pagination-bootstrap', {
                            ref: 'pagination',
                            // class: {'pull-right': true},
                            props: {},
                            on: {
                                'vuetable-pagination:change-page': this.onChangePage
                            }
                        })
                    ]
                )
            },

            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData);
                this.$refs.paginationInfo.setPaginationData(paginationData);

            },

            onChangePage(page) {
                this.$refs.vuetable.changePage(page)
            },

            onCellClicked(data, field, event) {
                // console.log('cellClicked: ', field.name);
                this.$refs.vuetable.toggleDetailRow(data.id)
            },

            onFilterSet(filterText) {
                this.appendParams.filter = filterText;
                Vue.nextTick(() => this.$refs.vuetable.refresh())
            },

            onFilterReset() {
                delete this.appendParams.filterText;
                this.$refs.vuetable.refresh()
                // Vue.nextTick(() => this.$refs.vuetable.refresh())
            },

            onLimitSet(perPage) {
                this.perPage = perPage;
                Vue.nextTick(() => this.$refs.vuetable.refresh())
            },

            httpFetch(apiUrl, httpOptions) {
                return httpClient.get(apiUrl, httpOptions);
            }

        }
    }
</script>

<style scoped>

</style>
