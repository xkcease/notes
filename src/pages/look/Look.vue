<template>
    <el-container>
        <el-main>
            <el-row type="flex" justify="center">
                <el-col :span="14" class="col-wrap">
                    <div class="wrap">
                        <el-form>
                            <el-form-item class="ft-title">
                                <el-input class="input-title" v-model="form.title" placeholder="请在这里输入笔记主题" disabled></el-input>
                            </el-form-item>
                            <el-form-item class="ft-text">
                                <el-input type="textarea" v-model="form.content" disabled></el-input>
                            </el-form-item>
                            <div>
                                <div class="pic" v-for="pic in picList">
                                    <img :src="pic.url"/>
                                </div>
                                <div class="aud" v-for="audio in audioList">
                                    <span>{{audio.name}}</span>
                                    <audio  controls="true" loop="true">
                                        <source :src="audio.url" type="audio/mp3">
                                    </audio>
                                </div>
                            </div>
                            <el-divider></el-divider>
                            <el-form-item>
                                <el-button @click="edit">编辑</el-button>
                                <el-button @click="back">返回</el-button>
                            </el-form-item>               
                        </el-form>
                    </div>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>


<script>
    export default{
        props: {
            picProp: Array,
            audioProp: Array,            
            note: Object,
        },
        data() {
            return {
                form: {
                    bid: this.note.bid,
                    title: this.note.title,
                    content: this.note.content,
                },
                picList: this.picProp,
                audioList: this.audioProp,
            }
        },
        methods: {
            edit: function() {
                $.post(
                    '../take/take.php',
                    {data: JSON.stringify({new: 0, bid: this.form.bid})},
                    function(dataJson) {
                        if (JSON.parse(dataJson).state) {
                            window.location.href = '../take/take.html';
                        }
                        else {
                            console.log('take error');
                        }
                    }
                );
            },
            back: function() {
                window.location.href = '../board/board.html';
            }
        },
        
    }    

</script>



<style>
    *{
        margin: 0;
        padding: 0;
    }

    html{
        font-family:'Microsoft YaHei';
        background: #FAFAFA;
    }

    .col-wrap{
        background: #fff;
        border-radius: 4px;
        margin-top: 10px; 
    }

    .wrap{
        height: 100%;
        margin: 20px;
    }

    .ft-text{
        border-top: 1px dashed darkgray;
        padding-top: 10px;
    }

    .ft-title{
        text-align: center;
        margin-bottom: 10px; 
    }

    .input-title{
        width: 80%;
    }
    
    .el-input__inner{
        text-align: center;
        color: black!important;
        background-color: #fff!important;
    }

    .el-textarea__inner{
        resize: none;
        height: 400px;
        color: black!important;
        background-color: #fff!important;
    }

    .el-main {
        overflow: hidden !important;
    }

    .pic{
        margin-bottom: 25px;
        display: inline-block;
    }

    .aud{
        display: flex;
        align-items: flex-end;
    }    
    
    .aud span{
        margin-right: 20px;
    }


</style>