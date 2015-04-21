<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>StudyKart</title>
    <meta name="Welcome" content="Hello User">
    

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
                url: "/CodeIgniter_2.2.0/index.php/home/notifier",
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
                url:"/CodeIgniter_2.2.0/index.php/home/read_notifs",
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
                        <a href="/CodeIgniter_2.2.0/index.php/home/load_materials" class="navbar-brand">StudyKart</a>
                    </div>
                    <div class="collpase navbar-collapse" id="example">
                        <ul class="nav navbar-nav">
                            <li class ="xyz"><a href="https://cryptic-citadel-3874.herokuapp.com/index.php/home/wish_list">Wish list</a></li>
                            <li class="xyz"><a href="https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/account">My account</a></li>
                            
                            <li class="xyz"><a href="https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login">Sell</a></li>
                            <?php
                            if(isset($_COOKIE['student']))
                            {
                                //echo $_COOKIE['student'];
                                $users=$_COOKIE['student'];
                            ?>
                                <li class="xyz"><a href="#"><?php echo "Hello "; echo $users; ?></a></li>
                                <li class="xyz"><a href="https://cryptic-citadel-3874.herokuapp.com/index.php/logout/logout_student">Logout</a></li>
                                <li class="xyz"><a href="https://cryptic-citadel-3874.herokuapp.com/index.php/home/cart">Shopping cart</a></li>
                                <li class="xyz"><a href="https://cryptic-citadel-3874.herokuapp.com/index.php/home/viewOrder">My Orders</a></li>
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
                                    $this->load->database();
                                    $sql = "SELECT Email FROM users WHERE Username='$users'";
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



     <div class="jumbotron">
        <div class="container">
            <h1>Find the resources you need</h1>


            <form method="POST" action="/CodeIgniter_2.2.0/index.php/home/search" class="navbar-form navbar-center" role="search">
                        <div class="form-group">
                            <input type="text" name="searchbox" class="form-control" placeholder="Search this out">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <p> <em><br>Your exam + Our Material = Instant Success!</br></em></p>
            <a href="#">Learn More</a>
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
                                    <a href="/CodeIgniter_2.2.0/index.php/home/sub_search?Subcategory=<?php echo $subcategory; ?>" class="list-group-item"><?php echo $subcategory; ?></a>
                                <?php
                                }
                                ?>
                                    <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_category?category=<?php echo $category->Category; ?>&add=0" class="list-group-item">EDIT</a>-->
                             </div>   
                      <?php
                          $i=$i+1; 
                      }
                      ?>
                        <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/add_category?add=0" class="list-group-item list-group-item-success" data-toggle="" data-parent="#MainMenu">ADD NEW  <i class="fa fa-caret-down"></i></a>-->
                    </div>


                 </div>
            </div>



            <div class="col-md-9">
            <div class="container">
            <!-- <div class="col-md-9 ">Engineering --> 
                    <?php
                        $i=1;
                        foreach($categories as $category){
                      ?>
                            <div class="col-md-9 "><?php echo $category->Category; ?> 
                             <div class="row"> 
                                    <?php
                                     $sql="SELECT * FROM materials WHERE Category='$category->Category' ORDER BY Price desc LIMIT 3";  
                                            $r=mysql_query($sql);

                                            while($result=mysql_fetch_object($r))
                                            {
                                            ?>
                                                <div class="col-md-4">
                                                <a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $result->Material_ID; ?>"> 
                                                <div class="thumbnail">
                                                    <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $result->Image;?>" > 
                                                </div>
                                                <?php echo $result->Material_Name; ?><br/>
                                                Price: <?php echo $result->Price; ?></a><br/>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                </div>
                             </div>   
                      <?php
                          $i=$i+1; 
                      }
                      ?>

                
                      </div>
            </div>
       
                                    
        </div>
    </div>

    
    

        

    <footer>
        <div class="container">
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


