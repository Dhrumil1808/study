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

        ?>
        <tr>
        <td> <?php echo $r->Material_Name; ?> </td>
        <td> <?php echo 1; ?> </td>
        <td> <?php echo ($r->Price)* 1; ?> </td>
        <td> <?php echo $r->Discount; ?> </td>
        <td> <?php echo $r->FinalPrice;
                        $sum+=$r->FinalPrice; ?> </td>
        </tr>
        <?php
        }
        
            ?>
            <tr>
            <td> Total </td>
            <td>       </td>
            <td>       </td>
            <td>       </td>
            <td> <?php echo $sum; ?> </td>
            </tr>
        </table>
    
        
        <a href="/CodeIgniter_2.2.0/index.php/home/payment?msg=<?php echo $_GET['ID'] ?>"><input type="submit" value="Proceed to Checkout"> </a>
        
</body>
</html>
