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

    <title>Write a review</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <!--script src="src/bootstrap-rating-input.js"></script-->
    <script src="bootstrap-rating-input.min.js"></script>
    <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">

    <script>
      $(function(){
        $('input').on('change', function(){
          alert("Changed: " + $(this).val())
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

            
    </style>
</head>


<body>

	
    <div class="container" id = "heading">
    	<div class="col-md-3">
	    	<div class="panel panel-info" >
				<div class="panel-heading" id="p_heading">
					<h3 class="panel-title">Name of Material</h3>
				</div>
				<div class="panel-body" id = "panel_body0">
					<div class="thumbnail">
                        <img src="http://goo.gl/0Kd7UO">
                    </div>	
				</div>
			</div>
		</div>
	
		

		<div class="col-md-9">
	    	<div class="panel panel-info" >
				<div class="panel-heading" id="p_heading">
				<h3 class="panel-title">Write a review</h3>
				</div>
				<div class="panel-body" id = "panel_body1">
				<form class="form-horizontal">	
						<fieldset>
						<legend>Help Others! Share your opinions.</legend>
						<h6>* All fields are mandatory</h6>
						<div class="form-group">
						  <label for="nameInput" class="col-lg-2 control-label">Review Title:</label>
						  <div class="col-lg-10">
						    <input type="text" class="form-control" id="nameInput" placeholder="">
						  </div>
						</div>
						<div class="form-group">
						  <label for="textArea" class="col-lg-2 control-label"> Your Review:</label>
						  <div class="col-lg-10">
						    <textarea class="form-control" rows="3" id="textArea"></textarea>
						  </div>
						</div>
						<div class="form-group">
						<label for="textArea" class="col-lg-2 control-label"> Your Rating:</label>
						  	<div class="col-lg-10">				
					        <p><input class="rating" data-max="5" data-min="1" data-clearable="remove" id="some_id" name="your_awesome_parameter" type="number" /></p>

					    	</div>
						</div>
						<div class="col-md-3 col-md-offset-2">
						<a href="#" class="btn btn-primary">Submit</a>
						</div>
						</fieldset>
				</form>
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
    

