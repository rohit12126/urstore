<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?php echo "#" ?>| Admin login</title>
     <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap-reset.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/style-responsive.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.validate.js"></script>
<script type="text/javascript">
//check_session();
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
                if(data['status']=='success')
                {
                       jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url('backend/setsession'); ?>",
                        data: {id:data['userid'],user_status:data['data']['user_status'],user_login:data['data']['user_login']},
                        success: function(result)
                        {
                            
                               jQuery('.loading_countrygif').hide(); 
                               //window.location.href = "<?php echo base_url('backend'); ?>";
                               location.reload();
                        }

                    });     
                }
                jQuery('.loading_countrygif').hide();
            }
      }); 
   }

  

</script>

</head>

<body class="lock-screen" onload="startTime()">
        <div id="time"></div>
      <form action="<?php echo base_url('backend/login') ?>" method="post" id="login"  class="form-signin">
         <img src="<?php echo base_url(); ?>assets/admin/img/NCE-logo.png" style="padding-left: 20px;">
        
        <div class="text-center error_msg" style="display:none;">           
            <span class="help-block btn btn-danger " id="error_msg" style="width: 90%;">
            </span>
        </div>
        <div class="login-wrap">
        <?php msg_alert(); ?> 
            <input type="text" class="form-control" placeholder="Username" id="username"   name="username">
            <input  name="password" type="password" class="form-control" id="password" placeholder="Password">
            <button class="btn btn-lock login" type="submit">Sign in
            <i class="icon-arrow-right"></i></button>
            <!--  <button class="btn btn-lock login" type="button">Sign in
            <i class="icon-arrow-right"></i></button>
              <button class="btn btn-lock logout" type="button">logout
            <i class="icon-arrow-right"></i></button>
             <button class="btn btn-lock checksession" type="button">checksession
            <i class="icon-arrow-right"></i></button> -->
        </div>
      </form>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->

    <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
       /* jQuery("#login").validate({
            rules: {
                username: "required",
                password: "required",
             },
            submitHandler: function() {
                var username=$('#username').val();
                var password=$('#password').val();
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
                                            url: "<?php echo base_url('backend/setsession'); ?>",
                                            data: {id:data['data']['data']['ID'],user_status:data['data']['data']['user_status'],user_login:data['data']['data']['user_login']},
                                            success: function(result)
                                            {
                                                
                                                   jQuery('.loading_countrygif').hide(); 
                                                   //window.location.href = "<?php echo base_url('backend'); ?>";
                                                   location.reload();
                                            }

                                        });     
                                    }else{
                                        $('.error_msg').show();
                                        $('#error_msg').text(data['msg']);
                                    }
                                  
                                jQuery('.loading_countrygif').hide();
                            }
                      }); 
                }
           }); 
      
*/
    </script>
    <style type="text/css" media="screen">
    .logo{
    background: rgb(13, 93, 126);
    padding: 6px 78px 6px 78px;
    margin: 12px;
        }
        span{
            color: #0C0C0C;
    font-size: 16px;
    font-weight: bold;
    padding: 0px;
    margin: 0px;
        }
       
    </style>
  </body>
</html>
