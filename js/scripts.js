/*********** GLOBAL VARIABLES **********/

var about_message = "<span class=\"emph\">.: codebits geeky ui :.</span><br/>this is a terminal-like ui to access the codebits.eu website (for all those geeks that find the codebits website a bit non-geeky). it uses the <a href=\"http://codebits.eu/s/api\" target=\"_blank\">codebits api</a> to access all information.<br/><br/>developed by <a href=\"http://antoniolopes.info\" target=\"_blank\">A&there4; L&there4; of the Gr&there4; Lobster Lodge</a> a.k.a. <a href=\"http://codebits.eu/tonyvirtual\" target=\"_blank\">tonyvirtual</a><br/>";

// Message to be displayed on a non_implemented command
var not_implemented = "sorry, haven't had time to implement that feature just yet.";

// Message to be displayed when exiting
var exit_message = "it was nice to make your acquaintance, meat unit";

// List of help messages for each command
var help = {
	"about" : "know more about this website",
	"help" : "get a list of available commands",
	"login" : "login with codebits credentials",
	"logout" : "close session",
	"quit" : "close this terminal",
	"badges" : "list codebits badges",
	"badgeusers &lt;badge_id&gt;" : "list users for a given badge",
	"accepted" : "list accepted users for this year's event",
	"user &lt;user_id&gt;" : "get info on given user",
	"userbio &lt;user_id&gt;" : "get bio of given user",
	"userfriends &lt;user_id&gt;" : "list friends for a given user",
	"useradd &lt;user_id&gt;" : "add or confirm a given user as a friend",
	"userreject &lt;user_id&gt;" : "reject a given user as a friend",
	"usersessions &lt;user_id&gt;" : "list favorite calendar sessions for a given user",
	"session &lt;session_id&gt;" : "get info on given session",
	"calendar": "get this year's event calendar with detailed information",
	"subtalks" : "get a list of submitted talks",
	"talkup &lt;talk_id&gt;" : "vote thumbs up on a given talk",
	"talkdown &lt;talk_id&gt;" : "vote thumbs down on a given talk",
	"projects" : "list submitted projects for this year's competition",
	"projectinfo &lt;project_id&gt;" : "get info on a specific project",
	"projectvotes &lt;project_id&gt;" : "get the current number of votes of a given project",
	"projectup" : "vote thumbs up for the current project being presented",
	"projectdown" : "vote thumbs down for the current project being presented",
	"whoami" : "get logged user info",
	"myfriends" : "get logged user friends"
};

// List of commands
var commands = {
	"help" : display_help,
	"about" : display_about,
	"hello": "greetings, human",
	"search" : not_implemented,
	"login" : login,
	"logout" : logout,
	"close" : exit,
	"exit" : exit,
	"quit" : exit,
	":q" : exit,
	":x" : exit,
	"badges" : badges,
	"badgeusers" : badge_users,
	"42" : "answer to the ultimate question of life, the universe, and everything.",
	"user" : user,
	"userfriends": user_friends,
	"useradd": user_add,
	"userreject": user_reject,
	"usersessions": user_sessions,
	"session": session,
	"calendar": calendar,
	"subtalks": sub_talks,
	"talkup": talk_up,
	"talkdown": talk_down,
	"projects": not_implemented,
	"projectinfo": not_implemented,
	"projectvotes": not_implemented,
	"projectup": not_implemented,
	"projectdown": not_implemented,
	"userbio" : user_bio,
	"me" : user_info,
	"whoami" : user_info,
	"myfriends" : my_friends,
	"accepted" : accepted_users
};

// List of nasty terms...to be extended
var nasty_terms = [
	"fuck",
	"cunt",
	"shit",
	"tits",
	"boobs",
	"boobies",
	"titties",
	"cock",
	"bitch",
	"cum",
	"ass"
];

// Nasty terms reply
var nasty_term_message = "i believe that is not the proper way to speak to a lady.";

// In case of error
var error_message = "computer says no.";

var temp_username = "";

// Hack to have trim() working on IE
if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}

/****************************************/

// Function to escape special characters from the user's input
function escape_html(unsafe) {
  return unsafe
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

// Function that proccesses the input from the user
function process_input(input){
	if(input != ""){
		// Adds the user's input to the log box
		log('<span class="emph">%&gt; ' + escape_html(input) + '</span>');
	
		// Check for nasty terms
		if(exists_nasty_term(input)){
			log(nasty_term_message);
		}else{
			// Splits the input into an array of params
			var input_array = input.trim().split(" ");
			// Process it accordingly	
			process_command(input_array);
		}
	}
}

// Function that processes a command sent by the user
function process_command(input_array){
	// Compare with the list of commands
	for(var command in commands){
		// if it matches a command
		if(input_array[0].toLowerCase() == command){
			// check if command has a response
			if(typeof commands[command] === 'string'){
				log(commands[command]);
			}else{ // or is a function handler
				commands[command](input_array);
			}
			return;
		}
	}
	// If not in the list of commands, send error
	log(error_message);
}

// Function to check if there are any nasty terms
function exists_nasty_term(input){
	input = input.trim();
	// Compare with list of nasty terms
	for(var i in nasty_terms)
		if(input.toLowerCase().search(nasty_terms[i]) != -1)
			return true;
	return false;
}

// Function that adds text to the log box
function log(msg){
	$('#log').append('<br/>' + msg);
	// With animated scroll
	$('#log').animate({scrollTop:$("#log")[0].scrollHeight}, 1000);
	// Without animated scroll
	//$("#log").scrollTop($("#log")[0].scrollHeight);
}

// Execute closing animation
function exit(input_array){
	log(exit_message);
	$('#log').delay(1000).slideUp(1000, function(){
		$('#terminal').fadeOut(1000, function () {
			$('#refreshmsg').fadeIn(1000);
		});
	});
}

// Display about message
function display_about(input_array){
	log(about_message);
}

// Display help message
function display_help(input_array){
	var msg = "<ul>";
	for(item in help){
		msg = msg + '<li><span class="emph">' + item + '</span> - ' + help[item] + '</li>';
	}
	msg = msg + "</ul>";
	log(msg);
}

function ajax_call(call_type, call_url, call_data){
	log('processing...');
	$.ajax({
		type: call_type,
		url: call_url,
		data: call_data,
		success: function(msg){
			log(msg);
		},
		error: function(req, msg){
			log("could not complete request: " + msg);
		}
	});
}

// Perform logout call
function logout(input_array){
	ajax_call("GET", "api/logout.php", "");
}

// Perform login animation
function login(input_array){
	log("please, input your username (e-mail registered with codebits).");
	$('#inputbox').hide();
	$('#loginuser').show();
	$('#loginuser').val("");
	$('#loginuser').focus();
}

// Process username info
function process_username(input){
	log("now, please, input your password.");
	temp_username = input;
	$('#loginuser').hide();
	$('#loginpwd').show();
	$('#loginpwd').val("");
	$('#loginpwd').focus();
}

// Perform login call
function process_login(password){
	ajax_call("GET", "api/login.php", "username="+temp_username+"&password="+password);
	$('#loginpwd').hide();
	$('#inputbox').show();
	$('#inputbox').focus();
}

// Perform badge_users call
function badge_users(input_array){
	var badge_id = parseInt(input_array[1]);
	if(isNaN(badge_id)){
		log("usage: badgeusers &lt;badge_id&gt;");
	}else{
		ajax_call("GET", "api/listbadgeusers.php", "badgeid="+badge_id);
	}
}

// Perform badges call
function badges(input_array){
	ajax_call("GET", "api/listbadges.php", "");
}

// Perform user_info call
function user_info(input_array){
	ajax_call("GET", "api/userinfo.php", "");
}

// Perform user call
function user(input_array){
	var user_id = parseInt(input_array[1]);
	if(isNaN(user_id)){
		log("usage: user &lt;user_id&gt;");
	}else{
		ajax_call("GET", "api/userinfo.php", "userid="+user_id);
	}
}

// Perform user_bio call
function user_bio(input_array){
	var user_id = parseInt(input_array[1]);
	if(isNaN(user_id)){
		log("usage: userbio &lt;user_id&gt;");
	}else{
		ajax_call("GET", "api/userbio.php", "userid="+user_id);
	}
}

// Perform user_friends call
function user_friends(input_array){
	var user_id = parseInt(input_array[1]);
	if(isNaN(user_id)){
		log("usage: userfriends &lt;user_id&gt;");
	}else{
		ajax_call("GET", "api/userfriends.php", "userid="+user_id);
	}
}

// Perform accepted_users call
function accepted_users(input_array){
	ajax_call("GET", "api/acceptedusers.php", "");
}

// Perform user_add call
function user_add(input_array){
	var user_id = parseInt(input_array[1]);
	if(isNaN(user_id)){
		log("usage: useradd &lt;user_id&gt;");
	}else{
		ajax_call("GET", "api/useradd.php", "userid="+user_id);
	}
}

// Perform user_add call
function user_reject(input_array){
	var user_id = parseInt(input_array[1]);
	if(isNaN(user_id)){
		log("usage: userreject &lt;user_id&gt;");
	}else{
		ajax_call("GET", "api/userreject.php", "userid="+user_id);
	}
}

// Perform user_sessions call
function user_sessions(input_array){
	var user_id = parseInt(input_array[1]);
	if(isNaN(user_id)){
		log("usage: usersessions &lt;user_id&gt;");
	}else{
		ajax_call("GET", "api/usersessions.php", "userid="+user_id);
	}
}

// Perform session call
function session(input_array){
	var session_id = parseInt(input_array[1]);
	if(isNaN(session_id)){
		log("usage: session &lt;session_id&gt;");
	}else{
		ajax_call("GET", "api/sessioninfo.php", "sessionid="+session_id);
	}
}

// Perform sub_talks call
function sub_talks(input_array){
	ajax_call("GET", "api/subtalks.php", "");
}

// Perform talk_up call
function talk_up(input_array){
	var talk_id = parseInt(input_array[1]);
	if(isNaN(talk_id)){
		log("usage: talkup &lt;talk_id&gt;");
	}else{
		ajax_call("GET", "api/talkup.php", "talkid="+talk_id);
	}
}

// Perform talk_down call
function talk_down(input_array){
	var talk_id = parseInt(input_array[1]);
	if(isNaN(talk_id)){
		log("usage: talkdown &lt;talk_id&gt;");
	}else{
		ajax_call("GET", "api/talkdown.php", "talkid="+talk_id);
	}
}

// Perform calendar call
function calendar(input_array){
	ajax_call("GET", "api/calendar.php", "");
}

// Perform my_friends call
function my_friends(input_array){
	ajax_call("GET", "api/userfriends.php", "");
}

// JQuery on load function
$(document).ready(function() {
	$('#terminal').fadeIn(1000, function () {
		// focus on the input box
		$('#inputbox').focus();

		// Event for key press on input boxes (Enter code 13)
		$('#inputbox').keypress(function(e){
	    	if(e.which == 13){
				e.preventDefault();
				process_input($('#inputbox').val());
				$('#inputbox').val("");
	    	}
	    });
		// Event for key press on input boxes (Enter code 13)
		$('#loginuser').keypress(function(e){
	    	if(e.which == 13){
				e.preventDefault();
				process_username($('#loginuser').val());
	    	}
	    });
		// Event for key press on input boxes (Enter code 13)
		$('#loginpwd').keypress(function(e){
	    	if(e.which == 13){
				e.preventDefault();
				process_login($('#loginpwd').val());
	    	}
	    });
    });
});
