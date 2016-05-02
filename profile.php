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
		<script src="js/render.js"></script>
		<script src="js/posting.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA_VTS6otdV5SUrMIEtkCk189jKBkq4QW8" async defer></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style type="text/css">
			html, body { height: 100%; margin: 0; padding: 0; }
			#map { height: 100%; }
		</style>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/posting.css">
		<link rel="stylesheet" href="css/friends.css">
	</head>
	<body>
        <header>
        <nav class="navbar navbar-default">
  	    <div class="container-fluid">
    		<div class="navbar-header">
     		    <div class="navbar-brand">Free Time App</div>
    		</div>
    		
   		<ul class="nav navbar-nav">
     		 <li class="active"><a href="profile.php">Home</a></li>
 
 
 		 <!--<li><a href="preferences.php">Preferences</a></li>-->
     		 <!--<li><a href="#" id="logout">Logout</a></li> -->
     		 
   	 	</ul>
   	 	<ul class="nav navbar-nav navbar-right">
	     	 <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
	     	 <li><a href="preferences.php">Preferences</a></li>
	    	 <li><a href="#" id="logout"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
	   	</ul>

  	    </div>
	</nav>
        
        </header>
        
		<div class="container" id="container">
		

					<div class="col-sm-3">
						<div class="row">
							<div class="UserProfile">
								<h3> Profile </h3>
							</div>
						</div>
						<div class="row">
							<div class="friend_content">
								<div class="friend_list">
									<h3>Friends</h3>
									
								</div>
								<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="btn-add-friend">+
									  </button>
									  <ul class="dropdown-menu">
									    <label style="color:grey; margin-left:5px;">Your 6 digit id is: <span id="user_id"><button id="show-id">SHOWID</button></span></label>
									    <br/>
									    <div style="text-align:center;" id="add-friend-code">
  									    	<input type="text" id="friend_code" placeholder="tesT" size="30"><br>
									    </div>
									    <label id="error-msg" style="float:left; margin-left:12px; color:red; font-weight:normal;"></label>
									    <div style="float:right; margin-right:12px; display:inline;" id="add-friend-div">
									    	<button id="add_friend">Submit</button>
									    </div>								    
									  </ul>
									</div>
								
							</div>
						</div>
					</div>

				<div class="col-sm-9">
					<div class="new_posting">
						<form>
							<textarea name="posting_textbox" id="posting_textarea" maxlength="200" cols="64" rows="3"></textarea>
							</br>
							<td><span class="word_cnt">200</span></td>
							<!--<input type="button" id="submit_post" value="Post">-->
							<button class="btn btn-success btn-xs" id="submit_post" style="float:right" value="Post">Post</button>
						</form>
					</div>
					<div class="posts" id="posts">
						<!-- Posts are generated here -->
					</div>
				</div>


		</div>
		<div class="bgCover">&nbsp;</div>
		<!-- overlay box -->
		<div class="OverlayBox">
			<div class="overlayContent">
				<!--normal content-->
				<div style="height:100%; width:100%;">
					<div id="overlay_div"></div>
					<button class="btn btn-primary active" id="close_map_btn" style="float: right">Close</button> 
				</div>
			</div>
		</div>
	</body>
</html>