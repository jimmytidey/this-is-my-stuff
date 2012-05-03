<?
$cookie_name = $GLOBALS['APP_NAME']."_user_cookie"; 


//check if Cookie already exists 
if (isset($_SESSION['session_id'])){ 
    $id = $_SESSION['session_id'];
    $existing_data = show_document("users", $id);
    $existing_data['last_interaction']=time(); 
    $progress = update_document('users', $id, $existing_data);
    $json['status']= 'updating old user';
    $cookie_name = $GLOBALS['APP_NAME']."_user_cookie"; 
    $user_id =  $_SESSION['session_id'];
}

else {
    $id                         = rand(0,99999999999);
    $user['last_interaction']   = time();
    $user['ip']                 = $_SERVER['REMOTE_ADDR'];
    $user['role']                 = 'user';
    $expire=time()+60*60*24*30;
    $cookie_name = $GLOBALS['APP_NAME']."_user_cookie";
    $_SESSION['session_id'] = $id;
    $_SESSION['session_auth'] = 'temp';
    $progress = update_document('users', $id, $user);
    $json['status']= 'creating new user';
}




?>