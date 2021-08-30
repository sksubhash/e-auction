<?php
include_once("connection.php"); 
include("header.php");

if($row121212['reg_username']==''){
    header("location:profile.php");
}
 if(isset($_REQUEST['submit']))
 {
    $action = $_REQUEST['submit'];
    if($action=='Add SUbCategory')
    {   
        $catname=$_REQUEST['cat'];
        $subcatname=$_REQUEST['subcatname'];
        
        $subcatimage=$_FILES['file']['name'];
        $tmp_name=$_FILES['file']['tmp_name'];
        $path="images/sub_category/".$subcatimage;
        $date=date('Y-m-d h:i:s');
        //echo $squery2[0];
       $s="insert into subcategory(cat_id,subcat_name,subcat_image,subcat_entry_date) values('$catname','$subcatname','$path','$date')";
        $b=mysqli_query($conn,$s)  or die(mysqli_error($conn));
        if($b){
            move_uploaded_file($tmp_name,$path);
            header("location:subcategory.php");
        } else{ 
            echo "<script>alert('Sub Category Does Not Added')</script>"; 
        }
    }else
    {
        $id=$_REQUEST['e'];
		$subcatimage=$_FILES['file']['name'];
        $tmp_name=$_FILES['file']['tmp_name'];
        $path="images/sub_category/".$subcatimage;
        $subcatname=$_REQUEST['subcatname'];
        $catname=$_REQUEST['cat'];
        $s="update subcategory set cat_id='$catname',subcat_name='$subcatname',subcat_image='$path' where subcat_id='$id'";
        $b=mysqli_query($conn,$s);
		if($b)
		{
			move_uploaded_file($tmp_name,$path);
			header("location:subcategory.php");
		}
        
        
    }
 
 }

 
 if(isset($_REQUEST['e'])){
     $id = $_REQUEST['e'];
     $s="select * from subcategory where subcat_id='$id'";
     $s1=mysqli_query($conn,$s);
     $row = mysqli_fetch_array($s1);
 }
 if(isset($_REQUEST['d'])){
     $id = $_REQUEST['d'];
     $s="select * from subcategory where subcat_id='$id'";
     $s1=mysqli_query($conn,$s);
     $s2=mysqli_fetch_array($s1);
     unlink($s2['subcat_image']);
     $d="delete from subcategory where subcat_id='$id'";
     mysqli_query($conn,$d);
     header("location:subcategory.php");
 }
 if(isset($_REQUEST['md'])){
     $id = $_REQUEST['mdchk'];
     foreach($id as $value){
         $s="select * from subcategory where subcat_id='$value'";
         $s1=mysqli_query($conn,$s);
         $s2=mysqli_fetch_array($s1);
         unlink($s2['subcat_image']);
         $md="delete from subcategory where subcat_id='$value'";
         mysqli_query($conn,$md);
         header("location:subcategory.php");
          }   
 }

 $s="select * from  subcategory as subcat,category as cat where subcat.cat_id=cat.cat_id ORDER BY subcat.subcat_id DESC";
 $select1=mysqli_query($conn,$s);
 
 if(isset($_REQUEST['status'])){
    $id = $_REQUEST['status'];
    $state="select * from subcategory where subcat_id='$id'";
    $state1=mysqli_query($conn,$state);
    $state2=mysqli_fetch_array($state1);
    $status=$state2['subcat_status'];
    if($status=='Active'){
         $up = "update subcategory set subcat_status='Deactive' where subcat_id='$id'";
    }else{
         $up = "update subcategory set subcat_status='Active' where subcat_id='$id'";
    }
    mysqli_query($conn,$up);
    header("location:subcategory.php");
}
 
 

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sub Category</title>
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
        <link rel="stylesheet" type="text/css" href="CSS/dataTables.css">

 
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
			<li><a href="#">Manage Category</a></li>
			<li><a href="#">Sub Category</a></li>
		</ol>
		</div>
			</div>
	
	<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					
					<span>Add Sub Category </span>
				</div>
				
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" enctype="multipart/form-data" role="form2" id="form2" method="post">
					<div class="form-group">
						<label class="col-sm-2 control-label">Select Category</label>
						<div class="col-sm-4" style="width:700px;">
							<select class="form-control" data-error="#ss1" name="cat" style="width:300px;float:left;">
							<span id="ss1"></span>
							<option value="">Select Category</option>
							<?php $selectcat="select * from category";
                                $squery1=mysqli_query($conn,$selectcat);
                              
                               while( $squery2=mysqli_fetch_array($squery1)){
                            ?>
                            <option
                            <?php if(isset($_REQUEST['e'])){ if($squery2['cat_id']==$row['cat_id']){?>
                            selected <?php }}?> value="<?php echo $squery2[0];?>"><?php echo $squery2[1];?></option>
                            <?php
                               } 
                            ?>
						</select>
						</div><br><br>
						<label class="col-sm-2 control-label">Sub Category Name</label>
						<div class="col-sm-4" style="width:700px;">
                        <input type="text" 
                        <?php if(isset($_REQUEST['e'])){ ?> value="<?php echo $row['subcat_name'];?>" <?php }?> data-error="#ss2" class="form-control" style="width:300px;float:left;" placeholder="Sub Category name" data-toggle="tooltip" data-placement="bottom" title="ADD YOUR SUB CATEGORY" name="subcatname">
						<span id="ss2"></span>
						</div><br><br>
                        <label class="col-sm-2 control-label">Sub Category   Image</label>
                        <div class="col-sm-4" style="width:700px;">
                        <input type="file" style="width:300px;float:left;" data-error="#ss3" class="form-control" data-toggle="tooltip" data-placement="bottom" title="ADD YOUR SUBCATEGORY IMAGE" name="file" multiple="">
                        <span id="ss3">
						</div><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="submit" class="btn btn-primary" name="submit" value="<?php if(isset($_REQUEST['e'])){echo "Update SUbCategory";} else{ echo "Add SUbCategory"; }?>"> 
					</div>
					
				
				<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                
                    <span>Sub Category List</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                        <tr>
                        <?php if($_SESSION['TYPE']=="SuperAdmin"){?>
                            <th>Select</th>
                            <?php }?>
                            <th>Action</th>
							<th>Image</th>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Current Status</th>
                            <th>Change Status</th>
                            <th>Entry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
                    <?php

                        while($row=mysqli_fetch_array($select1)){
                         ?>
						<tr>
                        <?php if($_SESSION['TYPE']=="SuperAdmin"){?>
                            <td> <input type="checkbox" name="mdchk[]" value="<?php echo $row['subcat_id'];?>"></td>                <?php }?>
                            <td><a href="subcategory.php?e=<?php echo $row['subcat_id'];?>"> <img src="images\icon\edit.png" height="30px;" width="30px;"></a> <?php if($_SESSION['TYPE']=="SuperAdmin"){?>| <a href="subcategory.php?d=<?php echo $row['subcat_id'];?>"><img src="images\icon\delete.png" height="30px;" width="30px;"></a><?php }?> </td>
                            <td><img src="<?php echo $row['subcat_image'];?>" style="hieght:50px;width:50px;"></td>
							<td><?php echo $row['subcat_id'];?></td>
                            <td><?php echo $row['cat_name'];?></td>
                            <td><?php echo $row['subcat_name'];?></td>
                            <td><?php echo $row['subcat_status'];?></td>
                            <td><a href="subcategory.php?status=<?php echo $row['subcat_id'];?>"><?php  if($row['subcat_status']=='Active'){?><img title="Active" src="images/icon/active.png"> <?php } else {?><img title="Deactive" src="images/icon/deactive.png"><?php }?> </a></td>
                            <td><?php $date=date_create($row['subcat_entry_date']);
                            echo date_format($date,"F d ,Y"); ?></td>
                        </tr>
                       
                        <?php }?>
                    <!-- End: list_row -->
                    </tbody>
                    <tfoot> 
                        
                        <?php if($_SESSION['TYPE']=="SuperAdmin"){?>
                        <tr>
                            <th colspan="7">
                                <input type="submit" class="btn btn-primary" name="md" value="Delete Selected" >
                             </th>
                        </tr>
                        <?php }?>
                        
                        

                    </tfoot>
                    
                </table>
                </form>
            </div>
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

    <script type="text/javascript" charset="utf8" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
  <script>
  $(function(){
    $("#datatable-1").dataTable();
  })
  </script>
 
<script type="text/javascript" src="js/jqv.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		$("#form2").validate({
			
			rules:{
				cat:{
					required:true,
				},
				subcatname:{
					required:true,
				},
				file:{
					required:true,
				},
			},
			messages:
			{
				cat:{
					required:"SELECT CATEGORY NAME",
					
				},
				subcatname:{
					required:"ENTER SUBCATEGORY NAME",
				},
				file:{
					required:"CHOOSE SUBCATEGORY IMAGE",
					
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
