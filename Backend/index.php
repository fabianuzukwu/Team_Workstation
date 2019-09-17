<?php
	// Inject necessary files
	include ('functions.php');
	$auth = confirm_auth();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-form">
                        <h2 class="form-title">Team Workstation HNG Task Page</h2>
						<h3> <?php echo "Welcome {$auth['name']} "  ?> </h3>
						<p> We hope you had a seemless experience getting in here</p>
                        <form method="POST" class="register-form" action="logout.php">
                            <div class="form-group form-button">
                                <input type="submit" name="logout" id="logout-btn" class="form-submit" value="Logout"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
</body>
</html>