import iziToast from "izitoast";

let position = 'bottomRight';
let displayMode = 'replace';
let  timeout = 8000;

const toast = {
    error: (message, title = 'Error') => {
        return iziToast.error({
            title: title,
            message: message,
            position: position,
            transitionIn: 'fadeIn',
            icon: 'icon-x',
            displayMode: displayMode,
            layout: 2,
            timeout: timeout
        });
    },

    success: (message, title = 'Success') => {
        return iziToast.success({
            title: title,
            message: message,
            position: position,
            transitionIn: 'fadeIn',
            icon: 'icon-star-empty3',
            displayMode: displayMode,
            layout: 2,
            timeout: timeout
        });
    },

    question: (message, title = 'Question') => {
        return iziToast.question({
            title: title,
            message: message,
            timeout: 20000,
            progressBar: false,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            position: 'center',
            transitionIn: 'fadeIn',
            transitionOut: 'fadeOut',
            layout: 2,
            buttons: [
                ['<button><b>Confirm</b></button>', function (instance, toast, button, e, inputs) {

                    // console.info(button);
                    // console.info(e);

                    // alert(inputs[0].options[inputs[0].selectedIndex].value);

                    instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                    // return new Promise(resolve => resolve(true))
                    /* iziToast.success({
                         id: 'success',
                         zindex: 9999,
                         timeout: 2000,
                         title: 'Success',
                         overlay: true,
                         message: 'Thank you',
                         position: 'center'
                     });*/

                }, false], // true to focus

                ['<button>NO</button>', function (instance, toast, button, e) {

                    instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                    // console.info(button.innerText);

                }]
            ],
            onClosed: function (instance, toast, closedBy) {

            }
            // buttons: [
            //     ['<button><b>YES</b></button>', function (instance, toast) {
            //         return instance;
            //
            //         instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
            //
            //     }, true],
            //     ['<button>NO</button>', function (instance, toast) {
            //
            //         instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
            //
            //     }],
            // ],
        })
    },

    info: (message, title = 'Info') => {
        return iziToast.info({
            title: title,
            message: message,
            displayMode: 'once',
            id: 'question',
            position: 'bottomRight',
            transitionIn: 'fadeIn',
            transitionOut: 'fadeOut',
            layout: 2,
            timeout: timeout
        });
    },

    warning: (message, title = 'Info') => {
        return iziToast.warning({
            title: title,
            message: message,
            displayMode: 'once',
            id: 'question',
            position: 'bottomRight',
            transitionIn: 'fadeIn',
            transitionOut: 'fadeOut',
            layout: 2,
            timeout: timeout
        });
    },

};
export default window.toast = toast;
