<?php

##########################################################################
# Pagina em php com login para executar shell script 
# Revision: 1.0
# Date: 16/11/2016
# Author: Diego Maia - diegosmaia@yahoo.com.br Telegram - @diegosmaia
##########################################################################

# http://www.php.net/features.http-auth
# Aproveitei algumas coisas pra adiantar


$valid_passwords = array ("dmaia" => "teste");
$valid_users = array_keys($valid_passwords);


// If arrives here, is a valid user.
echo "<h1>Script para desativar/ativar porta Switch</h1>";
echo "<br/><br/>";
echo "<form action=\"index.php\" method=\"post\">";
echo "IP <input type=\"text\" name=\"equipip\" maxlength=\"50\" value=" .(isset($_POST['equipip']) ? $_POST['equipip'] : "").">";
echo "Porta <input type=\"text\" name=\"equipporta\" maxlength=\"2\" value=".(isset($_POST['equipporta']) ? $_POST['equipporta'] : "").">";
echo "<input type=\"submit\" name=\"formSubmit\" value=\"Submit\">";
echo "</form>";
echo "<div>";
echo "Resultado:";
if($_POST['formSubmit'] == "Submit") 
  {
    $varip = $_POST['equipip'];
    $varporta = $_POST['equipporta'];
	$user = $_SERVER['PHP_AUTH_USER'];
	$pass = $_SERVER['PHP_AUTH_PW'];

	$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);
	if (!$validated) {
  		header('WWW-Authenticate: Basic realm="My Realm"');
  		header('HTTP/1.0 401 Unauthorized');
  		die ("Voce nao esta autorizado para executar este script");
	}
	$output = shell_exec('ls -lart');
	#$output = shell_exec('script.sh $varip $varporta');
	echo "<pre>$output</pre>";
  }
echo "</div>";

?>

