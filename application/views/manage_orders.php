<html>

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
        

            <div class="col-md-offset-10" id="MainMenu">
                 <i>Select Action:</i>
                <div class="btn-group">
                <form method = "POST" action = "edit_orders" enctype="multipart/form-data">
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
	$this->load->database();
	$sql = "SELECT orders.Order_ID, materials.Material_ID, materials.Material_Name, orders.Quantity, orders.Order_Cost, orders.Delivery_Status, orders.Order_Approve_Status,materials.Image FROM  `orders` ,  `materials` WHERE orders.Material_ID = materials.Material_ID AND materials.Vendor_Email =  '$email' AND orders.Order_Approve_Status=0";
	$result = mysql_query($sql);
	$i= 0;
	while($r = mysql_fetch_array($result)){
		//echo $r['Order_ID']." ".$r['Material_ID']." ".$r['Material_Name']." ".$r['Quantity']." ".$r['Order_Cost']." ".$r['Delivery_Status'];
	?>
		<thead class="row">
        <tr>
                                <td class="checkbox" align="center">
                                    <label>
                                        <input type="checkbox" id="select" name="select[]" value="<?php echo $r['Order_ID']; ?>">
                                    </label>
                                </td>
                        
                            <td class="col-md-3" id="Material_Name">
                                
                                <img src="/CodeIgniter_2.2.0/<?php echo $r['Image']; ?>" height="80px" width="80px"/>
                                
                                <?php echo $r['Material_Name']; ?>
                               
                            </td>
                           	<td class="col-md-2" id="qty">
                                
                                 	<?php echo $r['Quantity']; ?>
                                      </td>
                            <td class="col-md-2" id="price">
                                 	<?php echo $r['Order_Cost']; ?>
                               
                            </td>
                            

                    </tr>
                    </thead>
                        
        				
     <?php
	 $i = $i+1;
	 }

	 $this->load->database();
	 $sql = "SELECT orders.Order_ID, materials.Material_ID, materials.Material_Name, orders.Quantity, orders.Order_Cost, orders.Delivery_Status, orders.Order_Approve_Status,materials.Image FROM  `orders` ,  `materials` WHERE orders.Material_ID = materials.Material_ID AND materials.Vendor_Email =  '$email' AND orders.Order_Approve_Status=1";
	 $result = mysql_query($sql);
	 $i= 0;
	 ?>
     <thead class="row">
     <tr>
	 		<td> Approved </td>
            </tr>
	 <?php
	 while($r = mysql_fetch_array($result)){
	 	 $r['Order_ID']." ".$r['Material_ID']." ".$r['Material_Name']." ".$r['Quantity']." ".$r['Order_Cost']." ".$r['Delivery_Status'];
	 ?>
        <tr>
                                <td class="checkbox" align="center">
                                    <label>
                                        <input type="checkbox" id="select" name="select[]" value="<?php echo $r['Order_ID']; ?>">
                                    </label>
                                </td>
                        
                            <td class="col-md-3" id="Material_Name" >
                                
                                <img src="/CodeIgniter_2.2.0/<?php echo $r['Image']; ?>" height="80px" width="80px"/>
                                
    
                                <?php echo $r['Material_Name']; ?>
                               
                            </td>
                            <td class="col-md-2" id="qty">
                                
                                    <?php echo $r['Quantity']; ?>
                                      </td>
                            <td class="col-md-2" id="price">
                                    <?php echo $r['Order_Cost']; ?>
                               
                            </td>
                            

                    </tr>
                    </thead>



        
      <?php 
	  $i = $i+1;
	  }
	  ?>
      </table>
      
      <input type = "submit" value="Submit" class="btn btn-success btn-lg" id="go_back" />
      </form>
    
      </div>

      </body>
      </html>
	 
	 