import Vue from 'vue';
import {Input, Container, Main, Row, Col, Form, FormItem, Button} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Login from './Login.vue';

Vue.use(Input);
Vue.use(Container);
Vue.use(Main);
Vue.use(Row);
Vue.use(Col);
Vue.use(Form);
Vue.use(FormItem);
Vue.use(Button);

new Vue({
    el: '#login',
    // components: {
    //     Login,
    // },
    // template: '<Login></Login>',
    render: h => h(Login),
});


