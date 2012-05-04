


<div id='adi'>
    
    <?
    
    $doc_id  = $_GET['id']; 
    $adi_data = show_document("adi", $doc_id);
    $action = $adi_data['action']; 
    $product_id = $adi_data['product_id']; 
    $user_id = $adi_data['user_id']; 
    $user_query = json_encode(array("_id"=> $user_id)); 
    $user_data = search_collection("users", $user_query);
    $product_query = json_encode(array("id"=> $product_id)); 
    $product_data = search_collection("products", $product_query);
    echo "<h2>". $user_data[0]->name." ". $action  ."  ". $product_data[0]->fn . "</h2>";  
    echo "<img src='". $product_data[0]->photo . "' />";  
    ?>
     
    
</div>