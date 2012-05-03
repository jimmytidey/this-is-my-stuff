<?

$url = "http://qa.evrythng.net/thng-crud/v1/products?q=";

$data = file_get_contents($url . urlencode($_GET['query'])) ; 

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo $data; 

?>