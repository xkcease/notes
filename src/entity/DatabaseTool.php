<?php
    include_once "User.php";
    include_once "Note.php";
    include_once "Item.php";

    Class DatabaseTool {
        private static $dbt;
        private $conn;


        private function __construct() {
            $this->conn = new Mysqli("localhost", "root", "123456", "notes");
            
            if($this->conn->connect_error) {
                die("con failed:" .$this->$conn->connect_error);
            }
        }

        public static function getInstance() {
            if (self::$dbt === null){
                self::$dbt = new DatabaseTool();
            }
            return self::$dbt;
        }
        

        // 插入用户
        public function insertUser($user) {
            $stmt = $this->conn->prepare("insert into user(username, password, phone) values(?, ?, ?)");
            $stmt->bind_param("sss", $user->username, $user->password, $user->phone);
            $stmt->execute();
            $stmt->close();
        }

        //修改用户
        public function updateUser($user) {
            $stmt = $this->conn->prepare("update user set password=? where username=?");
            $stmt->bind_param("ss", $user->password, $user->username);
            $stmt->execute();
            $stmt->close();
        }

        // 查询用户按用户名
        public function queryUserByName($username) {
            $stmt = $this->conn->prepare("select * from user where username=?");

            $stmt->bind_param("s", $username);
            $stmt->bind_result($id, $username, $password, $phone);

            $user = null;
            
            $stmt->execute();

            if($stmt->fetch()){
                $user = new User();
                $user->id = $id;
                $user->username =  $username;
                $user->password = $password;
                $user->phone = $phone;   
            }
            
            $stmt->close();
            

            return $user;
        }


        // 查询用户按手机号
        public function queryUserByPhone($phone) {
            $stmt = $this->conn->prepare("select * from user where phone=?");
            
            $stmt->bind_param("s", $phone);
            $stmt->bind_result($id, $username, $password, $phone);
            
            $user = null;
            
            $stmt->execute();

            if($stmt->fetch()){
                $user = new User();
                $user->id = $id;
                $user->username =  $username;
                $user->password = $password;
                $user->phone = $phone;   
            }
            
            $stmt->close();

            return $user;
        }



        // 添加笔记
        public function insertNote($note) {
            $stmt = $this->conn->prepare("insert into notes(id, title, date, content) values(?, ?, ?, ?)");
            $stmt->bind_param("isss", $note->id, $note->title, $note->date, $note->content);
            $stmt->execute();
            $stmt->close();
        }

        
        // 修改笔记
        public function updateNote($note) {
            $stmt = $this->conn->prepare("update notes set title=?, date=?, content=? where id=? and bid=?");
            $stmt->bind_param("sssii", $note->title, $note->date, $note->content, $note->id, $note->bid);
            $stmt->execute();
            $stmt->close();
        }


        // 查找笔记
        public function queryNotes($id) {
            $stmt = $this->conn->prepare("select * from notes where id=?");
            
            $stmt->bind_param("i", $id);
            $stmt->bind_result($id, $bid, $title, $date, $content);
            
            $stmt->execute();
            
            $noteList = array();

            while($stmt->fetch()){
                $note = new Note();
                $note->id = $id;
                $note->bid = $bid;
                $note->title = $title;
                $note->date = $date;
                $note->content = $content;

                array_push($noteList, $note);
            }
            
            $stmt->close();

            return $noteList;
        }


        // 查找笔记按bid
        public function queryNoteByBid($bid) {
            $stmt = $this->conn->prepare("select * from notes where bid=?");
            
            $stmt->bind_param("i", $bid);
            $stmt->bind_result($id, $bid, $title, $date, $content);
            
            $stmt->execute();
            
            $note = null;
            
            if($stmt->fetch()){
                $note = new Note();
                $note->id = $id;
                $note->bid = $bid;
                $note->title = $title;
                $note->date = $date;
                $note->content = $content;
            }
            
            $stmt->close();

            return $note;
        }


        // 查找笔记按title
        public function queryNoteByTitle($title) {
            $stmt = $this->conn->prepare("select * from notes where title=?");
            
            $stmt->bind_param("s", $title);
            $stmt->bind_result($id, $bid, $title, $date, $content);
            
            $stmt->execute();
            
            $note = null;

            while($stmt->fetch()){
                $note = new Note();
                $note->id = $id;
                $note->bid = $bid;
                $note->title = $title;
                $note->date = $date;
                $note->content = $content;
            }
            
            $stmt->close();

            return $note;
        }

        // 添加部件
        public function insertItem($item) {
            $stmt = $this->conn->prepare("insert into items(bid, url, kind) values(?, ?, ?)");
            $stmt->bind_param("isi", $item->bid, $item->url, $item->kind);
            $stmt->execute();
            $stmt->close();
        }

        // 查找部件
        public function queryItems($bid, $kind) {
            $result = $this->conn->query("select * from items where bid='{$bid}' and kind='{$kind}';");
           
            $itemList = array();
            
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $item = new Item();
                    $item->bid = $row['bid'];   
                    $item->url = $row['url'];
                    $item->kind = $row['kind'];
                    $item->name = $this->getItemName($item->url);
                    
                    array_push($itemList, $item);
                }
            }

            $result->free();
            
            return $itemList;
        }


        // 获取部件名字
        public function getItemName($url) {
            $list = preg_split('/\//', $url);
            $str = $list[count($list) - 1];
            
            $list = preg_split('/\./', $url);
            $str = $list[0];
            
            return $str;
        }
    }

?>