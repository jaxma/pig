<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='keywords' content="<?php echo ($site_keywords); ?>"/>
    <meta name='description' content="<?php echo ($site_description); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ($site_title); ?></title>

    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">  
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="__CSS__/font-awesome.min.css">                
    <!-- Font Awesome -->
    <link rel="stylesheet" href="__CSS__/bootstrap.min.css">                                      
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="__CSS__/hero-slider-style.css">                              
    <!-- Hero slider style (https://codyhouse.co/gem/hero-slider/) -->
    <link rel="stylesheet" href="__CSS__/magnific-popup.css">                                 
    <!-- Magnific popup style (http://dimsemenov.com/plugins/magnific-popup/) -->
    <link rel="stylesheet" href="__CSS__/tooplate-style.css">                                   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
</head>

    <body>
        
        <!-- Content -->
        <div class="cd-hero">

            <!-- Navigation -->        
            <div class="cd-slider-nav">
                <nav class="navbar">
                    <div class="tm-navbar-bg">
                        
                        <a class="navbar-brand text-uppercase" href="<?php echo U('Index/index2');?>">Guinea Pig</a>

                        <img id="reloads" src = "__IMG__/reloads.gif" title="刷新">
                        <img id="blog" src = "__IMG__/blog.png" title="博客">

                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                            &#9776;
                        </button>
                        <div class="navbar-toggle" id="main_tip_search2"> 
                            <form action="<?php echo U('Index/index2');?>" style='float:right;' method='post'>
                                <button type = "submit" class = 'search_btn'>ss</button>
                                <input type="text" name="search" id="tip_search_input" list="search" autocomplete=off required>
                            </form>
                        </div>
                        <div class="collapse navbar-toggleable-md text-xs-center text-uppercase tm-navbar" id="tmNavbar">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active selected">
                                    <a class="nav-link" href="#0" data-no="1">荷兰猪 <span class="sr-only">(current)</span></a>
                                </li>                                
                                <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="2">博客</a>
                                </li>
<!--                                 <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="3">其他</a>
                                </li> -->
								<li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="4">精彩留言</a>
                                </li>
<!--                                                                 <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="5">Keep in touch</a>
                                </li> -->
                            </ul>
                        </div>                        
                    </div>

                </nav>
            </div> 

            <ul class="cd-hero-slider">

                <!-- Page 1 Gallery One -->
                <li class="selected">                    
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content" data-page-no="1" data-page-type="gallery">
                            <div class="tm-img-gallery-container">
                                <div class="tm-img-gallery gallery-one">
                                <!-- Gallery One pop up connected with JS code below -->                                    
                                    <div class="tm-img-gallery-info-container">                                    
                                        <h2 class="tm-text-title tm-gallery-title tm-white"><span class="tm-white">荷兰猪的日常</span></h2>
                                        <p class="tm-text">豚鼠（学名：Cavia porcellus）又名天竺鼠。豚鼠是无尾啮齿动物，身体紧凑，短粗，头大颈短，它们具有小的花瓣状耳朵，位于头顶的两侧，具有小三角形嘴。四肢短小，作为选择育种的结果，存在20种不同表型的毛发颜色，并且存在13种不同的表型毛发质地和长度
                                        </p>
                                    </div>

                                <?php if(is_array($ads)): foreach($ads as $key=>$i): ?><div class="grid-item">
                                        <figure class="effect-bubba">
                                            <img src="__ROOT__/<?php echo ($i["original_img"]); ?>" alt="Image" class="img-fluid tm-img">
                                            <figcaption>
                                                <h2 class="tm-figure-title"><?php echo ($i["title"]); ?></h2>
                                                <p class="tm-figure-description"><?php echo ($i["description"]); ?></p>
                                                <a href="__ROOT__/<?php echo ($i["original_img"]); ?>">查看大图</a>
                                            </figcaption>           
                                        </figure>
                                    </div><?php endforeach; endif; ?>      

                                </div>            
                            </div>
                        </div>                                                    
                    </div>                    
                </li>

                <!-- Page 2 Gallery Two -->
                <li>                    
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content" data-page-no="2" data-page-type="gallery">
                            <div class="tm-img-gallery-container">
                                <div class="tm-img-gallery gallery-two">
                                <!-- Gallery Two pop up connected with JS code below -->
                                    
                                    <div class="tm-img-gallery-info-container">                                    
                                        <h2 class="tm-text-title tm-gallery-title"><span class="tm-white">博客</span></h2>
                                        <p class="tm-text"><span class="tm-white">记录小猪的日常，还有生活的点滴，也可能写技术博客</span>
                                        </p>
                                    </div>

                                <?php if(is_array($goods)): foreach($goods as $key=>$i): ?><div class="grid-item" onclick="location.href = '<?php echo U('Index/index', array('goods_id'=>$i['goods_id']));?>'">
                                        <figure class="effect-bubba">
                                            <img src="__ROOT__/<?php echo ($i["goods_img"]); ?>" alt="Image" class="img-fluid tm-img">
                                            <figcaption>
                                                <h2 class="tm-figure-title"><?php echo ($i["title"]); ?></h2>
                                               	<p class="tm-figure-description"><?php echo ($i["description"]); ?></p>
                                           	 <a href="__ROOT__/<?php echo ($i["goods_img"]); ?>"> 更多</a>
                                            </figcaption>           
                                        </figure>
                                    </div><?php endforeach; endif; ?>
                                    
                                </div>                                 
                            </div>
                        </div>                      
                    </div>
                </li>

                <!-- Page 3 Gallery Three -->
<!--                 <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content" data-page-no="3" data-page-type="gallery">                        
                            <div class="tm-img-gallery-container">
                                <div class="tm-img-gallery gallery-three">
                                    
                                    <div class="tm-img-gallery-info-container">                                    
                                        <h2 class="tm-text-title tm-gallery-title"><span class="tm-white">Third Multi Gallery</span></h2>
                                        <p class="tm-text"><span class="tm-white">Donec dapibus dui sed nisi fermentum, a sollicitudin lorem fringilla. Integer nec pharetra turpis, eu sagittis ipsum. Cras dignissim lacus dolor.</span>
                                        </p>                                     
                                    </div>
                                    <div class="grid-item">
                                        <figure class="effect-bubba">
                                            <img src="__IMG__/tm-img-01-tn.jpg" alt="Image" class="img-fluid tm-img">
                                            <figcaption>
                                                <h2 class="tm-figure-title">Image <span>One</span></h2>
                                                <p class="tm-figure-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a href="__IMG__/tm-img-01.jpg">View more</a>
                                            </figcaption>           
                                        </figure>
                                    </div>
                                                                     
                                </div>                                 
                            </div> 
                        </div>         
                    </div>  
                </li> -->

                <!-- Page 4 About -->
                <li>
                    <div class="cd-full-width"  style="margin-top:50px;">
                        <div class="container-fluid js-tm-page-content tm-page-width tm-pad-b" data-page-no="4">
                            <div class="row tm-white-box-margin-b">
                                <div class="col-xs-12">
                                    <div class="tm-flex">
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-textbox-padding">
                                            <h2 class="tm-text-title"><?php echo ($c1["title"]); ?></h2>
                                            <p class="tm-text"><?php echo ($c1["content"]); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row tm-white-box-margin-b">
                                <div class="col-xs-12">
                                    <div class="tm-flex">
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title"><?php echo ($c2["title"]); ?></h2>
                                            <p class="tm-text"><?php echo ($c2["content"]); ?></p>
                                        </div>
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title"><?php echo ($c3["title"]); ?></h2>
                                            <p class="tm-text"><?php echo ($c3["content"]); ?></p>     
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tm-flex">
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title"><?php echo ($c4["title"]); ?></h2>
                                            <p class="tm-text"><?php echo ($c4["content"]); ?></p>
                                        </div>
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title"><?php echo ($c5["title"]); ?></h2>
                                            <p class="tm-text"><?php echo ($c5["content"]); ?></p>     
                                        </div>
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title"><?php echo ($c6["title"]); ?></h2>
                                            <p class="tm-text"><?php echo ($c6["content"]); ?></p>     
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>              
                    </div> <!-- .cd-full-width -->

                </li>

                <!-- Page 5 Contact Us -->
                <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content tm-page-pad" data-page-no="5">
                            <div class="tm-contact-page">                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="tm-flex tm-contact-container">                                
                                            <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding tm-textbox-padding-contact">
                                                <h2 class="tm-contact-info">Say hello to us!</h2>
                                                <p class="tm-text">Pellentesque euismod, sem nec euismod interdum, odio elit venenatis est, gravida aliquet velit velit a ex. In luctus orci et orci lobortis, quis sagittis nibh laoreet.</p>                                                
                                                
                                                <!-- contact form -->
                                                <form action="index.html" method="post" class="tm-contact-form">

                                                    <div class="form-group">
                                                        <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name"  required/>
                                                    </div>
                                        
                                                    <div class="form-group">                                                        
                                                        <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"  required/>
                                                    </div>                                                        
                                                    
                                                    <div class="form-group">
                                                        <textarea id="contact_message" name="contact_message" class="form-control" rows="5" placeholder="Your message" required></textarea>
                                                    </div> 

                                                    <button type="submit" class="pull-xs-right tm-submit-btn">Send</button>  
                                                
                                                </form>  
                                            </div>

                                            <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding tm-textbox-padding-contact">
                                                <h2 class="tm-contact-info">794 Old Street 12120, San Francisco, CA</h2>
                                                <!-- google map goes here -->
                                                <div id="google-map"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>    

                        </div>
                        
                    </div> <!-- .cd-full-width -->
                </li>
            </ul> <!-- .cd-hero-slider --> 
            <footer class="tm-footer">
            
            
            

<!--                  <p class="tm-social-icons-container text-xs-center">
                    <a href="#" class="tm-social-link" onlick = 'fwechat();'><i class="fa fa-facebook"></i></a>
                </p> -->

            </footer>
                    
        </div> <!-- .cd-hero -->
        

        <!-- Preloader, https://ihatetomatoes.net/create-custom-preloading-screen/ -->
        <div id="loader-wrapper">
            
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>
        
        <!-- load JS files -->
        <script src="__JS__/jquery-1.11.3.min.js"></script>         <!-- jQuery (https://jquery.com/download/) -->
        <script src="__JS__/tether.min.js"></script> <!-- Tether for Bootstrap (http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h) --> 
        <script src="__JS__/bootstrap.min.js"></script>             <!-- Bootstrap js (v4-alpha.getbootstrap.com/) -->
        <script src="__JS__/hero-slider-main.js"></script>          <!-- Hero slider (https://codyhouse.co/gem/hero-slider/) -->
        <script src="__JS__/jquery.magnific-popup.min.js"></script> <!-- Magnific popup (http://dimsemenov.com/plugins/magnific-popup/) -->
        
        <script>

            function adjustHeightOfPage(pageNo) {

                var offset = 80;
                var pageContentHeight = 0;

                var pageType = $('div[data-page-no="' + pageNo + '"]').data("page-type");

                if( pageType != undefined && pageType == "gallery") {
                    pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .tm-img-gallery-container").height();
                }
                else {
                    pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .js-tm-page-content").height() + 20;
                }

                if($(window).width() >= 992) { offset = 120; }
                else if($(window).width() < 480) { offset = 40; }
               
                // Get the page height
                var totalPageHeight = $('.cd-slider-nav').height()
                                        + pageContentHeight + offset
                                        + $('.tm-footer').height();

                // Adjust layout based on page height and window height
                if(totalPageHeight > $(window).height()) 
                {
                    $('.cd-hero-slider').addClass('small-screen');
                    $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", totalPageHeight + "px");
                }
                else 
                {
                    $('.cd-hero-slider').removeClass('small-screen');
                    $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", "100%");
                }
            }

            /*
                Everything is loaded including images.
            */
            $(window).load(function(){

                adjustHeightOfPage(1); // Adjust page height

                /* Gallery One pop up
                -----------------------------------------*/
                $('.gallery-one').magnificPopup({
                    delegate: 'a', // child items selector, by clicking on it popup will open
                    type: 'image',
                    gallery:{enabled:true}                
                });
				
				/* Gallery Two pop up
                -----------------------------------------*/
				$('.gallery-two').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{enabled:true}                
                });

                /* Gallery Three pop up
                -----------------------------------------*/
                $('.gallery-three').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{enabled:true}                
                });

                /* Collapse menu after click 
                -----------------------------------------*/
                $('#tmNavbar a').click(function(){
                    $('#tmNavbar').collapse('hide');

                    adjustHeightOfPage($(this).data("no")); // Adjust page height       
                });

                /* Browser resized 
                -----------------------------------------*/
                $( window ).resize(function() {
                    var currentPageNo = $(".cd-hero-slider li.selected .js-tm-page-content").data("page-no");
                    
                    // wait 3 seconds
                    setTimeout(function() {
                        adjustHeightOfPage( currentPageNo );
                    }, 1000);
                    
                });
        
                // Remove preloader (https://ihatetomatoes.net/create-custom-preloading-screen/)
                $('body').addClass('loaded');
                           
            });
            $('#reloads').hover(function(){
                $(this).stop().animate({'width':'80px','height':'80px'});
            },function(){
                $(this).stop().animate({'width':'60px','height':'60px'});
            })
            $('#reloads').click(function(){
                location.href = '<?php echo U('Index/index2');?>';
            })
            $('#blog').hover(function(){
                $(this).stop().animate({'width':'180px','height':'100px'});
            },function(){
                $(this).stop().animate({'width':'150px','height':'80px'});
            })
            $('#blog').click(function(){
                location.href = '<?php echo U('Index/index');?>';
            })

        </script>            

</body>
</html>