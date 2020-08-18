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
  date_default_timezone_set('Asia/Kolkata');
  $cd = date('Y-m-d');
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
</head>
<body>
<div>
<div class="jumbotron" style="height: 180px; width: 100%; margin-top: 10px; padding: 2rem 2rem; opacity: 0.8;">
    <h2>Task Scheduler</h2>      
    <p>A website that helps you prioritize your tasks.</p>
	<button type="submit" class="btn btn-secondary" name="addbutton" onclick="location.href = 'add.php';" style="border:0px;margin-left: 25px; margin-top: 0px;"><img src="image/plus.png"></button>
 
  <div class="dropdown" style="float: right; opacity: 1;">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
    <img src="image/user.jpg">
    </button>
    <div class="dropdown-menu">
    <p class="dropdown-item"><strong><?php echo $_SESSION['username']; ?></strong></p>
      <a class="dropdown-item" href="index.php?logout='1'">Logout</a>
      <a class="dropdown-item" href="mailer/mail.php">Reminders</a>
    </div>
  </div>
  </div>
<div class="flex-container">

        <?php
            include('database/connect.php');
            $hey=$_SESSION['username'];
            $sql = "SELECT tname FROM task where username='$hey' order by label ASC, date(deadline) ASC limit 1";
            $result = mysqli_query($conn, $sql);
            if(!mysqli_query($conn, $sql)){
              echo "NO CONNECTION";
            }
            if ($result->num_rows == 1) {
              echo "<div class='jumbotron' style=' background: #808080; color: #ffffff; height: auto; width: 80%; margin-top: 10px; padding: 1rem 2rem; opacity: 0.8;'>";
              $row = $result->fetch_assoc();
              echo "<h4> To do now: ".$row["tname"]."</h4>";
              echo "</div>";
            }
            else {
            }
            $conn -> close();
          ?>

  <div style="border: 1px solid #ffffff; background: #ffb3ba; overflow-y: scroll; height: 300px; width: 550px; opacity: 0.8;" class='table-responsive'>
  <p class="font-weight-bold">
    Urgent & Important tasks 
  </p>  
    <?php
        include('database/connect.php');
        $hey=$_SESSION['username'];
        $sql = "SELECT * FROM task where username='$hey' and label='1' and done=0 order by date(deadline)";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover table-fixed'>
          <thead>
            <tr>
              <th scope='col'> # </th>
              <th scope='col'>TASK</th>
              <th scope='col'>DEADLINE</th>
            </tr>
          </thead><tbody>";
            while($row = $result->fetch_assoc()) {
              $date1=date_create(date('Y-m-d'));
              $date2=date_create($row['C_date']);
              $diff=date_diff($date1,$date2);
              if ($row['deadline'] > $cd) {
                echo"<tr><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td>".$row["tname"]."</td><td>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
              else{
                echo"<tr style='background: #ff6961;'><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td style='color: #ffffff'>".$row["tname"]."</td><td style='color: #ffffff'>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
            }
            echo "</tbody></table>";
        } 
        else {
          echo "<div class='text-center'><img src='image/smile.png' style='height: 150px; width: 150px;'><br><h5>You are all done for today.</h5></div>";
        }
        $conn -> close();
      ?>
    </div>
  <div style="border: 1px solid #ffffff; background: #ffffba; overflow-y: scroll; height: 300px; width: 550px; opacity: 0.8;" class='table-responsive'>
  <p class="font-weight-bold">
    Urgent tasks 
  </p>
    <?php
        include('database/connect.php');
        $hey=$_SESSION['username'];
        $sql = "SELECT * FROM task where username='$hey' and label='2' and done=0 order by date(deadline)";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover table-fixed'>
          <thead>
            <tr>
              <th scope='col'> # </th>
              <th scope='col'>TASK</th>
              <th scope='col'>DEADLINE</th>
            </tr>
          </thead><tbody>";
            while($row = $result->fetch_assoc()) {
              $date1=date_create(date('Y-m-d'));
              $date2=date_create($row['C_date']);
              $diff=date_diff($date1,$date2);
              if ($row['deadline'] > $cd) {
                echo"<tr><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td>".$row["tname"]."</td><td>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
              else{
                echo"<tr style='background: #ff6961;'><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td style='color: #ffffff'>".$row["tname"]."</td><td style='color: #ffffff'>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
            }
            echo "</tbody></table>";
          } 
          else {
            echo "<div class='text-center'><img src='image/smile.png' style='height: 150px; width: 150px;'><br><h5>You are all done for today.</h5></div>";
          }
        $conn -> close();
      ?>
    </div>
  <div style="border: 1px solid #ffffff; background: #baffc9; overflow-y: scroll; height: 300px; width: 550px; opacity: 0.8;" class='table-responsive'>
  <p class="font-weight-bold">
    Important tasks 
  </p>
    <?php
        include('database/connect.php');
        $hey=$_SESSION['username'];
        $sql = "SELECT * FROM task where username='$hey' and label='3' and done=0 order by date(deadline)";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover table-fixed'>
          <thead>
            <tr>
              <th scope='col'> # </th>
              <th scope='col'>TASK</th>
              <th scope='col'>DEADLINE</th>
            </tr>
          </thead><tbody>";
            while($row = $result->fetch_assoc()) {
              $date1=date_create(date('Y-m-d'));
              $date2=date_create($row['C_date']);
              $diff=date_diff($date1,$date2);
              if ($row['deadline'] > $cd) {
                echo"<tr><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td>".$row["tname"]."</td><td>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
              else{
                echo"<tr style='background: #ff6961;'><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td style='color: #ffffff'>".$row["tname"]."</td><td style='color: #ffffff'>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
            }
            echo "</tbody></table>";
          } 
          else {
            echo "<div class='text-center'><img src='image/smile.png' style='height: 150px; width: 150px;'><br><h5>You are all done for today.</h5></div>";
          }
        $conn -> close();
      ?>
    </div>
  <div style="border: 1px solid #ffffff; background: #bae1ff; overflow-y: scroll; height: 300px; width: 550px; opacity: 0.8;" class='table-responsive'>
  <p class="font-weight-bold">
    Periodic tasks 
  </p>
    <?php
        include('database/connect.php');
        $hey=$_SESSION['username'];
        $sql = "SELECT * FROM task where username='$hey' and label='4' and done=0 order by date(deadline)";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover table-fixed'>
          <thead>
            <tr>
              <th scope='col'> # </th>
              <th scope='col'>TASK</th>
              <th scope='col'>DEADLINE</th>
            </tr>
          </thead><tbody>";
            while($row = $result->fetch_assoc()) {
              $date1=date_create(date('Y-m-d'));
              $date2=date_create($row['C_date']);
              $diff=date_diff($date1,$date2);
              if ($row['deadline'] > $cd) {
                echo"<tr><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td>".$row["tname"]."</td><td>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
              else{
                echo"<tr style='background: #ff6961;'><th scope='row'><button type='button' class='btn btn-default view_data' data-toggle='modal' data-target='#modal1' id=".$row['taskid']."><img src='image/edit.png'></button></th><td style='color: #ffffff'>".$row["tname"]."</td><td style='color: #ffffff'>".$row["deadline"]."<br>Created before ".$diff->format("%a Days")." </td></tr>";
              }
            }
            echo "</tbody></table>";
          } 
          else {
            echo "<div class='text-center'><img src='image/smile.png' style='height: 150px; width: 150px;'><br><h5>You are all done for today.</h5></div>";
          }
        $conn -> close();
      ?>
    </div>
<div style="border: 1px solid #ffffff; background: #ffdfba; width: 1100px; overflow-y: scroll; height: 300px; opacity: 0.8;" class="table-responsive">
<p class="font-weight-bold">
  Completed tasks 
</p>
    <?php
        include('database/connect.php');
        $hey=$_SESSION['username'];
        $sql = "SELECT * FROM task where username='$hey' and done=1 order by date(deadline) DESC;";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover table-fixed'>
          <thead>
            <tr>
              <th scope='col'>TASK</th>
              <th scope='col'>DESCRIPTION</th>
              <th scope='col'>DEADLINE</th>
              <th scope='col'></th>
            </tr>
          </thead><tbody>";
            while($row = $result->fetch_assoc()) {
              echo"<tr><td>".$row["tname"]."</td><td>".$row["detail"]."</td><td>".$row["deadline"]."</td><td><form method='post' style='border: none; padding: 0px 0px 0px 0px' action='select.php'><input type='hidden' value=".$row["taskid"]." name='taskno'><button type='submit' class='btn btn-danger' name='deletebutton'><img src='image/delete.png'></button></form> </td></tr>";
            }
            echo "</tbody></table>";
        }
        else {
          echo "<div class='text-center'><img src='image/sun.png' style='height: 150px; width: 150px;'><br><br><h5>No completed tasks. Get started.</h5></div>";
        }
        $conn -> close();
      ?>
</div>
</div>
  <div id="modal1" class="modal fade">  
      <div class="modal-dialog">  
          <div class="modal-content">  
                <div class="modal-header">    
                    <h4 class="modal-title">Task details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="task_detail">

                </div> 
          </div>             
      </div>  
  </div>  
</div> 
</body>
</html>
<script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var task_id = $(this).attr("id");  
           $.ajax({  
                url:"select.php",  
                method:"post",  
                data:{task_id:task_id},  
                success:function(data){  
                     $('#task_detail').html(data);  
                     $('#modal1').modal("show");  
                }  
           });  
      });  
 });
</script>