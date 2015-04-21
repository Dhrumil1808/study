<html>

<head>

    <meta charset="utf-8">
    <title>My Kart</title>
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
        alert("hello");
        $("#notify").click(function(){
            $("#notify").html('');
            $.ajax({
                type: "POST",
                url: "/CodeIgniter_2.2.0/index.php/admin_home/notifier?uname=<?php echo $admin; ?>",
                success: function(msg){
                    $("#notify").html(msg)
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
            body
            {
                background: #f2f2f2;
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
                width: 100%;
                border-collapse: collapse;
                background: #f2f2f2;
            }

            #centre
            {
                text-align: center;
            }
            #go_back
            {
                width: 200px;
                font-size: 18px;
                padding: 5px 0px;
            }
            #net_amount
            {
                
                margin:0px 0px 0px 0px; 
                background: #f2f2f2; 
                border: 1px solid #ddd;
                width: 100%;
                padding:15px 15px 15px 88px;

            }
            .amount
            {
                
               margin:0px 0px 0px 0px;
            }
            .sum
            {
                font-weight: bold;
                margin: 0px 0px 0px 0px;
            }
            .row
            {
                background: #f2f2f2;
                border-top: 1px solid #ddd;
                border-bottom: 1px solid #ddd;

            }
            .row_heading
            {
                background: #f2f2f2;
                border-top:1px solid #ddd;
                border-bottom: 1px solid #ddd;
                

            }
            #Material_Name
            {
                border-left:  3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
                width: 20%;
                font-weight: bold;
            }
            #qty
            {
                border-left:  3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
               text-align: center;
               font-weight: bold;
            }
            #price
            {
                border-left:   3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
                font-weight: bold;
            }
            #discount
            {
                border-left: 3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
                font-weight: bold;
            }
            #Subtotal
            {
                border-left: 3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
                font-weight: bold;
            }
            #empty_cart
            {
                font-weight: bold;
                margin: 142px 0px 0px 350px;
                font-size: 20px;
            }
            table
            {
                border:3px solid #e4e4e4;
                margin:0px 90px 0px 70px;
            }
            .orders
            {
                margin:100px 0px 0px 80px;
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
            ?>
            
            <li><a href="/CodeIgniter_2.2.0/index.php/admin_home/getUnapprovedOrder">Orders <span class="badge"><?php echo $no_orders; ?></span></a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/my_account/admin_account">Account</a></li>
            <li><a href="/CodeIgniter_2.2.0/index.php/logout/logout_admin">Logout</a></li>

            <li><a href="/CodeIgniter_2.2.0/index.php/signup/add_admin">Add Admin</a></li>
            <li id="notify" class="dropdown">
                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#">
            <span class="glyphicon glyphicon-bell"></span>
          </a>
          
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

 <div class ="container">
        

            <div class="col-md-offset-10" id="MainMenu">
                 <i>Select Action:</i>
                <div class="btn-group">
                <form method = "POST" action = "edit_general_orders" enctype="multipart/form-data">
                <select class="btn btn-default" name="options">
                <option selected="selected" value="0"> None </option>
                <option value="1"> APPROVED</option>
                <option value="2"> UNAPPROVED </option>
                </select>
                   
                </div>
            
                </div>

            <table cellpadding="0" cellspacing="0">
                <thead class="row_heading"> 
                <tr>
                    <td id="Material_Name" class="col-md-4" colspan="">
                        ____</td>
            
                    <td id="qty" class="col-md-2"> 
                        Item</td>

                    <td id="price" class="col-md-2"> 
                    Quantity</td>
                    
                    <td id="discount" class="col-md-2"> 
                            Price</td>
                    
                 
                    
                </tr>
            </thead>    
            

        <?php 
        foreach($results1 as $row1) {
            $vendor = $row1->Username;

            ?>
        
        <thead class="row">
        <tr>
            <td> <?php echo $vendor; ?> </td>
            </tr>
            <?php
            foreach($results as $row) {
                if($row->Username == $vendor) { 
            ?>


            
        <tr>
                                <td class="checkbox" align="center">
                                    <label>
                                        <input type="checkbox" id="select" name="select[]" value="<?php echo $row->Order_ID; ?>">
                                    </label>
                                </td>
                        
                            <td class="col-md-3" id="Material_Name">
                                
                                <img src="/CodeIgniter_2.2.0/<?php echo $row->Image; ?>" height="80px" width="80px"/>
                                
                                <?php echo $row->Material_Name; ?>
                               
                            </td>
                            <td class="col-md-2" id="qty">
                                
                                    <?php echo $row->Quantity; ?>
                                      </td>
                            <td class="col-md-2" id="price">
                                    <?php echo $row->Order_Cost; ?>
                               
                            </td>
                            

                    </tr>
                    <?php }
                        }?>
                    </thead>
                    <?php } ?>
                        
                        
     
      </table>
      
      <input type = "submit" value="Submit" class="btn btn-success btn-lg" id="go_back" />
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
     
     