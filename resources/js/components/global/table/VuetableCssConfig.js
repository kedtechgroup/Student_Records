/*
 * Copyright (c) 2019.  medic@medic.org
 *
 * This file is part of Medic.
 *
 * Medic is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Medic is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Medic. If not, see <http://www.gnu.org/licenses/>.
 */

export default {
    table: {
        tableClass: 'table table-xs table-striped',
        ascendingIcon: 'glyphicon glyphicon-chevron-up',
        descendingIcon: 'glyphicon glyphicon-chevron-down',
        handleIcon: 'glyphicon glyphicon-menu-hamburger',
        renderIcon: function (classes, options) {
            return `<span class="${classes.join(' ')}"></span>`
        }
    },
    pagination: {
        wrapperClass: "pagination align-self-end",
        activeClass: "",
        disabledClass: "disabled",
        pageClass: "page-item ",
        linkClass: "page-link 2",
        icons: {
            first: "",
            prev: "Prev",
            next: "Next",
            last: ""
        }
    },
    paginationInfo: {
        infoClass: "dataTables_info"
    }
}

