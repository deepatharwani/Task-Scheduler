<?php include('database/server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Jura" />
</head>
<body>
<div style="opacity: 0.8;">
<div class="jumbotron" style="height: auto; width: 100%; margin-top: 10px; padding: 2rem 2rem;">
    <h2>Task Scheduler</h2>      
    <p>A website that helps you prioritize your tasks.</p>
  </div>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('database/errors.php'); ?>
    
    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><img src="image/email.png"></span>
    </div>
    <input style="border-top-left-radius: 5px;    border-bottom-left-radius: 5px;    height: auto;" type="text" name="email" placeholder=" Email " class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>

    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><img src="image/phone.png"></span>
    </div>
    <input style="border-top-left-radius: 5px;    border-bottom-left-radius: 5px;    height: auto;" type="text" name="phone" placeholder=" Phone " class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>

    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><img src="image/usericon.png"></span>
    </div>
    <input style="border-top-left-radius: 5px;    border-bottom-left-radius: 5px;    height: auto;" type="text" name="username" placeholder=" Username " class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>

    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><img src="image/password.png"></span>
    </div>
    <input style="border-top-left-radius: 5px;    border-bottom-left-radius: 5px;    height: auto;" type="password" name="password_1" placeholder=" Password " class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>

    <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><img src="image/password.png"></span>
    </div>
    <input style="border-top-left-radius: 5px;    border-bottom-left-radius: 5px;    height: auto;" type="password" name="password_2" placeholder=" Confirm password " class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn btn-primary" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

</div>
</body>
</html>