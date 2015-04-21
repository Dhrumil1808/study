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

    <title>Check Out</title>

    

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js">
</script>
<script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/jquery.cslider.js"></script>
<!-- start slider -->
<script>
  //alert("ROFL");
  $(document).ready(function(){
  
    //alert("first");
  $(".payment").click(function () {
      
      
      //alert(this.value);
      var b=$(".payment:checked").val();
      //alert(b);
      $.ajax({
        type: "POST",
        data: "data="+ this.value,
        url:"",
        success: function(msg){
      
        if(b==1)
          { 
            $("#des_cod").show()
            $("#cash").show()
            $("#des_Online_pay").hide()
            $("#gateway").hide()

            $("#none").hide()
            $(".red").hide()

            <?php
            if(!isset($_GET['msg']) || !isset($_GET['msg1']))
            {
            ?>
            $("#default").show()
            <?php
          }
          ?>
          }
        else 
          {
            $("#des_Online_pay").show()
            $("#gateway").show()
            $("#des_cod").hide()
            $("#cash").hide()
            $("#none").hide()
            $(".red").hide()
          }
          
          
          
        }
        
      });
    
    });
  });
  </script>
  

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
            .red
            {
                color:#F00;
            }
             .col-md-6
              {
                margin: 0px 0px 0px 200px;
              }
              #none
              {
                margin:55px 0px 0px 0px;
              }
              #des_Online_pay
              {
                font-weight: bold;
              }
              #des_cod
              {
                font-weight: bold;
              }
              #cash
              {
                margin: 55px 0px 0px 0px;
              }
              #online_payment
              {
                margin: 10px 0px 0px 0px;
              }


    </style>
</head>


<body>



    <div class="container" id = "heading">
      <div class="col-md-6">
        <div class="panel panel-primary" >
        <div class="panel-heading" id="p_heading">
        <h3 class="panel-title">Shipping Details</h3>
        </div>
        <div class="panel-body" id = "panel_body">
      <div class="red"><?php echo validation_errors(); ?> </div>
      
        <form class="form-horizontal" method="post" id="shipping" action="cod" >  
            <fieldset>
            <legend>Shipping Information</legend>
            <?php

            ?>
            <div class="form-group">
              <label for="nameInput" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-10">
                <input type="text" name="shipping_name" class="form-control" id="nameInput" placeholder="Name of the reciever">
              </div>
            </div>
            <div class="form-group">
              <label for="contactInput" class="col-lg-2 control-label">Contact Number</label>
              <div class="col-lg-10">
                <input type="text" name="shipping_contact" class="form-control" id="contactInput" placeholder="Mobile Number">
              </div>
            </div>
            <div class="form-group">
              <label for="textArea" class="col-lg-2 control-label">Delivery Address</label>
              <div class="col-lg-10">
                <textarea class="form-control" name="shipping_address" rows="3" id="textArea"></textarea>
                
              </div>
            </div>
            <div class="form-group">
                <label for="nameInput" class="col-lg-2 control-label"> City </label>
                <div class="col-lg-10">
                 <input type="text" class="form-control" name="shipping_city" id="nameInput" placeholder="Name of city">
                </div>
                </div>
                <div class="form-group">
                <label for="nameInput" class="col-lg-2 control-label"> State </label>
                <div class="col-lg-10">
                <select name="shipping_state[]" class="form-control">
                <option value="0"> Select </option>
                <?php
                $select="SELECT * FROM states";
                $run=mysql_query($select);
                while($r=mysql_fetch_object($run))
                {
                  ?>
                  <option value="<?php echo $r->State_ID;?>"><?php echo $r->State; ?> </option>
                  <?php
                }
                ?>
                </select>
                </div>
                </div>

                <div class="form-group">
                <label for="contactInput" class="col-lg-2 control-label"> Pincode </label>
                <div class="col-lg-10">
                 <input type="text" name="shipping_pincode" class="form-control" id="contactInput" placeholder="Pincode">
                </div>
                </div>
            </fieldset>
          </div>
        
      </div>
    </div>

    
    </div>


  <div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-success" >
        <div class="panel-heading" id="p_heading">
        <h3 class="panel-title">Payment Details</h3>
        </div>
        <div class="panel-body" id = "panel_body2">
             <fieldset>
            <legend>Payment Method</legend>
            <div class="form-group">
              <div class="col-lg-10">
                <div class="radio">
                  <label>
                    <input type="radio" class="payment"  name="options" id="optionsRadios1" value="1">
                    Cash on delivery (COD)
                  </label>

                </div>
                 <br/>
                <div id="des_cod" class="payment" style="display:none;"> Pay with cash upon delivery. </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="options" class="payment" id="optionsRadios2" value="2">
                    PayU Payment
                  </label>
                </div>
                <div id="des_Online_pay" class="payment" style="display:none">  Pay securely by Credit or Debit Card or Internet Banking through PayU Secure Servers. </div>
              </div>
            </div>
            </fieldset>
            

            
      
       <?php  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $sel="SELECT * FROM users WHERE Username='$_COOKIE[student]'";
   //echo $sel;
   //echo $action;
   $time_zone=date_default_timezone_set("Asia/Kolkata");
   $date=date("Y-m-d H:i:s");
   //echo $date;
   $result=mysql_query($sel);
   $r2=mysql_fetch_object($result);
   $email=$r2->Email;
   $t='cod';
?>

<?php
  if(isset($_GET['msg']))
{

           $time_zone=date_default_timezone_set("Asia/Kolkata");
           $date=date("Y-m-d H:i:s");

            $id=$_GET['msg'];
        $sum=0;
        $t_quantity=0;
        $t='cod';
        $quantity=$_GET['quantity'];      
            
                $sql1= "SELECT * FROM materials WHERE Material_ID='$id'";
        //echo $sql1;
                $m=$id;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
            ?>
        <tr>
        <td> <?php  $row->Material_Name; ?> </td>
        <td> <?php  $quantity;
                        $t_quantity+=$quantity; ?> </td>
        <td> <?php  ($row->Price)* $quantity; ?> </td>
        <td> <?php  $row->Discount * $quantity; ?> </td>
        <td> <?php  $row->FinalPrice*$quantity;
                        $sum+=$row->FinalPrice* $quantity; ?> </td>
        </tr>
      
            <tr>
            <td> </td>
            <td>       </td>
            <td>       </td>
            <td>       </td>
            <td> <?php  $sum; ?> </td>
            </tr>
        </table>
 
 <input type="hidden" name="material_ID" value="<?php echo $m; ?>">
 <input type="hidden" name="mode" value="<?php echo $t; ?>">
 <input type="hidden" name="cost" value="<?php echo $sum; ?>">
 <input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="date" value="<?php echo $date; ?>">
<input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
   <?php $data=array('email'=>$email, 'mode'=>$t,'order'=>$sum,'date'=>$date,'id'=>$m,'quantity'=>$quantity);
 ?>


    
    <input type="hidden" name="material_ID" value="<?php echo $data['id']; ?>">
 <input type="hidden" name="mode" value="<?php echo $data['mode']; ?>">
 <input type="hidden" name="cost" value="<?php echo $data['order']; ?>">
 <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
<input type="hidden" name="date" value="<?php echo $data['date']; ?>"> 
<input type="hidden" name="quantity" value="<?php echo $data['quantity'] ?>">

      <?php

}
else
{
          $time_zone=date_default_timezone_set("Asia/Kolkata");
           $date=date("Y-m-d H:i:s");

            //$email=$_GET['msg1'];
              $sum=0;
        $t_quantity=0;
        $t='cod';
         
           
                $sql1= "SELECT * FROM materials WHERE Material_ID='$id'";
        
                 $m=$id;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
            ?>
        <tr>
        <td> <?php  $row->Material_Name; ?> </td>
        <td> <?php  $quantity;
                        $t_quantity+=$quantity; ?> </td>
        <td> <?php  ($row->Price)* $quantity; ?> </td>
        <td> <?php  $row->Discount * $quantity; ?> </td>
        <td> <?php  $row->FinalPrice*$quantity;
                        $sum+=$row->FinalPrice* $quantity; ?> </td>
        </tr>
      
            <tr>
            <td> Total </td>
            <td>       </td>
            <td>       </td>
            <td>       </td>
            <td> <?php  $sum; ?> </td>
            </tr>
        </table>
 
 <input type="hidden" name="material_ID" value="<?php echo $m; ?>">
 <input type="hidden" name="mode" value="<?php echo $t; ?>">
 <input type="hidden" name="cost" value="<?php echo $sum; ?>">
 <input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="date" value="<?php echo $date; ?>">
<input type="hidden" name="quantity" value="<?php echo $quantity ?>">
   <?php $data=array('email'=>$email, 'mode'=>$t,'order'=>$sum,'date'=>$date,'id'=>$m,'quantity'=>$quantity);
 ?>


    
    <input type="hidden" name="material_ID" value="<?php echo $data['id']; ?>">
 <input type="hidden" name="mode" value="<?php echo $data['mode']; ?>">
 <input type="hidden" name="cost" value="<?php echo $data['order']; ?>">
 <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
<input type="hidden" name="date" value="<?php echo $data['date']; ?>"> 
<input type="hidden" name="quantity" value="<?php echo $data['quantity'] ?>">
<?php
}
?>

<input type="submit" name="submit" id="cash" class="btn btn-primary" style="display:none" value="Place Order"> 
    
    <?php

//echo isset($_COOKIE['name']);
// Merchant key here as provided by Payu
$MERCHANT_KEY = "JBZaLc";

// Merchant Salt as provided by Payu
$SALT = "GQs7yium";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";
//$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$posted['surl']="http://localhost/CodeIgniter_2.2.0/index.php/login/success1";
$posted['furl']="http://localhost/CodeIgniter_2.2.0/index.php/login/failure";
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
             empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
      || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
  $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';  
  foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="http://localhost/CodeIgniter_2.2.0/css/style.css" rel="stylesheet" type="text/css" media="all" />

<!-- start slider -->


  
  <script>
  //alert("LOL");
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  
  </head>
  <body onLoad="submitPayuForm()">
    
    <br/>
    <?php if($formError) { ?>
  
      
    <?php }

    

     if(isset($_GET['msg']))
   {

    ?>

    <div method="post" name="payuForm" id="gateway" style="display:none">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>"/>
    
    <?php
    $time_zone=date_default_timezone_set("Asia/Kolkata");
           $date=date("Y-m-d H:i:s");

            $id=$_GET['msg'];
          $quantity=$_GET['quantity'];
         $t_quantity=0;
         $sum=0;
               
                $sql1= "SELECT * FROM materials WHERE Material_ID='$id'";
               $name=NULL;
               $description=NULL;
                   $m=$id;
                //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $name.=$row->Material_Name;
                $description.=$row->Description;
            ?>
        <tr>
        <td> <?php  $row->Material_Name; ?> </td>
        <td> <?php  $quantity;
                        $t_quantity+=$quantity; ?> </td>
        <td> <?php  ($row->Price)* $quantity; ?> </td>
        <td> <?php  $row->Discount * $quantity; ?> </td>
        <td> <?php  $row->FinalPrice*$quantity;
                         $sum+=$row->FinalPrice* $quantity; ?> </td>
        </tr>
        <?php
        
          $t='cc';

          $total=array($name);
            ?>
            <tr>
            <td>  </td>
            <td>       </td>
            <td>       </td>
            <td>       </td>
            <td> <?php  $sum; ?> </td>
            </tr>
  
   <tr>
         
          <td><input type="hidden" name="amount" value="<?php echo $sum; ?>" /></td>
          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo $r2->Username; ?>" /></td>
        </tr>
        <tr>
         
          <td><input type="hidden" name="email" id="email" value="<?php echo $r2->Email;?>" /></td>
         
          <td><input type="hidden" name="phone" value="<?php echo $r2->Contact; ?>" /></td>
        </tr>
        <tr>
         <td colspan="3"><input type="hidden" name="productinfo"  value="<?php echo $total; ?>"?></td>
        </tr>
        <tr>
         <td colspan="3"><input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
         <td colspan="3"><input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
             <input type="hidden" name="material_ID" value="<?php echo $m; ?>">
             <input type="hidden" name="mode" value="<?php echo $t; ?>">
             <input type="hidden" name="cost" value="<?php echo $sum; ?>">
             <input type="hidden" name="email" value="<?php echo $email; ?>">
             <input type="hidden" name="date" value="<?php echo $date; ?>">
             <input type="hidden" name="quantity" value="<?php echo $t_quantity;?>">
   <?php $data=array('email'=>$email, 'mode'=>$t,'order'=>$sum,'date'=>$date,'id'=>$m,'quantity'=>$t_quantity);
 ?>


    
            <input type="hidden" name="material_ID" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="mode" value="<?php echo $data['mode']; ?>">
            <input type="hidden" name="cost" value="<?php echo $data['order']; ?>">
            <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
            <input type="hidden" name="date" value="<?php echo $data['date']; ?>"> 
            <input type="hidden" name="date" value="<?php echo $data['quantity']; ?>"> 

        </tr>
        <tr>
            
            <td colspan="4"><input type="submit" formaction="online_payment_direct" name="online_submit"  class="btn btn-primary" value="Place order"></td> 

        </tr>
      </table>
    </div>
    </form>

   <?php
 }
 else
 {
  ?>
  <div method="post" name="payuForm" id="gateway" style="display:none">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>"/>
    <?php
    $time_zone=date_default_timezone_set("Asia/Kolkata");
           $date=date("Y-m-d H:i:s");

            //$email=$_GET['msg1'];
        $t_quantity=0;
              $name=NULL;
              $description=NULL;
              $sum=0;
                $sql1= "SELECT * FROM materials WHERE Material_ID='$id'";
                //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $name.=$row->Material_Name;
                $description.=$row->Description;
            ?>
        <tr>
        <td> <?php  $row->Material_Name; ?> </td>
        <td> <?php  $quantity;
                        $t_quantity+=$quantity; ?> </td>
        <td> <?php  ($row->Price)* $quantity; ?> </td>
        <td> <?php  $row->Discount * $quantity; ?> </td>
        <td> <?php  $row->FinalPrice*$quantity;
                         $sum+=$row->FinalPrice* $quantity; ?> </td>
        </tr>
        <?php
        
          $t='cc';

          $total=array($name);
            ?>
            <tr>
            <td>  </td>
            <td>       </td>
            <td>       </td>
            <td>       </td>
            <td> <?php  $sum; ?> </td>
            </tr>
  
   <tr>
         
          <td><input type="hidden" name="amount" value="<?php echo $sum; ?>" /></td>
          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo $r2->Username; ?>" /></td>
        </tr>
        <tr>
         
          <td><input type="hidden" name="email" id="email" value="<?php echo $r2->Email;?>" /></td>
         
          <td><input type="hidden" name="phone" value="<?php echo $r2->Contact; ?>" /></td>
        </tr>
        <tr>
         <td colspan="3"><input type="hidden" name="productinfo"  value="<?php echo $total; ?>"?></td>
        </tr>
        <tr>
         <td colspan="3"><input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
         <td colspan="3"><input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
        
             <input type="hidden" name="material_ID" value="<?php echo $m; ?>">
             <input type="hidden" name="mode" value="<?php echo $t; ?>">
             <input type="hidden" name="cost" value="<?php echo $sum; ?>">
             <input type="hidden" name="email" value="<?php echo $email; ?>">
             <input type="hidden" name="date" value="<?php echo $date; ?>">
             <input type="hidden" name="quantity" value="<?php echo $t_quantity;?>">
   <?php $data=array('email'=>$email, 'mode'=>$t,'order'=>$sum,'date'=>$date,'id'=>$m,'quantity'=>$t_quantity);
 ?>


    
            <input type="hidden" name="material_ID" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="mode" value="<?php echo $data['mode']; ?>">
            <input type="hidden" name="cost" value="<?php echo $data['order']; ?>">
            <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
            <input type="hidden" name="date" value="<?php echo $data['date']; ?>"> 
            <input type="hidden" name="date" value="<?php echo $data['quantity']; ?>"> 

        </tr>
        <tr>
            
            <td colspan="4"><input type="submit" formaction="online_payment_direct" name="online_submit"  class="btn btn-primary" value="Place order"></td> 

        </tr>
      </table>
    </div>
    </form>
  <?php
}
?>
            <a href="payment"><input type="submit" name="nothing" class="btn btn-primary" id="none" value="Place Order"></a>
            <div class="red"> 
              <?php
              echo "please select one of the options above in order to proceed";
    ?>
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
</html>
