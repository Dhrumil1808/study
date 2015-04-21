

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<title>Product Details</title>
<meta name="pDetails" content="productSwag">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



  <style>


  #fk
  {
    padding-top: 100px;
      
  }

  #kk
  {
    padding-top: 50px;
    text-align: center;
  }

  #nk

  {
    text-align: left;
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
        <div class="row" id="fk">

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


            <div class="col-md-9 ">
            <div class="well" >
              <div id="name">
        <h1> <?php echo $row->Material_Name; ?> </h1>
        <img src=""/>
        </div>
            </div>
            </div>
            
            <div class="col-md-9">
                <div class="row"> 
                    <div class="col-md-6">
                        <div class = "well">
                        <img  class="img-polaroid" src="http://localhost/CodeIgniter_2.2.0/<?php echo $row->Image;?>" height="400" width="400" />
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class = "well"><div id="flip">
                          <p><?php
                              if(($row->Quantity) > 0) {
                                echo "Product is available";
                              }
                              else {
                                echo "Product is unavailable";
                              }
                          ?></p>

           
            <p><a href="/CodeIgniter_2.2.0/index.php/home/add_review?ID=<?php echo $row->Material_ID; ?>"> Write a review</a></p>


            <p> <a href="/CodeIgniter_2.2.0/index.php/home/add_to_wishlist?ID=<?php echo $row->Material_ID; ?>">Add to wishlist</a></p>
            <div id="silicon">
            <h3><?php echo $row->Price; ?>/-</h3>
            <p> Free delivery</p></div>
                    </div>

                    
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="row"> 
                  <?php

                              if(($row->Quantity) > 0) {
                                ?>

                <form action="/CodeIgniter_2.2.0/index.php/home/buy_now" method="post">
                  <input type="number" name="quantity" min="0" max="<?php echo ($row->Quantity); ?>" step="1" value="0" size="6" />
                    <input type="hidden" name="id" value="<?php echo $row->Material_ID ?>">
                    <div class="col-md-6">
                    <input type="submit" class="btn btn-primary btn-lg" value="Buy Now"/> </div>
                    <div class="col-md-6">
                    <input type="submit" class="btn btn-warning btn-lg" formaction="/CodeIgniter_2.2.0/index.php/home/add_to_cart" value="Add To Cart"/>
                     
                      </div>
                    </form>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div class="red">
                      <?php
                      echo "product is out of stock";
                    }
                    ?>

                    <div class="col-md-6 ">
                     <?php if(($row->Quantity) > 0) { ?>
                        <!--<a href="/CodeIgniter_2.2.0/index.php/home/buy_now_direct?ID=<?php echo $row->Material_ID;?>" class="btn btn-primary btn-lg">BUY NOW</a>
                      <?php } ?>
                    </div>
                    <div class="col-md-6 ">
                    <?php if(($row->Quantity) > 0) { ?>
                    <a href="/CodeIgniter_2.2.0/index.php/home/add_to_cart?ID=<?php echo $row->Material_ID; ?>" class="btn btn-warning btn-lg">ADD TO CART</a>
                    <?php } ?>
                    </div>-->
                </div>
            </div>
            
            

            <div class="col-md-6">
              <div class="row" id = "kk">
              <h3>Description</h3>
              <div class="well" id = "nk">
                <p><?php echo $row->Description; ?> </p>
              </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row" id = "kk">
              <h3>Reviews</h3>
              <div class="well" id = "nk">
              
            <?php $sql="SELECT * FROM material_review WHERE Material_ID=$row->Material_ID ORDER BY Rating asc LIMIT 5";
                  $result=mysql_query($sql);
                  while($r=mysql_fetch_object($result))
                  {
                    $sql = "SELECT Username FROM users WHERE Email='$r->Student_Email'";
                    $reviewer_uname=mysql_fetch_object(mysql_query($sql));
                    echo "<h4>User: </h4>".$reviewer_uname->Username; ?><br />
                    <?php echo "<h4>Review: </h4>".$r->Review; ?> <br />

                    <?php  echo "<h4>Rating: </h4>".$r->Rating; ?><br />
                    <?php
                  }
            ?>
          <!--<p>Write a review</p>

          <form>
          Your Name:<input type ='text' name ='name' id='name'/><br/>
          Your Review:<input type ='text' name ='your_review' id='your_review'/><br/>
          <p>Bad<input type="radio" name= "gud" value="gud"> <input type="radio" name= "gud1" value="gud1"> <input type="radio" name= "gud5" value="gud5"> <input type="radio" name= "gud2" value="gud2"> <input type="radio" name= "gud3" value="gud3"> Good</p>
          <input type='submit' value='Submit'/>
          </form>-->
          <?php 
            $sql = "SELECT BusinessName FROM vendor WHERE Email='$row->Vendor_Email'";
            $vendor=mysql_query($sql);
            $bname = mysql_fetch_object($vendor);
            ?>
              </div>
              </div>
            </div>

            <div class="col-md-12">
                <div class="row"> 
                    <h4> Specifications</h4>
          <p>
          <table border="1" style ="width:100%">
          <tr>
              <td><b>Seller</b></td>
              <td><b>Category</b></td>
              <td><b>Sub category</b></td>
              <td><b>Discount</b></td>
          </tr>
          <tr>
              <td> <?php echo $bname->BusinessName; ?></td>
              <td><?php echo $row->Category; ?></td>
              <td><?php echo $row->Subcategory; ?></td>
              <td><?php echo $row->Discount; ?>%</td>
          </tr>
          </table>
          </p>
                </div>
            </div>                        
        </div>
    </div>

     <!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>    
</html>


