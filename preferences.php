<?php
//enable this when finished
//error_reporting(0);
session_start();
if(!isset($_SESSION['login_user'])) {
	header("location: index.php");	
	exit;
}		
?>
<!DOCTYPE html>
<html>
	<head>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="js/logout.js"></script>
		<script src="js/preferences.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA_VTS6otdV5SUrMIEtkCk189jKBkq4QW8" async defer></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style type="text/css">
			html, body { height: 100%; margin: 0; padding: 0; }
			#map { height: 100%; }
		</style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/preferences.css">
	</head>
	<body>
        <header>
        <nav class="navbar navbar-default">
  	    <div class="container-fluid">
    		<div class="navbar-header">
     		    <div class="navbar-brand" style="margin-left:300px;">Free Time App</div>
    		</div>
    		
   		<ul class="nav navbar-nav">
     		 <li><a href="profile.php">Home</a></li>
 
 
 		 <!--<li><a href="preferences.php">Preferences</a></li>-->
     		 <!--<li><a href="#" id="logout">Logout</a></li> -->
     		 
   	 	</ul>
   	 	<ul class="nav navbar-nav navbar-right" style="margin-right:500px;">
	     	 <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
	     	 <li class="active"><a href="preferences.php">Preferences</a></li>
	    	 <li><a href="#" id="logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
	   	</ul>

  	    </div>
	</nav>
        
        </header>
        
		<div class="container" id="container">
			<div id="preferences-area">
				<div class="jumbotron" style="height: 120px; background: transparent;">
					<div id="preference-div">
					<h2>Preferences</h2>
					</div>
				</div>
				<form>
				<div id="form-div">
				<table class="table">
				    <tbody>
				      <tr>
				        <td class="col-sm-3" style="border-right: 1px solid #D3D3D3; text-align:right; margin-right: 10px;">Email address</td>
				        <td class="col-sm-9"style="border-right: 1px solid #D3D3D3;  text-align:left;"><input type="text" placeholder="New e-mail address" id="new-email"></input></td>
				      </tr>
				      <tr>
				        <td class="col-sm-3" style="border-right: 1px solid #D3D3D3; text-align:right; margin-right: 10px;">Security</td>
				        <td class="col-sm-9"style="border-right: 1px solid #D3D3D3;  text-align:left;"><input type="text" placeholder="Current password" id="current-password"></input> <input type="text" placeholder="New password" id="new-password"></input> <input type="text" placeholder="Confirm new password" id="confirm-password"></input></td>
				      </tr>
				    </tbody>
			         </table>
			         <label id="error-msg"></label>
			      <input type="button" id="save-changes" value="Save Changes" style="float:right"></input>    
			      </div>
			       	</form>
			</div>
		</div>
	</body>
</html>