<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];
        if(empty($selector)||empty($validator)){
            echo "Could not validate your request";
        }else{
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>

                <form action="reset-password.inc.php" method="post">
                    <input type="hidden" name="selector" value="<?php echo $selector;?>">
                    <input type="hidden" name="validator" value="<?php echo $validator;?>">
                    <input type="password" name="pwd" id="password_1" placeholder="Enter a new password" onkeyup='check();' required>
                    <input type="password" name="pwd-repeat" id="password_2" placeholder="Repeat new password" onkeyup='check();' required>
                    <input type="submit" name="reset-password-submit" value="Reset Password">
                </form>
                <br><br><br><br>
                <label id="message"></label>
            
                <?php
            }else{
                
            }
        }
    ?>
</body>
<script>
    var check = function() {

        if (document.getElementById('password_1').value ==
            document.getElementById('password_2').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
            if (document.getElementById('password_1').value == "") {
                document.getElementById('message').innerHTML = '';
            }
        } else if (document.getElementById('password_1').value !=
            document.getElementById('password_2').value) {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }

    }
</script>
</html>