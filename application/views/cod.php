<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
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
                margin:0px 0px 30px 700px;
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
                margin: 0px 0px 0px 0px;
            }
            .transaction
            {
                margin: 35px 0px 0px 680px;
                font-weight: bold;
                font-size: 18px;

            }
            .address
            {
                font-weight: bold;
            }
            table
            {
                border:3px solid #e4e4e4;
                margin:0px 90px 0px 70px;
            }
    </style>
</head>

<body>
<div class="container">
<div class="row">
<div id="container">
<h2> Order Received </h2>
<h3> Thank You. Your order has been received </h3>

<h4> Order Details </h4>
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
		if(isset($_GET['value']))
		{

			$sel="SELECT * FROM orders ORDER BY Order_ID DESC  LIMIT 1";
			//echo $sel;
			$run=mysql_query($sel);
			$execute=mysql_fetch_object($run);
			$id=$execute->Material_ID;
 		$select="SELECT * FROM materials WHERE materials.Material_ID='$id'"; 
		//echo $select;
			$fetch=mysql_query($select);
			$sum=0;
		 while($row=mysql_fetch_object($fetch))
{
	
	
	 ?>
     
         <thead class="row">
                        <tr>
                        
                            <td class = "col-md-4" id="Material_Name">
                               
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $row->Image;?>" width="80px" height="80px">
                                <h4><?php echo $row->Material_Name; ?> </h4>
                                  
                            </td>
                        
                 
                    <td class="col-md-2" id ="qty"> 
                        <h4><?php echo $execute->Quantity; ?></h4>
                    </td>
                    <td class="col-md-2" id ="price"> 
                        <h4><?php echo ($row->Price) * ($execute->Quantity); ?></h4>
                    </td>

                    <td class="col-md-2" id ="discount"> 
                        <h4><?php echo $row->Discount *($execute->Quantity); ?></h4>
                    </td>
                    <td class="col-md-2" id ="Subtotal"> 
                        <h4><?php echo $row->FinalPrice*($execute->Quantity);
                                        $sum+=$row->FinalPrice *($execute->Quantity); ?></h4>
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
  
            </div>
            </thead>
            </table> 
<?php

	$time_zone=date_default_timezone_set("Asia/Kolkata");
	 $date=date("Y-m-d H:i:s");
	 //echo $date
		$transaction="SELECT  Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1" ;
		//echo $transaction;
	$trans=mysql_query($transaction);
	$t=mysql_fetch_object($trans);
	$trans_ID=$t->Order_ID;
	
   ?>

   
        
    <div class="transaction">
    <?php
 echo "Your transaction ID for order is". "&nbsp;".$trans_ID;
}
?>

 

            </div>
            
   <?php

           
	//header("location:cod_email");

	if(isset($_GET['value1']))
	{

		 $select_cart="SELECT * FROM cart,users WHERE cart.Student_Email = '$_GET[value1]' AND email='$_GET[value1]'";
        //echo $select_cart;
        $result_cart=mysql_query($select_cart);
        $sum=0;
        $t_quantity=0;
        $this->load->helper('cookie');
        if(mysql_num_rows($result_cart)==0)
        {   
             delete_cookie('student');
             echo "<script language=\"JavaScript\">\n";
            echo "alert('Session has expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
        }
        //$quantity=$_GET['value3'];
        else
        {
         while($r = mysql_fetch_object($result_cart)) 
        
        {
                $id=$r->Material_ID;
                $sql1= "SELECT * FROM materials WHERE materials.Material_ID=$r->Material_ID";
		//echo $sql1;
				$result1=mysql_query($sql1);
				$row=mysql_fetch_object($result1);
        		$quan=$row->Material_ID;
        		$sel="SELECT * FROM cart WHERE Material_ID='$quan' ";
        		$run=mysql_query($sel);
        		$run1=mysql_fetch_object($run);
       			//echo $sql1;
             ?>
           
         <thead class="row">
                        <tr>
                        
                            <td class = "col-md-4" id="Material_Name">
                               
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $row->Image;?>" width="80px" height="80px">
                                <h4><?php echo $row->Material_Name; ?> </h4>
                                  
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
  
            </div>
            </thead>
            </table> 
        <?php
        $transaction="SELECT  Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1" ;
		//echo $transaction;
	$trans=mysql_query($transaction);
	$t=mysql_fetch_object($trans);
	$trans_ID=$t->Order_ID;
    ?>
    <div class="transaction">
    <?php
	echo "Your transaction ID for order is". "&nbsp;".$trans_ID;
    }
    ?>
    </div>
    <?php
	} 
                     $student=$_COOKIE['student'];

                    $query = $this->db->query("SELECT * FROM users WHERE Username = '$student'");
    
                               foreach($query->result() as $row) {
                                $student_email = $row->Email;
                                    }

    $query3="DELETE FROM cart WHERE  Student_Email='$student_email'";
         //echo $query3;
         mysql_query($query3);   


?>

<h3> Shipping Address </h3>
<?php
$sel="SELECT * FROM student WHERE Email='$student_email'";
$run=mysql_query($sel);
while($r=mysql_fetch_object($run))
{
?>
<div class="address">
Address:
  <?php  echo $r->Address;
  ?>
  <br/>
  City:
  <?php
    echo $r->City;
    ?>
    <br/>
    State:
    <?php
    echo $r->State;
    ?>
    <br/>
    Pincode:
    <?php
    echo $r->Pincode;
}
?>
</div>
</div>
<div class="col-md-3" >
                        <a href="/CodeIgniter_2.2.0/index.php/home/load_materials" id="go_back" class="btn btn-success btn-lg">Continue Shopping</a>
                    </div>
</div>
</div>

</body>