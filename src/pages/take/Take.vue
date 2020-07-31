<template>
    <el-container>
        <el-main>
            <el-row type="flex" justify="center">
                <el-col :span="14" class="col-wrap">
                    <div class="wrap">
                        <el-form>
                            <el-form-item class="ft-title">
                                <el-input class="input-title" v-model="form.title" placeholder="请在这里输入笔记主题"></el-input>
                            </el-form-item>
                            <el-form-item class="ft-text">
                                <el-input type="textarea" v-model="form.content"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-upload 
                                    ref="picUp" 
                                    action="additem.php" 
                                    :auto-upload="false" 
                                    list-type="picture-card" 
                                    :file-list="picList" 
                                    :before-upload="handleBeforePicUpload"
                                >
                                    <i slot="default" class="el-icon-picture-outline"></i>
                                </el-upload>
                            </el-form-item>
                            <el-form-item>
                                <el-upload
                                    ref="audioUp" 
                                    action="additem.php" 
                                    :auto-upload="false" 
                                    :file-list="audioList" 
                                    :before-upload="handleBeforeAudioUpload"
                                >
                                    <el-button icon="el-icon-plus">添加音频</el-button>
                                </el-upload>
                            </el-form-item>
                            <el-divider></el-divider>
                            <el-form-item>
                                <el-button @click="save">保存</el-button>
                                <el-button @click="back">取消</el-button>
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
                    title: this.note.title,
                    content: this.note.content,
                },
                picList: this.picProp,
                audioList: this.audioProp,
            }
        },
        methods: {
            save: function() {
                $.post('aunote.php',
                {data: JSON.stringify(this.form)},
                function(){
                    console.log('save note');
                    window.location.href = '../board/board.html';
                });
                this.$refs.picUp.submit();
                this.$refs.audioUp.submit();
            },
            back: function() {
                window.location.href = '../board/board.html';
            },
            handleBeforePicUpload(file) {
                if (!file.type.includes("image")) {
                    alert("上传文件类型必须是图片!");
                    return false;
                }
                console.log(file.name + '--' + file.url);
                console.log(file);
            },
            handleBeforeAudioUpload(file) {
                if (!file.type.includes("mpeg")) {
                    alert("上传文件类型必须是MP3!");
                    return false;
                }
                console.log(file.name + '--' + file.url);
                console.log(file);
            },
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

    }

    .el-textarea__inner{
        resize: none;
        height: 400px;
    }

    .el-main {
        overflow: hidden !important;
    }

</style>