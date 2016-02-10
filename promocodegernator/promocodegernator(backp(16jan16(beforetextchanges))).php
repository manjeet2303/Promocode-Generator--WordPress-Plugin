<?php 

    /*

    Plugin Name: Refferal Code  Generator

    Description: Plugin For Generating Promo Codes

    Author: Asha chouhan

    Version: 1.0

    */



include_once('db_connection.php');	



add_action('admin_menu', 'pcg_admin_actions');

	

function pcg_admin_actions()

{

  



  add_menu_page( 'Promo code Generator', 'Promo code Generator', 'manage_options', 'main_page', 'promo_code_generator_home', '', 6 ); 

  

  add_submenu_page('main_page', 'Add  Doctors', 'Add  Doctors', 'manage_options', 'doctors_page', 'add_doctors' );

  

  add_submenu_page('main_page', 'Assign Promo Code', 'Assign Promo Code', 'manage_options', 'promo_page', 'add_promo_code' );

  

  add_submenu_page('main_page', 'Doctor Commission', 'Doctor Commission', 'manage_options', 'commission_page', 'doctor_comission' );





  

  

  add_submenu_page( 

          null            // -> Set to null - will hide menu link

        , 'Add New Code'    // -> Page Title

        , 'Add New Code'    // -> Title that would otherwise appear in the menu

        , 'administrator' // -> Capability level

        , 'add_new_code_menu_handle'   // -> Still accessible via admin.php?page=add_new_code_menu_handle

        , 'add_new_code' // -> To render the page

    );

	

	add_submenu_page( 

          null            // -> Set to null - will hide menu link

        , 'Edit Promo Code'    // -> Page Title

        , 'Edit Promo Code'    // -> Title that would otherwise appear in the menu

        , 'administrator' // -> Capability level

        , 'edit_promo_code_menu_handle'   // -> Still accessible via admin.php?page=edit_promo_code_menu_handle

        , 'edit_promo_code' // -> To render the page

    );

	

	add_submenu_page( 

          null            // -> Set to null - will hide menu link

        , 'Assign Promo Code'    // -> Page Title

        , 'Assign Promo Code'    // -> Title that would otherwise appear in the menu

        , 'administrator' // -> Capability level

        , 'assign_promo_code_menu_handle'   // -> Still accessible via admin.php?page=assign_promo_code_menu_handle

        , 'assign_promo_code' // -> To render the page

    );

	

	add_submenu_page( 

          null            // -> Set to null - will hide menu link

        , 'Edit Assigned Promo Code'    // -> Page Title

        , 'Edit Assigned Promo Code'    // -> Title that would otherwise appear in the menu

        , 'administrator' // -> Capability level

        , 'edit_assigned_promo_code_menu_handle'   // -> Still accessible via admin.php?page=edit_assigned_promo_code_menu_handle

        , 'edit_assigned_promo_code' // -> To render the page

    );	

	

	add_submenu_page( 

          null            // -> Set to null - will hide menu link

        , 'Check Doctor Commission'    // -> Page Title

        , 'Check Doctor Commission'    // -> Title that would otherwise appear in the menu

        , 'administrator' // -> Capability level

        , 'get_doc_commission_menu_handle'   // -> Still accessible via admin.php?page=get_doc_commission_menu_handle

        , 'get_doc_commission' // -> To render the page

    );
	
	
	add_submenu_page( 

          null            /* -> Set to null - will hide menu link */

        , 'Add New Dcotor'    /* -> Page Title*/

        , 'Add New Dcotor'    /* -> Title that would otherwise appear in the menu */

        , 'administrator' /* -> Capability level  */

        , 'add_new_doctor_menu_handle'   /* -> Still accessible via admin.php?page=add_new_doctor_menu_handle  */

        , 'add_new_dcotor' /* -> To render the page */

    );

    add_submenu_page( 

          null            /*-> Set to null - will hide menu link*/

        , 'Edit Doctor Detail'    /* -> Page Title*/

        , 'Edit Doctor Detail'    /* -> Title that would otherwise appear in the menu*/

        , 'administrator' /*-> Capability level*/

        , 'edit_doctor_detail_menu_handle'   /* -> Still accessible via admin.php?page=edit_doctor_detail_menu_handle*/

        , 'edit_doctor_detail' /*-> To render the page*/

    );

  

}



// add scripts in front end



add_action( 'wp_enqueue_scripts', 'promo_front_end_scripts' );



function promo_front_end_scripts()

{

	wp_register_style('fancy_style', plugins_url('css/jquery.fancybox.css', __FILE__) );

	

	wp_enqueue_style( 'fancy_style' );

	

	wp_register_script( 'fancy_js', plugins_url('js/jquery.fancybox.js', __FILE__), array('jquery'), null, true );

    

	wp_enqueue_script('fancy_js');

	

	

	wp_register_script( 'fancy_promo_js', plugins_url('js/promo_fancybox_script.js', __FILE__), array('jquery'), null, true); 

    

	wp_enqueue_script('fancy_promo_js');



}



// add scripts in admin panel



function promo_scripts()

{

    wp_register_style( 'myPluginStylesheet', plugins_url('css/promo.css', __FILE__));

	

	wp_enqueue_style( 'myPluginStylesheet' );

	

	wp_register_script( 'myPluginScript', plugins_url('js/validation.js', __FILE__));

	

	wp_enqueue_script( 'myPluginScript' );

}



add_action('admin_head','promo_scripts');



// Register Ajax call functions



add_action("wp_ajax_add_doctor_data", "add_doctor_data");

add_action("wp_ajax_nopriv_add_doctor_data", "add_doctor_data");



add_action("wp_ajax_send_promo_code", "send_promo_code");

add_action("wp_ajax_nopriv_send_promo_code", "send_promo_code");



add_action("wp_ajax_generate_promo_code", "generate_promo_code");

add_action("wp_ajax_nopriv_generate_promo_code", "generate_promo_code");



add_action("wp_ajax_delete_promo_code", "delete_promo_code");

add_action("wp_ajax_nopriv_delete_promo_code", "delete_promo_code");



add_action("wp_ajax_delete_assigned_promo_code", "delete_assigned_promo_code");

add_action("wp_ajax_nopriv_delete_assigned_promo_code", "delete_assigned_promo_code");



add_action("wp_ajax_register_user", "register_user");

add_action("wp_ajax_nopriv_register_user", "register_user");



add_action("wp_ajax_login_user", "login_user");

add_action("wp_ajax_nopriv_login_user", "login_user");



add_action("wp_ajax_check_promo", "check_promo");

add_action("wp_ajax_nopriv_check_promo", "check_promo");



function add_new_dcotor()
{
	
?>

	<form action="" method="post" id="elegant-aero" class="elegant-aero" onsubmit="return(submit_data());">

    <h1>

	  Add Doctor<span>Please fill all the fields.</span>

    </h1>

	

	<h3 id="success_msg" style="display:none;">

        <span></span>

    </h3>

	

    <label>

        <span>Doctor Name :</span>

        <input id="name" type="text" name="name" placeholder="Enter doctor name" />

    </label>

   

    <label>

        <span>Doctor Email :</span>

        <input id="email" type="email" name="email" placeholder="Enter valid email Address" />

    </label>

   

    <!--label>

        <span>Message To Doctor :</span>

        <textarea id="message" name="message" placeholder="Your message to doctor"></textarea>

    </label-->    

    

	<label>

        <span id="loader">&nbsp;</span>

        <input type="submit" class="button" value="Add Doctor" />

     </label>    

</form>	

<?php
}


function edit_doctor_detail()
{	global $conn;		$email = $_GET['doctor_email'];		if($_POST)	{				print_r($_POST);			}		$sql = 'select * from wp_promo_doctor_detail where email="'.$email.'"';     $result = $conn->query($sql);		$row = $result->fetch_assoc();	
?>

<form action="" method="post" id="edit_doctor_detail" class="elegant-aero" onsubmit="return(submit_data());">

    <h1>

	  Edit Doctor Detail<span>Please fill all the fields.</span>

    </h1>

	

	<h3 id="success_msg" style="display:none;">

        <span></span>

    </h3>

	

    <label>

        <span>Doctor Name :</span>

        <input id="name" type="text" name="name" placeholder="Enter doctor name" value="<?php echo $row['name'];?>"/>

    </label>

   

    <label>

        <span>Doctor Email :</span>

        <input id="email" type="email" name="email" placeholder="Enter valid email Address" value="<?php echo $row['email'];?>" />

    </label>

	<label>

        <span id="loader">&nbsp;</span>

        <input type="submit" class="button" value="Save" />

     </label>    

</form>	

<?php

}


function doctor_comission()

{

	global $conn;

	

	$sql = 'select * from wp_promo_doctor_detail';

 

    $promo_result = $conn->query($sql);

	

?>	

<div class="wrap">

<table class="wp-list-table widefat fixed striped posts">

 <thead>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		 Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		 Doctor Name

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		 Doctor Email

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		 Action

		</th>

		

    </tr>

 </thead>

 

 <tbody id="the-list">

 <?php

 

 $counter = 1;

 

 if($promo_result->num_rows > 0)

 {

	 while($row = $promo_result->fetch_assoc())

	 {

		 ?>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $counter++; ?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['name'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['email'];?>

		</th>

		

		<th class="manage-column column-title column-primary desc promo">

		   <a href="admin.php?page=get_doc_commission_menu_handle&doc_email=<?php echo $row['email'];?>">Check Commission</a>

		</th>

    </tr>

 <?php        

     }

 }

 ?>

 

 

 </tbody>

 

 <tfoot>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		 Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		 Doctor Name

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		 Doctor Email

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		 Action

		</th>

		

    </tr>

 </tfoot>

 

</table>



</div>



<?php



}



function get_doc_commission()

{

	global $conn;

	

	$email = $_GET['doc_email'];

	

	$sql = 'select * from wp_doctor_commission where doctor_email="'.$email.'"';

  

    $result = $conn->query($sql);

	

	if($result->num_rows > 0)

	{

?>		



<form action="" method="post" id="generate_promo_code_form" class="elegant-aero" onsubmit="return(generate_promo_code_detail());">

	

	<table id="comission_table">

	<!--tr>

	  <td colspan="1">Doctor:</td>

	  <td><?php echo $email; ?></td>

	</tr-->

	<tr>

	 <th>Sr. No.</th>

	 <th>Promo Code</th>

	 <th>Date</th>

	 <th>Comission Earned</th>

	 

	</tr>



<?php

       $counter = 1;

	   

	   $comission = 00.00;



		while($row = $result->fetch_assoc())

	    {

?>	  

	

	

	<tr>

	  <td><?php echo $counter++; ?></td>

	  <td><?php echo $row['promo_code']; ?></td>

	  

	  <td><?php echo $row['date']; ?></td>

	  <td>$<?php echo $row['comission']; ?></td>

	  

	</tr>

	

<?php

        $comission = $comission  + $row['comission'];

  

		}

		?>

		

		<tr>

		<td colspan="3"><strong>Total Comission of <?php echo $email; ?></strong></td>

		<td><strong>$<?php echo number_format($comission, 2, '.', ''); ?></strong></td>

		</tr>

		

		</table>

	

    </form>

	<?php

	}

	else

	{

?>

    <form action="" method="post" id="generate_promo_code_form" class="elegant-aero" onsubmit="return(generate_promo_code_detail());">

    

	<label>

        <span>Doctor Email :</span>

        <span><?php echo $email; ?></span>

    </label>

	

	<label>

        <span>Commission :</span>

        <span>No Commission</span>

    </label>

	

    </form>

<?php

	}

}



function check_promo()

{	

	global $conn;

	

	$res = '';

	

	$promo_code = $_POST['promo_code'];

	

	//$user_email = $_POST['user_email'];

	

	$sql1 = 'select * from wp_promo_doctors where code_name="'.$promo_code.'" && status="enable"';

  

    $result1 = $conn->query($sql1);

	

	if( $result1->num_rows > 0 )

	{

		while($row = $result1->fetch_assoc())

	    {

		   $doctor_email =  $row['doctor_email'];

        }

		

		$res = $doctor_email.'_yes';

	}

	else

	{

		$res = 'Invalid Promo Code';

	}

	

	/*

	

	$sql2 = 'select * from wp_user_promocode_detail where promo_code="'.$promo_code.'" && user_email="'.$user_email.'"';

  

    $result2 = $conn->query($sql2);

	

	

	if( $result1->num_rows > 0 && $result2->num_rows > 0)

	{

		$res = 'Promo Code '.$promo_code.' Expired';

	}

	else if( $result1->num_rows > 0 && !$result2->num_rows > 0 )

	{

		while($row = $result1->fetch_assoc())

	    {

		   $doctor_email =  $row['doctor_email'];

        }

		$res = $doctor_email.'_yes';

	}

	else

	{

		$res = 'Invalid Promo Code';

	}

	*/

	

	echo $res;

	

	die();

}



function login_user()

{

	global $conn;

	

	$result = '';

	

	$password  = $_POST['password'];

	

	$email = $_POST['email'];

	

	$sql = 'select * from wp_promo_users where user_email="'.$email.'" && user_pwd="'.$password.'"';

  

    $result = $conn->query($sql);

	

	if($result->num_rows > 0)

    {		

	   $result = 'yes';	   

    }

	else

	{

		$result = 'no';

	}

	

	echo $result;

	

	die();

}



function register_user()

{

	

	global $conn;

	

	$result = '';

	

	$name  = $_POST['name'];

	

	$password  = $_POST['password'];

	

	$email = $_POST['username'];

	

	$sql = 'select * from wp_promo_users where user_email="'.$email.'"';

  

    $result = $conn->query($sql);

  

    if($result->num_rows > 0)

    {

		

	   $result = 'no';

		

	   

    }

	else

	{

	   $sql = "INSERT INTO wp_promo_users (user_name, user_email, user_pwd) VALUES ('$name', '$email','$password')";

		

	   if($conn->query($sql) === TRUE)

       {

	     $result = 'yes';

       }

       else

       {

          echo "Error: " . $sql . "<br>" . $conn->error;

       } 

	}

	

	echo $result ;

	

	

	die();

}





function delete_promo_code()

{

	global $conn;

	

	$code_name  = $_POST['code_name'];

	

	$sql = "DELETE FROM wp_promo_codes WHERE code_name='$code_name'";

	

	if($conn->query($sql) === TRUE) 

	{

		echo 'yes';

	}

	else

	{

		echo 'no';

	}

	

	die();

}



function delete_assigned_promo_code()

{

	global $conn;

	

	$code_name  = $_POST['code_name'];

	

	$sql = "DELETE FROM wp_promo_doctors WHERE code_name='$code_name'";

	

	if($conn->query($sql) === TRUE) 

	{

		echo 'yes';

	}

	else

	{

		echo 'no';

	}

	

	die();

}





function email_to_doctor($email,$data=array())

{

	

//print_r($data);

	

extract($data);

	

$to = $email;



$subject = "Pittman Promo Code";



$message = "

<html>

<head>

</head>

<body>

<table border='1'>

<tr>

<th>Promo Code</th><th>Promo Commission</th>

<th>Promo Discount</th>

</tr>

<tr>

<td>".$promo_code."</td>

<td>".$promo_commision."</td><td>".$promo_discount."</td>

</tr>

</table>

</body>

</html>

";



$headers = 'From: webmaster@pittmanpillow.com' . "\r\n" ;



$headers .="Reply-To: webmaster@pittmanpillow.com\r\n" ;



$headers .='X-Mailer: PHP/' . phpversion();



$headers .= "MIME-Version: 1.0\r\n";



$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 



if(mail($to,$subject,$message,$headers))

{

	return true;

}

else

{

	return false;

}



}



function send_promo_code()

{

	global $conn;

	

	$result = '';



    $email = $_POST['email'];

	

	$promo_code = $_POST['promo_code'];

	

	$promo_discount = $_POST['promo_discount'];

	

	$promo_commision = $_POST['promo_commision'];

	

	//get doctor id and email first

	

	$sql = 'select * from wp_promo_doctors where doctor_email="'.$email.'" && code_name="'.$promo_code.'"';

  

    $result = $conn->query($sql);

  

    if($result->num_rows > 0)

    {

		

	   $result = 'no';

		

	   

    }

	else

	{

	   $sql = "INSERT INTO wp_promo_doctors (doctor_email, code_name, status) VALUES ('$email', '$promo_code','enable')";

	   

	   $data['promo_code'] = $promo_code;

	   

	   $data['promo_discount'] = $promo_discount;

	   

	   $data['promo_commision'] = $promo_commision;

	   

	    if($conn->query($sql) === TRUE)

        {	

            $res = email_to_doctor($email,$data);	

			$result = 'yes';

        }

	}

	

	echo $result;	

	

	die();

}



function add_doctor_data()

{

  global $conn;

  

  //print_r($_POST);

  

  $result = '';

  

  $name  = $_POST['name'];

  

  $email = $_POST['email'];

  

  //$msg = $_POST['msg'];

  

  $sql = 'select * from wp_promo_doctor_detail where email="'.$email.'"';

  

  $result = $conn->query($sql);

  

  if($result->num_rows > 0)

  {

	//echo 'This Doctor Already Exist'; 

	$result = 'no';

  }

  else

  {

    $sql = "INSERT INTO wp_promo_doctor_detail (name, email) VALUES ('$name', '$email')";



    if($conn->query($sql) === TRUE)

    {

      //echo 'New Doctor Added Successfully';

	  $result = 'yes';

    }

    else

    {

      echo "Error: " . $sql . "<br>" . $conn->error;

    } 

  }  

  

  echo $result;

   

  die();

}



function generate_promo_code()

{

	global $conn;		$result = '';		$promo_code = $_POST['promo_code'];		$promo_discount = $_POST['promo_discount'];		$promo_comission = $_POST['promo_commision'];		$sql = 'select * from wp_promo_codes where code_name="'.$promo_code.'"';      $result = $conn->query($sql);		if($result->num_rows > 0)    {		$result = 'no';	}	else	{		$sql = "INSERT INTO wp_promo_codes (code_name, code_discount, code_commission, code_status) VALUES ('$promo_code', '$promo_discount','$promo_comission', 'enable')";				if($conn->query($sql) === TRUE)        {				$result = 'yes';        }	}		echo $result;



	die();

}



function edit_assigned_promo_code()

{

	global $conn;

	

	$code_name = $_GET['code_name'];

	

	$doctor_email = $_GET['doctor_email'];	

	

	$promo_codes = array();

 

    $sql = 'select * from wp_promo_codes';

 

    $promo_result = $conn->query($sql);

 

    if($promo_result->num_rows > 0)

    {

	  while($row = $promo_result->fetch_assoc())

	  {

         //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

		 $promo_codes[''.$row['code_name'].''] =  $row['code_name'];

      }

    } 

	

	//print_r($promo_codes);



    if($_POST)

	{

		//print_r($_POST);

		

		$sql = 'UPDATE wp_promo_doctors SET code_name="'.$_POST['promo_code'].'", status="'.$_POST['promo_status'].'" WHERE doctor_email="'.$_POST['doctor_email'].'"';

			if($conn->query($sql) === TRUE) 

			{

				echo 'Promo code Assigned Successfully';

				echo '<script>window.location="admin.php?page=promo_page"</script>';

			}

			else

			{

				echo "Error updating record: " . $conn->error;

			}

        

	}	

	

	$sql = 'select * from wp_promo_doctors where doctor_email="'.$doctor_email.'"';

 

    $result = $conn->query($sql);

	

	$row = $result->fetch_assoc();

	

?>	

	<form action="" method="post" id="edit_promo_code_form" class="elegant-aero">

    <h1>

	  Edit Assigned Promo Code To Doctor

    </h1>

	

	<h3 id="success_msg" style="display:none;">

        <span></span>

    </h3>

	

	<label>

        <span>Doctor Email :</span>

        <input id="doctor_email" type="text" name="doctor_email" placeholder="Ex. save20" value="<?php echo $row['doctor_email']; ?>" readonly>

    </label>

	

	<label>

        <span>Promo Code :</span>

        <select name="promo_code" id="promo_code">

		<?php foreach($promo_codes as $key => $value) { ?>

		 <option value="<?php echo $key; ?>" <?php if($value==$row['code_name']){echo 'selected';} ?>><?php echo $value; ?></option>

		<?php } ?>

		</select>

    </label>  



    <label>

        <span>Status :</span>

        <input type="radio" name="promo_status" value="enable" <?php if($row['status']=='enable'){echo 'checked';}?>/>Enable

		<input type="radio" name="promo_status" value="disable" <?php if($row['status']=='disable'){echo 'checked';}?>/>Disable

    </label>	

    

	<label>

        <span id="loader">&nbsp;</span>

        <input type="submit" class="button" value="Update Code" />

    </label>    

</form>

<?php

}



function edit_promo_code()

{

	

	global $conn;

	

	$code_name = $_GET['code_name'];



    if($_POST)

	{

		//print_r($_POST);

		

		if($code_name==$_POST['promo_code'])

		{

			$sql = 'UPDATE wp_promo_codes SET code_discount="'.$_POST['promo_discount'].'", code_commission="'.$_POST['promo_comission'].'", code_status="'.$_POST['promo_status'].'" WHERE code_name="'.$code_name.'"';

			

			if($conn->query($sql) === TRUE) 

			{

				echo 'Promo code Updated Sucessfully';

				echo '<script>window.location="admin.php?page=main_page"</script>';

			}

			else

			{

				echo "Error updating record: " . $conn->error;

			}

		}

		else

		{

			$sql = 'UPDATE wp_promo_codes SET code_name="'.$_POST['promo_code'].'", code_discount="'.$_POST['promo_discount'].'", code_commission="'.$_POST['promo_comission'].'", code_status="'.$_POST['promo_status'].'" WHERE code_name="'.$code_name.'"';

			if($conn->query($sql) === TRUE) 

			{

				echo 'Promo code Updated Sucessfully';

				echo '<script>window.location="admin.php?page=main_page"</script>';

			}

			else

			{

				echo "Error updating record: " . $conn->error;

			}

		}

        

	}	

	

	$sql = 'select * from wp_promo_codes where code_name="'.$code_name.'"';

 

    $result = $conn->query($sql);

	

	$row = $result->fetch_assoc();

	

?>	

	<form action="" method="post" id="edit_promo_code_form" class="elegant-aero">

    <h1>

	  Edit Promo Code

    </h1>

	

	<h3 id="success_msg" style="display:none;">

        <span></span>

    </h3>

	

	<label>

        <span>Promo Code :</span>

        <input id="promo_code" type="text" name="promo_code" placeholder="Ex. save20" value="<?php echo $row['code_name']; ?>"/>

    </label>

	

	<label>

        <span>Discount :</span>

        <input id="promo_discount" type="text" name="promo_discount" placeholder="Ex. 5%" value="<?php echo $row['code_discount']; ?>"/>

    </label>

   

    <label>

        <span>Commission :</span>

        <input id="promo_comission" type="text" name="promo_comission" placeholder="Ex. 1%" value="<?php echo $row['code_commission']; ?>"/>

    </label>   



    <label>

        <span>Status :</span>

        <input type="radio" name="promo_status" value="enable" <?php if($row['code_status']=='enable'){echo 'checked';}?>/>Enable

		<input type="radio" name="promo_status" value="disable" <?php if($row['code_status']=='disable'){echo 'checked';}?>/>Disable

    </label>	

    

	<label>

        <span id="loader">&nbsp;</span>

        <input type="submit" class="button" value="Update Code" />

    </label>    

</form>

<?php

}



function add_new_code()

{

	?>

	<form action="" method="post" id="generate_promo_code_form" class="elegant-aero" onsubmit="return(generate_promo_code_detail());">

    <h1>

	  Generate Promo Codes For Doctors<span>Please fill all the fields.</span>

    </h1>

	

	<h3 id="success_msg" style="display:none;">

        <span></span>

    </h3>

	

	<label>

        <span>Promo Code :</span>

        <input id="promo_code" type="text" name="promo_code" placeholder="Ex. save20" />

    </label>

	

	<label>

        <span>Discount :</span>

        <input id="promo_discount" type="text" name="promo_discount" placeholder="Ex. 5%" onKeyUp="numericFilter(this);"/>

    </label>

   

    <label>

        <span>Commission :</span>

        <input id="promo_comission" type="text" name="promo_comission" placeholder="Ex. 1%" onKeyUp="numericFilter(this);"/>

    </label>    

    

	<label>

        <span id="loader">&nbsp;</span>

        <input type="submit" class="button" value="Generate Code" />

    </label>    

    </form>

<?php

}



function promo_code_generator_home()

{

	global $conn;

	

	$sql = 'select * from wp_promo_codes';

 

    $result = $conn->query($sql);

?>

<div class="wrap">

<br/>

<a href="admin.php?page=add_new_code_menu_handle" class="likeabutton">Add New Promo Code</a>

<br/><br/>

<table class="wp-list-table widefat fixed striped posts">

 <thead>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Promo code

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Discount

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Commission

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Status

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Actions

		</th>

    </tr>

 </thead>

 

 <tbody id="the-list">

 <?php

 $counter = 1;

 if($result->num_rows > 0)

 {

	 while($row = $result->fetch_assoc())

	 {

		 ?>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $counter++; ?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['code_name'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['code_discount'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['code_commission'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['code_status'];?>

		</th>

		

		<th class="manage-column column-title column-primary desc promo">

		   <a href="admin.php?page=edit_promo_code_menu_handle&action=edit&code_name=<?php echo $row['code_name'];?>">Edit</a>

		   <a href="javascript:delete_promo_code('<?php echo $row['code_name']; ?>');">Delete</a>

		</th>

    </tr>

 <?php        

     }

 }

 ?>

 

 

 </tbody>

 

 <tfoot>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Promo code

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Discount

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Commission

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Status

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Actions

		</th>

    </tr>

 </tfoot>

 

</table>



</div>

<?php

}



function assign_promo_code()

{

  global $conn;	

 

  $promo_codes = $doctors = array();

 

  $sql = 'select * from wp_promo_codes';

 

  $result1 = $conn->query($sql);

 

  $sql = 'select * from wp_promo_doctors';

 

  $result2 = $conn->query($sql);

 

 if($result1->num_rows > 0)

 {

	 while($row = $result1->fetch_assoc())

	 {

		//echo '<pre>'; print_r($row);

        

		//$promo_codes[$row['code_id'].'_'.$row['code_commission'].'_'.$row['code_discount']] =  $row['code_name'];

		

		$promo_all[$row['code_id'].'_'.$row['code_commission'].'_'.$row['code_discount']] = $row['code_name'];

     }

 }

 

 if($result2->num_rows > 0)

 {

	 while($row = $result2->fetch_assoc())

	 {

		//echo '<pre>'; print_r($row);

        

		//$promo_codes[$row['code_id'].'_'.$row['code_commission'].'_'.$row['code_discount']] =  $row['code_name'];

		

		$promo_assigned[] = $row['code_name'];

     }

 }

 

  if($promo_all && $promo_assigned)

  {

    $array_without_code = array_diff($promo_all, $promo_assigned);

  }

  else

  {

	  $array_without_code = $promo_all;

  }

 

  //echo '<br><br><br><br><br><br><pre>'; print_r($array_without_code);

 

  $sql = 'select * from wp_promo_doctor_detail';

 

  $result2 = $conn->query($sql);

 

 if($result2->num_rows > 0)

 {

	 while($row = $result2->fetch_assoc())

	 {

        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

		$doctors[$row['name']] =  $row['email'];

     }

 }

 

?>

  <form action="" method="post" id="add_promo_code_form" class="elegant-aero" onsubmit="return(submit_promo_code_detail());">

    <h1>

	  Assign Promo Codes To Doctors<span>Please fill all the fields.</span>

    </h1>

	

	<h3 id="success_msg" style="display:none;">

        <span></span>

    </h3>

	

    <label>

        <span>Select Doctor Email :</span>

        <!--input id="email" type="email" name="email" placeholder="Enter valid email Address" /-->

		<select name="doctors_emails" id="doctors_emails">

		<option value="-1">--Select Doctor Email--</option>

		<?php foreach($doctors as $key => $value) { ?>

		 <option value="<?php echo $key.'_'.$value; ?>"><?php echo $value; ?></option>

		<?php } ?>

		</select>

    </label>

	

	<label>

        <span>Select Promo Code :</span>

		<?php

		if($array_without_code)

		{

		?>

		<select name="promo_codes" id="promo_codes" onchange="javascript:get_promo_data(this.value);">

		<option value="-1">--Select Promo code--</option>

		<?php foreach($array_without_code as $key => $value) { ?>

		 <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

		<?php } ?>

		</select>

		<?php

		}

		else

		{

		?>

		<h3><span>All Promo Codes Assigned, Please Generate New One to Assign</span></h3>

        <?php 

		} 

		?>

    </label>

	

	<?php

	if($array_without_code)

	{

	?>

	

	<label>

        <span>Discount :</span>

        <input id="promo_discount" type="text" name="promo_discount" placeholder="Ex. 5%" readonly/>

    </label>

   

    <label>

        <span>Commission :</span>

        <input id="promo_comission" type="text" name="promo_comission" placeholder="Ex. 1%" readonly/>

    </label>    

    

	<label>

        <span id="loader">&nbsp;</span>

        <input type="submit" class="button" value="Send" />

    </label> 

    

	<?php

	}

	?>

	

</form>

<?php

}



function add_promo_code()

{

    global $conn;

	

	$sql = 'select * from wp_promo_doctors';

 

    $result = $conn->query($sql);

?>

<div class="wrap">

<br/>

<a href="admin.php?page=assign_promo_code_menu_handle" class="likeabutton">Assign Promo Code To Doctors</a>

<br/><br/>

<table class="wp-list-table widefat fixed striped posts">

 <thead>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Doctor Email

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Promo Code

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Status

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Actions

		</th>

    </tr>

 </thead>

 

 <tbody id="the-list">

 <?php

 $counter = 1;

 if($result->num_rows > 0)

 {

	 while($row = $result->fetch_assoc())

	 {

		 ?>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $counter++; ?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['doctor_email'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['code_name'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['status'];?>

		</th>

		

		<th class="manage-column column-title column-primary desc promo">

		   <a href="admin.php?page=edit_assigned_promo_code_menu_handle&action=edit&doctor_email=<?php echo $row['doctor_email'];?>&code_name=<?php echo $row['code_name'];?>">Edit</a>

		   <a href="javascript:delete_assigned_promo_code('<?php echo $row['code_name']; ?>');">Delete</a>

		</th>

    </tr>

 <?php        

     }

 }

 ?>

 

 

 </tbody>

 

 <tfoot>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Doctor Email

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Promo Code

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Status

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Actions

		</th>

    </tr>

 </tfoot>

 

</table>



</div>

<?php

}



function add_doctors()

{
	
	global $conn;

	

	$sql = 'select * from wp_promo_doctor_detail';

 

    $result = $conn->query($sql);

?>

<div class="wrap">

<br/>

<a href="admin.php?page=add_new_doctor_menu_handle" class="likeabutton">Add New Doctor</a>

<br/><br/>

<table class="wp-list-table widefat fixed striped posts">

 <thead>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		Sr. No

		</th>

		
		<th class="manage-column column-title column-primary sortable desc">

		Doctor Name

		</th>
		

		<th class="manage-column column-title column-primary sortable desc">

		Doctor Email

		</th>

		<!--th class="manage-column column-title column-primary sortable desc">

		Actions

		</th-->

    </tr>

 </thead>

 

 <tbody id="the-list">

 <?php

 $counter = 1;

 if($result->num_rows > 0)

 {

	 while($row = $result->fetch_assoc())

	 {

		 ?>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $counter++; ?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['name'];?>

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		<?php echo $row['email'];?>

		</th>

		

		<!--th class="manage-column column-title column-primary desc promo">

		   <a href="admin.php?page=edit_doctor_detail_menu_handle&action=edit&doctor_email=<?php echo $row['email'];?>">Edit</a>

		   <a href="javascript:delete_assigned_promo_code('<?php echo $row['code_name']; ?>');">Delete</a>

		</th-->

    </tr>

 <?php        

     }

 }

 ?>

 

 

 </tbody>

 

 <tfoot>

	<tr>

		<th class="manage-column column-title column-primary sortable desc">

		Sr. No

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Doctor Name

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Doctor Email

		</th>

		

		<!--th class="manage-column column-title column-primary sortable desc">

		Status

		</th>

		

		<th class="manage-column column-title column-primary sortable desc">

		Actions

		</th-->

    </tr>

 </tfoot>

 

</table>



</div>



<?php

}

?>