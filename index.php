<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"  prefix="og: http://ogp.me/ns#" class="no-js">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="https://learncodeweb.com/demo/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Validate Emails and send using PHPMailer and JQuery Ajax</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote-bs4.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-6724419004010752",
		enable_page_level_ads: true
	  });
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131906273-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-131906273-1');
	</script>
</head>

<body>
	
	<div class="bg-light border-bottom shadow-sm sticky-top">
		<div class="container">
			<header class="blog-header py-1">
				<nav class="navbar navbar-expand-lg navbar-light bg-light"> <a class="navbar-brand text-muted p-0 m-0" href="https://learncodeweb.com"><img src='https://learncodeweb.com/wp-content/uploads/2019/01/logo.png' alt='LearnCodeWeb'></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-17" class="active nav-item"><a title="Home" href="https://learncodeweb.com/" class="nav-link">Home</a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-16" class="nav-item"><a title="Web Development" href="https://learncodeweb.com/learn/web-development/" class="nav-link">Web Development</a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-558" class="nav-item"><a title="PHP" href="https://learncodeweb.com/learn/php/" class="nav-link">PHP</a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-14" class="nav-item"><a title="Bootstrap" href="https://learncodeweb.com/learn/bootstrap-framework/" class="nav-link">Bootstrap</a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-559" class="nav-item"><a title="WordPress" href="https://learncodeweb.com/learn/wordpress/" class="nav-link">WordPress</a></li>
							<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-15" class="nav-item"><a title="Snippets" href="https://learncodeweb.com/learn/snippets/" class="nav-link">Snippets</a></li>
						</ul>
						<form method="get" action="https://learncodeweb.com" class="form-inline my-2 my-lg-0">
							<div class="input-group input-group-md">
								<input type="text" class="form-control search-width" name="s" id="search" value="" placeholder="Search..." aria-label="Search">
								<div class="input-group-append">
									<button type="submit" class="btn btn-primary" id="searchBtn"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</nav>
			</header>
		</div> <!--/.container-->
	</div>
	<div class="container my-2">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- demo top banner -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-6724419004010752"
			 data-ad-slot="6737619771"
			 data-ad-format="auto"
			 data-full-width-responsive="true"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	
	<script>
        $(document).ready(function(e){
            $("#emailFrom").on("submit",function(){
                $("html, body").animate({scrollTop: 0}, 1000);
                email = $("#to").val();
                if(email!=""){
                    totalEmail = email.split(',');
                    countEmail = totalEmail.length;
                    flag = 0;
                    noEmails = '';
                    for(i=0;i<countEmail;i++){
                        if(emailValidate(totalEmail[i])===false){
                            var elements = [totalEmail[i]];
                            var noEmails = elements.join(',');
                            $("#emailMsg").html('<div class="alert alert-danger"><i class="fa fa-fw fa-exclamation-triangle"></i> Email(s) typo error ('+noEmails+') <strong>Please type correct email(s)!</strong></div>');	 
                            flag = 1;
                        }
                    }
                    if(flag==1){
                        $("#eMsg").html('<small><em class="text text-danger"> <strong>Example:</strong> example<strong>@</strong>gmail<strong>.com</strong></i></small>');
                        return false;
                    }
                    $("#emailMsg").html('<div class="overlay"><i class="fa fa-fw fa-spin fa-spinner"></i> Please wait...!</div>');
                    $.ajax({
                        type:'POST',
                        url:'ajax/action.ajax.php',
                        data:$("#emailFrom").serialize(),
                        success: function(data){
                            a = data.split('|***|');
                            if(a[1]==1){
                                $("#emailMsg").html(a[0]);
                                $("#to,#subject").val('');
                            }else{
                                $("#emailMsg").html(a[0]);
                            }
                        }
                    });
                }else{
                    $("#emailMsg").html('<div class="alert alert-danger"><i class="fa fa-fw fa-exclamation-triangle"></i> Enter email first <strong>Please type correct email(s)!</strong></div>');
                    return false;
                }
            });
        });
        
        function emailValidate(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    </script>
    <div class="container">
        <div class="alert alert-warning"><i class="fa fa-fw fa-exclamation-triangle"></i> If you do not get any email then don't worry. <strong>Its us not you!</strong> Try code on your own server.</div>
        <div class="col-sm-12"> 
            <div id="emailMsg"></div>
            <h1><a href="https://learncodeweb.com/web-development/validate-emails-and-send-using-phpmailer-and-jquery-ajax/">Validate Emails and send using PHPMailer and JQuery Ajax</a></h1>
            <form id="emailFrom" method="post" onsubmit="return false;">
                <input type="hidden" name="sendEmail" value="ok" />
                <div class="form-group">
                    <label>To:</label>
                    <input type="text" name="to" id="to" class="form-control-lg form-control" placeholder="More than one email, Please seperate with comma (,)" />
                    <div class="text-danger"><small>* More than one email, Please seperate with comma (,)'</small></div>
                </div>
                <div class="form-group">
                    <label for="staticEmail">Subject:</label>
                    <input class="form-control form-control-lg" id="subject" name="subject" placeholder="Enter your subject" type="text">
                </div>
                <div class="form-group">
                    <textarea name="mailEditor" id="txtEditor"></textarea>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LeXKIkUAAAAAJrVaP2rbXY7r8uWLr13YX3X_c3r"></div>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary">Send Email</button>
                </div>
            </form>
        </div>
    </div>
	
	
	<div class="container">
		<div class="row">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- demo left sidebar -->
			<ins class="adsbygoogle"
				 style="display:block"
				 data-ad-client="ca-pub-6724419004010752"
				 data-ad-slot="7706376079"
				 data-ad-format="auto"
				 data-full-width-responsive="true"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div>
	
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs4-summernote@0.8.10/dist/summernote-bs4.min.js"></script>
    <script>
		$(document).ready(function() {
			$('textarea').summernote({
				height: 300,   //set editable area's height
			});
		});
	</script>
</body>
</html>