

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Product List</title>
    <meta name="description" content="Hello World">
    

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js">
</script>
<script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter_2.2.0/js/jquery.cslider.js"></script>
<!-- start slider -->
<script>
    //alert("ROFL");
    $(document).ready(function(){
    
        alert("first");
    $("#search").change(function () {
            
        
            //alert(this.value);
            var b=$("#search").val();
                alert(b);
                $("#searching").html('');
            $.ajax({
                type: "POST",
                data: "data="+ b,
                url:"/CodeIgniter_2.2.0/index.php/home/ajax_print_materials?ID=<?php echo $typed; ?>",
                success: function(msg){
            
                $("#searching").html(msg)
                }
                
            });
        
        });
    });
    </script>


    <style>
            

            .list-group.panel > .list-group-item 
            {
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
            }
            .list-group-submenu 
            {
                margin-left:20px;
            }

            #sidebar
            {
                margin-top: 100px;
            }

            #page
            {
                padding-left: 250px;
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



    <div class ="container" id = "sidebar">
        <div class="row">
            <div class="col-md-3">
                
                <!-- menu -->
                <?php
             $this->load->database();
                $sql = "SELECT DISTINCT Category FROM categories";
                $result = mysql_query($sql);
                $categories = Array();
                $i=0;
                while($r=mysql_fetch_array($result)){
                    $categories[$i]=(object)NULL;
                    $categories[$i]->Category = $r['Category'];
                    $cat = $r['Category'];
                    $sql = "SELECT Subcategory FROM categories WHERE Category='$cat'";
                    $res = mysql_query($sql);
                    $categories[$i]->Subcategory = Array();
                    $j=0;
                    while($row=mysql_fetch_array($res)){
                        $categories[$i]->Subcategory[$j]=(object)NULL;
                        $categories[$i]->Subcategory[$j]=$row['Subcategory'];
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
                                    <a href="/CodeIgniter_2.2.0/index.php/home/sub_search?Subcategory=<?php echo $subcategory; ?>" class="list-group-item"><?php echo $subcategory; ?></a>
                                <?php
                                }
                                ?>
                                    <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_category?category=<?php echo $category->Category; ?>&add=0" class="list-group-item">EDIT</a>-->
                             </div>   
                      <?php
                          $i=$i+1; 
                      }
                      ?>                    </div>


                 </div>
            </div>
            
                <div class="col-md-9">
                <div class="container">
            <!-- <div class="container"> -->
                <div class="col-md-9"> 
                    <div class="well">
                        <h3>Filters</h3></br>
                        <h4>Sort by</h4>
                        <select id="search">
                          <option value="default">Default</option>
                          <option value="name_asc">Name(A-Z)</option>
                          <option value="name_desc">Name(Z-A)</option>
                          <option value="price_asc">Price(Low to High)</option>
                          <option value="price_desc">Price(High to Low)</option>
                          <!-- <option value="price_asc">Price(Low to High)</option> -->
                          <option value="rating">Rating</option>
                        </select>

                    </div>
                </div>

                <div id="searching">
             
                    <div class="col-md-9">
                        <div class="row"> 
                            <?php while($result=mysql_fetch_object($search))
                            {
                                //$re=$result->Material_Name;
                            ?>
                                <div class="col-md-4">
                                <a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $result->Material_ID; ?>"> 
                                <div class="thumbnail">
                                    <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $result->Image;?>" > 

                                </div>
                                <?php echo $result->Material_Name; ?><br/>
                                Price: <?php echo $result->Price; ?></a><br/>
                                </div>
                                  <form method="post">
                                <input type="hidden" value="<?php echo $result->Material_Name ?>" name="material_name">
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                </div>
                                    
        </div>
    </div>        
    </div>
    </div>
    <div class="container">
            
            <hr>
            <ul class="pager">
                <li class="previous"><a href="">&larr;Previous One</a></li>
                <li class="next"><a href="">Next One&rarr;</a></li>
            </ul>

            <div class = "text-center">
            
            <ul class="pagination pagination-sm">
                <li class="disabled"><a href="">&laquo;</a></li>
                <li  class="active"><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
                <li><a href="">6</a></li>
                <li><a href="">&raquo;</a></li>
            </ul>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
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

