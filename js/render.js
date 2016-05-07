window.onload = function() {
    var lat;
    var lon;
    setGeoLocation(function(lat, lon) {
        setCoord(lat,lon);
        getPosts();
    });
   
	function setGeoLocation(callback) {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				lat = getCoord(position.coords.latitude);
				lon = getCoord(position.coords.longitude);
				callback(lat, lon);
			});
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}
	function getCoord(s) {
		t = Math.round(s * 1000) / 1000;
		return t;
	}
	function setCoord(tlat, tlon) { 
		lat = tlat;
		lon = tlon;
    }
    
    function getPosts() {
        $.get("display_posts.php", {
                lat: lat,
                lon: lon,
                }, 
            function (data) { 
            //alert(data);
                var post_array= $.parseJSON(data);
                for (i = 0; i < post_array.length; i++) {
                    var div_s = "<div class=\"post\" data-value='" + post_array[i].Post_ID + "'>";
                    var desc = "	<p>" + post_array[i].Post_Desc + "</p>";
                    var mapBtn = "<button type=\"button\" class=\"btn btn-sm btn-info\" id=\"open_map\">Map</button>";
                    var geo = "<span style='display:none' id=\"geo\">" + post_array[i].Location + "</span>";
                    var time = "<span>" + post_array[i].Time_Stamp + "</span>";
                    var username = "<h3>" + post_array[i].Firstname + "</h3>";
                    var deletebtn;
                    var hangoutbtn;
                    var listPcpBtn;
                    if (post_array[i].isOwner == 'true'){
                        username = "<h3 style=\"background-color: yellow\">" + post_array[i].Firstname + "</h3>";
                        listPcpBtn = "<button type=\"button\" class=\"btn btn-sm btn-info\" id=\"list_ptcp\" data-toggle=\"modal\" data-target=\"#myModal\" style=\"float: left\">List</button>";
                        deletebtn= "<button type=\"button\" class=\"btn btn-danger btn-xs\" id=\"del_post\">Delete<span class=\"glyphicon glyphicon-remove\"></span></button>";
                        hangoutbtn = "";
                    }
                    else {
                        deletebtn = "";
                        listPcpBtn = "";
                        if (post_array[i].Is_Participant == 'Y'){
                            hangoutbtn = "<button type=\"button\" class=\"btn btn-danger\" id=\"ditch\" style=\"float: left\">Ditch</button>";
                        }
                        else {
                            hangoutbtn = "<button type=\"button\" class=\"btn btn-success\" id=\"hangout\" style=\"float: left\">Hangout</button>";
                        }
                    }
                    var div_e = "</div>";
                    var out = div_s + username + "<span id=\"time\"> " + time + "</span>" +  deletebtn  + desc + hangoutbtn + mapBtn + geo + listPcpBtn + "<br/><br/>" + div_e;
                    $('#posts').append(out);
                }
        });
    }
    
	    $.get("list_friends.php", 
	        function (data) { 
		    	var friends = $.parseJSON(data);
		    	var ul = "<ul style=\"list-style:none;\">";
		    	var ul_e = "</ul>";
		    	var out = "";
		    	for (i = 0; i < friends.length; i++) {
	                	var removeFriendBtn = "<button type=\"button\" class=\"btn btn-danger btn-xs\" id=\"removeFriend\">Remove Friend</button>";
		    	        out = out + "<li value=" + friends[i].User_ID + ">" + friends[i].Firstname + removeFriendBtn + "<br><br/>" + "</li>";
		    	}
		    	$('.friend_list').append(ul + out + ul_e);
	    });
	    
	    $.get("display_profile.php", 
	        function (data) { 
		    	if (data != "") {
		    		var username = data;
				$('#lbl-username').text(username);
			}
				    	
	    });

    
    $(document).on('click', '#removeFriend', function() {    
        var t = $(this);
        var parent = $(t).parent();
        var friend_id = $(parent).attr("value");
        $.post("remove_friend.php", {
            friend_id: friend_id,
        },
        function (data) { 
            if (data == "") {
                $(parent).remove();
            }
        });
    });
    
    $(document).on('click', '#add_friend', function() {
    	var key = $('#friend_code').val();   
        $.post("add_friend.php", {
            key: key,
        },
        function (data) { 
            if (data == "") {
                $('#error-msg').text("");	
            }
            else {
            	$('#error-msg').text(data);	
            }
        });
        return false;
    });

    $(document).on('click', '#show-id', function() {  
        var t = $(this);
        var parent = $(t).parent();
        $.get("gen_id.php", 
       
        function (data) { 
        	if(data != ""){
			t.remove();
			parent.append(data);
		}
        });
	 return false;
    });
}