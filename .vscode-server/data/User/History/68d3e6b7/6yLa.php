<html lang="en-GB"><head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<title>Damn Vulnerable Web Application (DVWA)Test Credentials</title>

		<link rel="stylesheet" type="text/css" href="../../dvwa/css/source.css">

		<link rel="icon" type="\image/ico" href="../../favicon.ico">

	</head>

	<body>

		<div id="container">

			
		<div class="body_padded">
			<h1>Test Credentials</h1>
			<h2>Vulnerabilities/CSRF</h2>
			<div id="code">
				<form action="https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/test_credentials.php" method="post">
					<fieldset>
						
						<label for="user">Username</label><br> <input type="text" class="loginInput" size="20" name="username"><br>
						<label for="pass">Password</label><br> <input type="password" class="loginInput" autocomplete="off" size="20" name="password"><br>
						<p class="submit"><input type="submit" value="Login" name="Login"></p>
					</fieldset>
				</form>

                <form action="#" method="GET">
			New password:<br>
			<input type="password" autocomplete="off" name="password_new"><br>
			Confirm new password:<br>
			<input type="password" autocomplete="off" name="password_conf"><br>
			<br>
			<input type="submit" value="Change" name="Change">

		</form>
				
			</div>
		</div>


		</div>

	

</body></html>