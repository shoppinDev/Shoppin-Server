
<?php include('include/header.php');?>

<!-- Start: Main -->
<div id="main"> 
  
 <?php include('include/sidebar_left.php');?>
 
  <!-- Start: Content -->
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
		  <li class="crumb-active"><a href="javascript:void(0);"> Add Module</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>module/lists">Module</a></li>
          <li class="crumb-trail">Add a Module</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Add Module </span> </div>
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
<?php }  ?>

				<div id="validator"  class="alert alert-danger alert-dismissable" style="display:none;">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error &nbsp; </b><span id="error_msg1"></span>
                                    </div>
    
    
            <div class="col-md-12">			
			
            <form role="form" id="form" method="post" action="<?php echo $base_url;?>module/add" enctype="multipart/form-data">
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="add_module">
				
     
				
                <div class="form-group">
                  <label style="width:100%; margin:15px 0 5px;" for="Module_name">Module Name<span style="color:red"> *<span></label>
                  <input id="module_name" name="module_name" type="text" class="form-control" placeholder="Enter Module Name"  />
                </div>
                <div class="form-group">
                  <input class="submit btn bg-purple pull-right" type="submit" value="Submit" onclick="javascript:validate();return false;"/>
				   <a href="<?php echo $base_url;?>module/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
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
		
	
		
		var module_name = $("#module_name").val();
		if(module_name == ''){
			//alert('Please Enter Module ');
			$("#error_msg1").html("Please Enter Module Name.");
			$("#validator").css("display","block");
			return false;
		}

		var pa=document.getElementById('Module_name');
		var p = /[a-zA-Z\s-, ]+$/; 
		if(!p.test(pa.value))
			{
				//alert("Please Enter Valid Module ");
				$("#error_msg1").html("Please Enter Valid Module Name.");
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
