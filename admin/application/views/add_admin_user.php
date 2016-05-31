<?php include('include/header.php');?>
<!-- Start: Main -->
<div id="main">   
 <?php include('include/sidebar_left.php');?>
 
  <!-- Start: Content -->
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
		  <li class="crumb-active"><a href="javascript:void(0);"> Add Admin User</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>admin_user/lists">Admin user</a></li>
          <li class="crumb-trail">Add a Admin User</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Add Admin User </span> </div>
            <div class="panel-body">
                      
<?php if($this->session->flashdata('L_strErrorMessage')) 
  { ?>
		  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> <?php echo $this->session->flashdata('L_strErrorMessage'); ?>
                                    </div>
                                    
                                    
                  
  <?php } 


  ?>


<?php if($this->session->flashdata('flashError')!='') { ?>
<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error!</b> <?php echo $this->session->flashdata('flashError'); ?>
                                    </div>
<?php } if($L_strErrorMessage != ""){?>
	<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error!</b> <?php echo $L_strErrorMessage; ?>
                                    </div>
<?php } ?>

    <div id="validator"  class="alert alert-danger alert-dismissable" style="display:none;">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error &nbsp; </b><span id="error_msg1"></span>
                                    </div>
    
            <div class="col-md-12">			
			
            <form role="form" id="form" method="post" action="<?php echo $base_url;?>admin_user/add" enctype="multipart/form-data">
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="add_admin_user">
	
					
					
						<div class="form-group">
                  <label for="admin_role">Admin Role<span style="color:red"> *<span></label>
				  	<span id='prod1'> 
				<select name='role_id' id="role_id" class="form-control jobtext">
				<option value="" selected>-- Select Admin Role--</option>
				<?php for($i=0;$i<count($allrole);$i++)
				{
				?>
				<option value='<?php echo $allrole[$i]->role_id; ?>'>
					<?php echo $allrole[$i]->role_name; ?>
				</option>
				<?php
				}
				?>
				</select>
				</span>
				</div>	
					
					
		<div class="form-group">
					<label for="inputEmail">Name: <span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="admin_name" name="admin_name" class="form-control" value="<?php echo $admin_name;?>">
					</div>
				</div>
			<!--	<div class="form-group">
					<label for="inputEmail">First Name:</label>
					<div class="">
					  <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">Last Name:</label>
					<div class="">
					  <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $lastname;?>">
					</div>
				</div> 
				-->
				<div class="form-group">
					<label  for="inputEmail">Email:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="admin_email" name="admin_email" class="form-control"  value="<?php echo $admin_email;?>">
					</div>
				</div>
			
				<!--<div class="form-group">
					<label  for="inputEmail">Password:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="password" id="admin_password" name="admin_password" class="form-control" value="<?php echo $admin_password;?>">
					</div>
				</div>
				<div class="form-group">
					<label  for="inputEmail">Confirm Password:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="password" id="conpassword" name="conpassword" class="form-control" >
					</div>
				</div>-->
				<div class="form-group">
					<label for="inputEmail">Mobile: <span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $phone;?>" onkeypress="return numbersonly(event)" maxlength="12">
					</div>
				</div>
				
				
					<div class="form-group">
					<label  for="inputEmail">Status:</label>
					<div class="">
                    <div class="radio">
                        <label>
                        <input type="radio" id="active" name="status" value="1" checked="check"> 
                         Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="active" name="status"  value="0">
                          Deactive
                        </label>
                      </div>                     
					</div>
				</div> 
		    <!--		<div class="form-group">
					<label  for="inputEmail">Gender:</label>
					<div class="">
                    <div class="radio">
                        <label>
                        <input type="radio" id="gender" name="gender" value="1" checked="check"> 
                         Male
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="gender" name="gender"  value="0">
                          Female
                        </label>
                      </div>                     
					</div>
				</div> 
				
				<div class="form-group">
					<label for="inputEmail">DOB:</label>
					<div class="">
					  <input type="text" id="dob" name="dob" class="form-control" value="<?php echo $dob;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">Company:</label>
					<div class="">
					  <input type="text" id="company" name="company" class="form-control" value="<?php echo $company;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">Website:</label>
					<div class="">
					  <input type="text" id="website" name="website" class="form-control" value="<?php echo $website;?>">
					</div>
				</div>
				
				 <div class="form-group">
					<label for="inputEmail">State:</label>
					<div class="">
					 <span id='prod1'>                          
                       
					      <select name='state' id="state" class="form-control jobtext" onchange="get_city(this.value)">
				<option value=''>Select State</option>
				<?php for($i=0;$i<count($state_list);$i++)
				{
				?>
				<option value='<?php echo $state_list[$i]->sid; ?>'>
				<?php echo $state_list[$i]->sname; ?>
				</option>
				<?php
				}
				?>
				</select>
			
                           
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">City:</label>
					<div class="">
					 <span id='prod2'>
                          <select name='city' id="city" class="form-control jobtext">
				<option value=''>Select City</option>
				<?php for($i=0;$i<count($city_list);$i++)
				{
				?>
				<option value='<?php echo $city_list[$i]->city_id; ?>'>
				<?php echo $city_list[$i]->city_name; ?>
				</option>
				<?php
				}
				?>
				</select>                          
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">Address:</label>
					<div class="">
					  <textarea class="form-control" name="address" id="address"><?php echo $address;?></textarea>
					</div>
				</div>
				
			  -->
                <div class="form-group">
                  <input class="submit btn bg-purple pull-right" type="submit" value="Submit" onclick="javascript:validate();return false;"/>
				  <a href="<?php echo $base_url;?>admin_user/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
                </div>
              </form>
			  
            </div>
          </div>
			
          
        </div>
       </div> 
      </div>
    </div>
  </section>
  <!-- End: Content --> 
  
   
 <?php include('include/sidebar_right.php');?>
 </div>
<!-- End #Main --> 
<?php include('include/footer.php')?>

<script>
	function validate(){
		
		
		
		var role_id= $("#role_id").val();
		if(role_id==''){
			
			$("#error_msg1").html("Please Select admin Role.");
			$("#validator").css("display","block");
			return false;
		}
		
		var admin_name= $("#admin_name").val();
		if(admin_name==''){
			
			$("#error_msg1").html("Please Enter The admin Name.");
			$("#validator").css("display","block");
			return false;
		}
		
		
		
		
		
		var admin_email= $("#admin_email").val();
		if(admin_email==''){
			$("#error_msg1").html("Please Enter The Email.");
			$("#validator").css("display","block");
			return  false;
		}
		var em = document.getElementById('admin_email');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(em.value)) {
			
			$("#error_msg1").html("Please Provide a Valid Email Address.");
			$("#validator").css("display","block");
			em.focus;
			return false;
		}
		


		var admin_password= $("#admin_password").val();
		if(admin_password==''){
			
			$("#error_msg1").html("Please Enter The Password.");
			$("#validator").css("display","block");
			return false;
		}
		var conpassword= $("#conpassword").val();
		if(conpassword==''){
			
			$("#error_msg1").html("Please Enter The Confirm Password.");
			$("#validator").css("display","block");
			return false;
		}
		if(conpassword != admin_password){
			
			$("#error_msg1").html("Do not match Confirm Password.");
			$("#validator").css("display","block");
			return false;
		}

	
			
		var phone= $("#phone").val();
		if(phone==''){
			$("#error_msg1").html("Please Enter Mobile Number.");
			$("#validator").css("display","block");
			return  false;
		}
		var phone = document.getElementById('phone');
		var filter = /^[0-9]{10}$/;
		if (!filter.test(phone.value)) {
			
			$("#error_msg1").html("Please Enter 10 Digit Mobile Number.");
			$("#validator").css("display","block");
			phone.focus;
			return false;
		}
		
		
		var active=$("#active").val();
		if(active==''){			
			$("#error_msg1").html("Please Choose One Option Active");
			$("#validator").css("display","block");
			return false;
		}
			
		$('#form').submit();
	}
	
	function get_city(cid)
{
	//alert(cid);
		//country id
		var url = '<?php echo $base_url ?>/regusers/show_city/';
		//window.location = url;
		$.ajax({
		url:url,
		type:'post',
		data:'cid='+cid,
		success:function(msg)
		{
			//alert(msg);
			document.getElementById('prod2').innerHTML = msg ;
		}
		});
}
function numbersonly(e){
    var unicode=e.charCode? e.charCode : e.keyCode
    if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
         if (unicode < 45 || unicode > 57) //if not a number
            return false //disable key press
    }
	}
</script>
		<script type="text/javascript" src="<?php echo $base_url_views; ?>js/jquery.validate.js"></script>  
<script type="text/javascript" src="<?php echo $base_url_views; ?>js/bootstrap-datepicker.js"></script> 
<script type="text/javascript">
jQuery(document).ready(function () {
	  "use strict";
     Core.init();     
     Ajax.init();     
	 $('#dob').datepicker()
 
     });
</script>