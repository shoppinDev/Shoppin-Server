<?php include('include/header.php');?>
<!-- Start: Main -->
<div id="main"> 
  
 <?php include('include/sidebar_left.php');?>
 <style>
 .resp-tabs-list li{text-transform:none !important;}
 .form-control.input-sm{font-weight:normal;}
 </style>
  <!-- Start: Content -->
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
		  <li class="crumb-active"><a href="#"> Edit Merchant<?php echo $merchant_name;?></a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>merchant/lists">Merchant</a></li>
          <li class="crumb-trail">Edit Merchant</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Edit Merchant <?php echo $merchant_name;?> </span> </div>
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

  <div class="resp-tabs-container">
   
    <div class="static-page-data">
    
     <form role="form" id="form" method="post" action="<?php echo $base_url;?>merchant/edit/<?php echo $merchant_id; ?>" enctype="multipart/form-data" >
 				
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="edit_merchant">
			<INPUT TYPE="hidden" NAME="hiddenaction" VALUE="<?php echo $merchant_id;?>">
    <?php if($deapproval!=''){ ?>
			<INPUT TYPE="hidden" NAME="approval" VALUE="yes">
			<?php } else{?>
			<INPUT TYPE="hidden" NAME="approval" VALUE="">
			<?php } ?>
	<!--		<div class="form-group">
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
					<label for="inputEmail">Merchant Name:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="username" name="merchant_name" class="form-control" value="<?php echo $merchant_name;?>">
					</div>
				</div>
				<div class="form-group">
					<label  for="inputEmail">Email:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="email" name="merchant_email" class="form-control" value="<?php echo $merchant_email;?>">
					</div>
				</div>
			
					<div class="form-group">
					<label  for="inputEmail">Password:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="password" id="password" name="merchant_password" class="form-control" value="<?php echo $merchant_password;?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail">Phone:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="phone" name="merchant_mobile" class="form-control" value="<?php echo $merchant_mobile;?>" onkeypress="return numbersonly(event)" maxlength="12">
					</div>
				</div>
				
				
						<div class="form-group">
					<label for="inputEmail">Vat:</label>
					<div class="">
					  <input type="text" id="merchant_vat" name="merchant_vat" class="form-control" value="<?php echo $merchant_vat;?>">
					</div>
				</div>
				
						<div class="form-group">
					<label for="inputEmail">Tax:</label>
					<div class="">
					  <input type="text" id="merchant_tax" name="merchant_tax" class="form-control" value="<?php echo $merchant_tax;?>">
					</div>
				</div>
						<div class="form-group">
					<label for="inputEmail">Pancard Number:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="text" id="pan" name="merchant_pan" class="form-control" value="<?php echo $merchant_pan;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">Address:</label>
					<div class="">
					  <textarea class="form-control" name="merchant_add" id="merchant_add"><?php echo $merchant_add; ?></textarea>
					</div>
				</div>
				  <div class="form-group">
					<label for="inputEmail">City:</label>
					<div class="">
					  <input type="text" id="merchant_city" name="merchant_city" class="form-control" value="<?php echo $merchant_city;?>">
					</div>
				</div>
				  <div class="form-group">
					<label for="inputEmail">State:</label>
					<div class="">
					  <input type="text" id="merchant_State" name="merchant_State" class="form-control" value="<?php echo $merchant_State;?>">
					</div>
				</div>
				
				  <div class="form-group">
					<label for="inputEmail">Country:</label>
					<div class="">
					  <input type="text" id="merchant_country" name="merchant_country" class="form-control" value="<?php echo $merchant_country;?>">
					</div>
				</div>
				  <div class="form-group">
					<label for="inputEmail">zip:</label>
					<div class="">
					  <input type="text" id="merchant_zip" name="merchant_zip" class="form-control" value="<?php echo $merchant_zip;?>">
					</div>
				</div>
				<!--<div class="form-group">
					<label  for="inputEmail">Status:</label>
					<div class="">
                    <div class="radio">
                        <label>
                        <input type="radio" id="Active" name="is_approve" value="1" <?php if($is_approve=='1'){echo 'checked';}?>> 
                         Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="Active" name="is_approve"  value="0" <?php if($is_approve=='0'){echo 'checked';}?>>
                          Deactive
                        </label>
                      </div>                     
					</div>
				</div>-->
		<!--		
				<div class="form-group">
					<label for="inputEmail">DOB<?php echo $dob;?>:</label>
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
				<option value='<?php echo $state_list[$i]->sid; ?>'  <?php if($city_list[$i]->sid==$state){echo 'selected';}?>>
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
				<option value='<?php echo $city_list[$i]->city_id; ?>' <?php if($city_list[$i]->city_id==$city){echo 'selected';}?>>
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
                	<?php if($deapproval!=''){ ?>
					<div class="form-group">
					 	<?php if($is_approve=='0' || $is_approve=='2')
										{ 
										?>
										
						<input class="submit btn bg-purple pull-right" id="is_active" name="is_active" type="button" value="Active" onclick="approve('<?php echo $base_url."merchant/userstatus/";?><?php echo $merchant_id; ?>',1);"/>
						
										<?php }else{ ?>
										
										 <input class="submit btn bg-purple pull-right" id="is_active" type="button" id="is_active" name="is_active"  value="Inactive" onclick="deapprove('<?php echo $base_url."merchant/userstatus/";?><?php echo $merchant_id; ?>',0);"/>
										  
										<?php } ?>
				  <a href="<?php echo $base_url;?>merchant/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
                </div>
					
				
				<?php } else{ ?>
				<div class="form-group">
                <input class="submit btn btn-alert pull-right" type="submit" value="Update" onclick="javascript:validate();return false;"/>
				  <a href="<?php echo $base_url;?>merchant/lists" class="submit btn btn-alert pull-right" style="margin-right: 10px;" />Cancel</a>
                </div>
                <?php } ?>

				<div style="clear:both;"></div>
              </form>
    </div>
    
  
    
 
    
  </div>

    
    
            <?php /*?><div class="col-md-12">			
			
            <form role="form" id="form" method="post" action="<?php echo $base_url;?>regusers/edit/<?php echo $id; ?>" enctype="multipart/form-data" >
 				
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="edit_regusers">
			<INPUT TYPE="hidden" NAME="hiddenaction" VALUE="<?php echo $id;?>">
    
			<div class="form-group">
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
				<div class="form-group">
					<label  for="inputEmail">Email:</label>
					<div class="">
					  <input type="text" id="email" name="email" class="form-control" value="<?php echo $email;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail">User Name:</label>
					<div class="">
					  <input type="text" id="username" name="username" class="form-control" value="<?php echo $username;?>">
					</div>
				</div>
				<div class="form-group">
					<label  for="inputEmail">Password:</label>
					<div class="">
					  <input type="password" id="password" name="password" class="form-control" value="<?php echo $password;?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail">Phone:</label>
					<div class="">
					  <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $phone;?>" onkeypress="return numbersonly(event)" maxlength="12">
					</div>
				</div>
				<div class="form-group">
					<label  for="inputEmail">Gender:</label>
					<div class="">
                    <div class="radio">
                        <label>
                        <input type="radio" id="gender" name="gender" value="1" <?php if($gender='1'){echo 'checked';}?>> 
                         Male
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="gender" name="gender"  value="0" <?php if($gender='0'){echo 'checked';}?>>
                          Female
                        </label>
                      </div>                     
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail">DOB<?php echo $dob;?>:</label>
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
				<option value='<?php echo $state_list[$i]->sid; ?>'  <?php if($city_list[$i]->sid==$state){echo 'selected';}?>>
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
				<option value='<?php echo $city_list[$i]->city_id; ?>' <?php if($city_list[$i]->city_id==$city){echo 'selected';}?>>
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
				
				
                
                <div class="form-group">
                  <input class="submit btn bg-purple pull-right" type="submit" value="Submit" onclick="javascript:validate();return false;"/>
				  <a href="<?php echo $base_url;?>regusers/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
                </div>
				
              </form>
			  
            </div><?php */?>
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
			
			$("#error_msg1").html("Please Enter The Merchant Name.");
			$("#validator").css("display","block");
			return false;
		}
		
		
		
		
		var email= $("#email").val();
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
	
		
	
		var password= $("#password").val();
		if(password==''){
			
			$("#error_msg1").html("Please Enter The Password.");
			$("#validator").css("display","block");
			return false;
		}		

		var phone= $("#phone").val();
		if(phone==''){
			$("#error_msg1").html("Please Enter Phone Number.");
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
		var pan= $("#pan").val();
		if(pan==''){
			$("#error_msg1").html("Please Enter Pancard Number.");
			$("#validator").css("display","block");
			return  false;
		}
		var pan = document.getElementById('pan');
		var filter = /^[A-Za-z0-9]{10}$/;
		if (!filter.test(pan.value)) {
			
			$("#error_msg1").html("Please Enter 10 digit Alpha Numeric Pancard Number.");
			$("#validator").css("display","block");
			phone.focus;
			return false;
		}

		
		var Active=$("#Active").val();
		if(Active==''){			
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
<script>
function approve(url,is_approve){
	
		if(is_approve=='1'){
		 alert('Are you sure you want to Active Register Merchant ?');
			window.location.href='<?php echo $base_url ?>/merchant/userstatus/<?php echo $merchant_id ?>/'+is_approve;		 
			}
		
}
					function deapprove(url,is_approve){
	
		if(is_approve=='0'){
		alert('Are you sure you want to Inactive Register Merchant ?');
			window.location.href='<?php echo $base_url ?>/merchant/userstatus/<?php echo $merchant_id ?>/'+is_approve;	
				} 
			 
						
					}
</script>
 

<link href="<?php echo $base_url_views;?>checkout/easy-responsive-tabs.css" rel="stylesheet" />
<script src="<?php echo $base_url_views;?>checkout/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
    $(document).ready(function () {
        $('.horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

       
    });
	</script>
			<script type="text/javascript" src="<?php echo $base_url_views; ?>js/jquery.validate.js"></script>  
<script type="text/javascript" src="<?php echo $base_url_views; ?>js/bootstrap-datepicker.js"></script> 
<script type="text/javascript">
jQuery(document).ready(function () {
	  "use strict";
     Core.init();     
     Ajax.init();     
	 $('#startdate').datepicker()
	 $('#enddate').datepicker()
     });
</script>