<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link rel="shortcut icon" href="<?php echo base_url("Bootstrap/images/favicon.ico"); ?>" />
    <link href="<?php echo base_url("Bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/prettyPhoto.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/price-range.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/animate.css"); ?>" rel="stylesheet">
	<link href="<?php echo base_url("Bootstrap/css/main.css"); ?>" rel="stylesheet">
	<link href="<?php echo base_url("Bootstrap/css/responsive.css"); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("Bootstrap/css/sweet-alert.css"); ?>">
</head><!--/head-->

<body>
	<?php $this->load->view('module/header');?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<!-- <form action="#">
							<input type="email" placeholder=" Email Address" class="mailuser" />
							<input type="password" placeholder=" Password" class="passuser"/>
							
							<button type="submit" class="btn btn-default" id="clickme" onclick="event.preventDefault(); load_ajaxlogin();" >Login</button>
						</form> -->

                        <form action="#" id= "login">
                            <div class="input-group">
                                <input id="email" type="email" class="form-control" placeholder=" Email"  name = "email">
                            </div>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control" placeholder=" Password"name = "password">
                            </div>
                            <button type="submit" class="btn btn-default" onclick="event.preventDefault();load_ajaxlogin();" >Login</button>
                            </form>
                     
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
							<form action="#" id= "signup">
							<div class="input-group">
                                <input id="name" type="text" class="form-control" placeholder=" Username" name = "name">
                            </div>
							<div class="input-group">
                                <input id="email1" type="text" class="form-control" placeholder=" Email"  name = "email">
                            </div>
                            <div class="input-group">
                                <input id="pass" type="password" class="form-control" placeholder=" Password"name = "password">
                            </div>
                            <div class="input-group">
                                <input id="repassword" type="password" class="form-control" name="repassword" placeholder=" Password" equalTo="#pass">
                            </div>
							<!-- <tr>
			                    <td>Captcha</td>
			                    <td>
			                        <i><img src="image.php" id="img-captcha"/></i>
			                        <i><input type="button" id="reload" value="Reload" onclick="$('#img-captcha').attr('src', 'image.php?rand=' + Math.random())" /> <br/></i>
			                        <input type="text"  placeholder="Captcha" id="captcha" value="" />
			                    </td>
			                </tr> -->
							<button type="submit" class="btn btn-default" onclick="load_ajax();event.preventDefault();" >Signup</button>
							</form>
					 
					</div><!--/sign up form-->
					
				</div>
			</div>
		</div>
	</section><!--/form-->
	<style type="text/css">
        .error{
            color:red;
        }
         label.valid {
            background: url('<?php echo base_url();?>Bootstrap/images/checked.gif') no-repeat;
            display: block;
            margin-top: 10px;
            width: 16px;
            height: 16px;
            z-index: 1000;
            float: right
        }
        .input-group {
            width: 100%;
        }
    </style>

<script src="<?php echo base_url();?>Bootstrap/js/jquery.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/price-range.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/main.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/sweet-alert.js"></script>
<script src="<?php echo base_url();?>Bootstrap/js/jquery.validate.min.js"></script>
<script type="text/javascript">
						
			
    $(document).ready(function() {
        // $('.check').click(function(event) {
        //     $('.signup button').toggleClass('active');
        // });
        $('#signup').validate({
        success:"valid",
        rules: {
            email:{
                required: true,
                email: true,
                remote:{
                    url: "<?php echo site_url();?>user/checkemail/",
                    type: "post"
                }
            },
            name:{
            	required: true,
            	minlength: 2
            },
            password:{
                required: true,
                minlength: 8
            },
            repassword:{
                required: true,
                minlength: 8
            },
        },
        messages:{
          	name:{
          		required: "Tên không được bỏ trống",
          		minlength: "Tên tối tiểu phải có 2 kí tự"
          	},
            email:{
                required: "Email không được bỏ trống",
                email: "Định dạng email không đúng",
                remote: "Email này đã có người sử dụng"
            },
            password:{
                required: "Mật khẩu không được bỏ trống",
                minlength: "Mật khẩu tối tiểu phải có 8 kí tự"
            },
            repassword:{
                required: "Mật khẩu xác nhận không được bỏ trống",
                equalTo: "Mật khẩu xác nhận không khớp",
                minlength: "Mật khẩu tối tiểu phải có 8 kí tự"
            },
        }
    });
});
</script>
</body>
</html>