<?php
 session_start();
?>
<head>
	<script type='text/javascript' src='jquery-1.8.3.js' ></script>
	<script type='text/javascript' src='jquery-ui-1.9.2.custom.js' ></script>
</head>
<style>a{text-decoration: none;}</style>
<?php
require_once "class_.php";

//istanzio class ma non ho capito ancora l utilizzo del perchè devo passare caratteri dentro
//visto che li ho dichiarati dentro la class ... capirò
$valore = new contatti("nome1", "nome2", "nome3", "nome4", "nome5", "nome6");

//ottengo il form per le insert e i ltext per il login ... 
echo $valore -> form();






?>

<div id='printresult'> </div>

<?php




// VARIATO il cookie con la sessione......... 
      // Se esiste già la sessione 
      // automitico login ... passo il cookie 
   
    $controlcookie = new utenti();
   
   
    //$controlcookie->trovasesiste($_COOKIE['mycooker'],"");
    $controlcookie -> trovasesiste(session_id(),"");
    
  //  setcookie("mycooker", session_id(), time() + 3000000);



?>

<script type='text/javascript' src='mynova.js' ></script>