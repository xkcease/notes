import Vue from 'vue/dist/vue.esm.js';
import {Container, Main, Row, Col, Button, Divider, Input} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Board from './Board.vue'
import $ from 'jquery';

Vue.use(Container);
Vue.use(Main);
Vue.use(Row);
Vue.use(Col);
Vue.use(Button);
Vue.use(Divider);
Vue.use(Input);



// 获取笔记
$.get(
    'notes.php',
    function(dataJson) {
        let dataNotes = [];
        dataNotes = JSON.parse(dataJson).data;
        
        new Vue({
            el: '#board',
            data:{
                notes: dataNotes,
            },
            components: {
                Board,
            },
            template: `<board v-bind:notes="notes"></board>`
        });
    }
);

