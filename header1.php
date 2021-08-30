<!DOCTYPE html>
<html lang="en">
  <head>
   
    



  <!-- SmartMenus core CSS (required) -->
<link href="cssnew/sm-core-css.css" rel="stylesheet" type="text/css" />

<!-- "sm-clean" menu theme (optional, you can use your own CSS, too) -->
<link href="cssnew/sm-clean/sm-clean.css" rel="stylesheet" type="text/css" />


    

  </head>

  <body>




    <nav id="main-nav">
      <!-- Sample menu definition -->
      <ul id="main-menu" class="sm sm-clean">
        <li><a href="http://www.smartmenus.org/">Home</a></li>
        <li><a href="http://www.smartmenus.org/about/">About</a>
          <ul>
            <li><a href="http://www.smartmenus.org/about/introduction-to-smartmenus-jquery/">Introduction to SmartMenus jQuery</a></li>
            <li><a href="http://www.smartmenus.org/about/themes/">Demos + themes</a></li>
            <li><a href="http://vadikom.com/about/#vasil-dinkov">The author</a></li>
            <li><a href="http://www.smartmenus.org/about/vadikom/">The company</a>
              <ul>
                <li><a href="http://vadikom.com/about/">About Vadikom</a></li>
                <li><a href="http://vadikom.com/projects/">Projects</a></li>
                <li><a href="http://vadikom.com/services/">Services</a></li>
                <li><a href="http://www.smartmenus.org/about/vadikom/privacy-policy/">Privacy policy</a></li>
              </ul>
            </li>
          </ul>
        </li>
        
        
      </ul>
    </nav>




    <!-- YOU DO NOT NEED THIS - demo page content -->
    




    <!-- jQuery -->
    <script type="text/javascript" src="jsnew/jquery/jquery.js"></script>

    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="jsnew/jquery.smartmenus.js"></script>

    <!-- SmartMenus jQuery init -->
    <script type="text/javascript">
    	$(function() {
    		$('#main-menu').smartmenus({
    			subMenusSubOffsetX: 1,
    			subMenusSubOffsetY: -8
    		});
    	});
    </script>




 

  </body>
</html>