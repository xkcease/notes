<template>
    <el-container>
        <el-main>
            <el-row type="flex" justify="center">
                <el-col :span="14" class="col-wrap">
                    <div class="wrap">
                        <h2>我的笔记</h2>
                        <el-divider></el-divider>
                        <div class="tool">
                            <el-button class="btn" icon="el-icon-edit-outline" type="primary" @click="write">写笔记</el-button>
                            <el-input class="search" suffix-icon="el-icon-search" placeholder="输入关键字" 
                                v-model="keyWord" @change="search"></el-input>
                        </div>
                        <el-divider></el-divider>
                        <div class="board-wrap">
                            <ul>
                                <li v-for="note in sNotes" :key="note.bid" class="li-wrap">
                                    <a class="link" @click="look(note.bid)">{{note.title}}</a>
                                    <span>{{note.date}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>


<script>
    export default{
        props: {
            notes: Array,
        },
        data() {
            return {
                oNotes: this.notes,
                sNotes: this.notes,
                keyWord: '',
            }
        },
        methods: {
            search: function() {
                this.sNotes = [];
                for (let i = 0; i < this.oNotes.length; i++) {
                    if (this.oNotes[i].title.split(this.keyWord).length > 1) {
                        this.sNotes.push(this.oNotes[i]);
                    }
                }              
            },
            write: function() {
                console.log('write');
                $.post(
                    '../take/take.php',
                    {data: JSON.stringify({new: 1})},
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
            look: function(b) {
                $.post(
                    '../look/look.php',
                    {data: JSON.stringify({bid: b})},
                    function(dataJson) {
                        if (JSON.parse(dataJson).state) {
                            window.location.href = '../look/look.html';
                        }
                        else {
                            console.log('look error');
                            console.log(b);
                        }
                    }
                );
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
    }

    .board-wrap{
        margin-bottom: 20px;
    }


    .li-wrap{
        display: flex;
        justify-content: space-between;
        margin: 0 5px;
    }

    .li-wrap:nth-child(even){
        background: #FFFDF1;
    }

    .link{
        font-size: 16px;
        margin-left: 10px;
        color: #333;
        text-decoration: none;
        cursor: pointer;
    }

    .link:hover{
        text-decoration: underline;
    }
    
    .li-wrap span{
        font-size: 16px;
        color: dimgray;
    }

    h2{
        margin-left: 10px;
        margin-top: 20px;
        font-size: 18px;
        color: #6B84EC;
    }

    .tool{
        margin: 10px;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    .tool .btn{
        width: 100px;
    }

    .tool .search{
        width: 200px;
    }
</style>