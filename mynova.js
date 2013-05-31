 
 
 
 
 
 
 
 
 
 

 	$('#trovanome').keyup(function(){
 		var r = $(this).val();
 			$("#printresult").load("result.php?trovanome=" + r );
 	});
 
 	

 
 
 
  	$(".hideresult").hide('fast');
  	$("#trova").hide('fast');
 
 $(".vedirisult").click(function(){

 

 	
 		$(".vedirisult").hide('slow');
 		$(".hideresult").show('slow');
   	$("#trova").show('fast');
 	$("#printresult").fadeIn("slow").load("result.php");

 });
 
 
 
  $(".hideresult").click(function(){

 	$(this).hide('slow');
 	 		$(".vedirisult").show('slow');
 	$("#printresult").fadeOut("slow");

 });
 
 
 
 
 
            function invapost(){
           $.post("control.php",$("#formcont").serialize()).done(function(data){
$("#printresult").load("result.php");

});
            }
            
            
            $(".invia").click(function(){invapost() ; } );
         //testo vuoto
function cntr(r){
if( $(r).val() == "" ){
$(r).css({'border':'3px solid red'})
}else{$(r).css({'border':'3px solid green'})
}
}













