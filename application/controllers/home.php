<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Home extends CI_Controller {
 
    public function load_materials()
    {
       
       // $data['categories'] = $categories;
        $this->load->view('load_materials');
    }

     public function search()
    {
        $this->load->database();
        $r=$this->input->post("searchbox");
        echo $r;
        $sql= "SELECT * FROM materials WHERE Material_Name LIKE '%$r%'";
       
        $result=mysql_query($sql);
        $data["search"]=$result;
        $data["typed"]=$r;
        $this->load->view('print_materials',$data);
       /* while($row=mysql_fetch_object($result))
        {
            echo $row->Material_Name."\n";
        }*/
        
    }

    public function sub_search()
    {
        $this->load->database();
        $subcat=$_GET['Subcategory'];
        $sql="SELECT * FROM materials WHERE Subcategory='$subcat'";
        echo $sql;
        $res=mysql_query($sql);
        $data["search"]=$res;
        $this->load->view('print_materials',$data);
    }


    public function ajax_print_materials()
    {
        $this->load->database();
        $sort=$_POST["data"];
        $r=$_GET["ID"];
        echo $r;

        if($sort='name_asc')
        {
            $sql= "SELECT * FROM materials WHERE Material_Name LIKE '%$r%' ORDER BY Material_Name asc";     
            $result=mysql_query($sql);
            $data["search"]=$result;
            $data["typed"]=$r;
            $this->load->view('print_materials',$data);
        }
        else if($sort='name_desc')
        {
            $sql= "SELECT * FROM materials WHERE Material_Name LIKE '%$r%' ORDER BY Material_Name desc";     
            $result=mysql_query($sql);
            $data["search"]=$result;
            $data["typed"]=$r;
            $this->load->view('print_materials',$data);
        }
        else if($sort='price_asc')
        {
            $sql= "SELECT * FROM materials WHERE Material_Name LIKE '%$r%' ORDER BY Price asc";     
            $result=mysql_query($sql);
            $data["search"]=$result;
            $data["typed"]=$r;
            $this->load->view('print_materials',$data);
        }
        else if($sort='price_desc')
        {
            $sql= "SELECT * FROM materials WHERE Material_Name LIKE '%$r%' ORDER BY Price desc";     
            $result=mysql_query($sql);
            $data["search"]=$result;
            $data["typed"]=$r;
            $this->load->view('print_materials',$data);
        }
        else if($sort='rating')
        {
            $sql= "SELECT * FROM materials m,material_review mr WHERE m.Material_ID=mr.Material_ID AND m.Material_Name LIKE '%$r%' ORDER BY mr.Rating desc";     
            $result=mysql_query($sql);
            $data["search"]=$result;
            $data["typed"]=$r;
            $this->load->view('print_materials',$data);
        }
        // $sql= "SELECT * FROM materials WHERE Material_Name LIKE '%$r%' ORDER BY Material_Name desc";
        // echo $sql;
       
        // $result=mysql_query($sql);
        // $data["search"]=$result;

        // $this->load->view('print_materials',$data);
    }

    public function wish_list()
    {
    	$this->load->database();

    	if(isset($_COOKIE['student']))
    		{
                $name=$_COOKIE['student'];
                echo $name;
                $sql= "SELECT Email FROM users WHERE Username='$name'";
                $result=mysql_query($sql);
                $r=mysql_fetch_object($result);
    			$sql= "SELECT w.Material_ID,m.Material_Name,m.Price,m.Quantity,m.Image,m.Quantity_Sold from wishlist w,materials m,users WHERE w.Material_ID=m.Material_ID AND w.Student_Email=users.Email AND users.Username='$name'";
    			$result=mysql_query($sql);

    			$data["wishes"]=$result;
                $data["email"]=$r;
    			$this->load->view('wish_list',$data);
    			
    		}
    	else
    	{
    		echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your wishlist!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
    	}
    }

    public function wishlist_remove()
    {
        $this->load->database();
        $id = $_GET['id'];
        if(isset($_COOKIE['student']))
        {
            $uname=$_COOKIE['student'];
            $sql = "DELETE FROM wishlist WHERE Material_ID=$id AND Student_Email= (SELECT Email FROM users WHERE Username= '$uname')";
            if(mysql_query($sql))
            {
                echo "removed";
            }
            else
                echo "error";
            header("location:http://localhost/CodeIgniter_2.2.0/index.php/home/wish_list");
        }
        
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your wishlist!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
        }
    }

    public function add_to_wishlist()
    {
        $this->load->database();

        $mat=$_GET['ID'];
        if(isset($_COOKIE['student']))
            {
                $name=$_COOKIE['student'];
                //echo $name;
                $sql= "SELECT Email FROM users WHERE Username='$name'";
                $result=mysql_query($sql);
                $r=mysql_fetch_object($result);
                $data=array('Material_ID' => $mat,'Student_Email'=> $r->Email);

                $this->db->insert('wishlist', $data); 
                
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Product has been added to your wishlist!');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
                echo "</script>";
            }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to add this product to your wishlist!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
            echo "</script>";
        }
    }

    public function add_to_cart()
    {
         $this->load->database();

        $mat=$this->input->post('id');
        //echo $mat; 
        $quantity=$this->input->post('quantity');
        //echo $quantity;

        if(isset($_COOKIE['student']))
            {

                if($quantity==0)
                {
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Quantity should be greater than 0!');\n";
                    echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
                    echo "</script>";    
                }
                else
                {
                $name=$_COOKIE['student'];
                //echo $name;
                $sql= "SELECT email FROM users WHERE Username='$name'";
                //echo $sql;
                $result=mysql_query($sql);
                $r=mysql_fetch_object($result);

                $sql4="SELECT Material_ID FROM cart WHERE Material_ID='$mat' AND Student_Email='$r->email'";
                //echo $sql4;
                $re=mysql_query($sql4);

                if(mysql_num_rows($re)==1)
                {
                    $res=mysql_fetch_object($re);
                    $sql2="SELECT Quantity FROM cart WHERE Material_ID='$mat' AND Student_Email='$r->email'";
                    $result=mysql_query($sql2);
                    $orig_qs=mysql_fetch_object($result);
                        //echo $orig_qs->Quantity;
                       // echo $quantity;

                 $price=$orig_qs->Quantity+$quantity;
                 //echo $price;
                    $update_quan="UPDATE cart SET Quantity='$price' WHERE Material_ID='$mat' AND Student_Email='$r->email'";
                    mysql_query($update_quan);
                    //echo $update_quan;
                }

                else
                {

                    $data=array('Material_ID' => $mat,'Student_Email'=> $r->email, 'Quantity'=>$quantity);
                    $this->db->insert('cart', $data);
                }
                
                
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Product has been added to your cart!');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
                echo "</script>";
            }
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to add this product to your cart!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
            echo "</script>";
        }
    }

    public function cart()
    {
        $this->load->database();
        if(isset($_COOKIE['student']))
        {
            $name=$_COOKIE['student'];
            $select="SELECT * FROM cart,users WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name') AND users.Email= (SELECT Email FROM users WHERE Username='$name');";
            //echo $select;
            $sql=mysql_query($select);
            $data["output"] = $sql;

        $this->load->view("cartView", $data);
        }

        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your cart!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
        }
        
    }
     public function remove_from_cart()
    {
        $this->load->database();
        if($_GET["ID"])
        {
            $id=$_GET['ID'];
            $delete="DELETE FROM cart WHERE Material_ID='$id'";
            $del=mysql_query($delete);
            $name=$_COOKIE['student'];
            $select="SELECT * FROM cart,users WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name') AND email=(SELECT Email FROM users WHERE Username='$name');";
        //echo $select;
            $sql=mysql_query($select);
            $data["output"] = $sql;

            $this->load->view("cartView", $data);
        }

    }
     public function add_to_wishlist_from_cart()
    {
        $this->load->database();
         $mat=$_GET['ID'];
        if(isset($_COOKIE['student']))
            {
                $name=$_COOKIE['student'];
                //echo $name;
                $sql1= "SELECT Email FROM users WHERE Username='$name'";
                $result=mysql_query($sql1);
                $r=mysql_fetch_object($result);
                $data1=array('Material_ID' => $mat,'Student_Email'=> $r->Email);

                $this->db->insert('wishlist', $data1); 
                 $delete="DELETE FROM cart WHERE Material_ID='$mat'";
                $del=mysql_query($delete);
                $name=$_COOKIE['student'];
                $select="SELECT * FROM cart,users WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name') AND email=(SELECT Email FROM users WHERE Username='$name');";
        //echo $select;
                $sql=mysql_query($select);
                $data["output"] = $sql;

                $this->load->view("cartView", $data); 
                
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Product has been added to your wishlist!');\n";
               // echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
                echo "</script>";
            }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to add this product to your wishlist!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
            echo "</script>";
        }

    }

    public function cart_remove()
    {
        $this->load->database();
        $id = $this->input->get('materialID');
        if(isset($_COOKIE['student']))
        {
            $name=$_COOKIE['student'];
            $sql="SELECT Email FROM users WHERE Username='$name'";
            $email=mysql_fetch_object(mysql_query($sql))->Email;
            $sql = "DELETE FROM cart WHERE Material_ID=$id AND Student_Email='$email'";
            if(mysql_query($sql))
            {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Product has been removed from your cart');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/home/cart'";
                echo "</script>";
            }
            else
            {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Cant remove');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/home/cart'";
                echo "</script>";
            }
            //header("location:http://localhost/CodeIgniter_2.2.0/index.php/home/cart");


        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to remove this product from cart!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
        }
    }

   

    public function add_review()
    {

        $mat=$_GET['ID'];   //material ID for material to be reviewed
        if(isset($_COOKIE['student']))
        {
            $this->load->database();
                $name=$_COOKIE['student'];
                //echo $name;
                $sql= "SELECT Email FROM users WHERE Username='$name'";
                $result=mysql_query($sql);
                $r=mysql_fetch_object($result);   //email of logged in user
                
                $data["id"]=$mat;
                $data["email"]=$r->Email; 

                $this->load->view("review_form",$data);
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to review this product!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
            echo "</script>";
        }
        
    }

    public function notifier(){
        if(isset($_COOKIE['student'])){
            $uname = $_COOKIE['student'];
            $this->load->database();
            $sql = "SELECT Email FROM users WHERE Username='$uname'";
            $result = mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql = "SELECT Notification_Text FROM notifications WHERE User_Email = '$email->Email'";
            $result = mysql_query($sql);
            $sql = "SELECT * FROM notifications WHERE User_Email = '$email->Email' AND Status='0'";
            $unread = mysql_query($sql);
            $no_unread = mysql_num_rows($unread);
            ?>
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <span id="notifBadge" class="glyphicon glyphicon-bell"></span>
          </a>
            <span class="badge badge-notify"><?php echo $no_unread; ?></span>
          <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

            
            <div class="notification-heading"><h4 class="menu-title">Notifications</h4>
            <li class="divider"></li>
           <div class="notifications-wrapper">
             <a class="content" href="#">
                <?php while($notification = mysql_fetch_object($result)){ ?>
               <div class="notification-item">
                <h4 class="item-title"><?php echo $notification->Notification_Text; ?></h4>
                
              </div>
              </a>  <?php  } ?>
            

           </div>
            <li class="divider"></li>
            <div class="notification-footer"></div>
          </ul>
          <?php
        }
        else{
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
        }
        
    }

    public function read_notifs(){
        if(isset($_COOKIE['student']))
        {
            $this->load->database();
            $uname = $_COOKIE['student'];
            $sql = "SELECT Email FROM users WHERE Username='$uname'";
            $result = mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql = "UPDATE notifications SET Status='1' WHERE User_Email = '$email->Email'";
            mysql_query($sql);
            echo "<script language=\"JavaScript\">\n";
            echo "alert('read');\n";
            //echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
        }
    }

    public function notifier_vendor(){
        if(isset($_COOKIE['vendor'])){
            $uname = $_COOKIE['vendor'];
            $this->load->database();
            $sql = "SELECT Email FROM users WHERE Username='$uname'";
            $result = mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql = "SELECT Notification_Text FROM notifications WHERE User_Email = '$email->Email'";
            $result = mysql_query($sql);
            $sql = "SELECT * FROM notifications WHERE User_Email = '$email->Email' AND Status='0'";
            $unread = mysql_query($sql);
            $no_unread = mysql_num_rows($unread);
            ?>
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <span id="notifBadge" class="glyphicon glyphicon-bell"></span>
          </a>
            <span class="badge badge-notify"><?php echo $no_unread; ?></span>
          <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

            
            <div class="notification-heading"><h4 class="menu-title">Notifications</h4>
            <li class="divider"></li>
           <div class="notifications-wrapper">
             <a class="content" href="#">
                <?php while($notification = mysql_fetch_object($result)){ ?>
               <div class="notification-item">
                <h4 class="item-title"><?php echo $notification->Notification_Text; ?></h4>
                
              </div>
              </a>  <?php  } ?>
            

           </div>
            <li class="divider"></li>
            <div class="notification-footer"></div>
          </ul>
          <?php
        }
        else{
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/vendor_login'";
            echo "</script>";
        }
        
    }

    public function read_notifs_vendor(){
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();
            $uname = $_COOKIE['vendor'];
            $sql = "SELECT Email FROM users WHERE Username='$uname'";
            $result = mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql = "UPDATE notifications SET Status='1' WHERE User_Email = '$email->Email'";
            mysql_query($sql);
            echo "<script language=\"JavaScript\">\n";
            echo "alert('read');\n";
            //echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
        }
    }



        public function payment()
            {
            if(isset($_COOKIE['student']))
            {
            $this->load->database();
            $this->load->library('form_validation');
            $this->load->view('shop');
            }
            else
            {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Session has expired.Please Re-login!');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials";
                echo "</script>";
            }
        }



        public function payment_cart()
            {
            if(isset($_COOKIE['student']))
                {
            $this->load->database();
            $this->load->library('form_validation');
            $this->load->view('shop_cart');
            }
            else
            {
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Session has expired.Please Re-login!');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials";
                echo "</script>";
            }
        }

            public function cod()
            {
                $this->load->database();
                if(isset($_COOKIE['student']))
                {
                
                 $this->load->library('form_validation');
                $this->form_validation->set_rules('shipping_name','Shipping Name','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
                $this->form_validation->set_rules('shipping_address','Shipping Address','trim|required|xss_clean');
                
                $this->form_validation->set_rules('shipping_city','Shipping city','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_pincode','Shipping city pincode','trim|required|xss_clean|exact_length[6]');
                

                    if($this->form_validation->run()==FALSE)
                    {
                        $data=array('email'=>$this->input->post('email'), 'id'=>$this->input->post('material_ID'),
                                    'order'=>$this->input->post('cost'),'date'=>$this->input->post('date'),'mode'=>$this->input->post('mode'),
                                    'quantity'=>$this->input->post('quantity'));
                               $this->load->view('shop',$data);
                    }
                    else
                    {
                        $id=$this->input->post('material_ID');
                        $email=$this->input->post('email');
                        $order=$this->input->post('cost');
                        $date=$this->input->post('date');

                        $mode=$this->input->post('mode');
                       $quantity=$this->input->post('quantity');
                       // $insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At)  VALUES ('$id','cod','$order','$quantity','$email','$date')";
                        //echo $insert;
                        //echo $_GET['value'];
                        $shipping_name=$this->input->post('shipping_name');
                       $shipping_contact=$this->input->post('shipping_contact');
                       $shipping_address=$this->input->post('shipping_address');
                       $shipping_city=$this->input->post('shipping_city');
                       $shipping_state=$this->input->post('shipping_state');
                       $shipping_pincode=$this->input->post('shipping_pincode');

                       $insert_address="INSERT INTO student(Address,City,State,Pincode) VALUES ('$shipping_address','$shipping_city','$shipping_state','$shipping_pincode')";
                    mysql_query($insert_address);
                      $insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At)  VALUES ('$id','cc','$order','$quantity','$email','$date')";
                        mysql_query($insert);

                        $insert_notification="INSERT INTO notifications(User_Email,Notification_Text,Status) VALUES('$email')";

                        $sql2="SELECT Quantity_Sold,Quantity FROM materials WHERE Material_ID='$id'";
                        $result=mysql_query($sql2);
                        $orig_qs=mysql_fetch_object($result);
                        $orig=$orig_qs->Quantity_Sold;
                        $updated_quantity=$orig+$quantity;  

                        $or_quan=$orig_qs->Quantity;
                        $new_quan=$or_quan-$quantity;
                        $add_qs="UPDATE materials SET Quantity_Sold='$updated_quantity',Quantity='$new_quan' WHERE Material_ID='$id'";
                        mysql_query($add_qs);
                        $sql = "SELECT Email FROM users WHERE type='Admin'";
                        $result = mysql_query($sql);
                        echo "Material(Material Name: ".$data['Material_Name'].") has been updated by".$_COOKIE['vendor'];
                        /*while($admin = mysql_fetch_object($result)){
                            $notification = array(
                            'User_Email' => $admin->Email,
                            'Notification_Text' => "Material(Material Name: ".$data['Material_Name'].") has updated added by ".$_COOKIE['vendor']
                            );
                            $this->db->insert('notifications', $notification);
            
                        }*/
                         $sel="SELECT * FROM orders ORDER BY Order_ID DESC  LIMIT 1";
            //echo $sel;
            $run=mysql_query($sel);
            $execute=mysql_fetch_object($run);
            $id=$execute->Material_ID;
   $select="SELECT * FROM materials WHERE materials.Material_ID='$id'"; 
        //echo $select;
            $fetch=mysql_query($select);
            $sum=0;

            $strmsg="<table>
                    <tr> 
                    <td> Material Name </td>
                    <td> Quantity </td>
                    <td> Price </td>
                    <td> Discount </td>
                    <td> Final Price </td> 
                    </table>";
         while($row=mysql_fetch_object($fetch))
{
    
    $strmsg.="<tr> 
    <td>". $row->Material_Name. "</td>
    <td>".$execute->Quantity. "</td>
    <td>".($row->Price) * ($execute->Quantity)."</td>
    <td>".$row->Discount *($execute->Quantity)."</td>
    <td>".$row->FinalPrice*($execute->Quantity);
                                    $sum+=$row->FinalPrice *($execute->Quantity)."</td>
                                    </tr>";
                                }

                            $strmsg.="<tr> 
        <td>
        Total</td>
        <td> </td>
        <td> </td>
        <td>".$sum. "</td>

         </tr>";        


    $this->load->database();
    $this->load->library('email');
        //$this->load->helper('email');
        //$this->email->initialize($config);
        //echo "mail";
        $this->email->from('dhrml.shah@gmail.com','studykart');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Order Review');
        
        $this->email->message($strmsg
                     );

                 
         $this->email->send();  
        echo $this->email->print_debugger();    
    
                       
                        header("location:cod1?value=$id");

                    }
                
                }
                

            else
            {
                echo "<script language=\"JavaScript\">\n";
            echo "alert('Session has expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials";
            echo "</script>";
            }
        
    }

    public function online_payment_direct()
    {
        $this->load->database();
                if(isset($_COOKIE['student']))
                {
                    
                    $this->load->library('form_validation');
                    //echo "hbdfjdsk";

                //echo $this->input->post('shipping_name');
                //echo $this->input->post('billing_name');
                $this->form_validation->set_rules('shipping_name','Shipping Name','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
                $this->form_validation->set_rules('shipping_address','Shipping Address','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_state','Shipping State','required'); 
                $this->form_validation->set_rules('shipping_city','Shipping city','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_pincode','Shipping city pincode','trim|required|xss_clean|exact_length[6]');
                $this->form_validation->set_message('check_default', 'You need to select something other than the default');



                    if($this->form_validation->run()==FALSE)
                    {
                        $data=array('email'=>$this->input->post('email'), 'id'=>$this->input->post('material_ID'),
                                    'order'=>$this->input->post('cost'),'date'=>$this->input->post('date'),'mode'=>$this->input->post('mode'),
                                    'quantity'=>$this->input->post('quantity'));
                            //echo $data;
                              //echo $data['email'];
                               //echo $data['order']; 
                            //header("location:shop_cart?msg1=$email");
                        $this->load->view('shop',$data);
                    }
                    else
                    {
                        $merchant_key=$this->input->post('key');
                        $hash=$this->input->post('hash');
                        $txnid=$this->input->post('txnid');
                        $amount=$this->input->post('amount');
                        $first_name=$this->input->post('firstname');
                        $email=$this->input->post('email');
                        $contact=$this->input->post('phone');
                        $product_info=$this->input->post('productinfo');
                        $success_url=$this->input->post('surl');
                        $failure_url=$this->input->post('furl');
                        $service=$this->input->post('service_provider');
                        $id=$this->input->post('material_ID');
                        $quantity=$this->input->post('quantity');
                        $order=$this->input->post('cost');
                        //$date=$this->input->post('date');
                        $shipping_name=$this->input->post('shipping_name');
                       $shipping_contact=$this->input->post('shipping_contact');
                       $shipping_address=$this->input->post('shipping_address');
                       $shipping_city=$this->input->post('shipping_city');
                       $shipping_state=$this->input->post('shipping_state');
                       $shipping_pincode=$this->input->post('shipping_pincode');

                       $insert_address="INSERT INTO student(Address,City,State,Pincode) VALUES ('$shipping_address','$shipping_city','$shipping_state','$shipping_pincode')";
                        mysql_query($insert_address);
                        
                        $time_zone=date_default_timezone_set("Asia/Kolkata");
                        $date=date("Y-m-d H:i:s");
                        
                        $mode=$this->input->post('mode');
                    //$insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At)  VALUES ('$id','cc','$order','$quantity','$email','$date')";
                    $insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At)  VALUES ('$id','cc','$order','$quantity','$email','$date')";
                        mysql_query($insert);

                        $sql2="SELECT Quantity_Sold,Quantity FROM materials WHERE Material_ID='$id'";
                        $result=mysql_query($sql2);
                        $orig_qs=mysql_fetch_object($result);
                        $orig=$orig_qs->Quantity_Sold;
                        $updated_quantity=$orig+$quantity;  

                        $or_quan=$orig_qs->Quantity;
                        $new_quan=$or_quan-$quantity;
                        $add_qs="UPDATE materials SET Quantity_Sold='$updated_quantity',Quantity='$new_quan' WHERE Material_ID='$id'";
                        mysql_query($add_qs);
                      $sel="SELECT * FROM orders ORDER BY Order_ID DESC  LIMIT 1";
            //echo $sel;
            $run=mysql_query($sel);
            $execute=mysql_fetch_object($run);
            $id=$execute->Material_ID;
        $select="SELECT * FROM materials WHERE materials.Material_ID='$id'"; 
        //echo $select;
            $fetch=mysql_query($select);
            $sum=0;
 
    


            $strmsg="<table>
                    <tr> 
                    <td> Material Name </td>
                    <td> Quantity </td>
                    <td> Price </td>
                    <td> Discount </td>
                    <td> Final Price </td> 
                    </table>";
          //$quantity=$_GET['value3'];
                 while($r=mysql_fetch_object($fetch))
{
                $id=$r->Material_ID;
                $sql1= "SELECT * FROM materials WHERE materials.Material_ID='$id'";
        //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $quan=$row->Material_ID;
                $sel="SELECT * FROM cart WHERE Material_ID='$quan' ";
                $run=mysql_query($sel);
                $run1=mysql_fetch_object($run);
    
    $strmsg.="<tr> 
    <td>". $row->Material_Name. "</td>
    <td>".$run1->Quantity. "</td>
    <td>".($row->Price) * ($run1->Quantity)."</td>
    <td>".$row->Discount *($run1->Quantity)."</td>
    <td>".$row->FinalPrice*($run1->Quantity);
                                    $sum+=$row->FinalPrice *($run1->Quantity)."</td>
                                    </tr>";
                                }

                            $strmsg.="<tr> 
        <td>
        Total</td>
        <td> </td>
        <td> </td>
        <td>".$sum. "</td>

         </tr>";        

    $this->load->database();
    $this->load->library('email');
        //$this->load->helper('email');
        //$this->email->initialize($config);
        //echo "mail";
        $this->email->from('dhrml.shah@gmail.com','studykart');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Order Review');
        
        $this->email->message($strmsg
                     );

                 
         $this->email->send();  
                       
                        $this->load->view('gateway');
                                           
                        
                    }

    }
    else
    {
        echo "<script language=\"JavaScript\">\n";
            echo "alert('Session has expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials";
            echo "</script>";
    }

}

    public function online_payment_cart()
    {
                $this->load->database();
                if(isset($_COOKIE['student']))
                {
                    
                    //$id =$_GET['value'];
                    //echo $id;
                    //echo $id;
                    $this->load->library('form_validation');
                    //echo "hbdfjdsk";

                //echo $this->input->post('shipping_name');
                //echo $this->input->post('billing_name');
                $this->form_validation->set_rules('shipping_name','Shipping Name','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
                $this->form_validation->set_rules('shipping_address','Shipping Address','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_city','Shipping city','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_pincode','Shipping city pincode','trim|required|xss_clean|exact_length[6]');
                $this->form_validation->set_rules('shipping_state','Shipping state','required|xss_clean');

                    if($this->form_validation->run()==FALSE)
                    {
                        //echo "wrong";
                        $data=array('email'=>$this->input->post('email'), 'id'=>$this->input->post('material_ID'),
                                    'order'=>$this->input->post('cost'),'date'=>$this->input->post('date'),'mode'=>$this->input->post('mode'));
                            //echo $data;
                               //echo $data['date'];
                               //echo $data['order']; 
                            //header("location:shop_cart?msg1=$email");
                        $this->load->view('shop_cart',$data);
                    
                    }
                    else
                    {

                            //echo "correct";
                        $merchant_key=$this->input->post('key');
                        $hash=$this->input->post('hash');
                        $txnid=$this->input->post('txnid');
                        $amount=$this->input->post('amount');
                        $first_name=$this->input->post('firstname');
                        $email=$this->input->post('email');
                        $contact=$this->input->post('phone');
                        $product_info=$this->input->post('productinfo');
                        $success_url=$this->input->post('surl');
                        $failure_url=$this->input->post('furl');
                        $service=$this->input->post('service_provider');
                        $id=$this->input->post('material_ID');
                        $quantity=$this->input->post('quantity');
                        $order=$this->input->post('cost');
                        //$date=$this->input->post('date')
                        $shipping_name=$this->input->post('shipping_name');
                       $shipping_contact=$this->input->post('shipping_contact');
                       $shipping_address=$this->input->post('shipping_address');
                       $shipping_city=$this->input->post('shipping_city');
                       $shipping_state=$this->input->post('shipping_state');
                       $shipping_pincode=$this->input->post('shipping_pincode');

                       $insert_address="INSERT INTO student(Address,City,State,Pincode) VALUES ('$shipping_address','$shipping_city','$shipping_state','$shipping_pincode')";
                        mysql_query($insert_address);
                        
                        $time_zone=date_default_timezone_set("Asia/Kolkata");
                        $date=date("Y-m-d H:i:s");
                        
                        $mode=$this->input->post('mode');
                        


                        $PAYU_BASE_URL = "https://test.payu.in";
                         $action = $PAYU_BASE_URL . '/_payment';
                                               
                //$insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At)  VALUES ('$id','cc','$order','$quantity','$email','$date')";
                            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);  
                        //mysql_query($insert);
                        $student=$_COOKIE['student'];

                    $query = $this->db->query("SELECT * FROM users WHERE Username = '$student'");
    
                                foreach($query->result() as $row) {
                                $student_email = $row->Email;
                                    }

        

        $query2 = $this->db->query("SELECT * FROM cart WHERE Student_Email = '$student_email'");

                            foreach($query2->result() as $row) {
                                            $mid = $row->Material_ID;
                                            $quant=$row->Quantity;

                           $select="SELECT * FROM materials WHERE Material_ID='$mid'";
                           $run=mysql_query($select);
                           $run_query=mysql_fetch_object($run);
                           $cost=$run_query->FinalPrice;                         
            $insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At,txnid)  VALUES ('$mid','cc','$cost','$quant','$email','$date','$txnid')";
                mysql_query($insert);
        }
                 $select_cart="SELECT * FROM cart,users WHERE cart.Student_Email = '$student_email' AND email='$student_email'";
        //echo $select_cart;
        $result_cart=mysql_query($select_cart);
        $sum=0;
        $t_quantity=0;


            $strmsg="<table>
                    <tr> 
                    <td> Material Name </td>
                    <td> Quantity </td>
                    <td> Price </td>
                    <td> Discount </td>
                    <td> Final Price </td> 
                    </table>";
          //$quantity=$_GET['value3'];
         while($r = mysql_fetch_object($result_cart)) 
        {
                $id=$r->Material_ID;
                $sql1= "SELECT * FROM materials WHERE materials.Material_ID='$id'";
        //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $quan=$row->Material_ID;
                $sel="SELECT * FROM cart WHERE Material_ID='$quan' ";
                $run=mysql_query($sel);
                $run1=mysql_fetch_object($run);
    
    $strmsg.="<tr> 
    <td>". $row->Material_Name. "</td>
    <td>".$run1->Quantity. "</td>
    <td>".($row->Price) * ($run1->Quantity)."</td>
    <td>".$row->Discount *($run1->Quantity)."</td>
    <td>".$row->FinalPrice*($run1->Quantity);
                                    $sum+=$row->FinalPrice *($run1->Quantity)."</td>
                                    </tr>";
                                }

                            $strmsg.="<tr> 
        <td>
        Total</td>
        <td> </td>
        <td> </td>
        <td>".$sum. "</td>

         </tr>";        

    $this->load->database();
    $this->load->library('email');
        //$this->load->helper('email');
        //$this->email->initialize($config);
        //echo "mail";
        $this->email->from('dhrml.shah@gmail.com','studykart');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Order Review');
        
        $this->email->message($strmsg
                     );

                 
         $this->email->send();  


                        $this->load->view('gateway');


                    }
                }

    
    else
    {
        echo "<script language=\"JavaScript\">\n";
            echo "alert('Session has expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials";
            echo "</script>";
    }
     
    } 
    public function cod_cart()
    {
        
                $this->load->database();
                if(isset($_COOKIE['student']))
                {
                    
                    $this->load->library('form_validation');
                    
                //echo $this->input->post('shipping_name');
                //echo $this->input->post('billing_name');
                $this->form_validation->set_rules('shipping_name','Shipping Name','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
                $this->form_validation->set_rules('shipping_address','Shipping Address','trim|required|xss_clean');
                
                $this->form_validation->set_rules('shipping_city','Shipping city','trim|required|xss_clean');
                $this->form_validation->set_rules('shipping_pincode','Shipping city pincode','trim|required|xss_clean|exact_length[6]');
                //$email=$this->input->post('email');
                $this->form_validation->set_rules('shipping_state','Shipping state','required|xss_clean');
                   
                   $data=array('email'=>$this->input->post('email'), 'id'=>$this->input->post('material_ID'),
                                    'order'=>$this->input->post('cost'),'date'=>$this->input->post('date'),'mode'=>$this->input->post('mode'));
                $id=$this->input->post('material_ID');
                        $email=$this->input->post('email');
                        $order=$this->input->post('cost');
                        $date=$this->input->post('date');
                        //echo $data['email'];
                        //echo $email;
                        //echo $order;
                        //echo $date;
                    if($this->form_validation->run()==FALSE)
                    {
                         $data=array('email'=>$this->input->post('email'), 'id'=>$this->input->post('material_ID'),
                                    'order'=>$this->input->post('cost'),'date'=>$this->input->post('date'),'mode'=>$this->input->post('mode')
                                    ,'quantity'=>$this->input->post('quantity'));
                            //echo $data;
                               //echo $data['email'];
                               //echo $data['order']; 
                            //header("location:shop_cart?msg1=$email");
                        $this->load->view('shop_cart',$data);
                    }
                    else
                    {
                        $id=$this->input->post('material_ID');
                        $email=$this->input->post('email');
                        $order=$this->input->post('cost');
                        $date=$this->input->post('date');
                       $mode=$this->input->post('mode');
                       $quantity=$this->input->post('quantity');
                       $shipping_name=$this->input->post('shipping_name');
                       $shipping_contact=$this->input->post('shipping_contact');
                       $shipping_address=$this->input->post('shipping_address');
                       $shipping_city=$this->input->post('shipping_city');
                       $shipping_state=$this->input->post('shipping_state');
                       $shipping_pincode=$this->input->post('shipping_pincode');

                       $insert_address="INSERT INTO student(Address,City,State,Pincode) VALUES ('$shipping_address','$shipping_city','$shipping_state','$shipping_pincode')";
                        mysql_query($insert_address);                            
                    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                        //$insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At)  VALUES ('$id','$cod','$order','$quantity','$email','$date')";
                    
                        //mysql_query($insert);
                        $student=$_COOKIE['student'];

                    $query = $this->db->query("SELECT * FROM users WHERE Username = '$student'");
    
                                foreach($query->result() as $row) {
                                $student_email = $row->Email;
                                    }

        

        $query2 = $this->db->query("SELECT * FROM cart WHERE Student_Email = '$student_email'");

                            foreach($query2->result() as $row) {
                                        $mid = $row->Material_ID;
                                        $quant=$row->Quantity;

                           $select="SELECT * FROM materials WHERE Material_ID='$mid'";
                           $run=mysql_query($select);
                           $run_query=mysql_fetch_object($run);
                           $cost=$run_query->FinalPrice;

            $insert="INSERT INTO orders (Material_ID,Mode_of_Payment,Order_Cost,Quantity,Student_Email,Order_Placed_At,txnid)  VALUES ('$mid','cc','$cost','$quant','$email','$date','$txnid')";
                mysql_query($insert);

            $query3 = $this->db->query("UPDATE materials
                                        SET materials.Quantity = materials.Quantity - '$row->Quantity' , materials.Quantity_Sold = materials.Quantity_Sold + '$row->Quantity'
                                        WHERE Material_ID = '$mid'");

        }
             $select_cart="SELECT * FROM cart,users WHERE cart.Student_Email = '$student_email' AND email='$student_email'";
        //echo $select_cart;
        $result_cart=mysql_query($select_cart);
        $sum=0;
        $t_quantity=0;


            $strmsg="<table>
                    <tr> 
                    <td> Material Name </td>
                    <td> Quantity </td>
                    <td> Price </td>
                    <td> Discount </td>
                    <td> Final Price </td> 
                    </table>";
          //$quantity=$_GET['value3'];
         while($r = mysql_fetch_object($result_cart)) 
        {
                $id=$r->Material_ID;
                $sql1= "SELECT * FROM materials WHERE materials.Material_ID='$id'";
        //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $quan=$row->Material_ID;
                $sel="SELECT * FROM cart WHERE Material_ID='$quan' ";
                $run=mysql_query($sel);
                $run1=mysql_fetch_object($run);
    
    $strmsg.="<tr> 
    <td>". $row->Material_Name. "</td>
    <td>".$run1->Quantity. "</td>
    <td>".($row->Price) * ($run1->Quantity)."</td>
    <td>".$row->Discount *($run1->Quantity)."</td>
    <td>".$row->FinalPrice*($run1->Quantity);
                                    $sum+=$row->FinalPrice *($run1->Quantity)."</td>
                                    </tr>";
                                }

                            $strmsg.="<tr> 
        <td>
        Total</td>
        <td> </td>
        <td> </td>
        <td>".$sum. "</td>

         </tr>";        

    $this->load->database();
    $this->load->library('email');
        //$this->load->helper('email');
        //$this->email->initialize($config);
        //echo "mail";
        $this->email->from('dhrml.shah@gmail.com','studykart');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Order Review');
        
        $this->email->message($strmsg
                     );

                 
         $this->email->send();  
        //echo $this->email->print_debugger();    
    //echo $strmsg;
                        
                        header("location:cod2?value1=$email");

                    }
                
                }
                

            else
            {
                echo "<script language=\"JavaScript\">\n";
            echo "alert('Session has expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials";
            echo "</script>";
            }
        
        
    }

    public function shop_cart()
    {
        $this->load->database();

        $this->load->library('form_validation');

        echo validation_errors();
        $this->load->view('shop_cart');
    }
    public function cod1()
    {
        $this->load->database();

        $this->load->view('cod');
    }


    public function cod2()
    {
        $this->load->database();
        $this->load->view('cod');
    }
			
			public function getRecentlyViewed(){
		$op = "201201117@a.com";

  		$select="SELECT * FROM recently_viewed WHERE Student_Email = '$op' ORDER BY Viewed_At DESC";

		$query = $this->db->query("$select");

		$data['results'] = $query->result();

		$this->load->view("recentlyView", $data);
	}

    public function buy_now_direct()
    {
        $this->load->database();
        if(isset($_COOKIE['student']))
        {
            $id=$_GET["ID"];
            $select_buy="SELECT * FROM materials WHERE materials.Material_ID='$id'";
            //echo $select;
            $result=mysql_query($select_buy);
            $data["id"]=$id;
            $data["buy"]=$result;

            $this->load->view('buynowDirect',$data);
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to review this product!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
        }
    }

    public function buy_now_cart()
    {
        $this->load->database();
        if(isset($_COOKIE['student']))
        {
            $name=$_COOKIE['student'];
            $select_cart="SELECT * FROM cart WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name');";
            //echo $select_cart;
            $result_cart=mysql_query($select_cart);
            $value=mysql_num_rows($result_cart);
            echo $value;

            $data["buy"]=$result_cart;

            $this->load->view('buynowFromCart',$data);
            //$sum=0;
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to review this product!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
        }

    }

     /*public function buy_now()
     {
         $this->load->database();
       if(isset($_COOKIE['student']))
       {
            if($_GET['ID'])
            {
                 $id=$_GET["ID"];
                 $select_buy="SELECT * FROM materials WHERE materials.Material_ID='$id'";
                 //echo $select;
                 $result=mysql_query($select_buy);
                 $data["id"]=$id;
                 $data["buy"]=$result;

                 $this->load->view('buynowDirect',$data);
                 //$sum=0;
            }
            else
            {
                 $name=$_COOKIE['student'];
                 $select_cart="SELECT * FROM cart,users WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name');";
                 //echo $select_cart;
                 $result_cart=mysql_query($select_cart);
                 $data["buy"]=$result_cart;

                 $this->load->view('buynowFromCart',$data);
                 //$sum=0;
            }
       }
       else
       {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to review this product!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
       }
        

     }*/

     public function viewOrder() {
        $username = $_COOKIE['student'];
        $this->load->database();
        $query = $this->db->query("SELECT * FROM users WHERE Username = '$username'");
    
        foreach($query->result() as $row) {
            $student_email = $row->Email;
        }

        $query2 = $this->db->query("SELECT orders.Order_ID, orders.Material_ID, orders.Quantity, orders.Order_Cost, orders.Mode_of_Payment, orders.Student_Email, orders.Order_Approve_Status, materials.Material_Name, materials.Image,  materials.Vendor_Email
                            FROM orders
                            INNER JOIN materials
                            ON orders.Material_ID = materials.Material_ID
                            WHERE orders.Student_Email = '$student_email'");

        $data['results'] = $query2->result();

        $this->load->view("viewOrder", $data);


    }

    public function deductMaterial() {
        $op = "charmik";
        $this->load->database();

        $query = $this->db->query("SELECT * FROM users WHERE Username = '$op'");
    
        foreach($query->result() as $row) {
            $student_email = $row->Email;
        }

        echo "studentn sfrunvu cdsucnu: ".$student_email;

        $query2 = $this->db->query("SELECT *
                            FROM cart
                            WHERE cart.Student_Email = '$student_email'");

        foreach($query2->result() as $row) {
            $mid = $row->Material_ID;

            $query3 = $this->db->query("UPDATE materials
                                        SET materials.Quantity = materials.Quantity - '$row->Quantity' , materials.Quantity_Sold = materials.Quantity_Sold + '$row->Quantity'
                                        WHERE Material_ID = '$mid'");

            $this->db->query("DELETE 
                              FROM cart
                              WHERE Material_ID = '$mid' AND Student_Email = '$student_email'"); 

        }


    }
    public function buy_now()
    {
        $this->load->database();
        ?>
        <head>
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
                margin: 60px 0px 0px 816px;
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
            table
            {
                border:3px solid #e4e4e4;
                margin:0px 90px 0px 70px;
            }
    </style>
</head>
        <?php
        //$this->load->database();

        $mat=$this->input->post('id');
        //echo $mat; 
        $quantity=$this->input->post('quantity');
        //echo $quantity;
        if(isset($_POST['quantity']))
        {
        if($quantity==0)
        {
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Quantity should be greater than 0!');\n";
                    echo "window.location='/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=$mat'";
                    echo "</script>";   

        }
        else
        {
       if(isset($_POST['id']))
       {

        $id=$_POST["id"];
        $select_buy="SELECT * FROM materials WHERE materials.Material_ID='$id'";
        //echo $select_buy;
        $result=mysql_query($select_buy);

        $sum=0;
        }
        else
        {
        $name=$_COOKIE['student'];
        $select_cart="SELECT * FROM cart,users WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name') And email=(SELECT Email FROM users WHERE Username='$name');";
        //echo $select_cart;
        $result_cart=mysql_query($select_cart);
        $sum=0;
        }


                ?>
        <div class="col-md-12 " id = "MainMenu">
               <table cellpadding="0" cellspacing="0">
                <thead class="row_heading"> 
                <tr>
                    <td id="Material_Name" class="col-md-4">
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
        <?php  if(isset($_POST['id']))
                {
               while($row = mysql_fetch_object($result)) 
        {
            $id=$_POST['id'];
            $cart="SELECT * FROM cart WHERE Material_ID='$id'";

            $run=mysql_query($cart);
            $run1=mysql_fetch_object($run);

            ?>
         <thead class="row">
                        <tr>
                        
                            <td class = "col-md-4" id="Material_Name">
                               
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $row->Image;?>" width="80px" height="80px">
                                <h4><?php echo $row->Material_Name; ?> </h4>
                                
                            
                  
                          
                            </td>
                        
                 
                    <td class="col-md-2" id ="qty"> 
                        <h4><?php echo $quantity; ?></h4>
                    </td>
                    <td class="col-md-2" id ="price"> 
                        <h4><?php echo ($row->Price) * ($quantity); ?></h4>
                    </td>

                    <td class="col-md-2" id ="discount"> 
                        <h4><?php echo $row->Discount *($quantity); ?></h4>
                    </td>
                    <td class="col-md-2" id ="Subtotal"> 
                        <h4><?php echo $row->FinalPrice*($quantity);
                                        $sum+=$row->FinalPrice *($quantity); ?></h4>
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
    <?php
        if(!isset($_POST['id']))
        {
              while($r = mysql_fetch_object($result_cart)) 
        {
                $sql1= "SELECT * FROM materials WHERE Material_ID=$r->Material_ID";
        //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $cart="SELECT * FROM cart WHERE Material_ID='$r->Material_ID'";
                $run=mysql_query($cart);
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
    
        
    <?php    
    
    }
}

        else
        {
       if(isset($_POST['id']))
       {

        $id=$_POST["id"];
        $select_buy="SELECT * FROM materials WHERE materials.Material_ID='$id'";
        //echo $select_buy;
        $result=mysql_query($select_buy);

        $sum=0;
        }
        else
        {
        $name=$_COOKIE['student'];
        $select_cart="SELECT * FROM cart,users WHERE cart.Student_Email = (SELECT Email FROM users WHERE Username='$name') And email=(SELECT Email FROM users WHERE Username='$name');";
        //echo $select_cart;
        $result_cart=mysql_query($select_cart);
        $sum=0;
        }


                ?>
        <div class="col-md-12 " id = "MainMenu">
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
        <?php  if(isset($_POST['id']))
                {
               while($r = mysql_fetch_object($result)) 
        {
            //$cart="SELECT * FROM cart WHERE Material_ID='$r->Material_ID'";
            //$run=mysql_query($cart);
            //$run1=mysql_fetch_object($run);

            ?>
      <thead class="row">
                        <tr>
                        
                            <td class = "col-md-4" id="Material_Name">
                               
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $row->Image;?>" width="80px" height="80px">
                                <h4><?php echo $row->Material_Name; ?> </h4>
                                
                            
                  
                          
                            </td>
                        
                 
                    <td class="col-md-2" id ="qty"> 
                        <h4><?php echo $quantity; ?></h4>
                    </td>
                    <td class="col-md-2" id ="price"> 
                        <h4><?php echo ($row->Price) * ($quantity); ?></h4>
                    </td>

                    <td class="col-md-2" id ="discount"> 
                        <h4><?php echo $row->Discount *($quantity); ?></h4>
                    </td>
                    <td class="col-md-2" id ="Subtotal"> 
                        <h4><?php echo $row->FinalPrice*($quantity);
                                        $sum+=$row->FinalPrice *($quantity); ?></h4>
                    </td>
                    </tr>
            
        </thead>
 <?php
        }
        }
        else
        {
              while($r = mysql_fetch_object($result_cart)) 
        {
                $sql1= "SELECT * FROM materials WHERE Material_ID=$r->Material_ID";
        //echo $sql1;
                $result1=mysql_query($sql1);
                $row=mysql_fetch_object($result1);
                $cart="SELECT * FROM cart WHERE Material_ID='$r->Material_ID'";
                $run=mysql_query($cart);
                $run1=mysql_fetch_object($run);

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
            </div>
            </table>
             <?php if(isset($_POST['id']))
        {
        ?>
        <div class="col-md-3" >
        <a href="/CodeIgniter_2.2.0/index.php/home/payment?msg=<?php echo $_POST['id'] ?>&quantity=<?php echo $quantity ?>" id="go_back" class="btn btn-success btn-lg">Proceed To Checkout </a>
                    </div>

        <?php    
        }
        else
        {
            $name=$_COOKIE['student'];
            $sel="SELECT Email FROM users WHERE Username='$name'";
            $res=mysql_query($sel);
            $r=mysql_fetch_object($res);    
            ?>
                  <div class="col-md-3" >
        <a href="/CodeIgniter_2.2.0/index.php/home/payment_cart?msg1=<?php echo $r->Email?>&quantity=<?php echo $quantity ?>" id="go_back" class="btn btn-success btn-lg">Proceed To Checkout</a>
                    </div>
 
            <?php

        }
        ?>
           


   <?php 
    
    }
            
}
          
?>