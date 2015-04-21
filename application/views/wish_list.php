

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>My Wishlist</title>
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




     
     <div class ="container">
        <div class="row">

            <div class="col-md-3">
                
         
            <?php
             $this->load->database();
                $sql = "SELECT DISTINCT Category FROM categories";
                $result = mysql_query($sql);
                $categories = Array();
                $i=0;
                while($category=mysql_fetch_array($result)){
                    $categories[$i]=(object)NULL;
                    $categories[$i]->Category = $category['Category'];
                    $cat = $category['Category'];
                    $sql = "SELECT Subcategory FROM categories WHERE Category='$cat'";
                    $res = mysql_query($sql);
                    $categories[$i]->Subcategory = Array();
                    $j=0;
                    while($subcategory=mysql_fetch_array($res)){
                        $categories[$i]->Subcategory[$j]=(object)NULL;
                        $categories[$i]->Subcategory[$j]=$subcategory['Subcategory'];
                        $j = $j+1;
                    }
                    $i=$i+1;
                }
        
        
            ?>


             <div id="MainMenu">
                    <div class="list-group panel">
                      <?php
                        $i=1;
                        foreach($categories as $category){
                      ?>
                            <a href="#demo<?php echo $i; ?>" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu"><?php echo $category->Category; ?>  <i class="fa fa-caret-down"></i></a>
                            <div class="collapse" id="demo<?php echo $i; ?>">
                                <?php foreach($category->Subcategory as $subcategory){
                                ?>
                                    <a href="" class="list-group-item"><?php echo $subcategory; ?></a>
                                <?php
                                }
                                ?>
                                    <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_category?category=<?php echo $category->Category; ?>&add=0" class="list-group-item">EDIT</a>-->
                             </div>   
                      <?php
                          $i=$i+1; 
                      }
                      ?>
                        <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/add_category?add=0" class="list-group-item list-group-item-success" data-toggle="" data-parent="#MainMenu">ADD NEW  <i class="fa fa-caret-down"></i></a>-->
                    </div>


                 </div>
            </div>


            <div class="col-md-9">
            <div class="container">
            <?php
              while($wish=mysql_fetch_object($wishes))
              {
            ?>
                <div class="col-md-9 " id = "MainMenu">
                <div class="row"> 
                    <div class="col-md-4">
                        <div class="thumbnail">
                        <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $wish->Image;?>">
                        </div>
                    </div>

                    <div class="col-md-8"> 
                        <div class = "row">
                        <h4>Product Name: </h4><h4><a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $wish->Material_ID; ?>"><?php echo $wish->Material_Name; ?></a></h4>
                        <hr>
                        <h4>Price: </h4><h4><?php echo $wish->Price; ?></h4>
                        <h5><p><?php
                              if(($wish->Quantity) > 0) {
                                echo "Product is available";
                              }
                              else {
                                echo "Product is unavailable";
                              }
                          ?></p>
                        </h5>
                        </br></br></br>

                        <?php
                              if(($wish->Quantity) > 0) {?>
                                <a href="/CodeIgniter_2.2.0/index.php/home/buy_now?ID=<?php echo $wish->Material_ID;?>" class="btn btn-success btn-lg">  Buy Now  </a>
                        
                        
                        <a href="/CodeIgniter_2.2.0/index.php/home/add_to_cart?ID=<?php echo $wish->Material_ID; ?>" class="btn btn-warning btn-lg">Add to Cart</a>
                             <?php }
                              else {
                               
                              }
                          ?>
                        
                        <a href="/CodeIgniter_2.2.0/index.php/home/wishlist_remove/?id=<?php echo $wish->Material_ID; ?>"> <h6> Remove from Wishlist </h6></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
              }
            ?>
            </div>
            </div>

                    
        </div>
    </div>
 

        

    <footer>
        <div class="container" >
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

