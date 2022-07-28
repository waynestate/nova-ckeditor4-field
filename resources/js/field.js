import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';
import CKEditor from './components/CKEditor';

Nova.booting((app, store) => {
    app.component('ckeditor', CKEditor)
    app.component('index-nova-ckeditor4', IndexField)
    app.component('detail-nova-ckeditor4', DetailField)
    app.component('form-nova-ckeditor4', FormField)
});
