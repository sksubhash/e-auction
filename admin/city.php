<?php
include_once("connection.php"); 
include("header.php");

if($row121212['reg_username']==''){
    header("location:profile.php");
}
 if(isset($_REQUEST['submit']))
 {
    $action = $_REQUEST['submit'];
    if($action=='Add City')
    {
        $cityname=$_REQUEST['cityname'];
        $statename=$_REQUEST['statename'];
        $date=date('Y-m-d h:i:s');
        //echo $squery2[0];
        $s="insert into city(state_id,city_name,city_entry_date) values('$statename','$cityname','$date')";
        $s1=mysqli_query($conn,$s);
    }else
    {   $id=$_REQUEST['e'];
        $cityname=$_REQUEST['cityname'];
        $statename=$_REQUEST['statename'];
        $s="update city set state_id='$statename',city_name='$cityname' where city_id='$id'";
        $s1=mysqli_query($conn,$s);
        header("location:city.php");
        
    }
 
 }

   
 

  
 $s="select state.*,city.* from state inner join   city on state.state_id=city.state_id where state.state_status='Active' ORDER BY city_name";
 $select1=mysqli_query($conn,$s);
 
 if(isset($_REQUEST['e'])){
     $id = $_REQUEST['e'];
     $s="select * from city where city_id='$id'";
     $s1=mysqli_query($conn,$s);
    $row=mysqli_fetch_array($s1);
 }
 if(isset($_REQUEST['d'])){ 
     $id=$_REQUEST['d'];
     $d="delete from city where city_id='$id'";
     $d1=mysqli_query($conn,$d);
     if($d1){header("location:city.php");}
 }
 if(isset($_REQUEST['status'])){
    $id = $_REQUEST['status'];
    $state="select * from city where city_id='$id'";
    $state1=mysqli_query($conn,$state);
    $state2=mysqli_fetch_array($state1);
    $status=$state2['city_status'];
    if($status=='Active'){
         $up = "update city set city_status='Deactive' where city_id='$id'";
    }else{
         $up = "update city set city_status='Active' where city_id='$id'";
    }
    mysqli_query($conn,$up);
    header("location:city.php");
}
 
 if(isset($_REQUEST['md'])){
     $id = $_REQUEST['mdchk'];
     foreach($id as $value){
         $md="delete from city where city_id='$value'";
         mysqli_query($conn,$md);
         header("location:city.php");
          }   
 }
 

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>City</title>
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
            <li><a href="#">Manage Location</a></li>
            <li><a href="#">City</a></li>
        </ol>
        </div>
            </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    
                    <span>Add City</span>
                </div>
                
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" role="form" id="form3" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select State</label>
                        <div class="col-sm-4" style=" width:700px;">
                            <select class="form-control" name="statename" data-error="#ss1" id="statename" style="width:300px; float:left;">
                            <option value="">Select State</option>
                            <?php $selectstate="select * from state where state_status='Active'";
                                $squery1=mysqli_query($conn,$selectstate);
                              
                               while( $squery2=mysqli_fetch_array($squery1)){
                            ?>
                            <option <?php 
                            if(isset($_REQUEST['e'])){if($squery2['state_id']==$row['state_id']){
                            ?> selected <?php }}?>
                             value="<?php echo $squery2[0];?>"><?php echo $squery2[1];?></option>
                            <?php
                               } 
                            ?>
                        </select>
                   <span id="ss1"></span>
				   </div><br><br><br>
                       
					   <label class="col-sm-2 control-label">City</label>
                       
					   <div class="col-sm-4"  style="width:700px;">
                        <input type="text" data-error="#errNm2" style="width:300px; float:left;"
                         <?php if(isset($_REQUEST['e'])){?>   value="<?php echo $row['city_name'];?>" <?php }?> class="form-control" placeholder="City name" data-toggle="tooltip" data-placement="bottom" title="ADD YOUR CITY NAME" name="cityname">
				           <span id="errNm2"  style="float:left;" ></span> <br><br>
				        
						<input type="submit" class="btn btn-primary"  name="submit" value="<?php if(isset($_REQUEST['e'])){echo "Update City";} else{ echo "Add City"; }?>"> 
	                      
				</div>
                    </div>
                		
                
                <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                
                    <span>City List</span>
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
                            <th>State Name</th>
                            <th>City Name</th>
                            <th>(Current | Change) Status</th>
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
                            <td> <input type="checkbox" name="mdchk[]" value="<?php echo $row['city_id'];?>"></td>              <?php }?>
                            <td><a href="city.php?e=<?php echo $row['city_id'];?>"><img src="images\icon\edit.png" height="30px;" width="30px;"></a> <?php if($_SESSION['TYPE']=="SuperAdmin"){?>|  <a href="city.php?d=<?php echo $row['city_id'];?>"><img src="images\icon\delete.png" height="30px;" width="30px;"></a><?php }?></td>
                            <td><?php echo $row['city_id'];?></td>
                            <td><?php echo $row['state_name'];?></td>
                            <td><?php echo $row['city_name'];?></td>
                            <td><?php echo $row['city_status'];?> | <a href="city.php?status=<?php echo $row['city_id'];?>"><?php  if($row['city_status']=='Active'){?><img title="Active" src="images/icon/active.png"> <?php } else {?><img title="Deactive" src="images/icon/deactive.png"><?php }?> </a></td>
                            <td><?php echo $row['city_entry_date']; ?></td>
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
		
		$("#form3").validate({
			
			rules:{
				statename:{
					required:true,
				},
				cityname:{
					required:true,
				},
			},
			messages:
			{
				statename:{
					required:"SELECT STATE NAME",
					
				},
				cityname:{
					required:"ENTER CITY NAME",
				},
			},
			
			 errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
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
