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
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- start slider -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

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
						$("#gateway").hide();
						$("#none").hide()
					}
				else 
					{
						$("#des_Online_pay").show()
						$("#gateway").show()
						$("#des_cod").hide()
						$("#cash").hide()
						$("#none").hide()
					}
					
					
					
				}
				
			});
		
		});
	});
	</script>
  
  
  
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
	
      
    <?php } ?>
    	
		<form name="radio" id="radio"> 
      	<input type="radio" class="payment" name="options" id="cod"  value="1"/> Cash On delivery
        <br/>
        <div id="des_cod" class="payment" style="display:none;"> Pay with cash upon delivery. </div>
       
        <input type="radio" name="options"  class="payment" id="Online_pay" value="2" selected="selected"/> Online Payment PayU
        
        <div id="des_Online_pay" class="payment" style="display:none">  Pay securely by Credit or Debit Card or Internet Banking through PayU Secure Servers. </div>
        </form>


	  <form action="<?php echo $action; ?>" method="post" name="payuForm" id="gateway" style="display:none">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
     
     <?php
	 $sel="SELECT * FROM users WHERE Username='$_COOKIE[name]'";
	 //echo $sel;
	 //echo $action;
	 $time_zone=date_default_timezone_set("Asia/Kolkata");
	 $date=date("Y-m-d");
	 
	 $result=mysql_query($sel);
	 $r2=mysql_fetch_object($result);
	 $t=$r2->email;
	 $sel2="SELECT * FROM materials,orders WHERE materials.Material_ID=orders.Material_ID AND orders.email='$t' AND order_placed_at='$date'";
	 //echo $sel2;
	 $result=mysql_query($sel2);
	 $sum=0;
	 $description=NULL;
	 $name=NULL;
	 while($r=mysql_fetch_object($result))
	 {
		 $sum+=($r->Order_Cost)*($r->Quantity);
		 $name.=$r->Material_Name;
		 $description=$r->Description;
	 }
	 //echo $sum;
	 $total=array($name,$description);
	 //echo $total;
	 ?>
      <table>
        
        <tr>
         
          <td><input type="hidden" name="amount" value="<?php echo $sum; ?>" /></td>
          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo $r2->Username; ?>" /></td>
        </tr>
        <tr>
         
          <td><input type="hidden" name="email" id="email" value="<?php echo $r2->email;?>" /></td>
         
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
        </tr>
        <tr>
        	
            <td colspan="4"><input type="submit"  value="Place order" /></td> 
          
        </tr>
      </table>
    </form>
    <form action="cod" method="post" style="display:none;" id="cash">
    <input type="submit" value="Place order"  />
    <?php  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
 $sel="SELECT * FROM users WHERE Username='$_COOKIE[name]'";
	 //echo $sel;
	 //echo $action;
	 $time_zone=date_default_timezone_set("Asia/Kolkata");
	 $date=date("Y-m-d H:i:s");
	 //echo $date;
	 $result=mysql_query($sel);
	 $r2=mysql_fetch_object($result);
	 $e=$r2->email;
	 $t='cod';
	
	
	$select="SELECT * FROM materials,orders WHERE materials.Material_ID=orders.Material_ID"; 
	///echo $select;
	$fetch=mysql_query($select);
	$res=mysql_fetch_object($fetch);
	
	//$r=mysql_fetch_object($fetch);
	 $o=$res->FinalPrice;
	 //echo $r->Material_Name;
 //echo $txnid;
 
 $insert="INSERT INTO orders (Material_ID,Mode_Of_payment,Order_Cost,Quantity,email,order_placed_at,Transaction_ID)  VALUES ('10','$t','$o','2','$e','$date','$txnid')";
 //echo $insert;
	mysql_query($insert);
	 ?>
    </form>
    
    <form action="shop" method="post" id="none" >
    <input type="submit" value="Place order" id="nothing" />
    </form>
  </body>
</html>
