<?
include_once('../../../../framework_code/framework.php'); 
include_once('../../../../services/facebook/src/facebook.php'); 

$facebook = new Facebook(array(
  'appId'  => $GLOBALS['FB_APP_ID'], 
  'secret' => $GLOBALS['FB_SECRET'], 
));




// Get User ID
$user = $facebook->getUser();


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile['data'] = $facebook->api('/me');
    $user_profile['logout_url'] = $facebook->getLogoutUrl();
    $user_profile['friends'] = $facebook->api('/me/friends');
    display_json($user_profile);
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if (!$user) {
  $loginUrl = $facebook->getLoginUrl();
  $error = array('login_url' => $loginUrl); 
  $json = json_encode($error);
  display_json($json);

}


?>

