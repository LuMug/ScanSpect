<?php 
	session_start(); 
	$route = include('./../Configuration/config.php');
?>
<!DOCTYPE html>
<html>
<head>

    <!--<link rel="stylesheet" href="<?php echo $route?>About/styles/about-us.css">-->
    <!--<link rel="stylesheet" href="<?php echo $route?>About/styles/framework.css">-->
    <style>
        /*---Inizio template---*/
        #about-us{display:block; width:100%; line-height:1.6em;}

        #about-us #about-intro{margin-bottom:50px; padding-bottom:50px; border-bottom:1px solid #CCCCCC;}
        #about-us #about-intro div{}

        #about-us #statements{margin-bottom:50px; padding-bottom:50px; border-bottom:1px solid #CCCCCC;}
        #about-us #statements div{}
        #about-us #statements div h2{margin-bottom:20px;}
        #about-us #statements div ul{margin:0; padding:0; list-style:none;}
        #about-us #statements div ul li{margin:10px 0 0 0;}
        #about-us #statements div .skillset{line-height:1.4em;}
        #about-us #statements div .skillset li{margin:25px 0 0 0;}
        #about-us #statements div ul li:first-child{margin-top:0;}
        #about-us #statements div .skillset li .fl_left{}
        #about-us #statements div .skillset li .fl_left img{}
        #about-us #statements div .skillset li .fl_right{width:220px; padding:3px 0 0 0;}
        #about-us #statements div .skillset li .fl_right p{margin:5px 0 0 0; padding:0;}
        #about-us #statements div .skillset li .fl_right p:first-child{margin-top:0; font-weight:bold;}

        #about-us #team{margin-bottom:0;}
        #about-us #team ul{margin:0; padding:0; list-style:none;}
        #about-us #team ul li{}
        #about-us #team ul li .figure{}
        #about-us #team ul li .figure img{padding:9px; border:1px solid #CCCCCC;}
        #about-us #team ul li .figure .figcaption{}
        #about-us #team ul li .figure .figcaption p{margin:15px 0 0 0; padding:0;}
        #about-us #team ul li .figure .figcaption .fl_left{}
        #about-us #team ul li .figure .figcaption .fl_left .team_name{font-weight:bold;}
        #about-us #team ul li .figure .figcaption .fl_left .team_title{margin:0 0 15px 0; font-size:11px; line-height:normal;}
        #about-us #team ul li .figure .figcaption ul{float:right; clear:right; margin-top:15px;}
        #about-us #team ul li .figure .figcaption ul li{display:inline; margin:0 0 0 5px;}
        #about-us #team ul li .figure .figcaption ul li:first-child{margin-left:0;}
        #about-us #team ul li .figure .figcaption ul li a{}
        #about-us #team ul li .figure .figcaption ul li a img{padding:0; border:none;}
        #about-us #team ul li .figure .figcaption .team_description{display:block; clear:both; margin:0; padding-top:15px; border-top:1px solid #CCCCCC;}
        /*---fine template---*/
        /*---Inizio 2 template---*/
        .one_half, 
        .one_third, .two_third, 
        .one_quarter, .two_quarter, .three_quarter, 
        .one_fifth, .two_fifth, .three_fifth, .four_fifth{display:inline-block; float:left; margin:0 0 0 20px; list-style:none;}

        .one_third, .two_third{margin:0 0 0 30px;}

        .first, 
        .one_half:first-child, 
        .one_third:first-child, .two_third:first-child, 
        .one_quarter:first-child, .two_quarter:first-child, .three_quarter:first-child, 
        .one_fifth:first-child, .two_fifth:first-child, .three_fifth:first-child, .four_fifth:first-child{margin-left:0;}

        .two_half, .three_third, .four_quarter, .five_fifth{display:block; width:100%; clear:both;}

        /*----------------------------------------------Half Grid-------------------------------------*/

        .one_half{width:470px;}

        /*----------------------------------------------Third Grid-------------------------------------*/

        .one_third{width:300px;}
        .two_third{width:630px;}

        /*----------------------------------------------Quarter Grid-------------------------------------*/

        .one_quarter{width:225px;}
        .two_quarter{width:470px;}
        .three_quarter{width:715px;}

        /*----------------------------------------------Fifth Grid-------------------------------------*/

        .one_fifth{width:176px;}
        .two_fifth{width:372px;}
        .three_fifth{width:568px;}
        .four_fifth{width:764px;}
        /*---fine 2 template---*/
        /*--Inizio 3 template--- */
        html{overflow-y:scroll;}

        body{margin:0; padding:0; font-size:13px; font-family:Georgia, "Times New Roman", Times, serif; color:#919191; background-color:#232323;}

        .justify{text-align:justify;}
        .bold{font-weight:bold;}
        .center{text-align:center;}
        .right{text-align:right;}
        .nostart{margin:0; padding:0; list-style:none;}
        .hidden{display:none;}

        .clear:after{content:"."; display:block; height:0; clear:both; visibility:hidden; line-height:0;}
        .clear{display:inline-block; clear:both;}
        html[xmlns] .clear{display:block;}
        * html .clear{height:1%;}

        a{outline:none; text-decoration:none;}

        .fl_left{float:left;}
        .fl_right{float:right;}

        img{margin:0; padding:0; border:none; line-height:normal; vertical-align:middle;}
        .imgholder, .imgl, .imgr{padding:4px; border:1px solid #D6D6D6; text-align:center;}
        .imgl{float:left; margin:0 15px 15px 0; clear:left;}
        .imgr{float:right; margin:0 0 15px 15px; clear:right;}

        /*----------------------------------------------HTML 5 Overrides-------------------------------------*/

        address, article, aside, figcaption, figure, footer, header, hgroup, nav, section{display:block; margin:0; padding:0;}

        /* ----------------------------------------------Wrapper-------------------------------------*/

        div.wrapper{display:block; width:100%; margin:0; padding:0; text-align:left;}

        .row1, .row1 a{color:#C0BAB6; background-color:#333333;}
        .row2{color:#979797; background-color:#FFFFFF;}
        .row2 a{color:#FF9900; background-color:#FFFFFF;}
        .row3, .row3 a{color:#919191; background-color:#232323;}

        div.wrapper h1, div.wrapper h2, div.wrapper h3, div.wrapper h4, div.wrapper h5, div.wrapper h6{
            margin:0 0 15px 0;
            padding:0;
            font-size:20px;
            font-weight:normal;
            line-height:normal;
            }

        /* ----------------------------------------------Generalise-------------------------------------*/

        form, fieldset, legend{margin:0; padding:0; border:none;}
        legend{display:none;}
        input, textarea, select{font-size:12px; font-family:Georgia, "Times New Roman", Times, serif;}

        #header, #container, #footer{display:block; width:960px; margin:0 auto;}

        /*----------------------------------------------Header-------------------------------------*/

        #header{padding:20px 0;}

        #header .fl_left h1, #header .fl_left h2{margin:0; padding:0; font-weight:normal; text-transform:none;}
        #header .fl_left h1{font-size:36px;}
        #header .fl_left h2{font-size:13px;}

        #header #topnav{display:block; float:right; margin:0; padding:20px; list-style:none; color:#C0BAB6; background-color:#232323; -webkit-border-radius:10px; -moz-border-radius:10px; border-radius:10px;}
        #header #topnav li{display:inline; margin-right:25px; text-transform:uppercase;}
        #header #topnav li.last{margin-right:0;}
        #header #topnav li a{color:#C0BAB6; background-color:#232323;}
        #header #topnav li a:hover, #header #topnav li.active a{color:#FF9900; background-color:#232323;}

        /*----------------------------------------------Content Area-------------------------------------*/

        #container{padding:30px 0;}
        #container a{background-color:transparent;}

        #container #portfolio, #container #gallery{margin-bottom:30px;}

        /* ----------------------------------------------Pagination-------------------------------------*/

        #container .pagination{display:block; width:100%; text-align:center; clear:both; font-family:Verdana, Geneva, sans-serif;}
        #container .pagination ul{margin:0; padding:0; list-style:none;}
        #container .pagination li{display:inline;}
        #container .pagination strong{font-weight:normal;}
        #container .pagination .next{margin:0;}
        #container .pagination a, #container .pagination .current strong, #container .pagination .splitter strong{display:inline-block; padding:2px 6px; margin:0 2px 0 0;}
        #container .pagination a{border:1px solid #DFDFDF;}

        /*----------------------------------------------Footer-------------------------------------*/

        #footer{padding:20px 0;}
        #footer p{margin:0; padding:0;}
        /*--fine 3 template--- */
        ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #333;
		}

		li {
			float: left;
		}

		li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		li a:hover {
			background-color: #4CAF50;
		}
		#login {
			float: right;
		}
    </style>
</head>
<body>
    <ul>
        <li><a class="active" href="<?php echo $route?>">Home</a></li>
        <?php
            if($_SESSION['loggedin']){
        ?>
        <li><a href="<?php echo $route?>Graphs/">Graphs</a></li>
        <?php
            }
        ?>
        <?php
            if($_SESSION['admin']){
        ?>
        <li><a href="<?php echo $route?>Administrator/">Data</a></li>
        <?php
            }
        ?>
        <?php 
            if(!$_SESSION['loggedin']){
        ?>
        <li id="login"><a href="<?php echo $route?>Login/">Login</a></li>
        <?php
            }else{
        ?>
        <li id="login"><a href="<?php echo $route?>User/"><?php if($_SESSION['admin'] == true){echo "Admin ";} echo $_SESSION['username'];?></a>
        <?php 
            }
        ?>
    </ul>
    <div class="wrapper row1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="https://www.os-templates.com/page-templates">About Us 9</a></h1>
      <h2>Free About Us Template</h2>
    </div>
    <ul id="topnav">
      <li><a href="https://www.os-templates.com/page-templates">Homepage</a></li>
      <li><a href="https://www.os-templates.com/page-templates">Style Demo</a></li>
      <li class="active"><a href="https://www.os-templates.com/page-templates">Full Width</a></li>
      <li><a href="https://www.os-templates.com/page-templates">Link Text</a></li>
      <li><a href="https://www.os-templates.com/page-templates">Link Text</a></li>
      <li class="last"><a href="https://www.os-templates.com/page-templates">Link Text</a></li>
    </ul>
  </div>
</div>
    <div class="wrapper row2">
    <div id="container" class="clear">
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <div id="about-us" class="clear">
        <!-- ####################################################################################################### -->
        <div id="about-intro" class="clear">
            <div class="one_half first">
            <h2>Vivamuslibero Auguer</h2>
            <p>In sed neque id libero pretium luctus. Vivamus faucibus. Ut vitae elit. In hac habitasse platea dictumst. Proin et nisl ac orci tempus luctus. Aenean lacinia justo at nisi. Vestibulum sed eros sit amet nisl lobortis commodo. Suspendisse nulla. Vivamus ac lorem. Aliquam pulvinar purus at felis. Quisque convallis nulla id ipsum. Praesent vitae urna. Fusce blandit nunc nec mi. Praesent vestibulum hendrerit ante.</p>
            <p>Vivamus accumsan. Donec molestie pede vel urna. Curabitur eget sem ornare felis gravida vestibulum.Sed pulvinar, tellus in venenatis vehicula, lorem magna dignissim erat, in accumsan ante lorem sit amet lorem.</p>
            </div>
            <div class="one_half"><img src="images/demo/470x250.gif" alt="Template Demo Image" /></div>
        </div>
        <!-- ####################################################################################################### -->
        <div id="statements" class="clear">
            <div class="one_third first">
            <h2>Vivamuslibero Auguer</h2>
            <p>Lorem ipsum dolor sit amet, consectetaur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Et harumd und.</p>
            </div>
            <div class="one_third">
            <h2>Vivamuslibero Auguer</h2>
            <ul class="skillset">
                <li class="clear"><img class="fl_left" src="images/demo/64x64.gif" alt="Template Demo Image" />
                <div class="fl_right">
                    <p>Indonectetus facilis</p>
                    <p>Inteligula congue id elis donec sce sag ittis intes id laoreet aenean.</p>
                </div>
                </li>
                <li class="clear"><img class="fl_left" src="images/demo/64x64.gif" alt="Template Demo Image" />
                <div class="fl_right">
                    <p>Indonectetus facilis</p>
                    <p>Inteligula congue id elis donec sce sag ittis intes id laoreet aenean.</p>
                </div>
                </li>
                <li class="clear"><img class="fl_left" src="images/demo/64x64.gif" alt="Template Demo Image" />
                <div class="fl_right">
                    <p>Indonectetus facilis</p>
                    <p>Inteligula congue id elis donec sce sag ittis intes id laoreet aenean.</p>
                </div>
                </li>
            </ul>
            </div>
            <div class="one_third">
            <h2>Vivamuslibero Auguer</h2>
            <ul>
                <li>Aliquam venenatis leo et orci.</li>
                <li>Pellentesque eleifend vulputate massa.</li>
                <li>Vivamus eleifend sollicitudin eros.</li>
                <li>Maecenas vitae nunc.</li>
                <li>Ut pretium odio eu nisi.</li>
                <li>Nam condimentum mi id magna.</li>
                <li>Pellentesque consectetuer, felis vel rhoncus.</li>
                <li>Sed sollicitudin bibendum dui.</li>
            </ul>
            </div>
        </div>
        <!-- ####################################################################################################### -->
        <div id="team">
            <ul class="clear">
            <li class="one_third first">
                <div class="figure"><img src="images/demo/team-member.gif" alt="Template Demo Image" />
                <div class="figcaption">
                    <div class="fl_left">
                    <p class="team_name">Name Goes Here</p>
                    <p class="team_title">Job Title Here</p>
                    </div>
                    <ul>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    </ul>
                    <p class="team_description">Vestassapede et donec ut est liberos sus et eget sed eget. Quisqueta habitur augue magnisl magna phas ellus sagit titor ant curabi turpis.</p>
                </div>
                </div>
            </li>
            <li class="one_third">
                <div class="figure"><img src="images/demo/team-member.gif" alt="Template Demo Image" />
                <div class="figcaption">
                    <div class="fl_left">
                    <p class="team_name">Name Goes Here</p>
                    <p class="team_title">Job Title Here</p>
                    </div>
                    <ul>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    </ul>
                    <p class="team_description">Vestassapede et donec ut est liberos sus et eget sed eget. Quisqueta habitur augue magnisl magna phas ellus sagit titor ant curabi turpis.</p>
                </div>
                </div>
            </li>
            <li class="one_third">
                <div class="figure"><img src="images/demo/team-member.gif" alt="Template Demo Image" />
                <div class="figcaption">
                    <div class="fl_left">
                    <p class="team_name">Name Goes Here</p>
                    <p class="team_title">Job Title Here</p>
                    </div>
                    <ul>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    <li><a href="https://www.os-templates.com/page-templates"><img src="images/demo/social-icon.png" alt="Template Demo Image" /></a></li>
                    </ul>
                    <p class="team_description">Vestassapede et donec ut est liberos sus et eget sed eget. Quisqueta habitur augue magnisl magna phas ellus sagit titor ant curabi turpis.</p>
                </div>
                </div>
            </li>
            </ul>
        </div>
        <!-- ####################################################################################################### -->
        </div>
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
    </div>
    </div>
    <!-- footer -->
    <div class="wrapper row3">
    <div id="footer" class="clear">
        <p class="fl_left">Copyright &copy; 2009 - 2020 - All Rights Reserved - <a href="https://www.os-templates.com/">Domain Name</a></p>
        <p class="fl_right">Template by <a href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    </div>
    </div>
    <div id="osfooter">
    <div>
        <div id="bsap_1244497" class="bsarocks bsap_2cdb89802e2deca5991138bb3e47b146"></div>
    </div>
    </div>
</body>
</html>