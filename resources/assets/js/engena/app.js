// var Vue = require('vue');
// var VueStrap = require('vue-strap/src/index.js');

var pass = new Vue({
    el: '#app',
    components: {
        'modal': VueStrap.modal,
    },
    data: {
        modalAction: '',
        errorMessages: [],
        showAddPassModal: false,
        selectedPasses: window.selectedPasses,
        passes: window.passes,
        durations: window.passDurations,
        selected: { pass_id: '', price: ''},
    },
    methods: {
        addPass: function () {
            var newPass = { index: this.selected.index, pass_id: this.selected.pass_id, price: this.selected.price };
            if(!this.validatePass(newPass)) {
                return false;
            }

            this.selectedPasses.push(newPass);
            this.closeModal();
        },
        savePass: function () {
            var pass = { index: this.selected.index, pass_id: this.selected.pass_id, price: this.selected.price };

            if(!this.validatePass(pass)) {
                return false;
            }
            this.selectedPasses[pass.index].pass_id          = pass.pass_id;
            this.selectedPasses[pass.index].price            = pass.price;
            this.closeModal();
        },
        removePass: function(index) {
            this.selectedPasses.splice(index, 1);
            this.closeModal();
        },
        validatePass: function(newPass) {
            this.errorMessages = [];

            // if ((newPass.pass_id === '') || !(newPass.pass_id in this.passes)) {
            if (newPass.pass_id === '') {
                this.errorMessages.push('The Pass field is required.');
            }
            if ((newPass.price === '')) {
                this.errorMessages.push('The Price field is required');
            }
            for(var i=0; i<this.selectedPasses.length; i++) {
                if ((this.selectedPasses[i].pass_id == newPass.pass_id) && (this.modalAction == 'add')) {
                    this.errorMessages.push('Selected pass type is already present.');
                }
            }

            if (this.errorMessages.length > 0) {
                return false;
            } else {
                return true;
            }
        },
        closeModal: function() {
            this.showAddPassModal = false;
            this.errorMessages = [];
            this.selected = {pass_id: '', price: ''};
        },
        showModal: function(event) {
            event.preventDefault();
            this.errorMessages = [];
            this.selected = {pass_id: '', price: ''};
            this.modalAction = 'add';
            this.showAddPassModal = true;
        },
        editPass: function(index) {
            this.errorMessages = [];
            this.selected = {index: index,
                pass_id: this.selectedPasses[index].pass_id,
                price: this.selectedPasses[index].price
            };
            this.modalAction = 'edit';
            this.showAddPassModal = true;
        },
    },

});

document.addEventListener("keydown", function(event) {
    if (pass.showAddPassModal && event.keyCode == 27) {
        pass.closeModal();
    }
});
