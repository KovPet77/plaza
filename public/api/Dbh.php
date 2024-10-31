<?php


      class Dbh{

         private $host = "127.0.0.1";
         private $user = "pomazpla_psmith2023";
         private $pwd = "h(foTcndE~[&";
         private $dbname = "pomazpla_reactnativeAPI";


         protected function connect()
         {
            
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
         }
      }