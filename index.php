<!DOCTYPE HTML>
<html>
	
	<head>
		<title>codebits.eu :: geek ui</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="css/style.css"  media="screen"  />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
 	</head>
	
	<body>
		<div id="refreshmsg">refresh the page for a new terminal window.</div>

		<div id="terminal">

			<div id="termtopbar">
				Terminal - bash - 520x600
			</div>

			<div id="header">
				<span class="emph">welcome to codebits.</span><br/>
				input your command or type <span class="emph">help</span> for a list of available commands.
			</div>
			
			<div id="log"></div>
			
			<div id="input">
				%> <input type="text" name="input" id="inputbox" autocomplete="off" />
				<input type="text" name="username" id="loginuser" autocomplete="off" />
				<input type="password" name="password" id="loginpwd" autocomplete="off" />
			</div>
		</div>
	</body>
</html>