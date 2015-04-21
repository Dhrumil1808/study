

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
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
                width: 20%;
            }
            #qty
            {
                border-left:  3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
               text-align: center;
            }
            #price
            {
                border-left:   3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
            }
            #discount
            {
                border-left: 3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
            }
            #Subtotal
            {
                border-left: 3px solid #e4e4e4;
                border-right: 3px solid #e4e4e4;
                border-bottom: 3px solid #e4e4e4;
                text-align: center;
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



     
   
    <?php

    $sum = 0;
    $value=mysql_num_rows($output);
        //echo $value;
        if($value==0)
        {
            ?>
    
            <?php
            ?>
            <div class="sum" id="empty_cart">
            <?php
            echo "your cart is currently empty";
        ?>
        </div>


        <?php
        }

        else
        {
            ?>
            
            <?php
    ?>
    <div class="container" id = "MainMenu">
                <table cellpadding="0" cellspacing="0">
                <thead class="row_heading"> 
                <tr>
                    <td id="Material_Name" class="col-md-4" colspan="">
                        Material Name</td>
            
                    <td id="qty" class="col-md-2"> 
                        Quantity</td>

                    <td id="price" class="col-md-2"> 
                    Price</td>
                    
                    <td id="discount" class="col-md-2"> 
                            Discount</td>
                    

                    <td id="Subtotal" class="col-md-2"> 
                        Subtotal</td>
                    
                </tr>
            </thead>    
<?php
        $this->load->database();
    while($r = mysql_fetch_object($output)) {

        //$this->load->database();
        $id=$r->Material_ID;
        $sql1= "SELECT * FROM materials WHERE materials.Material_ID=$r->Material_ID";
        //echo $sql1;
        $result1=mysql_query($sql1);
        $row=mysql_fetch_object($result1);
        $quan=$row->Material_ID;
        $sel="SELECT * FROM cart WHERE Material_ID='$quan' ";
        $run=mysql_query($sel);
        $run1=mysql_fetch_object($run);
?>
                        <thead class="row">
                        <tr>
                        
                            <td class = "col-md-4" id="Material_Name">
                               
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $row->Image;?>" width="80px" height="80px">
                                <h4><?php echo $row->Material_Name; ?> </h4>
                                
                            
                  
                                 
                                    <a href="remove_from_cart?ID=<?php echo $id ?>"> Remove </a> 
                                    
                              &nbsp; &nbsp;
                               
                                    <a href="add_to_wishlist_from_cart?ID=<?php echo $id ?>"> Move To Wishlist </a> 
                                         
                            </td>
                        
                 
                    <td class="col-md-2" id ="qty"> 
                        <h4><?php echo $run1->Quantity; ?></h4>
                    </td>
                    <td class="col-md-2" id ="price"> 
                        <h4><?php echo ($row->Price) * ($run1->Quantity); ?></h4>
                    </td>

                    <td class="col-md-2" id ="discount"> 
                        <h4><?php echo $row->Discount *($run1->Quantity); ?></h4>
                    </td>
                    <td class="col-md-2" id ="Subtotal"> 
                        <h4><?php echo $row->FinalPrice*($run1->Quantity);
                                        $sum+=$row->FinalPrice *($run1->Quantity); ?></h4>
                    </td>
                    </tr>
            
        </thead>


        
<?php
        
        
    }

    ?>
    <thead>
     <div class="col-md-4 col-md-offset-8">
     <tr>
     <td> </td>
     <td> </td>
     <td> </td>

                <td colspan="2" class="box"  id="net_amount"> 
                        <span class="amount">Total Amount Payable:</span> <span class="sum"> <?php echo $sum; ?></span> 
                </td>
                </tr>

                <?php
}
?>
  
            </div>
            </thead>
            </table>

                <br/>
                <br/>
            
                        <?php if($value!=0)
                    {
                        ?>
                    <div class="col-md-3" >
                        <a href="/CodeIgniter_2.2.0/index.php/home/load_materials" id="go_back" class="btn btn-success btn-lg">Continue Shopping</a>
                    </div>
                    
                    
                    
                        
                  <div class="col-md-3 col-md-offset-5">
                    <form method="post" action="buy_now">
                        <input type="submit" class="btn btn-success btn-lg"  id="go_back" value="Buy Now" /> 
                        </form>
                    </div>
        
                    <?php
                }
                else
                {
                    ?>
                    <div class="col-md-3" >
                        <a href="/CodeIgniter_2.2.0/index.php/home/load_materials" id="go_back" class="btn btn-success btn-lg">Continue Shopping</a>
                    </div>
                    <?php
                }
                ?>
        


</body> 
</html>
