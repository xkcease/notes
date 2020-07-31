<template>
    <el-container>
        <el-main>
            <el-row type="flex" justify="center">
                <el-col :span="6" class="col-wrap">
                    <div class="wrap">
                        <el-form ref="form" :model="form" :rules="rules">
                            <tran-com>
                                <p v-show="isShow" class="error">用户名或密码或验证码错误</p>
                            </tran-com>
                            <el-form-item prop="username">
                                <el-input v-model="form.username" placeholder="用户名"></el-input>
                            </el-form-item>
                            <el-form-item prop="password">
                                <el-input v-model="form.password" placeholder="密码" show-password></el-input>
                            </el-form-item>
                            <el-form-item class="ft-btn" prop="captcha">
                                <el-row type="flex" align="middle">
                                    <el-col>
                                        <el-input v-model="form.captcha" placeholder="验证码"></el-input>
                                    </el-col>
                                    <el-col :span="12">
                                        <img src="captcha.php" width="80" height="40"/>
                                    </el-col>
                                </el-row>
                            </el-form-item>
                            <a class="link" href="pages/register/register.html">注册</a>
                            <a class="link" href="pages/retrieve/retrieve.html">忘记密码?</a>
                            <el-form-item class="ft-btn">
                                <el-button type="primary" @click="submit" class="btn">登录</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>


<script>
    import TranCom from './components/TranCom.vue';
    import $ from 'jquery';
    import './assets/common.css';

    export default{
        components:{
            TranCom,
        },
        data() {
            return {
                form: {
                    username: '',
                    password: '',
                    captcha: '',
                },
                rules: {
                    username: [{required: true, message: '用户名不能为空', trigger: 'blur'}],
                    password: [{required: true, message: '密码不能为空', trigger: 'blur'}],
                    captcha: [{required: true, message: '验证码不能为空', trigger: 'blur'}],
                },
                isShow: false,
            }
        },
        methods: {
            submit: function(){
                const self = this;
                this.$refs.form.validate((valid) => {
                    if (valid) {      // 不为空
                        $.post(         // 登录验证
                            'login.php',
                            {data: JSON.stringify(this.form)},
                            function(dataJson){
                                if(JSON.parse(dataJson).state){    
                                    self.isShow = false;
                                    console.log('logon');
                                    console.log(JSON.parse(dataJson).data);
                                    window.location.href = 'pages/board/board.php';
                                }
                                else {
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