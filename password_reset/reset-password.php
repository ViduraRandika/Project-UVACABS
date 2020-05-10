<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="reset-request.inc.php" method="post">
        <input type="text" name="email" placeholder="Enter your email address">
        <input type="submit" name="reset-request-submit" value="submit">
    </form>
    <?php
    if(isset($_GET["reset"])){
        if ($_GET["reset"]=="success") {
            echo '<p>Check your email</p>';
        }
        if ($_GET["reset"]=="invalid") {
            echo '<p>We cant find your email.</p>';
        }
    }
    ?>
</body>
</html>