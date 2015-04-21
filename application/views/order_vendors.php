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

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



    <style>
            
            #search_results
            {
                margin-top: 100px;
            }

            #foot
            {
                margin-top: 100px;
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
    <div class="container" id = "search_results">
        <h2>Showing Vendors With Unapproved Orders</h2>
    </div>
    
    <?php
        $this->load->database(); 
        $sql="SELECT DISTINCT   
        materials.Vendor_Email,materials.Material_ID,orders.Order_Approve_Status FROM materials,orders WHERE orders.Material_ID=materials.Material_ID AND orders.Order_Approve_Status=0 ORDER BY materials.Vendor_Email asc";
        $results=mysql_query($sql);
        $users=Array();
        $i=0;
        while($user=mysql_fetch_object($results))
        {
            $users[$i]=(object)NULL;
            $sql="SELECT users.Name, users.Username, users.Email, vendor.BusinessName, users.Contact FROM users,vendor WHERE users.Email=vendor.Email AND users.Email='$user->Vendor_Email'";
            $result=mysql_query($sql);
            $users[$i]->vendor=mysql_fetch_object($result);
            $i=$i+1;
        }
    ?>
    <div class="list-group">
        <div class="container">
            <div class="list-group">
                <?php 
                    foreach($users as $user) 
                    {
                ?>
                        <a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_vendor?Username=<?php echo $user->vendor->Username; ?>" class="list-group-item" >
                        <h4 class="list-group-item-heading">Username: <?php echo $user->vendor->Username; ?></h4>
                        <p class="list-group-item-text">Name: <?php echo $user->vendor->Name; ?> </br> Email: <?php echo $user->vendor->Email; ?> </br> Business Name: <?php echo $user->vendor->BusinessName; ?> </br>Contact: <?php echo $user->vendor->Contact; ?></p>
                        </a>
                <?php
                    }
                ?>
                
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
    
