<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>My Account</title>

    

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">-->




    <style>
            

            #heading
            {
                padding-top: 100px;
                
            }
            #p_heading
            {
                text-align: center;
            }
            
            #foot
            {
                margin-top: 100px;
            }
            .jumbotron .container
            {

                padding-top: 100px;
            }

            .list-group.panel > .list-group-item 
            {
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
            }
            .list-group-submenu 
            {
                margin-left:20px;
            }


    </style>
</head>


<body>

    <header>   
     <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/CodeIgniter_2.2.0/index.php/admin_home/admin_page">StudyKart</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href=""><?php if(isset($_COOKIE['admin'])){
                $admin=$_COOKIE['admin'];
                echo $admin;
            }
                else{
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Session expired. Please Re-login');\n";
                    echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
                    echo "</script>";
                    }?></a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/my_account/admin_account">Account</a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/logout/logout_admin">Logout</a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/signup/add_admin">Add Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>
   </header>

    <div class="container" id = "heading">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/admin_account">Personal Info</a></li>
                <li class="active"><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_admin_password">Change Password</a></li>
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_admin_Email">Change Email</a></li>
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_admin_accnum">Change Account Number</a></li>
                
            </ul>
        </div>

        <div class="col-md-9">
            <div class="panel panel-info" >
                <div class="panel-heading" id="p_heading">
                <h3 class="panel-title">My Account</h3>
                </div>
                <?php echo validation_errors(); ?>
                <form class="form-horizontal" method="POST" >
                <div class="panel-body" id = "panel_body1">  
                        <fieldset>
                        <legend>Change Passsword</legend>
                        <div class="form-group">
                          <label for="inputPassword" class="col-lg-2 control-label">New Password</label>
                          <div class="col-lg-10">
                            <input type="password" name="new_password" id="InputPasswordFirst" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword" class="col-lg-2 control-label">Confirm Password</label>
                          <div class="col-lg-10">
                            <input type="password" name="confirm_password" id="InputPasswordSecond" class="form-control">
                          </div>
                        </div>
                         
                        </fieldset>
                        <div class="col-lg-6"> 
                            <input type="submit" name="submit" id="submit" value="UPDATE" class="btn btn-primary pull-right">
                        </div>
                    </form>

                </div>
            </div>
        </div>
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
    
