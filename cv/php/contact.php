<?php 
$array= array("prenom" =>"","nom" =>"","email" =>"","phone" =>"","message" =>"","prenomerror" =>"","nomerror" =>"","emailerror" =>"","phoneerror" =>"","messageerror" =>"","issucces"=> false);


$emailto="john@apprendre-a-coder.com";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	    $array["prenom"] = verfiyinput($_POST["prenom"]);
		$array["nom"] = verfiyinput($_POST["nom"]);
		$array["email"] = verfiyinput($_POST["email"]);
		$array["phone"] = verfiyinput($_POST["phone"]);
	    $array["message"] = verfiyinput($_POST["message"]);
        $array["issucces"]=true;
	    $emailtext="";
	if(empty( $array["prenom"]))
	{
	     $array["prenomerror"]="je veux connaitre ton prénom";  
		 $array["issucces"]=false;
	}
	else 
	{
	    $emailtext .="prenom:{$array["prenom"]}\n";
	}
		
	if(empty( $array["nom"]))
	{
	     $array["nomerror"]="et oui,je veux tout savoir.meme ton nom ";  
	     $array["issucces"]=false;
	}
	else
	{
		$emailtext .="nom:{$array["nom"]}\n";
	}
	if(empty( $array["message"]))
	{
	     $array["messageerror"]="que-ce-que tu veux ne dire?";  
		 $array["issucces"]=false;
	}
	else
	{
		$emailtext .="message:{$array["message"]} \n";
	}
		
	if(!isemail( $array["email"]))
	{
		 $array["emailerror"]="l'essaie de me rouler ?c'est pas un email ça! ";
		 $array["issucces"]=false;
	}
	else
	{
		$emailtext .="email:{$array["email"]}\n";
	}
		

	if(!isphone( $array["phone"]))
	{
	       $array["phoneerror"]="que des chiffre et des espace ...";
		   $array["issucces"]=false;
	}
	else
	{
		$emailtext .="phone:{$array["phone"]}\n";
	}
		
	if($array["issucces"])
	{
		$headers= "form:{$array["prenom"]} {$array["nom"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
		mail($emailto,"un message pour votre site",$emailtext,$headers);
		
	}
	echo json_encode($array);
	
}
function isphone($var){
	return preg_match("/^[0-9 ]*$/" ,$var);
}
function isemail($var)
	{
		return filter_var($var,FILTER_VALIDATE_EMAIL);
	}
function verfiyinput($var)
{
	$var= trim($var);
	$var= stripslashes($var);
	$var= htmlspecialchars($var);
	return $var;
}



?>
	
