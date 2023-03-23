<?php
session_start();

if(isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if(isset($_SESSION['steamid'])) {
    // The user is already logged in. Redirect to the homepage.
    header("Location: Messages.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Game Toxicity Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap">
    <link rel="stylesheet" href="/CSS/Homepage.css">
</head>
<body>
<header>
    <h1>Video Game Toxicity Data</h1>
</header>
<body>
<h1>Login with Steam</h1>
<form action="../php/authenticate.php" method="post">
    <input type="submit" value="Login with Steam" />
</form>
</body>
</html>