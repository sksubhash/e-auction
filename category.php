<?php
include_once("connection.php"); 

if(isset($_REQUEST['submit'])){ 
        $catname=$_REQUEST['catname'];
        $catimage=$_FILES['file']['name'];
        $tmp_name=$_FILES['file']['tmp_name'];
        $path="images/category/".$catimage;
        date_default_timezone_set('Asia/Calcutta');
        $date=date('y-m-d h:i:s');
         $checkcat=$_REQUEST['submit'];
    if($checkcat=='Update Category')
    {  
        $id=$_REQUEST['e'];
       
        $a="UPDATE category SET cat_name='$catname',cat_image='$path' WHERE cat_id='$id'";
        $b=mysqli_query($conn,$a);
        if($b){
            move_uploaded_file($tmp_name,$path);
            header("location:category.php");} else{ ?><script>alert("Category Does Not Updated");</script> <?php }
    }
    else{
        
        $a="insert into category(cat_name,cat_image,cat_entry_date) values('$catname','$path','$date')";
        $b=mysqli_query($conn,$a) or die(mysqli_error($conn));
        if($b){
            move_uploaded_file($tmp_name,$path);
            header("location:category.php");
              } else{ 
                    echo "<script>alert('Category Does Not Added')</script>"; 
              }
    
        }
}
    

 
 if(isset($_REQUEST['e'])){
     $id = $_REQUEST['e'];
     $s="select * from category where cat_id='$id'";
     $s1=mysqli_query($conn,$s);
     $row=mysqli_fetch_array($s1);
 } 
 if(isset($_REQUEST['d'])){
     $id = $_REQUEST['d'];
     $s="select * from category where cat_id='$id'";
     $s1=mysqli_query($conn,$s);
     $s2=mysqli_fetch_array($s1);
     unlink($s2['cat_image']);
     $a="DELETE FROM category WHERE cat_id ='$id'";
     $b=mysqli_query($conn,$a);
     if($b){?><script>alert("Category Deleted"); </script><?php header("location:category.php"); }
 } 
  if(isset($_REQUEST['md'])){
     $id = $_REQUEST['mdchk'];
     foreach($id as $value){
         $s="select * from category where cat_id='$value'";
         $s1=mysqli_query($conn,$s);
         $s2=mysqli_fetch_array($s1);
         unlink($s2['cat_image']);
         $md="delete from category where cat_id='$value'";
         mysqli_query($conn,$md);
         header("location:category.php");
          }   
 }
 
  $s11="select * from  category";
 $tp=mysqli_query($conn,$s11);
 $total_row=mysqli_num_rows($tp);
 $per_page=3;
 $total_page = ceil($total_row/$per_page);

 if(isset($_REQUEST['page_no'])){
    $page_no=$_REQUEST['page_no'];
     $start=($page_no-1)*$per_page;
 }else{
     $page_no=1;
     $start=($page_no-1)*$per_page;
     
 }
 $s="select * from  category limit $start ,$per_page";
 $s2=mysqli_query($conn,$s);
 
 if(isset($_REQUEST['status'])){
    $id = $_REQUEST['status'];
    $state="select * from category where cat_id='$id'";
    $state1=mysqli_query($conn,$state);
    $state2=mysqli_fetch_array($state1);
    $status=$state2['cat_status'];
    if($status=='Active'){
         $up = "update category set cat_status='Deactive' where cat_id='$id'";
    }else{
         $up = "update category set cat_status='Active' where cat_id='$id'";
    }
    mysqli_query($conn,$up);
    header("location:category.php");
}
 

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Category</title>
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
<?php include("header.php");?>
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
						<li><a href="#">Category</a></li>
					</ol>
				</div>
			</div>
			<form id="frm" enctype="multipart/form-data" method="post" action="" class="form-horizontal" role="form" style="margin-top: 50px; margin-left: 250px;">
				<div class="form-group">
                
					<label class="col-sm-2 control-label">Category Name</label>
					<div class="col-sm-4">
						<input type="text" value="<?php if(isset($_REQUEST['e'])){ echo $row['cat_name'];}?>" class="form-control" placeholder="Category name" data-toggle="tooltip" data-placement="bottom" title="ADD YOUR CATEGORY" name="catname">
                        
                    </div><br><br>
                    
                    <label class="col-sm-2 control-label">Category Image</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" data-toggle="tooltip" data-placement="bottom" title="ADD YOUR CATEGORY IMAGE" name="file" multiple="">
                        
                    </div><span><?php if(isset($_REQUEST['e'])){ echo $row['cat_image'];}?></span>
                    <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                      <input type="submit" class="btn btn-primary" name="submit" value="<?php if(isset($_REQUEST['e'])){echo "Update Category";} else{ echo "Add Category"; }?>"> 
				</div>
					
			</form>
            
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                 
                    <span>Category List</span>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Entry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
                    <?php

                        while($row=mysqli_fetch_array($s2)){
                         
                         
                    ?><form>
                        <tr> 
                        <?php if($_SESSION['TYPE']=="SuperAdmin"){?>
                            <td> <input type="checkbox" name="mdchk[]" value="<?php echo $row['cat_id'];?>"></td>       <?php }?>
                            <td><a href="category.php?e=<?php echo $row['cat_id'];?>"> Edit </a> <?php if($_SESSION['TYPE']=="SuperAdmin"){?>| <a href="category.php?d=<?php echo $row['cat_id'];?>"> Delete </a><?php }?></td>
                            <td><?php echo $row['cat_id'];?></td>
                            <td><?php echo $row['cat_name'];?></td>
                            <td><a href="category.php?status=<?php echo $row['cat_id'];?>"><?php echo $row['cat_status'];?></a></td>
                            <td><?php echo $row['cat_entry_date'];?></td>
                        </tr>
                        <?php
                           }
                        ?>
                        
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
                         <tr>
                            <td colspan="7" align="center" > 
                            <ul class="pagination">
                                 
                                 <li><a href="category.php?page_no=1"> First </a></li>
                         
                                <li> <?php if(isset($_REQUEST['page_no'])){ if($_REQUEST['page_no']==1)
                                 { echo "Previous"; }
                                 else{?>
                                 <a href="category.php?page_no=<?php echo $_REQUEST['page_no']-1; ?>"> Previous </a>
                                </li>  <?php }}  
                                
                                 for($i=1; $i<=$total_page; $i++){
                                 ?>
                                 <li><a  href="category.php?page_no=<?php echo $i;?>"><?php echo $i; ?></a></li>
                                 <li><?php }
                                 
                                 if(isset($_REQUEST['page_no'])){if($_REQUEST['page_no']==$total_page)
                                 { echo"Next"; }
                                 else{?>
                                 <a href="category.php?page_no=<?php echo $_REQUEST['page_no']+1; ?>"> Next </a>
                                 </li><?php }}?>
                                 
                                 <li><a href="category.php?page_no=<?php echo $total_page;?>"> Last </a></li>
                                    
                            </ul>
                             </td>
                         </tr>
                        
                        </form>
                    </tfoot>
                </table>
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

        <script type="text/javascript" src="js/jq.js"></script>
        <script type="text/javascript" src="js/jqv.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
               $("#frm").validate({
                  
                  
                  rules:
                  {
                      catname:
                      {
                        required:true,  
                      },
				  },
               }); 
                
                
                
            });
        </script>         
        
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
</body>
</html>
