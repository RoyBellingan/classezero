<?php





    // LA CONNESSIONE 
function conntrue(){
        $my = new mysqli("localhost", "root", "new-password","test");
return $my ;
}





class contatti{
var $nome;
var $cognome;
var $email;
var $azienda;
var $telefono;
var $sito;


public function __construct (){
/*$nome,$cognome,$email,$azienda,$telefono,$sito 
$this->nome=$nome;
$this->cognome=$cognome;
$this->email=$email;
$this->azienda=$azienda;
$this->telefono=$telefono;
$this->sito=$sito;

 * 
 * 
 */

}
public function form(){
    
    // STAMPO TUTTI GLI UTENTI INTERNI tagliando le iniziali della parola segreta 
  $prova=new utenti();$prova->trovatuttiutenti();

?>

<form id='userpersonal' onsubmit='return false;' >
    <input  type='text'  name='credenziale'  class='credenziale'>
    <label></label>
   </form>
<form id='formcont' onsubmit='return false;'>
	nome:
	<input type="text" id='nome'  onkeyup="cntr(this)" name='nome' >
	cognome:
	<input type="text" onkeyup="cntr(this)" name='cognome'  id='cognome'>
	email:
	<input type="text"  onkeyup="cntr(this)" name='email' id='email'>
	azienda:
	<input type="text"  onkeyup="cntr(this)" name='azienda' id='azienda'>
	telefono:
	<input type="text"  onkeyup="cntr(this)" name='telefono' id='telefono'>
	sito:
	<input type="text"  onkeyup="cntr(this)" name='sito'  id='sito'>
	<input type="button" class="invia" value="registra" />
	<input type="button" class="vedirisult" value="Open" />
	<input type='button' class='hideresult' value='Closer' />

</form>

<form id='trova' onsubmit="return false;">
<input type='text'  id='trovanome' name='trovanome'/>
</form>



<?
}


//STAMPO AL VOLO TUTTO 

public function printresult($idutente,$nome){
$my=conntrue();

// $my = new mysqli("localhost", "root", "new-password","test");
    $sql="SELECT * from contact where id_exutente = $idutente  ";
    
    
    // SINGOLO SOLO NOME 
if($nome != ""){
    
    $sql.= " and   nome LIKE '%$nome%'   ";
   
}

    
    $sql.="order by id_contact desc limit 0,200 ";
 $result= $my -> query ($sql);
 
 echo "<table border='1' style='width:100%;'><thead><th>nome</th>
 <th>cognome</th><th>email</th><th>azienda </th>
 <th>telefono</th>
 <th>sito </th> <th>Inserito </th>
 </thead><tbody>";

 while ($ris=mysqli_fetch_assoc($result)){
     extract($ris);
     $dint = date('d-m-Y h:i:s',($datainsert));
     echo "<tr><td>$nome</td>
     <td>$cognome</td>
     <td>$email</td>
     <td>$azienda</td>
     <td>$telefono</td>
     <td>$sito</td>    <td> $dint</td></tr>  " ;
     
    
     
 }   
    echo "</tbody></table>";
    
    
    
    
    
}


// INSERISCI
public function  insertdb($array){
$id=  $_SESSION['id_utente'];
$datain=strtotime(date('d-m-Y h:i:s')  );
foreach($array as $v => $names){$lorifo.= $v.'='.$names.'&';}
parse_str($lorifo);
$my=conntrue();

$sql="INSERT into contact values(null,'$nome','$cognome','$email','$azienda','$telefono','$sito','$id','$datain' ) ";
$result= $my -> query ($sql);
print_r($lorifo);

}


//function trova da fare 
public function trova($arraydaform){
$my=conntrue();

$sql="SELECT * FROM  contact ";
$result= $my -> query ($sql);
while($row= mysqli_fetch_assoc($result)){
echo "<pre>";
print_r ($row);
echo "<pre>";
}

}




//FINE CLASSE CONTATTI 
}
























/** UTENTI VOLANTI  AL VOLO ..............
 * utenti per log volanti   gemellati alla  lista dei  contatti 
 */
 
class utenti  {
    var $mycooker;
	var $email;
    
    
	function __construct() {
		
	}


// QUI MI INCASINO SEMPRE  + credo di farla semplice + la incasino 

function trovasesiste($mycooker,$email){
    
    // QUI ERA NATO PERIL COOKIE INVECE PASSO LA SESSION 
     $my=conntrue();

      $sql='SELECT * from utenti where ';
    
    
    // se passo il cookie 
    // se il cooki o sessione che passo è presente nel DB 
      if ($mycooker !=""){
            $sql.= "mycooker ='$mycooker'   " ; 
      $result= $my -> query ($sql);
      
      
      }
      
      
      // $email Sarebbe il nome che l utente posta per fare login  
      // QUI MI POPOLA SE CLICKKA UN  NUOVO ENTRATO O SE IL NOME esiste nel DB 
      
      if ($email !=""){
          $sql.= "email='$email'   " ; 
      $result= $my -> query ($sql);
            // Se il nome non esiste 
       if($row= mysqli_num_rows($result) == 0){
       ?>
       <script>
       var newcl="Attenzione utente assente  --Crearlo - <a href='' onclick='return false;' class='newcl'  >Si creo-- (<?php echo $email;?>)</a>" ; 
       $('#userpersonal label').html(newcl);
      
    function      confermanew(){
            $('.newcl').click( function (){
                 $('#userpersonal label').html("ATTENDERE ......");
                
           $.post("control.php",{"confermautente":"yes","nomeperinsert":"<?php echo $email ;?>"}).done(function(data){
              location.reload();
           });
                      
       });};
        confermanew();
       </script>
<?php
           
      exit ;
       
       
       
       } 
       }
      

//$result= $my -> query ($sql);
  
  // QUI PASSA SE L UTENTE ESISTE DA NOME O DA COOKIE ;; O SESSIONE AL MOMENT
 if($row= mysqli_num_rows($result) > 0   ){

  
  
     
     $risult=mysqli_fetch_array($result);
     
     // QUI MI PRENDO L ID DELL UTNTE CHE FA LOGIN 
        $_SESSION['id_utente']=$risult['id_utente'];
     
  
     $cook=session_id();
     
     
$sqlupdatecook ="UPDATE utenti set mycooker='$cook' where id_utente='$_SESSION[id_utente]'   ";
       
        $resultupdate = $my -> query ($sqlupdatecook);
    
   
    
?>
<script type='text/javascript'>



var c =   $('.credenziale').val("<?php echo $risult['email'];?>" );

$('#userpersonal input ').hide("slow");

var out="<span class='output' style='color:red;padding-left:19px;cursor:pointer;' >Logout</span>";
 $('#userpersonal label').html("Utente Loggato come : <span style='color:green'>"+ c.val() +"</span>"+ out );
 
 $('.output').click(function() {
$.post("control.php",{"logout":"on"}).done(function(){
  location.reload();
  
  //   $('#formcont').fadeOut('slow');
//      $('#userpersonal').fadeIn("slow");
      
      
})
    
});
 
 
 
 //SE è loggato passa e si vede il form
 $('#formcont').fadeIn('slow');

      

       
</script>

<?php
 
 }else{
         
     //  FINO A QUANDO NON OTTENGO un nome 
?><script>
    $('#formcont').hide('slow');

// VABBE LASCIAMO STARE non va bene   ma va molto meglio 

function login(){

var c= $('.credenziale').val();
$('.credenziale').focus();


   $('#userpersonal label').html("Login o scegli una password "); 


//  Key up è sbagliato per l uso che ne servirebbe sarebbe meglio un set timeou .. 
  $('.credenziale').keyup(function(){

      var c=$(this).val();
      if(c.length > 6 ){
        $($('.credenziale')).css({"border":"4px solid green"});  
        $('#userpersonal label').html("<p class='insertutente' style='cursor:pointer;'>Entra e/o Registrati </p> ");  




// SE avviene un  insert new utente 
$('.insertutente').click(function(){
    $("#userpersonal label").html("attendere ...");
    
$.post("control.php",{'newclient':c }).done(function(data){
    
    $("#userpersonal label").html(data);
    
});


});

  // $('#userpersonal input ').hide("slow");
 
 
  
      
           
            
                
}else{
  var count =  c.length - 7;
        $($('.credenziale')).css({"border":"14px solid red"});
       
        $('#userpersonal label').html("Scrivi altri "+ count );  
     $('#formcont').hide('slow');
     
     
     }
 
 });


}
login();
    
</script>

     <?php
         
      }   

    
    
}

function trovatuttiutenti(){
  $my=conntrue();

    $sql="SELECT * from utenti order by id_utente desc limit 0,1000";
    $result= $my -> query ($sql);
    
    echo "utenti :(".mysqli_num_rows($result).')-->';
while($row=mysqli_fetch_assoc($result)){
    $names=substr_replace($row['email'],'..',0,2);
   echo $names .'-';
}
}



function insertutente( $mycooker,$email){
    
$my=conntrue();

$sql="INSERT into utenti values (null,'$email','$mycooker') ";
$result= $my -> query ($sql);
 if($result){
     sleep(2);
   
 }else{echo mysqli_error(); }   

 }

	}




?>