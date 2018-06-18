
<?php
//index.php

$error = '';
$title='';
$name = '';
$email = '';
$postcode = '';


function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
	if(empty($_POST["name"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
	}
	else
	{
		$name = clean_text($_POST["name"]);
		if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
			$error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
		}
	}
	if(empty($_POST["email"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
	}
	else
	{
		$email = clean_text($_POST["email"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error .= '<p><label class="text-danger">Invalid email format</label></p>';
		}
	}
	if(empty($_POST["postcode"]))
	{
		$error .= '<p><label class="text-danger">Postcode is required</label></p>';
	}
	else
	{
		$postcode = clean_text($_POST["postcode"]);
	}
	if(empty($_POST["title"]))
	{
		$error .= '<p><label class="text-danger">Title is required</label></p>';
	}
	else
	{
		$title = clean_text($_POST["title"]);
	}

	if($error == '')
	{
		$file_open = fopen("contact_data.csv", "a");
		$no_rows = count(file("contact_data.csv"));
		if($no_rows > 1)
		{
			$no_rows = ($no_rows - 1) + 1;
		}
		$form_data = array(
			'sr_no'		=>	$no_rows,
                        'title'         =>	$title,
			'name'		=>	$name,
			'email'		=>	$email,
			'postcode'	=>	$postcode
                );
		fputcsv($file_open, $form_data);
		$error = '<label class="text-success">Thank you for contacting us!</label>';
		$title = '';
                $name = '';
		$email = '';
		$postcode = '';
	}
}

//?>
<!DOCTYPE html>
<html>
	<head>
		<title>Test Now Google Analytics 360</title>
                <link href="style.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h2 align="center">Test Now Google Analytics 360</h2>
			<br />
			<div class="col-md-6" style="margin:0 auto; float:none;">
                            <div class="ball"></div>	
                            <form method="post" id="form">
                                <h3 align="center">Contact Form</h3>
                                <br />
				<?php echo $error; ?>
                                <div class="form-group">
                                <select name="title" id="title" class="cat_dropdown_smaller">
                                    <option value="mrs">MRS</option>
                                    <option value="miss">MISS</option>
                                    <option value="mr" selected="selected">MR</option>
                                    <option value="mx">Mx.</option>
                                    <option value="lord">Lord</option>
                                    <option value="sir">Sir</option>
                                    <option value="dame">Dame</option>
                                    <option value="lady">Lady</option>
                                </select>    
                                </div>
                                <div class="form-group">
                                    <label>Enter Name</label>
                                    <input id="name" type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label>Enter Email</label>
                                    <input id="email" type="email" name="email" class="form-control" placeholder="Enter Email" value=" <?php echo $email; ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label>Enter Postcode</label>
                                    <input id="postcode" name="postcode" class="form-control" placeholder="Enter Postcode" value="<?php echo $postcode; ?>" required/>
                                </div>
                                <div class="form-group" align="center">
                                    <input type="submit" name="submit" class="btn btn-info" value="Submit" id="submit"/>
                                </div>
<!--                                <div class="row" style="margin-bottom:30px;">
                                    <div class="row" style="margin-bottom:30px;">
                                        <div class="col-sm-5">
                                            <img src="captcha.php" id="captcha_image"/>
                                            <br/> <a id="captcha_reload" href="#">reload</a>
                                            </div>
                                        <div class="col-sm-6">
                                            <label for="email">Enter the code from the image here:</label>
                                            <input type="text" class="form-control" required id="captcha" name="captcha" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <button type="submit" class="btn btn-lg btn-default pull-right" >Send →</button>
                                        </div>
                                    </div>
                                </div>-->
                                </form>
                <div id="success_message" style="width:80%; height:100%; display:none; ">
                <h3>Posted your message successfully!</h3>
                </div>
                <div id="error_message" style="width:80%; height:100%; display:none; ">
                    <h3>Error</h3>
                    Sorry there was an error sending your form.

        </div>
<!--			</form>-->
			</div>
                        <!-- This is the div the form's results will be placed into, it is hidden by default -->
<div style="display:none" id="message"></div>

<!-- This is the custom script that does the magic -->
<script type="text/javascript">
//function jqsub() {
//var $f = $('#form');
//var $m = $('#message');
//$.ajax({
//  type: 'POST',
//  url: $f.attr('action') + '&amp;JSON=1',
//  data: $f.serialize(),
//    success: function(msg) {
//    var formResponse = eval(msg); // This line evaluates the JSON data and converts it to JSON object. In older version of jQuery you will have to evaluate JSON object as a string.
//        if (formResponse.FormProcessV2Response.success) { 
//                $m.addClass('success').fadeIn().html(formResponse.FormProcessV2Response.message); 
//                $f.fadeOut(); //Hide the form
//        }
//                    
//    },
//    error: function(msg) {
//    alert('error'+msg);
//    return false;
//    }
//});
//}

  function jqsub() {
  var $f = $('#contact_form');
  var $m = $('#message');
  $.ajax({
  type: 'POST',
  url: $f.attr('action'),
  data: $f.serialize(),
  success: function(msg) {
  var formResponse = eval(msg); // This line evaluates the JSON data and converts it to JSON object. In older version of jQuery you will have to evaluate JSON object as a string.
  if (formResponse.FormProcessV2Response.success) { 
  $m.addClass('success').fadeIn().html(formResponse.FormProcessV2Response.message); 
  $f.fadeOut(); //Hide the form
  }
  
  },
  error: function(msg) {
  alert('error'+msg);
  return false;
  }
  });
  }
  </script>

        
		</div>
                               
	</body>
        
</html>
      