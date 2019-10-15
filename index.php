<?php 
require_once('lib/nusoap.php') ;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
if ($_POST) {
  	$numero_fact = $_POST['numero_fact'];
  	$vRefenca = $_POST['vRefenca'];
    $telcli = $_POST['telcli'];
    try{
    $client = new nusoap_client ('http://192.168.222.95/WEBSERVICE_ORACLE_WEB/awws/WebservicePlus.awws?wsdl', true);
      $err = $client->getError();
       if ($err) echo "<strong>Error:</strong>".$err;
        $resulat = $client ->call('Check_facture_ptf',array('vnum_fact'=>$numero_fact,'vRefenca'=>$vRefenca,'telcli'=>$telcli));
        $array = json_decode(json_encode($resulat),true);
     foreach($array as $item) {
              echo $item;
        }
    }
    catch(Exception $e){
     echo $e->getMessage();
    }
}