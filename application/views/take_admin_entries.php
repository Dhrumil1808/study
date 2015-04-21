<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta charset="utf-8">
    <title>Sign-Up</title>
    <meta name="description" content="Register">
    

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



    <style>
            

            #heading
            {
                padding-top: 100px;
                text-align: center;
                
            }
            #sign_in
            {
                margin-top: 50px;
                text-align: right;
                margin-bottom: 100px;
            }
            #foot
            {
                margin-top: 100px;
            }


    </style>
    <title>SIGN UP</title>
</head>




<body>

    <div class="container" id ="heading">
        <div class="col-md-6 col-md-offset-3">
            <h1>Register Your Account</h1>
        <div id = "sign_in">
            <h5>Already Have An Account?</h5>
            <h6><a href="#" >Sign in</a></h6>
        </div>
        </div>
    </div>
    
    <div class="container" >
    
    <div class="row" id="detail">
    <?php echo validation_errors(); ?>
        <form role="form" method="POST">
            <div class="col-lg-6 col-lg-offset-3">
                <h4> Fill in your details</h4>
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="InputName">Enter Name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="name" id="InputName" placeholder="Enter Name" value="<?php echo set_value('name') ?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputUsername">Enter Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="InputName" name="username" placeholder="Enter Username" value="<?php echo set_value('username') ?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter Email" value="<?php echo set_value('email')?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Contact Number</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="InputContact" name="contact" placeholder="Enter Contact" value="<?php echo set_value('contact')?> " maxlength="10" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="InputPassword">Enter Password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" id="InputPasswordFirst" name="password" placeholder="Enter Password" value="<?php echo set_value('password');?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ConfirmEmail">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="InputPasswordSecond" name="password1" placeholder="Confirm Password" value="<?php echo set_value('password1'); ?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Bank Account Number</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="InputContact" name="accnum" placeholder="Enter Contact" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                <input type="submit" name="submit" id="submit" value="Register" class="btn btn-info pull-right">
            </div>
        </form>

        
    </div>



    <footer>
        <div class="container" id = "foot" >
        <hr>

            <div class="row">
                

                <div class="col-md-3"><p><small><a href="#">Terms</a> </small></p></div>
                <div class="col-md-3"><p>   <small><a href="#">About </a></small></p></div>
                <div class="col-md-3"><p>   <small><a href="#">Legal</a> </small></p></div>
                <div class="col-md-3"><p>   <small><a href="#">Contact</a> 888888888 </small></p></div>
                    
            </div>
        </div> <!-- end container -->
    </footer>  

<!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>