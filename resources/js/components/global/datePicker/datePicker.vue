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

    <flat-pickr
        ref="flatpickr"
        :placeholder="placeholder"
        v-model="date"
        @on-change="onChange"
        @on-input="onInput"
        :config="config"
    />

</template>

<script>
    import flatPickr from 'vue-flatpickr-component'
    import 'flatpickr/dist/flatpickr.css';
    import 'flatpickr/dist/themes/airbnb.css';

    export default {
        name: 'date-picker',

        components: {
            flatPickr,
        },

        props: {
            value: {required: true},
            placeholder: {default: ''},
            dateFormat: {default: 'Y-m-d'},
            altFormat: {default: 'M j, Y'},
            wrap: {default: false},
            enableTime: {default: false},
            inline: {default: false},
            mode: {default: 'single'}, // 'single', 'range', 'multiple'
            position: {default: 'auto'}, // 'auto', 'top', 'bottom'
            maxDate: {default: ''},
            minDate: {default: ''},
            parseDate: {
                type: function () {

                },
                default: null
            },
        },

        data() {
            return {
                date: this.value,

                config: {
                    wrap: false, // set wrap to true only when using 'input-group'
                    altFormat: 'M j, Y',
                    placeholder: this.placeholder,
                    altInput: true,
                    dateFormat: this.dateFormat,
                    enableTime: this.enableTime,
                    inline: this.inline,
                    mode: this.mode,
                    position: this.position,
                    maxDate: this.maxDate,
                    minDate: this.minDate,
                    parseDate: this.parseDate,
                },
            }
        },

        methods: {
            onChange(selectedDate, dateStr) {
                this.$emit('on-change', selectedDate, dateStr)
            },

            onInput(selectedDate, dateStr) {
                this.$emit('on-input', selectedDate, dateStr)
            }
        }
    }
</script>

<style scoped>

</style>
