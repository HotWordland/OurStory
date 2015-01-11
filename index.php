<?php
include_once 'api.class.php';
if ($_SERVER["REQUEST_METHOD"]==POST)
{
    #$message = $_POST['message'];
    $indicatorMessage = '初始化';
    $username['UserName'] = $_POST['name'];
    $API = new api();
    $API->SelectArray('userinfo',$username);
    $result = $API->mysql_db->result;
    $error = mysql_error();
    if (mysql_num_rows($result)<=0)
    {
        $username['Message'] = $_POST['message'];
        $API->InsertArray('userinfo',$username);
        $result = $API->mysql_db->result;
        $error.=mysql_error();
        if ($API->mysql_db->dbAffectedRows()>0)
        {
            //成功插入数据
            $indicatorMessage = '留言成功！';

        }else
        {
            $indicatorMessage = '留言失败！';
        }
        
        
    }else
    {
        $indicatorMessage = '你已留言过';

    }
    echo "<script LANGUAGE='JavaScript'>alert('$indicatorMessage');</script>";

}
?>
<?php
header("Content-type: text/html; charset=utf-8");
      include_once 'api.class.php';
      $API = new api();
      $API->Select('UserInfo','order by id desc limit 0,2');
      $result = $API->mysql_db->result;
      $error = mysql_error();
      if(mysql_num_rows($result)>0){
          while ($row=mysql_fetch_array($result)) {
              foreach ($row as $key => $value) {
                  if(!is_numeric($key)){
                      $kj[$key]=$value;
                  }
              }
              $json['value'][] = $kj;
              $json['status'] = 1;
          }
      }else
      {
          $json['status'] = 0;
          $error .= "没有信息";
      }
      $json['error'] = $error;
      $js = json_encode($json);
      $lastestMessage = $json['value'];
      ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
<title>Home</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/demo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/sticky-navigation.css" />
<!------ js ------>
<script src="js/jquery.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<!------ js ------>
<!---- start-smoth-scrolling---->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
		    jQuery(document).ready(function ($) {
		        $(".scroll").click(function (event) {
		            event.preventDefault();
		            $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
		        });
		    });
		</script>
<!---- start-smoth-scrolling---->
<script>
    $(function () {

        // grab the initial top offset of the navigation 
        var sticky_navigation_offset_top = $('#sticky_navigation').offset().top;

        // our function that decides weather the navigation bar should have "fixed" css position or not.
        var sticky_navigation = function () {
            var scroll_top = $(window).scrollTop(); // our current vertical position from the top

            // if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
            if (scroll_top > sticky_navigation_offset_top) {
                $('#sticky_navigation').css({ 'position': 'fixed', 'top': 0, 'left': 0 });
            } else {
                $('#sticky_navigation').css({ 'position': 'relative' });
            }
        };

        // run our function on load
        sticky_navigation();

        // and run it again every time you scroll
        $(window).scroll(function () {
            sticky_navigation();
        });

        // NOT required:
        // for this demo disable all links that point to "#"
        $('a[href="#"]').click(function (event) {
            event.preventDefault();
        });

    });
</script>

<!--- fonts --->
<link href='http://fonts.useso.com/css?family=Lato:100,300italic,400,700,900,300italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Raleway:400,200,900,800,700,600,500,300,100' rel='stylesheet' type='text/css'>
<!--- fonts --->

</head>
<body>
<!---->
<div id="demo_top_wrapper">
	<div id="demo_top">
			<div class="header" id="home">
				<div class="logo">
				<a href="#"><img src="images/logo.png" alt=""/></a>
				</div>
			</div>
		
	 </div>
	 <div id="sticky_navigation_wrapper">
		 <div id="sticky_navigation">
			  <div class="top-menu">
				 <div class="container">
						<a href="#home"><h4>MRBELLE</h4></a>
						<span class="menu"> </span>
						<ul>
						<li><a class="scroll" href="#about">ABOUT</a></li>
						<li><a class="scroll" href="#blog">BLOG</a></li>
						<li><a class="scroll" href="#clients">CLIENTS</a></li>
						<li><a class="scroll" href="#contact">CONTACT</a></li>
						<a href="#"><span class="img1"> </span></a>
						<a href="#"><span class="img2"> </span></a>
						<a href="#"><span class="img3"> </span></a>				 
						<div class="clearfix"></div>
						</ul>
					 <div class="clearfix"></div>
				 </div>
			  </div>
		 </div>
	 </div>
</div>
<!---->
<section id="main">
<div class="about" id="about">
	 <h3>WELCOME TO MY WORLD</h3>
	 <b></b>
	 <div class="container">
		 <div class="about-grids">
			 <div class="col-md-6 about-info">		
				 <h4>Short Story</h4>
				  <label></label>
				 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				 Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
				 cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. pariatur. Stet clita kasd gubergren, no sea takimata est.
				 Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			 </div> 
			 <div class="col-md-6 about-skill">
				 <h4>Skills</h4>
				  <label></label>
				  <p><i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut</i></p>
					<div class="skill-grid1">
						 <div class="skill-bar">
						 <div class="info"><p>WRITING</p><i>20%</i></div>						 
						 </div>
						 <div class="icon"><img src="images/skil.png"></div>
						 <div class="clearfix"></div>
					 </div>
					 <div class="clearfix"></div>
					 <div class="skill-grid2">
						 <div class="skill-bar2">
						 <div class="info2"><p>SMILING</p><i>90%</i></div>
						 <div class="clearfix"></div>
						 </div>
						 <div class="icon"><img src="images/skil.png"></div>
						 <div class="clearfix"></div>
					 </div>
					 <div class="clearfix"></div>
					 <div class="skill-grid3">
						 <div class="skill-bar3">
						 <div class="info3"><p>COOKING</p><i>40%</i></div>
						 <div class="clearfix"></div>
						 </div>
						 <div class="icon"><img src="images/skil.png"></div>
						 <div class="clearfix"></div>
					 </div>
			 </div>
			 <div class="clearfix"></div>
		 </div>			 
	 </div>
	  <a></a>
</div>	
<!---->
<div class="blog" id="blog">
	 <h3>BLOG</h3>
	 <small></small>
	 <p><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam est metus, cursus quis tincidunt sit amet, varius sit amet lorem</i></p>
	 <div class="container">	
		 <div class="blog-top" id="top-sec">
			 <div class="blog-img">
				<img src="images/img1.jpg" alt="" class="img-responsive" />
			 </div>
			 <div class="img-desc">
				 <h4>MY PUPPY MUSTACHE</h4>
				 <span></span>
				 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
				 <span></span>
				 <div class="icons">
						<a href="#"><span class="img1"> </span></a>
						<a href="#"><span class="img2"> </span></a>
						<a href="#"><span class="img3"> </span></a>
				   </div>
					<a class="date" href="#">Mar 20</a>
					<div class="caption">
						<a href="#"><img src="images/link.png" alt=""/></a>
					</div>
					<div class="dmnd"></div>				
			 </div>
		 </div>
		 <div class="blog-top" id="Div1">
			 <div class="blog-img">
				<img src="images/img2.jpg" alt="" class="img-responsive" />
			 </div>
			 <div class="img-desc" >
				 <h4>MUSIC LIVE CONCERT</h4>
				 <span></span>
				 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
					<span></span>
					<div class="icons">
						<a href="#"><span class="img1"> </span></a>
						<a href="#"><span class="img2"> </span></a>
						<a href="#"><span class="img3"> </span></a>
				    </div>
					<a class="date" href="#">Apr 05</a>
					<div class="caption">
						<a href="#"><img src="images/link.png" alt=""/></a>
					</div>
					<div class="dmnd"></div>				
			 </div>
		 </div>
		 <div class="clearfix"></div>
		 
		 <div class="blog-top" id="bottom-sec">		 
			 <div class="img-desc blog-sec" >
				<h4>ROAD TO DREAMS</h4>
				<span></span>
				 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
				 <span></span>
				 <div class="icons">
					 <a href="#"><span class="img1"> </span></a>
					 <a href="#"><span class="img2"> </span></a>
					 <a href="#"><span class="img3"> </span></a>
				 </div>
				  <a class="date" href="#">Mar 24</a>
				   <div class="caption2">
						<a href=""><img src="images/link.png" alt=""/></a>
					</div>
					<div class="dmnd2"></div>	
			 </div>
			 <div class="blog-img img-sec">
				<img src="images/img3.jpg" alt="" class="img-responsive" />
			 </div>		 
		 </div>		 
		 
		 <div class="blog-top" id="Div2">		 
			 <div class="img-desc blog-sec" >
				<h4>ROAD TO DREAMS</h4>
				<span></span>
				 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
				 <span></span>
				<div class="icons">
					 <a href="#"><span class="img1"> </span></a>
					 <a href="#"><span class="img2"> </span></a>
					 <a href="#"><span class="img3"> </span></a>
				 </div>
				  <a class="date" href="#">Mar 11</a>
				   <div class="caption2">
						<a href=""><img src="images/link.png" alt=""/></a>
					</div>
					<div class="dmnd2"></div>	
			 </div>
			 <div class="blog-img img-sec">
				<img src="images/img4.jpg" alt="" class="img-responsive" />
			 </div>		 
		 </div>	
		 <div class="clearfix"></div>
			<div class="load"><a href="#">Load More</a></div>
	 </div>
</div>
<!---->
<div class="client" id="clients">
		 <h3>WHAT THEY SAY</h3>
		 <small></small>
		 <script>
		     // You can also use "$(window).load(function() {"
		     $(function () {
		         // Slideshow 1
		         $("#slider1").responsiveSlides({
		             auto: true,
		             nav: true,
		             speed: 500,
		             namespace: "callbacks",
		         });
		     });
	  </script>
	  <div class="container2">
			<div class="slider">
				<ul class="rslides" id="slider1">
				 <li>
				 <div class="person1"></div>
				 <div class="about-add-grid">
				 <h4><?php
                    $firstMessage = $lastestMessage[0];
                    echo $firstMessage['Message'];
?></h4>
				 <a href="#">留言人:<b><?php echo $firstMessage['UserName']; ?></b></a>		 
				 </div>
				 <div class="clearfix"></div>
			  </li>	
			  <li>
				 <div class="person2"></div>
				 <div class="about-add-grid">
				 <p><?php         
                 $secondMessage = $lastestMessage[1];
                 echo $secondMessage['Message'];
                                   ?></p>
				 <a href="#">留言人:<b><?php echo $secondMessage['UserName']; ?></b></a>		 
				 </div>
				 <div class="clearfix"></div>
			  </li>	
			 </ul>		
			</div>
	  </div>
</div>
<!---->
<div class="container">
	 <ul id="flexiselDemo1">
			<li>
				<div class="biseller-column">
				<img src="images/s1.png" alt="">
				</div>
			</li>
			<li>
				<div class="biseller-column">
				<img src="images/s2.png" alt="">
				</div>
			</li>
			<li>
				<div class="biseller-column">
				<img src="images/s3.png" alt="">
				</div>
			</li>
			<li>
				<div class="biseller-column">
				<img src="images/s2.png" alt="">
				</div>
			</li>
			<li>
				<div class="biseller-column">
				<img src="images/s1.png" alt="">
				</div>
			</li>
			<li>
				<div class="biseller-column">
				<img src="images/s3.png" alt="">
				</div>
			</li>
		</ul>
		<script type="text/javascript">
		    $(window).load(function () {
		        $("#flexiselDemo1").flexisel({
		            visibleItems: 3,
		            animationSpeed: 1000,
		            autoPlay: true,
		            autoPlaySpeed: 3000,
		            pauseOnHover: true,
		            enableResponsiveBreakpoints: true,
		            responsiveBreakpoints: {
		                portrait: {
		                    changePoint: 480,
		                    visibleItems: 1
		                },
		                landscape: {
		                    changePoint: 640,
		                    visibleItems: 2
		                },
		                tablet: {
		                    changePoint: 768,
		                    visibleItems: 3
		                }
		            }
		        });

		    });
	   </script>
	   <script type="text/javascript" src="js/jquery.flexisel.js"></script>	
</div>   
<!---->
<div class="contact text-center" id="contact">
	<h3>祝福</h3>
	<i class="line"></i>
	<form role =" from" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> "  method = "post" >
	<input name="name" type="text" placeholder="Name"  required/>&nbsp;
	<textarea name="message" placeholder="Message"></textarea>
	<input type="submit" value="SEND"/>
	</form>
</div>
<!---->
<div class="fotter">
	 <div class="scale"></div>
	 <a href=""><img src="images/ftr.logo.png" alt="" /></a>
	 <p>Copyright &copy; 2014.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
</div>

<!---->
</section>	
<!---->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
   
</html>