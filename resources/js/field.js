import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';
import CKEditor from './components/CKEditor';

Nova.booting((app, store) => {
    app.component('ckeditor', CKEditor)
    app.component('index-nova-ckeditor', IndexField)
    app.component('detail-nova-ckeditor', DetailField)
    app.component('form-nova-ckeditor', FormField)
});
