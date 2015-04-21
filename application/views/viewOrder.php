

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>My Kart</title>
    <meta name="description" content="YOLO">
    

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



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
                width: 250px;
                font-size: 18px;
                padding: 8px 0px;
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



     
     <div class ="container">
        


            <table cellpadding="0" cellspacing="0" class="orders">
                <thead class="row_heading"> 
                <tr>
                    <td id="Material_Name" class="col-md-4" colspan="">
                        Item</td>
            
                    <td id="qty" class="col-md-2"> 
                        Quantity</td>

                    <td id="price" class="col-md-2"> 
                    Cost</td>
                    
                    <td id="discount" class="col-md-2"> 
                            Mode</td>
                    

                    <td id="Subtotal" class="col-md-2"> 
                        Approval Status</td>
                    
                </tr>
            </thead>    
            
            <?php
                $this->load->database();
                foreach($results as $order) {
                    
                 
            ?>        

                   
                <thead class="row">
                <tr>
                <td class = "col-md-4" id="Material_Name">
                                    
               <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $order->Image;?>" width="80px" height="80px">
                    
                    
                                    <a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $order->Material_ID; ?>">
                                       <h6> <?php if(strlen($order->Material_Name)>15)
                                        {
                                            echo substr($order->Material_Name,0,15)."..."; 
                                            } else
                                            {
                                                echo $order->Material_Name;
                                                } ?></h6>
                                    </a>
                                        <?php
                                            $sql="SELECT users.Name FROM users WHERE Email='$order->Vendor_Email'";
                                            $result=mysql_query($sql);
                                            $seller=mysql_fetch_object($result);
                                        ?>
                                        
                                        Seller: 
                                        <?php if(strlen($seller->Name)>12)
                                        {
                                            echo substr($seller->Name,0,12)."..."; 
                                            } else
                                            {
                                                echo $seller->Name;
                                                } ?>
                                        
                    </td>         

                            <td class="col-md-2" id = "qty"> 
                                <h5><?php echo $order->Quantity; ?> </h5>
                            </td>
                          

                            <td class="col-md-2" id ="price"> 
                                <h5>Rs <?php echo $order->Order_Cost; ?> </h5>
                            </td>
                            <td class="col-md-2" id = "discount"> 
                                <h6><?php echo $order->Mode_of_Payment; ?></h6>
                                
                            </td>
                            <td class="col-md-2" id = "Subtotal"> 
                                <h4><?php if($order->Order_Approve_Status==0)echo "Unapproved"; else echo "Approved"; ?></h4>
                            </td>
                         
                                </tr>
                                </thead>

                     
            <?php
                }
            ?>


            
</table>
        
    </div>
 

        

    <footer>
        <div class="container" >
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
