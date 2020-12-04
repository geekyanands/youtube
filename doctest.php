<?php



$service_url = 'http://10.0.1.67:8080/DORest/1.3/jobs';

$xml = file_get_contents ("D:\Test\check.xml");

$check_path='$U/Overrides//BaseDocumentGeneration.wjs';

$result = api_call($service_url,$xml,$check_path);
if ($result == false || strpos($result,"EOF")==false){
    print_r( ' Response Error: ');
    print_r($result); 
} 
else{
$result = explode("\r\n\r\n", $result, 2);
print_r($result); 


$myfile = fopen("C:\\Users\\Vineeth\\Downloads\\Document_SAMPLE.pdf", "w") or die("Unable to open file!");

fwrite($myfile, $result[1]);

fclose($myfile);

}

function api_call ($endpointurl, $requestXML,$check_path) {
    $curl = curl_init();
    $curl_post_data = array(
        'input' => $requestXML,
        'scriptName'=>$check_path
    );
    curl_setopt( $curl, CURLOPT_URL, $endpointurl );
    curl_setopt($curl, CURLOPT_USERPWD, 'user:pass');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    curl_setopt($curl, CURLINFO_HEADER_OUT,true);
    curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    //   curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
    //  curl_setopt($curl, CURLOPT_TIMEOUT, 10); // 5 sec
  //  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
    $response = curl_exec($curl);
    
    curl_close($curl);
    
    return $response;
}	




?>