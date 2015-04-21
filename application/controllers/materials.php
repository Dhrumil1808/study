<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Materials extends CI_Controller {


    public function upload_material()
    {
       $this->load->database();

       $sql = "SELECT DISTINCT Category FROM categories;";
       $result = mysql_query($sql);
       $data["categories"] = $result;

       $sql1 = "SELECT DISTINCT Subcategory FROM categories;";
       $result1 = mysql_query($sql1);
       $data["subcat"] = $result1;
       $data['action'] = "upload";
       $data["material"]=null;
       //$mat=null;
       $this->load->view('abc1',$data);
    }

	public function add_material()
	{
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();

            $data = array(
            
            'Vendor_Email' => $this->getVendorEmail(),
            'Category' => $this->input->post('category'),
            'Subcategory' => $this->input->post('sub_category'),
            'Material_Name' => $this->input->post('material_name'),
            'Price' => intval($this->input->post('price')),
            'Discount' => floatval($this->input->post('discount')),
            'FinalPrice' => $this->getFinalPrice($this->input->post('discount'), $this->input->post('price')),
            'Quantity' => intval($this->input->post('quantity')),
            'Quantity_Sold' => 0,
            
            'Description' => $this->input->post('description'),
            'Image' => 'upload/'.$_COOKIE['vendor'].$_FILES['pic']['name'],
            
            'Material_Updated_At'=> $this->getDate()
            );

            $this->db->insert('materials', $data);
            
            $uploaddir = 'upload/';
            $uploadfile = $uploaddir.$_COOKIE['vendor'].basename($_FILES['pic']['name']);
            echo $_FILES['pic']['name'];
            echo $uploadfile;
            if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } 
            else {
                echo "Possible file upload attack!\n";
            }
            $sql = "SELECT Email FROM users WHERE type='Admin'";
            $result = mysql_query($sql);
            echo "New Material(Material Name: ".$data['Material_Name'].") has been added by".$_COOKIE['vendor'];
            while($admin = mysql_fetch_object($result)){
            $notification = array(
                'User_Email' => $admin->Email,
                'Notification_Text' => "New Material(Material Name: ".$data['Material_Name'].") has been added by ".$_COOKIE['vendor']
                );
            $this->db->insert('notifications', $notification);
        }


            header("location:show_detail");
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/vendor_login'";
            echo "</script>";
        }
		
    }
   	 
    public function getVendorEmail(){
        if(isset($_COOKIE['vendor']))
        {
            //echo "vendor cookie set";
        	$ven=$_COOKIE['vendor'];
            //echo $ven;
        	$sql="SELECT Email FROM users WHERE Username='$ven'";
            $result=mysql_query($sql);
            $r=mysql_fetch_object($result);
            return $r->Email;
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/vendor_login'";
            echo "</script>";
        }
    }
    public function getFinalPrice($discount, $price){
        return floatval($price)-(floatval($price)*floatval($discount)/100);
    }
    public function getDate(){
        date_default_timezone_set("Asia/Kolkata");
        return date("Y-m-d h:i:s");
    }

    public function update_material()
    {
        $mat=$_GET['Material'];
        echo $mat;

        $this->load->database();

        $sql = "SELECT DISTINCT Category FROM categories;";
        $result = mysql_query($sql);
        $data["categories"] = $result;

        $sql1 = "SELECT DISTINCT Subcategory FROM categories;";
        $result1 = mysql_query($sql1);
        $data["subcat"] = $result1;
        $data['action'] = "update";
        $data["material"]=$mat;
        
        $this->load->view('upload_material',$data);
    }

    public function insert_update_values()
    {
        $this->load->database();

        $data = array(
        
        //'Vendor_Email' => $this->getVendorEmail(),
        'Category' => $this->input->post('category'),
        'Subcategory' => $this->input->post('sub_category'),
        'Material_Name' => $this->input->post('material_name'),
        'Price' => intval($this->input->post('price')),
        'Discount' => floatval($this->input->post('discount')),
        'FinalPrice' => $this->getFinalPrice($this->input->post('discount'), $this->input->post('price')),
        'Quantity' => intval($this->input->post('quantity')),
        
        'Description' => $this->input->post('description'),
        'Image' => 'upload/'.$_FILES['pic']['name'],
        
        'Material_Updated_At'=> $this->getDate()
        );

        $this->db->where('Material_ID', $_GET["ID"]);
        $this->db->update('materials', $data);  
        
        $uploaddir = 'upload/';
        $uploadfile = $uploaddir . basename($_FILES['pic']['name']);
        echo $_FILES['pic']['name'];
        echo $uploadfile;
        if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Possible file upload attack!\n";
        }
        $sql = "SELECT Email FROM users WHERE type='Admin'";
        $result = mysql_query($sql);
        echo "Material(Material Name: ".$data['Material_Name'].") has been updated by".$_COOKIE['vendor'];
        while($admin = mysql_fetch_object($result)){
            $notification = array(
                'User_Email' => $admin->Email,
                'Notification_Text' => "Material(Material Name: ".$data['Material_Name'].") has updated added by ".$_COOKIE['vendor']
                );
            $this->db->insert('notifications', $notification);
            
        }
        
        header("location:show_detail");
        
    }

    public function show_detail()
    {
        $this->load->view('vendor_material');

    }

    public function material_detail()
    {
        $this->load->database();
        $m_id=$_GET["ID"];

        $select="SELECT * FROM materials WHERE Material_ID = '$m_id' ";
        //echo $select;
        $query =mysql_query($select);
        $data['row'] = mysql_fetch_object($query);
		
        $this->load->view('single_material_view',$data);
    }

    public function delete_material()
    {
        $this->load->database();
        $m_id=$_GET['Material'];
        echo $m_id;
        $sql="SELECT Image FROM materials WHERE Material_ID='$m_id'";
        $delete="DELETE FROM materials WHERE Material_ID='$m_id'";
        echo $delete;
        if(mysql_query($delete))
        {
            $result = mysql_query($sql);
            $image=mysql_fetch_object($result);
            $this->unlink($image->Image);
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Material Deleted!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/materials/show_detail'";
            echo "</script>";
        
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Cannot Delete. It has been ordered by an user!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/materials/show_detail'";
            echo "</script>";
        }
        
           
    }


}
?>