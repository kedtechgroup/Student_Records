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

import axios from "axios";
import toast from "./notifications";

/**
 * Create a new Axios client instance
 * @see https://github.com/mzabriskie/axios#creating-an-instance
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (!token) {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

const config = {
    // baseURL: 'http://192.168.0.7/',
    // timeout: 1000,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': token.content
    },
};

const httpClient = axios.create(config);

// Add a request interceptor
httpClient.interceptors.request.use(request => {
    // request.headers.common = {'X-Requested-With': 'XMLHttpRequest'};

    return request

}, (error) => {
    return Promise.reject(error);
});

// Add a response interceptor
httpClient.interceptors.response.use(response => response, (error) => {

    const {status} = error.response || {};

    if (status >= 500) {
        // toast.error(error.response.data.message);
    }

    // unauthenticated
    if (status === 401) {
        // toast.error('Please login to perform this action');

        setTimeout(() => {
            window.location.assign('/login');

        }, 3000)
    }

    return Promise.reject(error);

});

window.httpClient = httpClient;
