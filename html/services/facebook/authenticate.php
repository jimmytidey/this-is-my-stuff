<?
include_once('../../framework_code/framework.php'); 
include_once('src/facebook.php'); 

$facebook = new Facebook(array(
  'appId'  => $GLOBALS['FB_APP_ID'], 
  'secret' => $GLOBALS['FB_SECRET'], 
));

// Get User ID
$user = $facebook->getUser();
$expire=time()+200;
if (isset($_GET['return_url'])) { 
    $return_url = $_GET['return_url'];
    if ($return_url == 'here') { 
        $return_url = $_SERVER["HTTP_REFERER"]; 
    }
}



if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    
    //check if a user with this FB ID already exists
    $data = $facebook->api('/me');
    $fb_id = $data['id'];
    $fb_name = $data['name'];
    $query= '{fb_id:"'.$fb_id.'"}';
    $result = search_collection("users", $query);

    //Cannot sign into pre-existing user, should upgrade current accout 
    if (!isset($result['data'][0]->_id)) {
        $session_id = $_SESSION['session_id'];
        $data = array('fb_id'=> $fb_id, 'soc_net_auth' => 'fb_id', 'name' => $fb_name);        
        $result = update_document('users', $session_id, $data);
        $_SESSION['authenticated']= 'true';
        $_SESSION['session_auth'] = "fb";  
        $_SESSION['session_user_name'] =  $fb_name ;        
    }
    
    else {
        $user_id = $result['data'][0]->_id;
        $_SESSION['session_id'] = $user_id;
        $_SESSION['authenticated']= 'true';
        $_SESSION['session_auth'] = "fb";  
        $_SESSION['session_user_name'] =  $fb_name ;       
    }
    
    
    if (isset($return_url)) { 
        header("Location: " .$return_url);
    }
    else { 
        echo "You are authenticated with Facebook"; 
    }
    
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if (!$user) {
  $loginUrl = $facebook->getLoginUrl();
  $error = array('login_url' => $loginUrl); 

  header("Location: ".$loginUrl);
}


?>

