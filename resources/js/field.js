Nova.booting((Vue, router) => {
    Vue.component('index-nova-ckeditor', require('./components/IndexField'));
    Vue.component('detail-nova-ckeditor', require('./components/DetailField'));
    Vue.component('form-nova-ckeditor', require('./components/FormField'));
})
