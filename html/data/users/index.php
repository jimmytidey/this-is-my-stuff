<?
    include_once('../../framework_code/framework.php'); 
    $json['data'] = list_documents('users'); 
    display_json($json);

?>