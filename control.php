<?php
session_start();
error_reporting(0);

include 'class_.php';










/*
 * QUI CONTROLLI PER le richieste dei contatti veri e propri 
 * */

 

// INSERT NUOVI CONTATTI
if(($_POST['nome']!="")){
    //    $post=print_r($_POST);
    //parse_str($post);
    //echo $azienda;
    //ISTAN>IO CLASSE PER 
   
    $perinsert= new contatti();
    $perinsert -> insertdb($_POST);
   

}


















/*
 * controlli o come si chiamano per gli utenti loggati 
 */
///QUI CONTROLLO SE ESISTE IL NOME  DAL LOGIN 
if($_POST ['newclient']!=""){
    $email=htmlspecialchars(trim($_POST['newclient']));
   // $mycooker=$_COOKIE['mycooker'];
    $mycooker=session_id();
$c=new utenti();

// QUI PASSO LA CREDENZIALE E VEDO SE ESISTE 
$c->trovasesiste("",$email);
}






// QUI FACCIO NUOVA INSERT PER NUVO UTENTE 
// HO AGGIUNTO CHE SE NON ESISTE VA CONFERMATA LA CREAZIONE DI UNA N UVOA UTENTE
///QUI CONTROLLO SE ESISTE IL NOME 
if($_POST ['confermautente']=="yes"){
    $email=htmlspecialchars(trim($_POST['nomeperinsert']));
      // $mycooker=$_COOKIE['mycooker'];
       $mycooker=session_id();
$c=new utenti();
$c->insertutente( $mycooker,$email);
// QUI PASSO LA CREDENZIALE E VEDO SE ESISTE 
}


// QUI SE CLIKKANO LOGOUT 
if($_POST['logout']=='on'){
        session_regenerate_id();    
    //  session_destroy();
    }










?>


