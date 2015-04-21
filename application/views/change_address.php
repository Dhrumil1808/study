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
    
        <div class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php if(isset($_COOKIE['admin'])){ ?> <a href="/CodeIgniter_2.2.0/index.php/admin_home/admin_page" class="navbar-brand">Admin Home</a><?php } ?>
                        <a href="/CodeIgniter_2.2.0/index.php/home/load_materials" class="navbar-brand">StudyKart</a>
                    </div>
                    <div class="collpase navbar-collapse" id="example">
                        <ul class="nav navbar-nav">
                            <li class ="xyz"><a href="/CodeIgniter_2.2.0/index.php/home/wish_list">Wish list</a></li>
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/my_account/account">My account</a></li>
                            
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/login/vendor_login">Sell</a></li>
                            <?php
                            if(isset($_COOKIE['student']))
                            {
                                //echo $_COOKIE['student'];
                                $users=$_COOKIE['student'];
                            ?>
                                <li class="xyz"><a href="#"><?php echo "Hello "; echo $users; ?></a></li>
                                <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/logout/logout_student">Logout</a></li>
                                <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/home/cart">Shopping cart</a></li>
                                <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/home/viewOrder">My Orders</a></li>
                            <?php
                                    if(isset($_COOKIE['admin']))
                                    {
                                        $this->load->database();
                                        $sql = "SELECT users.Block_Status FROM users WHERE users.Username='$users'";
                                        $result = mysql_query($sql);
                                        $block = mysql_fetch_object($result);
                            ?>
                                    <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/admin_home/block_student?users=<?php echo $users; ?>"><?php if($block->Block_Status==0)echo "Block"; else echo "Unblock"; ?></a></li>
                            <?php
                                    }
                            }
                            else
                            {
                            //echo $_COOKIE['student'];
                            ?>
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/login/student_login">Login</a></li>
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/signup/take_entries">Create an account</a></li>
              <?php
                            }

                            ?>
                                
                            
                            
                        </ul>

                    </div>

                </div>
        </div>

    </header>

    <div class="container" id = "heading">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/account">Personal Info</a></li>
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_password">Change Password</a></li>
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_Email">Change Email</a></li>
                <li class="active"><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_address">Change Address</a></li>
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/reviews">Ratings and Reviews</a></li>
                
            </ul>
        </div>

        <div class="col-md-9">
            <div class="panel panel-info" >
                <div class="panel-heading" id="p_heading">
                <h3 class="panel-title">My Account</h3>
                </div>
                <?php echo validation_errors(); ?>
                <div class="panel-body" id = "panel_body1">
                <form class="form-horizontal" method="POST" >  
                        <fieldset>
                        <legend>Update Address</legend>
                        
                        <div class="form-group">
                          <label for="textArea" class="col-lg-2 control-label"> Address</label>
                          <div class="col-lg-10">
                            <textarea class="form-control" name="address" rows="3" id="textArea" ><?php echo $address->Address; ?></textarea>
                            <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="nameInput" class="col-lg-2 control-label">City</label>
                          <div class="col-lg-10">
                            <input type="text" name="city" class="form-control" id="nameInput" value="<?php echo $address->City; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="nameInput" class="col-lg-2 control-label">State</label>
                          <div class="col-lg-10">
                            <select name='state'>
 
                            <?php
                                $sql= "SELECT * FROM states";
                                $result=mysql_query($sql);

                                while($state=mysql_fetch_object($result))
                                {
                                    //echo $r->State;
                            ?>
                                    <option value="<?php echo $state->State; ?>" <?php if($address->State==$state->State){echo 'selected';} ?> > <?php echo $state->State; ?>
                                    </option>
                            <?php
                                }
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="contactInput" class="col-lg-2 control-label">Pincode</label>
                          <div class="col-lg-10">
                            <input type="text" name="pincode" class="form-control" id="contactInput" value="<?php echo $address->Pincode; ?>">
                          </div>
                        </div>
                        </fieldset>
                        <div class="form-group">
                          <div class="col-lg-4 col-lg-offset-8">
                            <div class="col-lg-6">
                            <input type="submit" name="submit" id="submit" value="UPDATE" class="btn btn-primary pull-right">
                            </div>
                          
                            
                          </div>
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
