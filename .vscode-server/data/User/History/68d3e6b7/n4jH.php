<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
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
                        window.open("https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/test_credentials.php", "_blank", 
                        "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");
                    }
                </script>
            </div><br>

            <!-- Form to change password, handled via AJAX -->
            <form id="passwordChangeForm" onsubmit="return handleFormSubmit(event);">
                New password:<br>
                <input type="password" autocomplete="off" name="password_new" id="password_new"><br>
                Confirm new password:<br>
                <input type="password" autocomplete="off" name="password_conf" id="password_conf"><br><br>
                <input type="submit" value="Change" name="Change">
            </form>

            <!-- This will display the response -->
            <pre id="responseMessage">Password not changed yet.</pre>
        </div>
    </div>

    <script>
        function handleFormSubmit(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Get form data
            const passwordNew = document.getElementById("password_new").value;
            const passwordConf = document.getElementById("password_conf").value;

            // Construct the query string
            const queryString = new URLSearchParams({
                password_new: passwordNew,
                password_conf: passwordConf
            }).toString();

            // Append query string to the URL and send the request
            fetch(`https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/?${queryString}`, {
                method: "GET"
            })
            .then(response => response.text())
            .then(result => {
                // Display the server's response inside the <pre> element
                document.getElementById("responseMessage").textContent = result;
            })
            .catch(error => {
                document.getElementById("responseMessage").textContent = "Error: " + error;
            });
        }
    </script>
</body>
</html>
