<?php 
    $u = "contactus";
    include('../php/register.php');
    include('../php/rememberme.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/contactus.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
  <?php include('navigation.php'); ?>

    <br>

    <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image" />
                    <h2>Contact Us</h2>
                    <h4>We would love to hear from you !</h4>
                </div>
            </div>
            <div class="col-md-9">
                <form action="../php/send_script_contactus.php" method="post">
                    <div class="contact-form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fname">First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lname">Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comment">Comment:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="comment" name="msg"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="send_message_btn">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div><?php include('footer.php') ?></div>
    
</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>