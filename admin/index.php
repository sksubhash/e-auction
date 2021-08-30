<!DOCTYPE html>
<?php
session_start();
include_once("connection.php");

if(isset($_REQUEST['login'])){     
    $username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
    $s="select * from reg where reg_email='$username' or reg_password='$password'";
    
    $s1=mysqli_query($conn,$s);
    $row=mysqli_fetch_array($s1);
    if($row['reg_email']==$username and $row['reg_password']==$password){
      $_SESSION['ID']=$row['reg_id'];
      header("location:home.php");   
    } else{
        echo "<script>alert('You Entered Wrong DATA')</script>";
    }
    
    /*if(mysqli_num_rows($s1)==1){   
        $row=mysqli_fetch_array($s1);
        echo 
        $_SESSION['ID']=$row['reg_id'];
        //header("location:home.php");
    }          
    else{echo"wrongknkldnxknvkdmnfdkj"; }*/
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Login Page</title>
		<meta name="description" content="description">
		<meta name="author" content="Evgeniya">
		<meta name="keyword" content="keywords">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<form action="" method="post">
<div class="container-fluid">
	<div id="page-login" class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			
			<div class="box">
				<div class="box-content">
					<div class="text-center">
						<h3 class="page-header">E Auction Admin Login</h3>
					</div>
					<div class="form-group">
						<label class="control-label">Username</label>
						<input type="text" class="form-control" name="username" />
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="password" class="form-control" name="password" />
					</div>
					<div class="text-center">
						<input type="submit" value="Sign In" name="login" class="btn btn-primary">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
</body>
</html>
