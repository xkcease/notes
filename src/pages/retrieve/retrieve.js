import Vue from 'vue';
import {Input, Container, Main, Row, Col, Form, FormItem, Button} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Retrieve from './Retrieve.vue';


Vue.use(Input);
Vue.use(Container);
Vue.use(Main);
Vue.use(Row);
Vue.use(Col);
Vue.use(Form);
Vue.use(FormItem);
Vue.use(Button);

new Vue({
    el: '#retrieve',
    render: h => h(Retrieve),
});


