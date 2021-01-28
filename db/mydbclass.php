<?php
    class mydbclass extends PDO {
        public $hostname = "localhost"; // 127.0.0.1
        public $dbname = "quiz_case";
        public $user = "root";
        public $pass = "";
        public $db;
       
        function __construct(){
            $this->db = new PDO ("mysql:host=$this->hostname; dbname=$this->dbname", $this->user, $this->pass);
        }

        function run_query($query){
            $save = $this->db->prepare($query);
            return $save->execute();
        }

        function selectOne($query){
            $save = $this->db->prepare($query);
            $save->execute();
            if(array_key_exists('0', $result = $save->fetchAll(PDO::FETCH_ASSOC))){
                // echo "vero";
                // echo "save <br>";
                // print_r($save);
                // echo "<br>";
                // print_r($result);
                return $result;
            }
            else{
                echo "falso";
                return -1;
            }
        }

        function max_id ($query){
            $save = $this->db->prepare($query);
            $save->execute();
            // print_r($save->fetchAll(PDO::FETCH_ASSOC));
             if(array_key_exists('0', $max_id = $save->fetchAll(PDO::FETCH_ASSOC))){
                // echo "vero";
                // echo "save <br>";
                // print_r($save);
                // echo "<br>";
                // print_r($result);
                return $max_id[0]['max_id'];
            }
        }

        function selectALL($query){
            $save = $this->db->prepare($query);
            $save->execute();
            return $save->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    $db = new mydbclass();
?>