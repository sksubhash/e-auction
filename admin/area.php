<?php
include_once("connection.php");
include_once("header.php");

if($row121212['reg_username']==''){
    header("location:profile.php");
} 
 if(isset($_REQUEST['submit']))
 {
    $action = $_REQUEST['submit'];
    if($action=='Add Area')
    {
        $areaname=$_REQUEST['areaname'];
        $cityname=$_REQUEST['cityname'];
        $statename=$_REQUEST['statename'];
		$area_pincode=$_REQUEST['area_pincode'];
        date_default_timezone_set('Asia/Calcutta');
        $date=date('Y-m-d h:i:s');

        //echo $squery2[0];
        $s="insert into area(state_id,city_id,area_name,area_pincode,area_entry_date) values('$statename','$cityname','$areaname',$area_pincode,'$date')";
        $s1=mysqli_query($conn,$s);
        header("location:area.php");
    }else
    {   
        $id = $_REQUEST['e'];
        $areaname=$_REQUEST['areaname'];
        $cityname=$_REQUEST['cityname'];
        $statename=$_REQUEST['statename'];
		$area_pincode=$_REQUEST['area_pincode'];
        $s="update area set state_id='$statename',city_id='$cityname',area_name='$areaname',area_pincode='$area_pincode' where area_id='$id'";
        $s1=mysqli_query($conn,$s);
        header("location:area.php");
        
    }
 
 }

 
 
  if(isset($_REQUEST['e'])){
     $id = $_REQUEST['e'];
     $s="select * from area where area_id='$id'";
     $s2=mysqli_query($conn,$s);
     $row=mysqli_fetch_array($s2);
     $state=$row['state_id'];
     $edit_city="select * from city where state_id='$state'";
     $edit_city1=mysqli_query($conn,$edit_city);
     
  }
  if(isset($_REQUEST['d'])){
      $id=$_REQUEST['d'];
      $s="delete from area where area_id='$id'";
      $s1=mysqli_query($conn,$s);
      header("location:area.php");
  }
  if(isset($_REQUEST['md'])){
     $id = $_REQUEST['mdchk'];
     foreach($id as $value){
         $md="delete from area where area_id='$value'";
         mysqli_query($conn,$md);
         header("location:area.php");
          }   
 }
 
 
 $s="select * from  area as a, city as c, state as s where a.city_id=c.city_id and a.state_id=s.state_id ORDER BY area_name";
 $select1=mysqli_query($conn,$s);
 
 if(isset($_REQUEST['status'])){
    $id = $_REQUEST['status'];
    $state="select * from area where area_id='$id'";
    $state1=mysqli_query($conn,$state);
    $state2=mysqli_fetch_array($state1);
    $status=$state2['area_status'];
    if($status=='Active'){
         $up = "update area set area_status='Deactive' where area_id='$id'";
    }else{
         $up = "update area set area_status='Active' where area_id='$id'";
    }
    mysqli_query($conn,$up);
    header("location:area.php");
}
 

?>
<script type="text/javascript">

function getstate(obj)
{
	//alert(obj);
	var a;
	if(window.XMLHttpRequest)
	{
		a=new XMLHttpRequest();
	}
	a.onreadystatechange=function()
	{
		if(a.readyState==4)
		{
			document.getElementById("city").innerHTML=a.responseText;
		}
	}
	
	a.open("GET","backend.php?state_id="+obj,true);
	a.send();
}

</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Area</title>
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
        <link rel="stylesheet" type="text/css" href="CSS/dataTables.css">98/
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
            <li><a href="#">Location Management</a></li>
            <li><a href="#">Area</a></li>
        </ol>
        </div>
            </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    
                    <span>Add Area</span>
                </div>
                
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" role="form" id="form" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select State</label>
                        <div class="col-sm-4" style=" width:700px;">
                            <select class="form-control" data-error="#ss1" style="width:300px;float:left;" name="statename" onchange="getstate(this.value)">
                            <span id="ss1"></span>
							<option value="">Select State</option>
                            <?php $selectstate="select * from state";
                                $squery1=mysqli_query($conn,$selectstate);
                              
                               while( $squery2=mysqli_fetch_array($squery1)){
                            ?>
                            <option 
                            <?php if(isset($_REQUEST['e'])){ if($squery2[0]==$row[1]){?> selected <?php }}?>
                            value="<?php echo $squery2[0];?>"><?php echo $squery2[1];?></option>
                            <?php
                               } 
                            ?>
                        </select>
                        </div><br><br>
						<label class="col-sm-2 control-label">Select City</label>
                        <div class="col-sm-4" style="width:700px;">
                            <select class="form-control" data-error="#ss2" name="cityname" id="city" style="width:300px;float:left;">
                            <span id="ss2"></span>
                            <option value="">Select City</option>
							<?php 
                            while($edit_city2=mysqli_fetch_array($edit_city1))
                            {
                                if($edit_city2['city_id']==$row['city_id'])
                                {
                                ?>
                                <option selected="" value="<?php echo $edit_city2[0]; ?> "><?php echo $edit_city2['city_name']; ?></option>
                                <?php
                                }
                                else
                                {
                                    ?>
                                <option  value="<?php echo $edit_city2[0]; ?>"><?php echo $edit_city2['city_name']; ?></option>
                                    
                                    <?php
                                }
                            }
                            ?> 
                         </select>
                        </div><br><br><br>
						
                        <label class="col-sm-2 control-label">Area</label>
                        <div class="col-sm-4"style=" width:700px;">
                        <input type="text" data-error="#ss3"value="<?php if(isset($_REQUEST['e'])){ echo $row['area_name'];}?>"  class="form-control" placeholder="Area Name" data-toggle="tooltip" data-placement="bottom" title="ADD YOUR AREA NAME" name="areaname" style="width:300px;float:left;">
						<span id="ss3"></span>
						</div><br><br>
						<label class="col-sm-2 control-label">Pincode</label>
                        <div class="col-sm-4" style=" width:700px;">
                        <input type="text"  data-error="#ss4" class="form-control" value="<?php if(isset($_REQUEST['e'])){ echo $row['area_pincode'];}?>" placeholder="Area Pincode" data-toggle="tooltip" data-placement="bottom" name="area_pincode" style="width:300px;float:left;">
					     <span id="ss4"></span>
                        </div><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" class="btn btn-primary" name="submit" value="<?php if(isset($_REQUEST['e'])){echo "Update Area";} else{ echo "Add Area"; }?>">
						<br>
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
                           <?php if($_SESSION['TYPE']=="SuperAdmin"){?> <th>Select</th> <?php }?>
                            <th>Action</th>
                            <th>ID</th>
                            <th>State Name</th>
                            <th>City Name</th>
                            <th>Area Name</th>
							<th>Pincode</th>
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
                           <?php if($_SESSION['TYPE']=="SuperAdmin"){?> <td> <input type="checkbox" name="mdchk[]" value="<?php echo $row['area_id'];?>"></td>  <?php }?>
                            <td><a href="area.php?e=<?php echo $row['area_id'];?>"> <img src="images\icon\edit.png" height="30px;" width="30px;"></a><?php if($_SESSION['TYPE']=="SuperAdmin"){?> | <a href="area.php?d=<?php echo $row['area_id'];?>"><img src="images\icon\delete.png" height="30px;" width="30px;"></a><?php }?></td>
                            <td><?php echo $row['area_id'];?></td>
                            <td><?php echo $row['state_name'];?></td>
                            <td><?php echo $row['city_name'];?></td>
                            <td><?php echo $row['area_name'];?></td>
							<td><?php echo $row['area_pincode'];?></td>
                            <td><?php echo $row['area_status'];?> | <a href="area.php?status=<?php echo $row['area_id'];?>"><?php  if($row['area_status']=='Active'){?><img title="Active" src="images/icon/active.png"> <?php } else {?><img title="Deactive" src="images/icon/deactive.png"><?php }?> </a></td>
                            <td><?php echo $row['area_entry_date']; ?></td>
                        </tr>
                       
                        <?php }?>
                    <!-- End: list_row -->
                    </tbody>
                    <tfoot>
                       
                       <?php if($_SESSION['TYPE']=="SuperAdmin"){?>
                         <tr>
                            <td colspan="7">
                                <input type="submit" class="btn btn-primary" name="md" value="Delete Selected" >
                             </td>
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
		
		$("#form").validate({
			
			rules:{
				statename:{
					required:true,
				},
				cityname:{
					required:true,
				},
				areaname:{
					required:true,
				},
				area_pincode:{
					required:true,
				},
			},
			messages:
			{
				statename:{
					required:"SELECT STATE NAME",
					
				},
				cityname:{
					required:"SELECT CITY NAME",
				},
				areaname:{
					required:"ENTER CITY NAME",
				},
				area_pincode:{
					required:"ENTER AREA PINCODE",
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
