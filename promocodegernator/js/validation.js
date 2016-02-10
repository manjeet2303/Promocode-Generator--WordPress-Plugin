function validation()
{
  var name = jQuery('#name').val();
  
  var email = jQuery('#email').val();
  
  //var msg = jQuery('#message').val();
  
  if(!name)
  {
    alert('Please Enter Referral Agent name');
	jQuery('#name').focus();
	return false;
  }
  
  if(!email)
  {
    alert('Please Enter Referral Agent Email');
	jQuery('#email').focus();
	return false;
  }
  
  /*
  if(!msg)
  {
    alert('Please Enter Your Message');
	jQuery('#message').focus();
	return false;
  }
  */
  
  return true;
}

function submit_data()
{
  if(validation())
  {
     //if all data are valid then make an ajax call
	 
	 //var data = jQuery('#elegant-aero').serialize()
	 
	 //console.log(data);
	 
	 //alert('validation is yes');
	 
	 var name = jQuery('#name').val();
  
     var email = jQuery('#email').val();
  
    // var msg = jQuery('#message').val();
	 
	 jQuery('#loader').html('<img width="50" src="http://pittmanpillow.com/wp-content/plugins/promocodegernator/images/loading.gif"/>');
	 
	 
	 jQuery.ajax({
	       type : "post",
	       url: "http://pittmanpillow.com/wp-admin/admin-ajax.php",
           data :{action: "add_doctor_data",name: name, email: email},		  
		   success: function(result)
		   {
             console.log(result);
			 
			 jQuery('#loader').html('&nbsp;');
			 
			 if(result=="no")
			 {
			   jQuery('#success_msg').show();
			
     		   jQuery('#success_msg span').html('This Referral Agent Already Exist');    		   
			 }
			 else
			 {
				jQuery('#success_msg').show();
			
     		    jQuery('#success_msg span').html('New Referral Agent added Succesfully');
				
				jQuery('#elegant-aero')[0].reset();
				
				setTimeout(function()
				{
                
     				window.location = 'admin.php?page=doctors_page';
                
				}, 2000);
				
				
			 }
			 
           },
		   error: function(error)
		   {
		     //cosnole.log(error);
		     alert('Connection is lost');
		   }
		 });
		
		return false;
	 
  }
  else
  {
     return false;
  }
}

function submit_promo_code_detail()
{
  var select_value = jQuery('#doctors_emails').val();
  
  if(select_value == -1)
  {
	  alert('Please Select Referral Agent Email');
	  return false;
  }
  
  var promo_code = jQuery('#promo_codes').val();
  
  if(promo_code == -1)
  {
	  alert('Please Select Referral Code');
	  return false;
  }
  
  var email = jQuery('#doctors_emails').find('option:selected').text();
  
  var promo_code = jQuery('#promo_codes').find('option:selected').text();
  
  var promo_discount = jQuery('#promo_discount').val();
  
  var promo_commision = jQuery('#promo_comission').val();
   
  
  jQuery('#loader').html('<img width="50" src="http://pittmanpillow.com/wp-content/plugins/promocodegernator/images/loading.gif"/>');
  
  jQuery.ajax({
	       type : "post",
	       url: "http://pittmanpillow.com/wp-admin/admin-ajax.php",
           data :{ action: "send_promo_code", email: email, promo_code: promo_code, promo_discount: promo_discount, promo_commision: promo_commision
		   },		  
		   success: function(result)
		   {
             console.log(result);

			 jQuery('#loader').html('&nbsp;');
			 
			 if(result=="no")
			 {
			   jQuery('#success_msg').show();
			
     		   jQuery('#success_msg span').html('This Referral Code Already Assigned to this Referral Agent');    		   
			 }
			 else
			 {
				jQuery('#success_msg').show();
			
     		    jQuery('#success_msg span').html('Referral Code sent on Referral Agent Email Succesfully');
				
				jQuery('#add_promo_code_form')[0].reset();
				
				window.location = 'admin.php?page=assign_promo_code_menu_handle';
			 }
			 
           },
		   error: function(error)
		   {
		     //cosnole.log(error);
		     alert('Connection is lost');
		   }
		 });  
		 
		 return false;
}

function generate_promo_code_detail()
{
	var promo_code = jQuery('#promo_code').val();
  
    var promo_discount = jQuery('#promo_discount').val();
  
    var promo_commision = jQuery('#promo_comission').val();
	
	if(!promo_code)
  {
    alert('Please Enter Valid Referral Code');
	jQuery('#promo_code').focus();
	return false;
  }	
  
  if(!promo_discount)
  {
    alert('Please Enter Valid Referral Code Discount');
	jQuery('#promo_discount').focus();
	return false;
  }	
  
  if(!promo_commision)
  {
    alert('Please Enter Valid Referral Code Commision');
	jQuery('#promo_comission').focus();
	return false;
  }	 
  
  jQuery('#loader').html('<img width="50" src="http://pittmanpillow.com/wp-content/plugins/promocodegernator/images/loading.gif"/>');
  
  jQuery.ajax({
	       type : "post",
	       url: "http://pittmanpillow.com/wp-admin/admin-ajax.php",
           data :{ action: "generate_promo_code", promo_code: promo_code, promo_discount: promo_discount, promo_commision: promo_commision },		  
		   success: function(result)
		   {
             console.log(result);

			 jQuery('#loader').html('&nbsp;');
			 
			 
			 if(result=="no")
			 {
			   jQuery('#success_msg').show();
			
     		   jQuery('#success_msg span').html('This Referral Code already Generated');    		   
			 }
			 else
			 {
				jQuery('#success_msg').show();
			
     		    jQuery('#success_msg span').html('Referral Code Generated Succesfully');
				
				jQuery('#generate_promo_code_form')[0].reset();
				
				window.location = 'admin.php?page=main_page';
			 }
			 
			 
           },
		   error: function(error)
		   {
		     //cosnole.log(error);
		     alert('Connection is lost');
		   }
		 });  
	
	return false;
}

function get_promo_data(option_vaue)
{
	console.log(option_vaue);
	
	var option_value =  option_vaue;
	
	if(option_vaue==-1)
	{
		alert('Please Select Referral Code');
		
		return false;
	}	
	
	
	var arr = option_vaue.split('_');
	
	console.log(arr);
	
	jQuery('#promo_discount').val(arr[2]);
	
	jQuery('#promo_comission').val(arr[1]);
	
	return false;
}

function delete_promo_code(promo_code)
{
	var result = confirm('Are you Sure to Delete '+ promo_code + ' Referral Code Permanently');
	
	console.log(result);
	
	if(result)
	{
		jQuery.ajax({
	       type : "post",
	       url: "http://pittmanpillow.com/wp-admin/admin-ajax.php",
           data :{ action: "delete_promo_code", code_name: promo_code },		  
		   success: function(result)
		   {
             console.log(result);

			 		 
			 if(result=="yes")
			 {
			   window.location = 'admin.php?page=main_page'; 		   
			 }
			 else
			 {
				alert('Please try again something goes Wrong on the Server');
			 }
			 
			 
           },
		   error: function(error)
		   {
		     //cosnole.log(error);
		     alert('Connection is lost');
		   }
		 }); 		
	}
	
}

function numericFilter(txb)
{
   if(parseInt(txb.value)>99)
   {
	   txb.value = "";
   }
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function delete_assigned_promo_code(promo_code)
{
    var result = confirm('Are you Sure to Delete '+ promo_code + ' Referral Code Permanently');
	
	console.log(result);
	
	if(result)
	{
		jQuery.ajax({
	       type : "post",
	       url: "http://pittmanpillow.com/wp-admin/admin-ajax.php",
           data :{ action: "delete_assigned_promo_code", code_name: promo_code },		  
		   success: function(result)
		   {
             console.log(result);

			 		 
			 if(result=="yes")
			 {
			   window.location = 'admin.php?page=promo_page'; 		   
			 }
			 else
			 {
				alert('Please try again something goes Wrong on the Server');
			 }
			 
			 
           },
		   error: function(error)
		   {
		     //cosnole.log(error);
		     alert('Connection is lost');
		   }
		 }); 		
	}
}