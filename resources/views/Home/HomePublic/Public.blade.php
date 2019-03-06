<!DOCTYPE html>
<html>
 <head> 
  <!-- Basic --> 
  <meta charset="utf-8" /> 
  <title>@yield('title')</title> 
  <meta name="keywords" content="HTML5 Template" /> 
  <meta name="description" content="Porto - Responsive HTML5 Template" /> 
  <meta name="author" content="okler.net" /> 
  <!-- Mobile Metas --> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
  <!-- Web Fonts  --> 
  <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css" /> --> 
  <!-- Vendor CSS --> 
  <link rel="stylesheet" href="/static/homes/vendor/bootstrap/bootstrap.css" /> 
  <link rel="stylesheet" href="/static/homes/vendor/fontawesome//static/homes/css/font-awesome.css" /> 
  <link rel="stylesheet" href="/static/homes/vendor/owlcarousel/owl.carousel.css" media="screen" /> 
  <link rel="stylesheet" href="/static/homes/vendor/owlcarousel/owl.theme.css" media="screen" /> 
  <link rel="stylesheet" href="/static/homes/vendor/magnific-popup/magnific-popup.css" media="screen" /> 
  <!-- Theme CSS --> 
  <link rel="stylesheet" href="/static/homes/css/theme.css" /> 
  <link rel="stylesheet" href="/static/homes/css/theme-elements.css" /> 
  <link rel="stylesheet" href="/static/homes/css/theme-blog.css" /> 
  <link rel="stylesheet" href="/static/homes/css/theme-shop.css" /> 
  <link rel="stylesheet" href="/static/homes/css/theme-animate.css" /> 
  <!-- Skin CSS --> 
  <link rel="stylesheet" href="/static/homes/css/skins/default.css" /> 
  <!-- Theme Custom CSS --> 
  <link rel="stylesheet" href="/static/homes/css/custom.css" /> 
  <!-- Head Libs --> 
  <script src="/static/homes/vendor/modernizr/modernizr.js"></script> 
  <!--[if IE]>
			<link rel="stylesheet" href="/static/homes/css/ie.css">
		<![endif]--> 
  <!--[if lte IE 8]>
			<script src="/static/homes/vendor/respond/respond.js"></script>
			<script src="/static/homes/vendor/excanvas/excanvas.js"></script>
		<![endif]--> 
 </head> 
 <body> 
  <div class="body"> 
   <header id="header"> 
    <div class="container"> 
     <h1 class="logo"> <a href="index.html"> <img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="/static/homes/img/logo.png" /> </a> </h1> 
     <div class="search"> 
      <form id="searchForm" action="page-search-results.html" method="get"> 
       <div class="input-group"> 
        <input type="text" class="form-control search" name="q" id="q" placeholder="Search..." required="" /> 
        <span class="input-group-btn"> <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button> </span> 
       </div> 
      </form> 
     </div> 
     <nav> 
      <ul class="nav nav-pills nav-top"> 
      @if(session('email'))      
       <li> <a href="about-us.html"><i class="fa fa-angle-right"></i>欢迎 {{session('email')}}</a> </li> 
       <li> <a href="login"><i class="fa fa-angle-right"></i>退出</a> </li> 
      @else
       <li> <a href="login"><i class="fa fa-angle-right"></i>登录</a> </li> 
       <li> <a href="homeregister/create"><i class="fa fa-angle-right"></i>注册</a> </li> 
      @endif
       <li> <a href="about-us.html"><i class="fa fa-angle-right"></i>About Us</a> </li> 
       <li> <a href="contact-us.html"><i class="fa fa-angle-right"></i>Contact Us</a> </li> 
       <li class="phone"> <span><i class="fa fa-phone"></i>(123) 456-7890</span> </li> 
      </ul> 
     </nav> 
     <button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse"> <i class="fa fa-bars"></i> </button> 
    </div> 
    <div class="navbar-collapse nav-main-collapse collapse"> 
     <div class="container"> 
      <ul class="social-icons"> 
       <li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li> 
       <li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li> 
       <li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li> 
      </ul>


      <nav class="nav-main mega-menu"> 
       <ul class="nav nav-pills nav-main" id="mainMenu">
          @foreach($cate as $row) 
          <li class="dropdown"> <a class="dropdown-toggle" href="#">{{$row->name}}<i class="fa fa-angle-down"></i> </a>
          @if(count($row->suv)) 
           <ul class="dropdown-menu">
              @foreach($row->suv as $rows) 
              <li class="dropdown-submenu"> <a href="#">{{$rows->name}}</a>
                @if($rows->suv) 
                 <ul class="dropdown-menu">
                    @foreach($rows->suv as $r) 
                    <li><a href="index.html">{{$r->name}}</a></li>
                    @endforeach
                 </ul>
                 @endif 
              </li>
              @endforeach 
           </ul>
           @endif 
         </li>
         @endforeach  
       </ul> 
      </nav> 



     </div> 
    </div> 
   </header> 
   @section('main')
   @show
   <footer id="footer"> 
    <div class="container"> 
     <div class="row"> 
      <div class="footer-ribbon"> 
       <span>Get in Touch</span> 
      </div> 
      <div class="col-md-3"> 
       <div class="newsletter"> 
        <h4>Newsletter</h4> 
        <p>Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p> 
        <div class="alert alert-success hidden" id="newsletterSuccess"> 
         <strong>Success!</strong> You've been added to our email list. 
        </div> 
        <div class="alert alert-danger hidden" id="newsletterError"></div> 
        <form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST"> 
         <div class="input-group"> 
          <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text" /> 
          <span class="input-group-btn"> <button class="btn btn-default" type="submit">Go!</button> </span> 
         </div> 
        </form> 
       </div> 
      </div> 
      <div class="col-md-3"> 
       <h4>Latest Tweets</h4> 
       <div id="tweet" class="twitter" data-plugin-tweets="" data-plugin-options="{&quot;username&quot;: &quot;&quot;, &quot;count&quot;: 2}"> 
        <p>Please wait...</p> 
       </div> 
      </div> 
      <div class="col-md-4"> 
       <div class="contact-details"> 
        <h4>Contact Us</h4> 
        <ul class="contact"> 
         <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</p></li> 
         <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> (123) 456-7890</p></li> 
         <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a></p></li> 
        </ul> 
       </div> 
      </div> 
      <div class="col-md-2"> 
       <h4>Follow Us</h4> 
       <div class="social-icons"> 
        <ul class="social-icons"> 
         <li class="facebook"><a href="http://www.facebook.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Facebook">Facebook</a></li> 
         <li class="twitter"><a href="http://www.twitter.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Twitter">Twitter</a></li> 
         <li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" data-placement="bottom" rel="tooltip" title="Linkedin">Linkedin</a></li> 
        </ul> 
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="footer-copyright"> 
     <div class="container"> 
      <div class="row"> 
       <div class="col-md-1"> 
        <a href="index.html" class="logo"> <img alt="Porto Website Template" class="img-responsive" src="/static/homes/img/logo-footer.png" /> </a> 
       </div> 
       <div class="col-md-7"> 
        <p>漏 Copyright 2014. All Rights Reserved.</p> 
       </div> 
       <div class="col-md-4"> 
        <nav id="sub-menu"> 
         <ul> 
          <li><a href="page-faq.html">FAQ's</a></li> 
          <li><a href="sitemap.html">Sitemap</a></li> 
          <li><a href="contact-us.html">Contact</a></li> 
         </ul> 
        </nav> 
       </div> 
      </div> 
     </div> 
    </div> 
   </footer> 
  </div> 
  <!-- Vendor --> 
  <script src="/static/homes/vendor/jquery/jquery.js"></script> 
  <script src="/static/homes/vendor/jquery.appear/jquery.appear.js"></script> 
  <script src="/static/homes/vendor/jquery.easing/jquery.easing.js"></script> 
  <script src="/static/homes/vendor/jquery-cookie/jquery-cookie.js"></script> 
  <script src="/static/homes/vendor/bootstrap/bootstrap.js"></script> 
  <script src="/static/homes/vendor/common/common.js"></script> 
  <script src="/static/homes/vendor/jquery.validation/jquery.validation.js"></script> 
  <script src="/static/homes/vendor/jquery.stellar/jquery.stellar.js"></script> 
  <script src="/static/homes/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script> 
  <script src="/static/homes/vendor/jquery.gmap/jquery.gmap.js"></script> 
  <script src="/static/homes/vendor/twitterjs/twitter.js"></script> 
  <script src="/static/homes/vendor/isotope/jquery.isotope.js"></script> 
  <script src="/static/homes/vendor/owlcarousel/owl.carousel.js"></script> 
  <script src="/static/homes/vendor/jflickrfeed/jflickrfeed.js"></script> 
  <script src="/static/homes/vendor/magnific-popup/jquery.magnific-popup.js"></script> 
  <script src="/static/homes/vendor/vide/vide.js"></script> 
  <!-- Theme Base, Components and Settings --> 
  <script src="/static/homes/js/theme.js"></script> 
  <!-- Theme Custom --> 
  <script src="/static/homes/js/custom.js"></script> 
  <!-- Theme Initialization Files --> 
  <script src="/static/homes/js/theme.init.js"></script> 
  <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script type="text/javascript">
		
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-12345678-1']);
			_gaq.push(['_trackPageview']);
		
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		
		</script>
		 -->   
 </body>
</html>