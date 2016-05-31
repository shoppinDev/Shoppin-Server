
<?php include('include/header.php');?>

<!-- Start: Main -->
<div id="main"> 
  
 <?php include('include/sidebar_left.php');?>
 
  <!-- Start: Content -->
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
		  <li class="crumb-active"><a href="#"> Add a Subcategory</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>subcategory/lists">Subcategory</a></li>
          <li class="crumb-trail">Add a Subcategory</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Add Subcategory </span> </div>
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
			
            <form role="form" id="form" method="post" action="<?php echo $base_url;?>subcategory/add" enctype="multipart/form-data">
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="add_subcategory">
				
	
		
				<div class="form-group">
                  <label for="categoryname">Category<span style="color:red"> *<span></label>
				  	<span id='prod1'> 
				<select name='category_id' id="categoryid" class="form-control jobtext">
				<option value="" selected>-- Select Category--</option>
				<?php for($i=0;$i<count($allcategorylist);$i++)
				{
				?>
				<option value='<?php echo $allcategorylist[$i]->category_id; ?>'>
					<?php echo $allcategorylist[$i]->category_name; ?>
				</option>
				<?php
				}
				?>
				</select>
				</span>
				</div>	
                <div class="form-group">
                  <label for="subcategoryname">Subcategory Name<span style="color:red"> *<span></label>
                  <input id="subcategoryname" name="subcategory_name" type="text" class="form-control" placeholder="Enter Subcategory Name" required />
                </div>		
                <div class="form-group">
                  <input class="submit btn bg-purple pull-right" type="submit" value="Submit" onclick="javascript:validate();return false;"/>
				  <a href="<?php echo $base_url;?>subcategory/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
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
		/* var countryids = $("#countryids").val();
		if(countryids == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Select Country.");
			$("#validator").css("display","block");
			return false;
		} */
		
		var categoryid = $("#categoryid").val();
		if(categoryid == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Select Category.");
			$("#validator").css("display","block");
			return false;
		}
		
		var subcategoryname = $("#subcategoryname").val();
		if(subcategoryname == ''){
			$("#error_msg1").html('Please Enter Subcategory Name.');
			$("#validator").css("display","block");
			return false;
		}

		/*var pa=document.getElementById('subcategoryname');
		var p = /[a-zA-Z\s-, ]+$/; 
		if(!p.test(pa.value))
			{
				$("#error_msg1").html("Please Enter Valid Subcategory Name.");
				$("#validator").css("display","block");
				return false;
			}*/
			
		
		
		var sortorder = $("#sortorder").val();
		if(sortorder == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter Sortorder.");
			$("#validator").css("display","block");
			return false;
		} 
		
		 /* var pageurl = $("#pageurl").val();
		if(pageurl == ''){
			//alert('Please Enter Category ');
			$("#error_msg").html("Please Enter pageurl ");
			return false;
		} */
		
		$('#form').submit();
	}
		function selectcat(id)
			{
			//alert(id);
		  var url = '<?php echo $base_url ?>subcategory/getcat/';
				$.ajax({
				url:url,
				type:'post',
				data:'id='+id,
				success:function(msg)
				{
					document.getElementById('prod1').innerHTML = msg ;  
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
