<html lang="en-GB"><head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<title>Damn Vulnerable Web Application (DVWA)Test Credentials</title>

		<link rel="stylesheet" type="text/css" href="../../dvwa/css/source.css">

		<link rel="icon" type="\image/ico" href="../../favicon.ico">

	</head>

	<body>

		<div id="container">
        <div class="vulnerable_code_area">
		<h3>Change your admin password:</h3>
		<br> 
		<div id="test_credentials">
			
 <button onclick="testFunct()">Test Credentials</button><br><br>
 <script>
function testFunct() {
  window.open("https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/test_credentials.php", "_blank", 
  "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");
}
</script>

		</div><br>
		<form action="https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/" method="GET">
			New password:<br>
			<input type="password" autocomplete="off" name="password_new"><br>
			Confirm new password:<br>
			<input type="password" autocomplete="off" name="password_conf"><br>
			<br>
			<input type="submit" value="Change" name="Change">

		</form>
		<pre>Password Changed.</pre>
	</div>

		</div>

	

</body></html>