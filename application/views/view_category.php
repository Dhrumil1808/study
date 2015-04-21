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

    <title>Upload Material</title>

    

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
        <!--div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/account">Profile</a></li>
                <li class="active"><a href="/CodeIgniter_2.2.0/index.php/my_account/edit_profile">Edit Profile</a></li>
                <li><a href="/CodeIgniter_2.2.0/index.php/my_account/reviews">Ratings and Reviews</a></li>
                
            </ul>
        </div-->
        <div class="col-md-9">
            <div class="panel panel-info" >
                <div class="panel-heading" id="p_heading">
                <h3 class="panel-title">Edit Category</h3>
                </div>
                <div class="panel-body" id = "panel_body1">
                <form class="form-horizontal" method="POST" action="edit_category" enctype="multipart/form-data" >
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />  
                        <fieldset>
                        <legend></legend>
                        <div class="form-group">
                            <div class="row">
                                <label for="nameInput" class="col-lg-2 control-label"><?php echo $category; ?></label>
                                <div class="col-lg-6">
                                    <input type="text" name="new_category_name" class="form-control" id="nameInput" >
                                    <input type="hidden" name="category" id="category" value="<?php echo $category; ?>" />
                                </div>
                                <div class="col-lg-3">
                                    <select name = "category_op" class="form-control" id="nameInput">
                                    <option value="Rename">Rename</option>
                                    <option value="Remove">Remove</option>
                                    <option value="None" selected> None</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i=0;
                        while($r=mysql_fetch_array($subcategories))
                        {
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <label for="nameInput" class="col-lg-2 control-label"><?php echo $r['Subcategory'].': '; ?></label>
                                <div class="col-lg-6">
                                    <input type="hidden" name="subcategory_name<?php echo $i; ?>" id="subcategory_name<?php echo $i; ?>" value="<?php echo $r['Subcategory']; ?>" />
                                    <input type="text" name="subcategory<?php echo $i; ?>" id="nameInput" class="form-control" />
                                </div>
                                <div class="col-lg-3">
                                    <select name = "sub_category<?php echo $i; ?>" class="form-control" id="nameInput">
                                    <option value="Rename">Rename</option>
                                    <option value="Remove">Remove</option>
                                    <option value="None" selected>None</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                            $i=$i+1;
                        }
                        ?>
                        <?php $j=0;
                        while($j<intval($add))
                        {
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <label for="nameInput" class="col-lg-2 control-label"><?php echo "New_Subcategory".$j.": "; ?></label>
                                <div class="col-lg-6">
                                    
                                    <input type="text" name="new_subcategory<?php echo $j; ?>" id="nameInput" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <?php
                            $j=$j+1;
                        }
                        ?>

                        </fieldset>
                        <div class="form-group">
                          <div class="col-lg-4 col-lg-offset-8">
                            <div class="col-lg-6">
                            <input type="submit" name="submit" id="submit" value="SUBMIT" class="btn btn-primary pull-right">
                            </div>
                          
                          </div>
                        </div>
                </form>
                <form class="form-horizontal" method="GET" action="view_category" enctype="multipart/form-data" >
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                    <fieldset>
                        <legend></legend>
                    <div class="form-group">
                        <div class="row">
                            <label for="nameInput" class="col-lg-2 control-label">Add_Subcategories</label>
                                <div class="col-lg-6">
                                    <input type="text" name="add" class="form-control" id="nameInput" >
                                    <input type="hidden" value="<?php echo $category; ?>" name="category" id="category" />
                                </div>
                        </div>
                    </div>
                    </fieldset>
                    <div class="form-group">
                          <div class="col-lg-4 col-lg-offset-8">
                            <div class="col-lg-6">
                            <input type="submit" name="submit" id="submit" value="GO" class="btn btn-primary pull-right">
                            </div>
                          
                          </div>
                        </div>
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
