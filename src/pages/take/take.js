import Vue from 'vue/dist/vue.esm.js';
import {Input, Container, Main, Row, Col, Form, FormItem, Button, Upload, Divider} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Take from './Take.vue'
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



let noteData = {title: '', content: ''};
let picList = [];
let audioList = [];

$.get(
    'getnote.php',
    function(dataJson) {
        let dataNote = JSON.parse(dataJson);

        if (dataNote.state) {       // 编辑
            noteData = dataNote.data;
            picList = dataNote.data.picList;
            audioList = dataNote.data.audioList;
        }
        
        new Vue({
            el: '#take',
            data: {
                note: noteData,
                picProp: picList,
                audioProp: audioList,
            },
            components: {
                Take,
            },
            template: `<take :picProp="picProp" :audioProp="audioProp" :note="note"></take>`,
        });
    }
);


