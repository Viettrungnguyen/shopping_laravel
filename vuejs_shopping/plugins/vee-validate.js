import Vue from 'vue'
import { ValidationProvider,ValidationObserver,extend } from 'vee-validate'

import {required,min,email} from 'vee-validate/dist/rules'

Vue.component('ValidationProvider',ValidationProvider)
Vue.component('ValidationObserver',ValidationObserver)
extend('required',{
    ...required,
    message:'please insert to row '
});
extend('min',{
    ...min,
    message:'nhap it nhat 4 ky tu'
})
extend('email',{
    ...email,
    message: 'this not type email'
})