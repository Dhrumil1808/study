

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>My Wishlist</title>
    <meta name="description" content="YOLO">
    

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
                url: "/CodeIgniter_2.2.0/index.php/home/notifier_vendor",
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
                url:"/CodeIgniter_2.2.0/index.php/home/read_notifs_vendor",
                success: function(){
            
                }
                
            });
        
        });
    });
    </script>


    <style>
            

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

            #MainMenu
            {
                padding-top: 100px;
            }
            #temp_padding
            {
                padding-top: 500px;
                padding-bottom: 25px
            }
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
                        <a href="/CodeIgniter_2.2.0/index.php/materials/show_detail" class="navbar-brand">StudyKart</a>
                    </div>
                    <div class="collpase navbar-collapse" id="example">
                        <ul class="nav navbar-nav">
                            
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/my_account/vendor_account">My account</a></li>
                            
                            
                            <?php
                            if(isset($_COOKIE['vendor']))
                            {
                                //echo $_COOKIE['student'];
                                $user=$_COOKIE['vendor'];
                            ?>
                                <li class="xyz"><a href="#"><?php echo "Hello "; echo $user; ?></a></li>
                                <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/logout/logout_vendor">Logout</a></li>
                            <?php
                                $this->load->database();
                                $sql = "SELECT Email FROM users WHERE Username='$user'";
                                $result = mysql_query($sql);
                                $email=mysql_fetch_object($result);
                                $sql = "SELECT Notification_Text FROM notifications WHERE User_Email = '$email->Email'";
                                $result = mysql_query($sql);
                                $sql = "SELECT * FROM notifications WHERE User_Email = '$email->Email' AND Status='0'";
                                $unread = mysql_query($sql);
                                $no_unread = mysql_num_rows($unread);
                            ?>
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

                            <?php
                            }

                            else
                            {
                            //echo $_COOKIE['student'];
                            
                                echo "<script language=\"JavaScript\">\n";
                                echo "alert('Session expired. Please Re-login');\n";
                                echo "window.location='/CodeIgniter_2.2.0/index.php/login/vendor_login'";
                                echo "</script>";
                            
              
                            }
                            if(isset($_COOKIE['admin']))
                            {
                                $this->load->database();
                                $sql = "SELECT users.Block_Status FROM users WHERE users.Username='$user'";
                                $result = mysql_query($sql);
                                $block = mysql_fetch_object($result);
                            ?>
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/admin_home/block_vendor?user=<?php echo $user; ?>"><?php if($block->Block_Status==0)echo "Block"; else echo "Unblock"; ?></a></li>
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/admin_home/manage_orders?user=<?php echo $user; ?>">Manage Orders</a></li>
                            <?php
                            }
                            ?>
                            
                            
                        </ul>

                    </div>

                </div>
        </div>

    </header>




     
     <div class ="container">
        <div class="row">

            

            <div class="col-md-9-offset-3">
            <div class="container">
            <?php
            $this->load->database();
            $sql= "SELECT * FROM materials WHERE Vendor_Email=(SELECT Email FROM users WHERE Username='$user')";
            $products=mysql_query($sql);
            $i=0;

            while($product=mysql_fetch_object($products))
              {
            ?>
                <div class="col-md-9 " id = "MainMenu">
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="thumbnail">
                        <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $product->Image;?>">
                        </div>
                    </div>

                    <div class="col-md-8"> 
                        <div class = "row">
                        <h4><?php echo $product->Material_Name; ?></h4>
                        <hr>
                        <h6>Price: Rs <?php echo $product->Price; ?></h6>
                        <h6>Discount: <?php echo $product->Discount."%"; ?>
                        <h6>Stock: <?php
                              echo $product->Quantity;
                          ?>
                        </h6>
                        <h6>Sold: <?php echo $product->Quantity_Sold; ?></h6>
                        
                        <a href="/CodeIgniter_2.2.0/index.php/materials/update_material?Material=<?php echo $product->Material_ID; ?>" class="btn btn-success btn-lg">  UPDATE  </a>
                        
                        
                        <a href="/CodeIgniter_2.2.0/index.php/materials/delete_material?Material=<?php echo $product->Material_ID; ?>" class="btn btn-warning btn-lg">DELETE</a>
                        
                        </div>
                    </div>
                </div>
            </div>
            <?php
              }
            ?>
            </div>
            </div>

            <!--div class="col-md-12">
                <div class="row">

                    <div class="col-md-3 col-md-offset-5">
                        <a href="/CodeIgniter_2.2.0/index.php/materials/upload_material" class="btn btn-success btn-lg">Add Material</a>
                    </div>
                </div>
            </div-->
            <br>
            <div class="col-md-12">
            <div class="container" id="temp_padding">
                <div class="row">
                    <div class="col-md-3"><p><small><a href="#">Terms</a> </small></p></div>
                    <div class="col-md-3"><p>   <small><a href="#">About </a></small></p></div>
                    <div class="col-md-3"><p>   <small><a href="#">Legal</a> </small></p></div>
                    <div class="col-md-3"><p>   <small><a href="#">Contact</a> 888888888 </small></p></div>
                </div>
            </div>
            </div>
                    
        </div>
    </div>
 

        

    <footer>
        <div class="container" >
        <hr>

            <div class="row">
                
                <div class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">
                <div class = "container">
                    <ul class="nav navbar-nav">
                        <li class ="xyz" align = "right"><a href="/CodeIgniter_2.2.0/index.php/materials/upload_material"><b>ADD NEW ITEM</b></a></li>
                    </ul>
                </div>
            </div>
                    
            </div>
        </div> <!-- end container -->
    </footer>   


<!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body> 
</html>

