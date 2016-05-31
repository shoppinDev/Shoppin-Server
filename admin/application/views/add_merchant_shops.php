<?php include('include/header.php');?>
<!-- Start: Main -->
<div id="main">   
 <?php include('include/sidebar_left.php');?>
 
  <!-- Start: Content -->
  <?php $this->load->library('session');?>
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
		  <li class="crumb-active"><a href="javascript:void(0);"> Add Merchant Shop</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>merchant_shops/lists/<?php echo $this->session->userdata('m_id');?>">Shop</a></li>
          <li class="crumb-trail">Add Merchant Shop</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Add Merchant Shop </span> </div>
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
			
            <form role="form" id="form" method="post" action="<?php echo $base_url;?>merchant_shops/add/<?php echo $this->session->userdata('m_id');?>" enctype="multipart/form-data">
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="add_merchant_shop">
	      <INPUT TYPE="hidden" NAME="merchant_id" VALUE="<?php echo $this->session->userdata('m_id');?>">
             <?php /* <div class="form-group">
						<label  for="select">User Category :</label>
						<div class="">
						  <span id='prod2'>
                          
                           <select id="category" name="ucategory" class="form-control">
								<option value="">Select User Category</option>
								<?php for($i=0;$i<count($utype_list);$i++)
					{
					?>
										<option value='<?php echo $utype_list[$i]->id; ?>' >
					<?php echo $utype_list[$i]->cname; ?>
					</option>
								<?php  }  ?>
						   </select>
                           
						</span>
						</div>
					</div>*/?>
					
					
					
		        <div class="form-group">
					<label for="inputEmail">Shop Name:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="username" name="shopname" class="form-control" value="<?php echo $shopname;?>">
					</div>
				</div>
						
				<div class="form-group">
					<label for="inputEmail">Shop Address:<span style="color:red"> *<span></label>
					<div class="">
					  <textarea class="form-control" name="Shop_address" id="shop_address"><?php echo $Shop_address; ?></textarea>
					</div>
				</div>
						
				 <div class="form-group">
					<label for="inputEmail">City:</label>
					<div class="">
					  <input type="text" id="shop_city" name="shop_city" class="form-control" value="<?php echo $shop_city;?>">
					</div>
				</div>
				  <div class="form-group">
					<label for="inputEmail">State:</label>
					<div class="">
					  <input type="text" id="shop_State" name="shop_State" class="form-control" value="<?php echo $shop_State;?>">
					</div>
				</div>
				  <div class="form-group">
					<label for="inputEmail">Country:</label>
					<div class="">
					  <input type="text" id="shop_country" name="shop_country" class="form-control" value="<?php echo $shop_country;?>">
					</div>
				</div>
				  <div class="form-group">
					<label for="inputEmail">zip:</label>
					<div class="">
					  <input type="text" id="shop_zip" name="shop_zip" class="form-control" value="<?php echo $shop_zip;?>">
					</div>
				</div>
				
						
						
				<div class="form-group">
					<label for="inputEmail">Shop Latitude:</label>
					<div >
					  <input type="text" id="Latitude" name="Latitude" class="form-control" value="<?php echo $Latitude; ?>" onkeypress="return numbersonly(event)">
					</div>
				</div>
					<div class="form-group">
					<label for="inputEmail">Shop Longitude:</label>
					<div class="">
					  <input type="text" id="Longitude" name="Longitude" class="form-control" value="<?php  echo $Longitude;?>" onkeypress="return numbersonly(event)">
					</div>
				</div>
				<div class="form-group">
				 <a href="" onclick="newvindow()">Click here </a> to find Lattitude and Longitude
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
			<!--	<div class="form-group">
					<label  for="inputEmail">Email:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="email" name="email" class="form-control"  value="<?php echo $email;?>">
					</div>
				</div>-->
			
				<!--<div class="form-group">
					<label  for="inputEmail">Password:</label>
					<div class="">
					  <input type="password" id="password" name="password" class="form-control" value="<?php echo $password;?>">
					</div>
				</div>
				<div class="form-group">
					<label  for="inputEmail">Confirm Password:</label>
					<div class="">
					  <input type="password" id="conpassword" name="conpassword" class="form-control" >
					</div>
				</div> -->
				<div class="form-group">
					<label for="inputEmail">Phone:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $phone;?>" onkeypress="return numbersonly(event)" maxlength="12">
					</div>
				</div>
				
				<!--<div class="form-group">
					<label for="inputEmail">Address:</label>
					<div class="">
					  <textarea class="form-control" name="shop_add" id="shop_add"><?php echo $shop_add; ?></textarea>
					</div>
				</div>-->
				 
				
			
				<!--
					<div class="form-group">
					<label  for="inputEmail">Status:</label>
					<div class="">
                    <div class="radio">
                        <label>
                        <input type="radio" id="active" name="active" value="1" checked="check"> 
                         Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="active" name="active"  value="0">
                          Deactive
                        </label>
                      </div>                     
					</div>
				</div> -->
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
                  <input class="submit btn btn-alert pull-right" type="submit" value="Submit" onclick="javascript:validate();return false;"/>
				  <a href="<?php echo $base_url;?>merchant_shops/lists/<?php echo $this->session->userdata['m_id']; ?>" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
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
		
		
		var username= $("#username").val();
		if(username==''){
			
			$("#error_msg1").html("Please Enter The Shop Name.");
			$("#validator").css("display","block");
			return false;
		}
		
		var shop_address= $("#shop_address").val();
		if(shop_address==''){
			
			$("#error_msg1").html("Please Enter The Shop address.");
			$("#validator").css("display","block");
			return false;
		}
		
		
		
	/*	var email= $("#email").val();
		if(email==''){
			$("#error_msg1").html("Please Enter The Email.");
			$("#validator").css("display","block");
			return  false;
		}
		var em = document.getElementById('email');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(em.value)) {
			
			$("#error_msg1").html("Please Provide a Valid Email Address.");
			$("#validator").css("display","block");
			em.focus;
			return false;
		}
*/		
		var phone= $("#phone").val();
		if(phone==''){
			$("#error_msg1").html("Please Enter Phone Number.");
			$("#validator").css("display","block");
			return  false;
		}
		var phone = document.getElementById('phone');
		var filter = /^[0-9]{10}$/;
		if (!filter.test(phone.value)) {
			
			$("#error_msg1").html("Please Enter 10 Digit Phone Number.");
			$("#validator").css("display","block");
			phone.focus;
			return false;
		}
		/*
		var active=$("#active").val();
		if(active==''){			
			$("#error_msg1").html("Please Choose One Option Active");
			$("#validator").css("display","block");
			return false;
		}
			*/
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

<script language="javascript" type="text/javascript">
function newvindow() {
		window.open("http://www.latlong.net/convert-address-to-lat-long.html");
}
</script>