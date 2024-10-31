<?php
 header('Content-Type: application/json');
 
 
include_once 'Dbh.php';
include_once 'api.php';


try{

$api = new API();

}catch(Exception $e){

   echo $e->getMessage();     
}

#https://acaan.hu/API/?api_key=EWRFGFHFH-2345452342356-GHJDFSAGJJ21334545346&token=3466743_HJGHJDGSFV_RTET6983&tablename=Pomaz



