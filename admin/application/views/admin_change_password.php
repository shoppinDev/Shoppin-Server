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
		  <li class="crumb-active"><a href="#"> Edit Admin Password<?php echo $admin_name;?></a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>admin_user/lists">Admin User</a></li>
          <li class="crumb-trail">Edit Admin Password</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Edit Admin Password <?php echo $admin_name;?> </span> </div>
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
    
     <form role="form" id="form" method="post" action="<?php echo $base_url;?>admin_user/change_pwd" enctype="multipart/form-data" >
 				
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="change_password">
			<INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $id;?>">
    
					<div class="form-group">
					<label for="inputEmail">Old Password:<span style="color:red"> *<span></label>
					<div class="">
					 <?//php print_r($this->admin_user_model->getpswd($this->session->userdata('adminId')));die; ?>
					  <input type="password"  value="<?php  
					  echo $this->admin_user_model->getpswd($this->session->userdata('adminId')); ?>" title="Old Password" readonly class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label  for="inputEmail">New Password:<span style="color:red"> *<span></label>
					<div class="">
					  <input type="password" name="password" id="Password" title="new Password" placeholder="Enter New Password" class="form-control">
					</div>
				</div>
					<div class="form-group">
					<label  for="inputEmail">Confirm Password:<span style="color:red"> *<span></label>
					<div class="">
					 <input type="password" name="repassword" class="form-control" id="Repassword" title="Re-password" placeholder="Enter Confirm Password">
					</div>
				</div>
			
			
	
                <div class="form-group">
                  <input class="submit btn bg-purple pull-right" type="submit" value="Update Password" onclick="javascript:validate();return false;"/>
				  <!--<a href="<?php echo $base_url;?>admin_user/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>-->
                </div>
				<div style="clear:both;"></div>
              </form>
    </div>
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
		


	

		
		
		var admin_password= $("#Password").val();
		if(admin_password==''){
			
			$("#error_msg1").html("Please Enter The  New Password.");
			$("#validator").css("display","block");
			return false;
		}
		var admin_repassword= $("#Repassword").val();
		if(admin_repassword==''){
			
			$("#error_msg1").html("Please Enter The  Confirm Password.");
			$("#validator").css("display","block");
			return false;
		}
		if(admin_password!=admin_repassword)
		{
			$("#error_msg1").html(" New Password and Confirm Password must be same.");
			$("#validator").css("display","block");
			return false;
			
		}

		
		
		
		
		
		$('#form').submit();
	}
function numbersonly(e){
    var unicode=e.charCode? e.charCode : e.keyCode
    if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
         if (unicode < 45 || unicode > 57) //if not a number
            return false //disable key press
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