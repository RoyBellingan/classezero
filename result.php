<?php
session_start(); 
error_reporting(0);
include_once "class_.php"; 
 
$resultprint= new contatti();

if($_GET['trovanome']==""){
$resultprint->printresult($_SESSION['id_utente'],"");
}else{
    $getnome=$_GET['trovanome'];
  $resultprint->printresult($_SESSION['id_utente'],$getnome);  
    
}
