define([
    'Magento_Ui/js/modal/alert'
], function (alert) {
    'use strict';

    return function (message) {
        alert({
            title: 'Response Message',
            content: message,
            buttons: [{
                text: 'Ok',
                click: function () {
                    this.closeModal();
                }
            }]
        });
    };
});
