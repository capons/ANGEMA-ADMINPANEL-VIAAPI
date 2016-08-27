(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

// var Vue = require('vue');
// var VueStrap = require('vue-strap/src/index.js');

var pass = new Vue({
    el: '#app',
    components: {
        'modal': VueStrap.modal
    },
    data: {
        modalAction: '',
        errorMessages: [],
        showAddPassModal: false,
        selectedPasses: window.selectedPasses,
        passes: window.passes,
        durations: window.passDurations,
        selected: { pass_id: '', price: '' }
    },
    methods: {
        addPass: function addPass() {
            var newPass = { index: this.selected.index, pass_id: this.selected.pass_id, price: this.selected.price };
            if (!this.validatePass(newPass)) {
                return false;
            }

            this.selectedPasses.push(newPass);
            this.closeModal();
        },
        savePass: function savePass() {
            var pass = { index: this.selected.index, pass_id: this.selected.pass_id, price: this.selected.price };

            if (!this.validatePass(pass)) {
                return false;
            }
            this.selectedPasses[pass.index].pass_id = pass.pass_id;
            this.selectedPasses[pass.index].price = pass.price;
            this.closeModal();
        },
        removePass: function removePass(index) {
            this.selectedPasses.splice(index, 1);
            this.closeModal();
        },
        validatePass: function validatePass(newPass) {
            this.errorMessages = [];

            // if ((newPass.pass_id === '') || !(newPass.pass_id in this.passes)) {
            if (newPass.pass_id === '') {
                this.errorMessages.push('The Pass field is required.');
            }
            if (newPass.price === '') {
                this.errorMessages.push('The Price field is required');
            }
            for (var i = 0; i < this.selectedPasses.length; i++) {
                if (this.selectedPasses[i].pass_id == newPass.pass_id && this.modalAction == 'add') {
                    this.errorMessages.push('Selected pass type is already present.');
                }
            }

            if (this.errorMessages.length > 0) {
                return false;
            } else {
                return true;
            }
        },
        closeModal: function closeModal() {
            this.showAddPassModal = false;
            this.errorMessages = [];
            this.selected = { pass_id: '', price: '' };
        },
        showModal: function showModal(event) {
            event.preventDefault();
            this.errorMessages = [];
            this.selected = { pass_id: '', price: '' };
            this.modalAction = 'add';
            this.showAddPassModal = true;
        },
        editPass: function editPass(index) {
            this.errorMessages = [];
            this.selected = { index: index,
                pass_id: this.selectedPasses[index].pass_id,
                price: this.selectedPasses[index].price
            };
            this.modalAction = 'edit';
            this.showAddPassModal = true;
        }
    }

});

document.addEventListener("keydown", function (event) {
    if (pass.showAddPassModal && event.keyCode == 27) {
        pass.closeModal();
    }
});

},{}]},{},[1]);

//# sourceMappingURL=app.js.map
