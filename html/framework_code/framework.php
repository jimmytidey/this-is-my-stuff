<?
session_start();
if (!isset($_SESSION['authenticated'])) { 
    $_SESSION['authenticated'] = 'false';
}

//keyword $GLOBALS['xxx'] just means that we can access the variable 

$GLOBALS['APP_NAME'] 		= "test"; 

//Facebook 
/* To set up a facebook app: 
goto https://developers.facebook.com/apps
You will need to specify website authentication and give your app a domain 
Youc can read about the possible permissions here: 
http://developers.facebook.com/docs/authentication/permissions/
*/
$GLOBALS['SITE_URL'] 		= "http://localhost"; 
$GLOBALS['FB_REDIRECT']     = "http://localhost:88/framework/html/data/facebook/";
$GLOBALS['FB_APP_ID'] 		= "188513601267454"; 
$GLOBALS['FB_SECRET']       = '73acb7112a1cf3fa6989e39bc176077e';
$GLOBALS['FB_PERMISSIONS']  = 'user_about_me,friends_about_me,user_activities,friends_activities,user_birthday,friends_birthday,user_checkins,friends_checkins,user_education_history,friends_education_history,user_events,friends_events,user_groups,friends_groups,user_hometown,friends_hometown,user_interests,friends_interests,user_likes,friends_likes,user_location,friends_location,user_notes,friends_notes,user_photos,friends_photos,user_questions,friends_questions,user_relationships,friends_relationships,user_relationship_details,friends_relationship_details,user_religion_politics,friends_religion_politics,user_status,friends_status,user_videos,friends_videos,user_website,friends_website,user_work_history,friends_work_history,email,,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,xmpp_login,ads_management,create_event,manage_friendlists,manage_notifications,user_online_presence,friends_online_presence,publish_checkins,publish_stream,rsvp_event,publish_actions,user_actions.music,friends_actions.music,user_actions.news,friends_actions.news,user_actions.video,friends_actions.video,user_games_activity,friends_games_activity';



//MONGODB
$GLOBALS['DB_LOCATION'] 	= "https://api.mongolab.com/api/1/databases/jimmytidey";
$GLOBALS['DB_API_KEY']		= "4f4fcacce4b085da4b636af4";

//PUBNUB
$GLOBALS['PUB']             = '';

//includes 
$GLOBALS['ROOT']             = dirname(__FILE__);
 
include_once($GLOBALS['ROOT'] . '/utility_functions.php');
include_once($GLOBALS['ROOT'] . '/db_functions.php');
include_once($GLOBALS['ROOT'] . '/user_manager.php');

?>