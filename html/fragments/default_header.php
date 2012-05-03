<? 
//include framework 
include('framework_code/framework.php');

if($_SESSION['session_auth'] != 'fb') {
    header("Location: services/facebook/authenticate.php?return_url=".$_SERVER["PHP_SELF"]);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title><?=$title ?></title>
		
		<!--  Main Script -->		
		<!-- <script type="text/javascript" charset="utf-8" src='framework_code/script/master.js'></script> -->
		
		<!--  Main CSS -->
		<link rel="stylesheet" href="framework_code/css/master.css" type="text/css" media="screen"  charset="utf-8">
		
		<!--  Editable CSS -->
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" charset="utf-8">
		
		<!--  jQuery -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
		<!-- <script type="text/javascript" charset="utf-8" src='framework_code/script/jquery-ui-1.8.17.custom.min.js'></script> -->
		
		<!-- Editable script -->
		<script type="text/javascript" charset="utf-8" src='script.js'></script>		
		<link rel="stylesheet" href="framework_code/css/jquery-ui-1.8.17.custom.css" type="text/css" media="screen" title="no title" charset="utf-8">
	</head>
	
	<body id="index" >
        
        <!-- All the context variables 
        authenticated = <? echo $_SESSION['authenticated'] ?>
        session_id = <? echo $_SESSION['session_id'] ?>
        session type = <? echo  $_SESSION['session_auth'] ?>
	    -->
	    
	    <input type='hidden' id='session_id' value="<? echo $_SESSION['session_id'] ?>"  />
	    
		<div pub-key="pub-3935e335-b4d7-4c1d-a53f-9902f8d18cb5" sub-key="sub-3cb83317-12c2-11e1-ae8f-cd58960bee98" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
		<!-- <script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script> -->

		<div id='content'>