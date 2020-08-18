<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first!";
  	header('location: register.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Task Scheduler</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Jura" />
  
        <script >
          function showh(){
            if(document.getElementById("inputGroupSelect01").value != "4"){
              document.getElementById("nu").required = "true";
              //document.getElementById("num").value = " ";
            }
            else{
              document.getElementById("deadline").type = "hidden";
              document.getElementById("nu").type = "text";
              alert("Enter the number of days after which you want the reminder :-) ")
            }
          }
        </script>

</head>
<body>
<div>
<div class="jumbotron" style="height: 180px; width: 100%; margin-top: 10px; padding: 2rem 2rem; opcaity: 0.8;">
    <h2>Task Scheduler</h2>      
    <p>A website that helps you prioritize your tasks.</p>
    <button type="submit" class="btn btn-secondary" name="addbutton" onclick="location.href = 'index.php';" style="border:0px;margin-left: 25px; margin-top: 0px;"><img src="image/back.png"></button>
 
  <div class="dropdown" style="float: right; opacity: 1;">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
    <img src="image/user.jpg">
    </button>
    <div class="dropdown-menu">
    <p class="dropdown-item"><strong><?php echo $_SESSION['username']; ?></strong></p>
      <a class="dropdown-item" href="index.php?logout='1'">Logout</a>
    </div>
    </div>
  </div>
<div class="flex-container">
    <div style="overflow-y: scroll; height: 300px; width: 550px; opacity: 0.9;" class='table-responsive'>
    
    <form action="add.php" method="post" style="width: 100%;">
        <p style="margin-left: 15px; margin-right: 15px; margin-top: 0px; margin-bottom: 0px;">Task name</p>
      	<div class="input-group">
          <input type="text" style="width: 75%; border-top-left-radius: 5px;    border-bottom-left-radius: 5px; height: 50px; margin-left: 15px; margin-right: 15px; margin-top: 5px; margin-bottom: 5px;" id="taskname" class="form-control validate" name="task" required>
        </div>
        <div class="input-group">
        <select class="custom-select" onchange="showh();" id="inputGroupSelect01" name="label" required>
            <option value="">Task type</option>
            <option value="1">Urgent & Important</option>
            <option value="2">Urgent</option>
            <option value="3">Important</option>
            <option value="4">Periodic</option>
        </select>

            <input type="hidden"  name="taskno">
      	</div>

        <p style="margin-left: 15px; margin-right: 15px; margin-top: 0px; margin-bottom: 0px;">Deadline</p>
        <div class="input-group">
        <input type="hidden"style="width: 75%; border-top-left-radius: 5px;    border-bottom-left-radius: 5px; height: 50px; margin-left: 15px; margin-right: 15px; margin-top: 5px; margin-bottom: 5px;" id="nu" class="form-control validate" name="nu" value="0">          
        <input type="date" min="<?php date_default_timezone_set('Asia/Kolkata'); $cd = date('Y-m-d'); echo $cd; ?>" style="width: 75%; border-top-left-radius: 5px;    border-bottom-left-radius: 5px; height: 50px; margin-left: 15px; margin-right: 15px; margin-top: 5px; margin-bottom: 5px;" id="deadline" class="form-control validate" name="deadline" value="<?php echo $deadline; ?>">
        </div>
	<p style="margin-left: 15px; margin-right: 15px; margin-top: 0px; margin-bottom: 0px;">Description</p>
        <div class="input-group">
          <textarea  style="width: 75%; border-top-left-radius: 5px;    border-bottom-left-radius: 5px; height: 150px; margin-left: 15px; margin-right: 15px; margin-top: 5px; margin-bottom: 5px;" rows="3" id="detail" class="form-control validate" name="detail" ></textarea>
        </div>
      <div class="modal-footer" style="border: 0px;">
      <div class="d-flex">
        <button type="submit" name="insert" class="btn btn-info" style="opacity: 1;"><img src="image/save.png"></button>
      </div>
      </div>  

    </div>
</div>
    </form>
    </div>
</div>
</body>

</html>

<?php
  if(isset($_POST["insert"]))
  {
     include('database/connect.php'); 
     $hey = $_SESSION['username'];
     $n = $_POST['nu'];
     $tn = $_POST['task'];
     $dl = $_POST['deadline'];
     $det = $_POST['detail'];
     $l= $_POST['label'];
     if ($dl == 0000-00-00)
     {
        date_default_timezone_set('Asia/Kolkata'); 
        $dl = date('Y-m-d');
        $dl = date('Y-m-d',strtotime($dl.'+'.$n.' days'));
     }
     $cd = date('Y-m-d');
     $sql = "INSERT INTO task (`username`, `tname`, `detail`, `label`,`C_date` ,`deadline`) VALUES ('$hey', '$tn', '$det', '$l','$cd','$dl')";
     if ($conn->query($sql) === TRUE) {
       echo "<div class='alert alert-success'>
       <strong>Success!</strong> A new task has been added.
     </div>";
       } else {
       echo "<script>
       alert('Error: ' . $sql . '<br>' . $conn->error;');
      </script>";
       }
       $conn->close(); 
       header("location: index.php");
   }
  ?>