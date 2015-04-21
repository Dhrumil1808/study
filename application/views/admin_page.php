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

    <title>Admin Page</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js">
    </script>
    <script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/modernizr.custom.28468.js"></script>
    <script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/jquery.cslider.js"></script>
    <script>
       $(document).ready(function(){
        //alert("hello");
        var interval=3000;
        //$("#notify").html('');
        var refresh = function(){
            $.ajax({
                type: "GET",
                url: "/CodeIgniter_2.2.0/index.php/admin_home/notifier",
                success: function(msg){
                    $('#notify').html(msg);
                    setTimeout(function(){
                        refresh();
                    }, interval);
                }
            });
        };
        refresh(); 

    });
    </script>

    <script>
    //alert("ROFL");
    $(document).ready(function(){
    
        //alert("first");
    $("#notify").click(function () {
            
        
            //alert(this.value);
            $.ajax({
                type: "GET",
                url:"/CodeIgniter_2.2.0/index.php/admin_home/read_notifs",
                success: function(){
            
                }
                
            });
        
        });
    });
    </script>

    <style>
            

            #heading
            {
                padding-top: 100px;
                text-align: center;
                
            }
            #search_box
            {
                margin-top: 50px;
                text-align: center;
                margin-bottom: 100px;
            }
            #search_button
            {
                text-align: center;
            }
            #foot
            {
                margin-top: 100px;
            }
              .dropdown {
    display:inline-block;
    margin-left:20px;
    padding:10px;
  }


.glyphicon-bell {
   
    font-size:1.5rem;

  }

.notifications {
   min-width:420px; 
  }
  
  .notifications-wrapper {
     overflow:auto;
      max-height:250px;
    }
    
 .menu-title {
     color:#ff7788;
     font-size:1.5rem;
      display:inline-block;
      }
 
.glyphicon-circle-arrow-right {
      margin-left:10px;     
   }
  
   
 .notification-heading, .notification-footer  {
    padding:2px 10px;
       }
      
        
.dropdown-menu.divider {
  margin:5px 0;          
  }

.item-title {
  
 font-size:1.3rem;
 color:#000;
    
}

.notifications a.content {
 text-decoration:none;
 background:#ccc;

 }
    
.notification-item {
 padding:10px;
 margin:5px;
 background:#ccc;
 border-radius:4px;
 }
 .badge-notify{
   background:red;
   position:absolute;
   top:0px;
  }



    </style>
</head>


<body>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
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
            <?php 
            $this->load->database();
            $sql="SELECT * FROM orders WHERE Order_Approve_Status=0";
            $result=mysql_query($sql);
            $no_orders=mysql_num_rows($result);
            ?>
            <?php
            $this->load->database();
            $sql = "SELECT Email FROM users WHERE Username='$admin'";
            $result = mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql = "SELECT Notification_Text FROM notifications WHERE User_Email = '$email->Email'";
            $result = mysql_query($sql);
            $sql = "SELECT * FROM notifications WHERE User_Email = '$email->Email' AND Status='0'";
            $unread = mysql_query($sql);
            $no_unread = mysql_num_rows($unread);
            ?>
            
            <li><a href="/CodeIgniter_2.2.0/index.php/admin_home/getUnapprovedOrder">Orders <span class="badge"><?php echo $no_orders; ?></span></a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/my_account/admin_account">Account</a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/logout/logout_admin">Logout</a></li>

            <li><a href="/CodeIgniter_2.2.0/index.php/signup/add_admin">Add Admin</a></li>

            <li id="notify" class="dropdown">
                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <span id="notifBadge" class="glyphicon glyphicon-bell"></span>
          </a>
          <span  class="badge badge-notify"><?php echo $no_unread; ?></span>
          
          <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
            
            
            <div class="notification-heading"><h4 class="menu-title">Notifications</h4>
            <li class="divider"></li>
           <div class="notifications-wrapper">
             <?php while($notification = mysql_fetch_object($result)){ ?>
             <a class="content" href="#">
              
               <div class="notification-item">
                <h4 class="item-title"><?php echo $notification->Notification_Text; ?></h4>
                
              </div>
              </a>   
                <?php } ?>

           </div>
            <li class="divider"></li>
            <div class="notification-footer"></div>
          </ul>
                </li>


          </ul>
          
        </div>

      </div>
    </nav>
   </header>
    
    <div class="jumbotron" id ="heading">
        <div class="container">
                        
            <h1> Welcome <?php if(isset($_COOKIE['admin'])){
                    echo $_COOKIE['admin'];
                } else{
                    header("location:http://localhost/CodeIgniter_2.2.0/index.php/login/admin_login");
                } ?></h1>
            
        </div>
    </div>
<div class ="container">
<div class="row">
            <div class="col-md-3">
                
         
            <?php
             $this->load->database();
                $sql = "SELECT DISTINCT Category FROM categories";
                $result = mysql_query($sql);
                $categories = Array();
                $i=0;
                while($r=mysql_fetch_array($result)){
                    $categories[$i]=(object)NULL;
                    $categories[$i]->Category = $r['Category'];
                    $cat = $r['Category'];
                    $sql = "SELECT Subcategory FROM categories WHERE Category='$cat'";
                    $res = mysql_query($sql);
                    $categories[$i]->Subcategory = Array();
                    $j=0;
                    while($row=mysql_fetch_array($res)){
                        $categories[$i]->Subcategory[$j]=(object)NULL;
                        $categories[$i]->Subcategory[$j]=$row['Subcategory'];
                        $j = $j+1;
                    }
                    $i=$i+1;
                }
        
        
            ?>


             <div id="MainMenu">
                    <div class="list-group panel">
                      <?php
                        $i=1;
                        foreach($categories as $category){
                      ?>
                            <a href="#demo<?php echo $i; ?>" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu"><?php echo $category->Category; ?>  <i class="fa fa-caret-down"></i></a>
                            <div class="collapse" id="demo<?php echo $i; ?>">
                                <?php foreach($category->Subcategory as $subcategory){
                                ?>
                                    <a href="" class="list-group-item"><?php echo $subcategory; ?></a>
                                <?php
                                }
                                ?>
                                    <a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_category?category=<?php echo $category->Category; ?>&add=0" class="list-group-item">EDIT</a>
                             </div>   
                      <?php
                          $i=$i+1; 
                      }
                      ?>
                        <a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/add_category?add=0" class="list-group-item list-group-item-success" data-toggle="" data-parent="#MainMenu">ADD NEW  <i class="fa fa-caret-down"></i></a>
                    </div>


                 </div>
            </div>
    <div class="col-md-9">
            <!--div class="container"-->
    <div class = "container" id="search_box">
        <div class="col-md-4">
            <form class="form-horizontal" method = "GET" action = "/CodeIgniter_2.2.0/index.php/admin_home/search_vendor" enctype="multipart/form-data">
              <fieldset>
                <legend>Search For Vendor</legend></br>
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="vendor" class="form-control" id="Vendor_Name" placeholder="Enter Name of Vendor">
                  </div>
                </div>

                <div class="form-group" id = "search_button">
                  <div class="col-lg-12">
                    <button type="search" class="btn btn-primary">Search</button>
                  </div>
                </div>
              </fieldset>
            </form>
        </div>
        <div class="col-md-4">
            <form class="form-horizontal" method = "GET" action = "/CodeIgniter_2.2.0/index.php/admin_home/search_student" enctype="multipart/form-data">
              <fieldset>
                <legend>Search For Student</legend></br>
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="student" class="form-control" id="Student_Name" placeholder="Enter Name of Student">
                  </div>
                </div>

                <div class="form-group" id = "search_button">
                  <div class="col-lg-12">
                    <button type="search" class="btn btn-primary">Search</button>
                  </div>
                </div>
              </fieldset>
            </form>
        </div>
    </div>
      <!--/div-->
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
   