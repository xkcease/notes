import Vue from 'vue/dist/vue.esm.js';
import {Input, Container, Main, Row, Col, Form, FormItem, Button, Upload, Divider} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Look from './Look.vue'
import $ from 'jquery';


Vue.use(Input);
Vue.use(Container);
Vue.use(Main);
Vue.use(Row);
Vue.use(Col);
Vue.use(Form);
Vue.use(FormItem);
Vue.use(Button);
Vue.use(Upload);
Vue.use(Divider);


$.get(
    'getlook.php',
    function(dataJson) {
        if (JSON.parse(dataJson).state) {
            let dataNote = JSON.parse(dataJson).data;
            console.log(dataNote);
            new Vue({
                el: '#look',
                data: {
                    note: {bid: dataNote.bid, title: dataNote.title, content: dataNote.content},
                    picProp: dataNote.picList,
                    audioProp: dataNote.audioList,
                },
                components: {
                    Look,
                },
                template: `<look :picProp="picProp" :audioProp="audioProp" :note="note"></look>`,
            });
        }
        else {
            console.log('getlook error');
        }
    }
);
