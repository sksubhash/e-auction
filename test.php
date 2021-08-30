<?php 


function timer()
{
    static $start;

    if (is_null($start))
    {
        $start = microtime(true);
    }
    else
    {
        $diff = round((microtime(true) - $start), 4);
        $start = null;
        return $diff;
    }
}

timer();

echo 'Page generated in ' . timer() . ' seconds.';





$page_loadtime_in_millisec = ($page_loadtime / 1000);
echo '<pre>Page Infor:
Page Load Time : ' . $page_loadtime.' <b>Microseconds</b><br/>
Page Load Time : ' . $page_loadtime_in_millisec.' <b>Milliseconds</b><br/>
Page Load Time : ' . number_format(($page_loadtime_in_millisec/1000),18) . ' <b>Seconds</b></pre>';



$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;


$started_at = microtime(true);

// This is where your logic will live
// echo 'Lorem ipsum dolor sit amet...';
// et cetera.

echo 'Cool, that only took ' . (microtime(true) - $started_at) . ' seconds!';





echo"<br><br><br>";





$start_time = microtime(TRUE);


$end_time = microtime(TRUE);
 
$time_taken = $end_time - $start_time;
 
$time_taken = round($time_taken,5);
 
echo 'Page generated in '.$time_taken.' seconds.';



?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>HTML5, CSS3 and jQuery Navigation menu</title>
        <link rel="stylesheet" href="css/nav.css">
        <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body class="no-js">
        <nav id="topNav">
               <ul id="drop-nav">
<li><a href="#">Support</a></li>
  <li><a href="#">Web Design</a></li>
    <ul>
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
    </ul>
  </li>
  <li><a href="#">Content Management</a>
    <ul>
      <li><a href="#">Joomla</a></li>
      <li><a href="#">Drupal</a></li>
      <li><a href="#">WordPress</a></li>
      <li><a href="#">Concrete 5</a></li>
    </ul>
  </li>
  <li><a href="#">Contact</a>
    <ul>
      <li><a href="#">General Inquiries</a></li>
      <li><a href="#">Ask me a Question</a></li>
    </ul>
  </li>
</ul>
        </nav>
        <script src="admin/js/jquery.js"></script>
        <script src="admin/js/jquery.min.js"></script>
    </body>
    <style type="text/css">
  ul {list-style: none;padding: 0px;margin: 0px;}
  ul li {display: block;position: relative;float: left;border:1px solid #000}
  li ul {display: none;}
  ul li a {display: block;background: #000;padding: 5px 10px 5px 10px;text-decoration: none;
           white-space: nowrap;color: #fff;}
  ul li a:hover {background: #f00;}
  li:hover ul {display: block; position: absolute;}
  li:hover li {float: none;}
  li:hover a {background: #f00;}
  li:hover li a:hover {background: #000;}
  #drop-nav li ul li {border-top: 0px;}
</style>



</html>