<?php
mysql_connect("localhost","root","");
mysql_select_db("studykart");

$status=$_POST['status'];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GQs7yium";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		// echo $hash;
		 //echo $posted_hash;
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	    $transaction="SELECT  txnid FROM orders ORDER BY Order_ID DESC LIMIT 1" ;
                //echo $transaction;
                $trans=mysql_query($transaction);
                $t=mysql_fetch_object($trans);
                $trans_ID=$t->txnid;
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your tranasaction ID for this transaction is ".$trans_ID.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
          

                     $student=$_COOKIE['student'];

                      $query2 = $this->db->query("SELECT * FROM cart WHERE Student_Email = '$student_email'");

                            foreach($query2->result() as $row) {
                                            $mid = $row->Material_ID;

            $query3 = $this->db->query("UPDATE materials
                                        SET materials.Quantity = materials.Quantity - '$row->Quantity' , materials.Quantity_Sold = materials.Quantity_Sold + '$row->Quantity'
                                        WHERE Material_ID = '$mid'");

        }

                    $query = $this->db->query("SELECT * FROM users WHERE Username = '$student'");
    
                               foreach($query->result() as $row) {
                                $student_email = $row->Email;
                                    }

                                    <?php
$sel="SELECT * FROM student WHERE Email='$student_email'";
$run=mysql_query($sel);
while($r=mysql_fetch_object($run))
{
?>
Adddress
  <?php  echo $r->Address;
  ?>
  <br/>
  City
  <?php
    echo $r->City;
    ?>
    <br/>
    State
    <?php
    echo $r->State;
    ?>
    <br/>
    Pincode
    <?php
    echo $r->Pincode;
}


    $query3="DELETE FROM cart WHERE  Student_Email='$student_email'";
         //echo $query3;
         mysql_query($query3);   


		   }         
?>	