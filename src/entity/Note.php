<?php

    Class Note {
        public $id;
        public $bid;
        public $title;
        public $date;
        public $content;
        public $picList;
        public $audioList;
    

        public function __construct() {
            $this->title = '';
            $this->date = '';
            $this->content = '';
            $this->picList = array();
            $this->audioList = array();
        }
    }
?>