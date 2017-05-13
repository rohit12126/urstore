<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0" />
<title><?php if (isset($title)) { echo $title; } ?> | NCE</title>
<link rel="icon" type="image/png" href="<?php echo base_url('assets/front') ?>/images/favicon.ico" />
<link rel="stylesheet" href="<?php echo base_url('assets/front') ?>/css/style.css">
<link rel="stylesheet" href="<?php echo base_url('assets/front') ?>/vendor/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- <link href="https://fonts.googleapis.com/css?family=Exo:200,300,400,500,600,700" rel="stylesheet">  -->
<link href="https://fonts.googleapis.com/css?family=Exo:200,300,400,500,600,700|Open+Sans" rel="stylesheet"> 
<script type="text/javascript" src="<?php echo base_url('assets/front') ?>/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.validate.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
check_session();
function check_session()
{    
    jQuery.ajax({
            type: "POST",
            url: "<?php echo API_URL; ?>",
            data: {action:'checksession'},
            beforeSend: function()
            {
                jQuery('.loading_countrygif').show();
            }, 
            success: function(result)
            {
                var data=jQuery.parseJSON(result);
                if(data['status']==='success')
                {
                       jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url('home/setsession'); ?>",
                        data: {id:data['userid'],user_status:data['data']['user_status'],user_login:data['data']['user_login']},
                        success: function(result)
                        {
                          //console.log(result);
                             jQuery('.loading_countrygif').hide(); 
                             window.location.href = "<?php echo base_url('home'); ?>";
                             //  location.reload();
                        }

                    });     
                }
                jQuery('.loading_countrygif').hide();
            }
      }); 
   }

</script>
</head>
<body>
 <section id="header" class="">
    <nav id="header-nav" class="navbar navbar-default">
      <div class="container">
          <div class="header_top_bar text-right">
            <ul class="header_top_link">
              <li>
                <a href="">Employee Portal</a>
              </li>
            </ul>
            <ul class="header_top_social">
              <li><a href=""><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a id="logo-sec" class="navbar-brand" href="<?php echo base_url('home') ?>">
                <img src="<?php echo base_url('assets/front') ?>/images/NCE-logo.png" alt="" />
              </a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul id="header-nav-ul" class="nav navbar-nav navbar-right header_nav_ul">
                <li><a href="http://192.186.205.27/employeeportal" target="_blank">Home</a></li>      
                <li>
                  <a href="#">Library</a>
                  <ul class="menu_dropdown">
                    <li>
                      <a href="http://192.186.205.27/human-resources" target="_blank">Human Resources</a>
                    </li>
                    <li>
                      <a href="http://192.186.205.27/forms-and-templates" target="_blank">Forms and Templates</a>
                    </li>
                  </ul>
                </li>
                <li><a href="http://192.186.205.27/category/employee-news" target="_blank">News</a></li> 
                <li><a href="<?php echo base_url('home') ?>">Wiki</a></li> 
              </ul>
          </div>
      </div>
    </nav>
    <div class="container-fluid header_serach_row">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="serach_wrapper">
              <div class="search_lable">Wiki Posts</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</header>
<section id="login-page" class="content_page">
<header>
    <div class="loading_countrygif" >
      <img src="<?php echo base_url('assets/front') ?>/images/loading.gif" alt="Loading..." />
    </div>
    <div class="container">
        <div class="row post_content_row">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
                <div class="login_wrapper">         
                  <form class="login_form" action="" method="post" id="login" >
                    <div class="login_error_msg error_msg" style="display:none;">
                        <span class="help-block" id="error_msg" style="width: 90%;"></span>
                    </div>
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control"  placeholder="Username" id="username"   name="username">
                    </div>
                    <div class="form-group margin_bottom_20">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="remember_checkbox">
                        <label><input type="checkbox"> Remember Me</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="login_submit">Log In</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</section> 
<script type="text/javascript">
jQuery(document).ready(function() {
	   jQuery("#login").validate({
            rules: {
                username: "required",
                password: "required",
             },
            submitHandler: function() {
                var username=jQuery('#username').val();
                var password=jQuery('#password').val();
                $('.error_msg').hide();
             jQuery.ajax({
                            type: "POST",
                            url: "<?php echo API_URL; ?>",
                            data: {action:'login',username:username,password:password},
                            beforeSend: function()
                            {
                                jQuery('.loading_countrygif').show();
                            }, 
                            success: function(result)
                            {
                                 var data=jQuery.parseJSON(result);
                                    if(data['status']=='success')
                                    {
                                           jQuery.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url('home/setsession'); ?>",
                                            data: {id:data['data']['data']['ID'],user_status:data['data']['data']['user_status'],user_login:data['data']['data']['user_login']},
                                            success: function(result)
                                            {
                                                jQuery('.loading_countrygif').hide(); 
                                                  window.location.href = "<?php echo base_url('home'); ?>";
                                                 // location.reload();
                                            }

                                        });     
                                    }else{
                                        jQuery('.error_msg').show();
                                        jQuery('#error_msg').text(data['msg']);
                                    }
                                  
                                jQuery('.loading_countrygif').hide();
                            }
                      }); 
                }
           }); 
    });    

</script>
<?php $this->load->view('templates/user_footer'); ?>