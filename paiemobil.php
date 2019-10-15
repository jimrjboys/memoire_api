<?php 
require_once('lib/nusoap.php') ; 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
if ($_POST) {
	$vNUM_SESSION = $_POST['vNUM_SESSION'];
	$vnum_fact = $_POST['vnum_fact'];
	$vref_client = $_POST['vref_client'];
	$vdate_paie = $_POST['vdate_paie'];
	$vtel_client = $_POST['vtel_client'];
	$vmontant = $_POST['vmontant'];
	$vtel_jirama = $_POST['vtel_jirama'];
	try{

		$client = new nusoap_client ('http://192.168.222.95/WEBSERVICE_ORACLE_WEB/awws/WebservicePlus.awws?wsdl', true);
		$err = $client->getError();
		if ($err) echo "<strong>Error:</strong>".$err;
		$resulat = $client ->call('Paie_Mobile',array('vNUM_SESSION'=>$vNUM_SESSION,
						'vnum_fact'=>$vnum_fact,
						'vref_client'=>$vref_client,
						'vdate_paie'=>$vdate_paie,
						'vtel_client'=>$vtel_client,
						'vmontant'=>$vmontant,
						'vtel_jirama'=>$vtel_jirama
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