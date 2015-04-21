<html>
        <body>
        <table>
        <tr>
        <td> Material Name </td>
        <td> Quantity </td>
        <td> Price </td>
        <td> Discount </td>
        <td> Final Price </td>
        </tr>

        <?php
        $sum=0;
        while($r = mysql_fetch_object($buy)) 
        {
                $sql1= "SELECT * FROM materials WHERE Material_ID=$r->Material_ID";
        //echo $sql1;
                $result1=mysql_query($sql1);
                $v=mysql_num_rows($result1);
                echo $v;
                $row=mysql_fetch_object($result1);
        ?>
        <tr>
        <td> <?php echo $row->Material_Name; ?> </td>
        <td> <?php echo $r->Quantity; ?> </td>
        <td> <?php echo ($row->Price)* $r->Quantity; ?> </td>
        <td> <?php echo $row->Discount; ?> </td>
        <td> <?php echo $row->FinalPrice*$r->Quantity;
                        $sum+=$row->FinalPrice* $r->Quantity; ?> </td>
        </tr>
        <?php
        }

        ?>

        <?php    
          $name=$_COOKIE['student'];
            $sel="SELECT Email FROM users WHERE Username='$name'";
            $res=mysql_query($sel);
            $r=mysql_fetch_object($res);    
            ?>

            <a href="/CodeIgniter_2.2.0/index.php/home/payment?msg1=<?php echo $r->Email ?>"> <input type="submit" value="Proceed to Checkout"/> </a> 
            