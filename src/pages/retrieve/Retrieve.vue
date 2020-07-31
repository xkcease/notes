<template>
    <el-container>
        <el-main>
            <el-row type="flex" justify="center">
                <el-col :span="6" class="col-wrap">
                    <div class="wrap">
                        <el-form ref="form" :model="form" :rules="rules">
                            <tran-com>
                                <p v-show="isShow" class="error">用户名或手机号错误</p>
                            </tran-com>
                            <el-form-item prop="username">
                                <el-input v-model="form.username" placeholder="用户名"></el-input>
                            </el-form-item>
                            <el-form-item prop="phone">
                                <el-input v-model="form.phone" placeholder="手机号"></el-input>
                            </el-form-item>
                            <el-form-item prop="password">
                                <el-input v-model="form.password" placeholder="密码" show-password></el-input>
                            </el-form-item>            
                            <el-form-item prop="againPassword">
                                <el-input v-model="form.againPassword" placeholder="再次输入密码" show-password></el-input>
                            </el-form-item>            
                            <a class="link" href="../../login.html">返回登录</a>
                            <el-form-item class="ft-btn">
                                <el-button type="primary" @click="submit" class="btn">重置密码</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>


<script>
    import TranCom from '../../components/TranCom.vue';
    import $ from 'jquery';
    import '../../assets/common.css';

    export default{
        components:{
            TranCom,
        },
        data() {
            return {
                form: {
                    username: '',
                    phone: '',
                    password: '',
                    againPassword: '',
                },
                rules: {
                    username: [
                        {required: true, message: '用户名不能为空', trigger: 'blur'}],
                    phone: [
                        {required: true, message: '手机号不能为空', trigger: 'blur'},
                        {pattern: /^1[3-9]\d{9}$/, message: '手机号错误', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '密码不能为空', trigger: 'blur'},
                        {pattern: /\w{4,20}/, message: '长度4-20的数字或字母或汉字或下划线', trigger: 'blur'},
                    ],
                    againPassword: [
                        {required: true, message: '确认密码不能为空', trigger: 'blur'},
                        {
                            validator: (rule, value, callback) => {
                                if(value != this.form.password){
                                    callback(new Error('两次密码输入不一致'));
                                }
                                else{
                                    callback();
                                }
                            },
                            trigger: 'blur'
                        }
                    ],
                },
                isShow: false,
            }
        },
        methods: {
            submit: function(){
                const self = this;
                this.$refs.form.validate((valid) => {
                    if (valid) {      // 不为空
                        $.post(
                            'retrieve.php',
                            {data: JSON.stringify(this.form)},
                            function(dataJson){
                                if (JSON.parse(dataJson).state) {
                                    console.log('update success');
                                    window.location.href = '../../login.html';
                                }
                                else{
                                    self.isShow = true;
                                }
                            }
                        );
                    } 
                    else {
                        console.log('error submit!!');
                        return false;
                    }
                })
            }
        },
        
    }    

</script>



<style>
    
</style>