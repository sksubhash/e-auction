<?php
include_once("connection.php");
include("header.php"); 

if(isset($_REQUEST['add_admin'])){
    $email=$_REQUEST['email'];
    $password=$_REQUEST['password'];
    date_default_timezone_set('Asia/Calcutta');
    $date=date('Y-m-d h:i:s'); 
    
    $dup_email="select * from reg where reg_email='$email'";
    $dup_email1=mysqli_query($conn,$dup_email);
    if(mysqli_num_rows($dup_email1))
    {
        ?>
        <script >
        alert("This Email Already Assigned Another Admin");
        </script><?php
    }   
    else
    {
    $add_admin="insert into reg(reg_name,reg_username,reg_email,reg_password,reg_entry_date,reg_user_type,reg_image) values('','','$email','$password','$date','Admin','images/icon/admin.png')";
    $add_admin1=mysqli_query($conn,$add_admin) or die(mysqli_error($conn));
    }
}


?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add Admin</title>
        <meta name="description" content="description">
        <meta name="author" content="DevOOPS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
        <link href="plugins/select2/select2.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<!--Start Header-->
<?php ?>
        <!--End Header-->


<!--Start Container-->
<?php include("sider.php");?>
        <!--Start Content-->
                <div id="content" class="col-xs-12 col-sm-10">
            <div class="row">
        <div id="breadcrumb" class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="#">Add Admin</a></li>
        </ol>
        </div>
            </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    
                    <span>Add Admin </span>
                </div>   
            <div class="no-move"></div>
            </div>
            <form name="admin_frm" id="admin_frm" method="post">
            <div class="box-content">
               <div class="text-center">
                        <h3 class="page-header">Add Admin</h3>
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="text" style="height: 40px;" class="form-control" name="email" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" style="height: 40px;" class="form-control" name="password" />
                    </div>
                    <div class="text-center">
                        <input type="submit" style="height: 40px;" class="btn btn-primary" value="Add Admin" name="add_admin">
                    </div>
             
            </div>
            </form>
        </div>
    </div>
</div>
                
                
            </div>
        </div>
    </div>
</div>        
</div>
        <!--End Content--> 
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript" src="js/jqv.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		$("#admin_frm").validate({
			
			rules:{
				email:{
					required:true,
					email:true,
				},
				password:
				{
					required:true,
				},
			},
			messages:
			{
				email:{
					required:"ENTER EMAIL ID",
					email:"ENTER VALID EMAIL ID",
				},
				password:
				{
					required:"ENTER PASSWORD",
				},
			},
		});
	});

</script>
<style>
    label.error{
        color:red;
    }
    input.error{
        color:red;
    }
    input.valid{
        color:green;
    }
</style>
</body>
</html>
