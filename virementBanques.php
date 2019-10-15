<?php 
require_once('lib/nusoap.php') ; 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
if ($_POST) {
	$NumFact = $_POST['NumFact'];
	$Montant = $_POST['Montant'];
	$TelClient = $_POST['TelClient'];
	$RefVirement = $_POST['RefVirement'];
	$NomEmetteur = $_POST['NomEmetteur'];
	$CompteBanque = $_POST['CompteBanque'];
	$DateVirement = $_POST['DateVirement'];
	$RefTRansaction = $_POST['RefTRansaction'];
	try{
		$client = new nusoap_client('http://192.168.222.95/WEBSERVICE_ORACLE_WEB/awws/WebservicePlus.awws?wsdl', true);
		$err = $client->getError();
		if ($err) echo "<strong>Error:</strong>".$err;
		$resulat = $client->call('Virement_banque',array('NumFact'=>$NumFact,
						'Montant'=>$Montant,
						'TelClient'=>$TelClient,
						'RefVirement'=>$RefVirement,
						'NomEmetteur'=>$NomEmetteur,
						'CompteBanque'=>$CompteBanque,
						'DateVirement'=>$DateVirement,
						'RefTRansaction'=>$RefTRansaction
					));
		$array = json_decode(json_encode($resulat), true);
			foreach($array as $item) {
			 	echo $item;
			}
	}catch(Exception $e){
		echo $e->getMessage();
	}
}
?>
