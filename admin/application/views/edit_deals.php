
<?php include('include/header.php');?>

<!-- Start: Main -->
<div id="main"> 
  
 <?php include('include/sidebar_left.php');?>
 
  <!-- Start: Content -->
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
		  <li class="crumb-active"><a href="#"> Edit a Deals</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>
          <li class="crumb-link"><a href="<?php echo $base_url; ?>deals/lists">Deals</a></li>
          <li class="crumb-trail">Edit a Deals</li>
        </ol>
      </div>
    </div>
    <div id="content">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-lock"></span> Edit Deals </span> </div>
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
            <form role="form" id="form" method="post" action="<?php echo $base_url;?>deals/edit/<?php echo $deal_id;?>" enctype="multipart/form-data">
			<INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
			<INPUT TYPE="hidden" NAME="action" VALUE="edit_deals">
			<INPUT TYPE="hidden" NAME="deal_id" VALUE="<?php echo $deal_id; ?>">
			<?php if($approval!=''){ ?>
			<INPUT TYPE="hidden" NAME="approval" VALUE="yes">
			<?php } else{?>
			<INPUT TYPE="hidden" NAME="approval" VALUE="">
			<?php } ?>
			
				<div class="form-group">
                  <label for="Merchant">Merchant<span style="color:red"> *<span></label>
				
				<select name='merchant_id' id="Merchant_id" class="form-control jobtext" onchange="get_shop(this.value);">
				<option value="">-- Select Merchant Name--</option>
				<?php for($i=0;$i<count($allmerchant);$i++)
				{
				?>
				<option value='<?php echo $allmerchant[$i]->merchant_id; ?>'<?php if($allmerchant[$i]->merchant_id==$merchant_id){ echo 'selected';} ?>>
					<?php echo $allmerchant[$i]->merchant_name; ?>
				</option>
				<?php
				}
				?>
				</select>
				
				</div>	
			
				
						<div class="form-group">
                  <label for="categoryname">Shop<span style="color:red"> *<span></label>
				  	<span id='shop'> 
				<select name='Shop_id' id="Shop_id" class="form-control jobtext">
				<option value="">-- Select Shop--</option>
				<?php for($i=0;$i<count($shop);$i++)
				{
				?>
				<option value='<?php echo $shop[$i]->shop_id; ?>'<?php if($shop[$i]->shop_id==$Shop_id){ echo 'selected';} ?>>
					<?php echo $shop[$i]->shop_name; ?>
				</option>
				<?php
				}
				?>
				</select>
				</span>
				</div>	
				<div class="form-group">
                  <label for="categoryname">Category<span style="color:red"> *<span></label>		  	 
				<select name='deal_category' id="category_id" class="form-control jobtext" onchange="get_subcategory(this.value);" >
				<option value="">-- Select Category--</option>
				<?php for($i=0;$i<count($allcategorylist);$i++)
				{
				?>
				   <option value='<?php echo $allcategorylist[$i]->category_id; ?>'<?php if($allcategorylist[$i]->category_id==$deal_category){ echo 'selected';} ?>>
					<?php echo $allcategorylist[$i]->category_name; ?>
				</option>
				<?php
				}
				?>
				</select>		
				</div>		
						<div class="form-group">
                  <label for="categoryname">Subcategory<span style="color:red"> *<span></label>
				  	<span id='prod1'> 
				<select name='deal_subcategory' id="subcategoryid" class="form-control jobtext">
				<option value="" selected>-- Select Subcategory--</option>
				<?php for($i=0;$i<count($subcategory);$i++)
				{
				?>
				<option value='<?php echo $subcategory[$i]->subcategory_id; ?>'<?php if($subcategory[$i]->subcategory_id==$deal_subcategory){ echo 'selected';} ?>>
					<?php echo $subcategory[$i]->subcategory_name; ?>
				</option>
				<?php
				}
				?>
				</select>
				</span>
				</div>		
				 <div class="form-group">
                  <label for="subcategoryname">Title<span style="color:red"> *<span></label>
                  <input id="deal_title" name="deal_title" type="text" value="<?php echo $deal_title; ?>" class="form-control" placeholder="Enter Subcategory Name" required />
                </div>	
				
				<div class="form-group">
					<label for="inputEmail">Description:<span style="color:red"> *<span></label>
					<div class="">
					  <textarea class="form-control" name="deal_description" id="deal_description"><?php echo $deal_description; ?></textarea>
					</div>
				</div>
			<!--	
				<div class="form-group">
                  <label for="startdate">Start date:</label>
                  <input id="deal_startdate" name="deal_startdate" type="text" value="<?php echo $deal_startdate; ?>" class="form-control" placeholder="Enter Startdate"  />
                </div>
				
				
				    <div class="form-group">
                  <label for="enddate">End date:</label>
                  <input id="deal_enddate" name="deal_enddate" type="text"  value="<?php echo $deal_enddate; ?>" class="form-control" placeholder="Enter Enddate"   />
                </div>
				
				-->
				
					<div class="form-group">
					<label  for="inputEmail">Deal Type</label>
				
                    <div class="form-group">
                  <label for="enddate">Start Date & Time:<span style="color:red"> *<span></label>
                  <input id="d_startdate" name="deal_startdate" type="text" class="form-control" placeholder="Enter Start date"   value="<?php echo $deal_startdate; ?>" />
					</div>
                      <div class="form-group">
                  <label for="enddate">End Date & Time:<span style="color:red"> *<span></label>
                  <input id="d_enddate" name="deal_enddate" type="text" class="form-control" placeholder="Enter End date" value="<?php echo $deal_enddate; ?>"  />
					</div>                
					</div>
					
				<?php $day=explode(',',$all_days); ?>
						<div class="form-group">
						<label  for="inputEmail">All Days</label>
                        <div class="checkbox">
                        <label>
						
                       <input type="checkbox" id="single" name="all_days[]" value="Sunday"<?php if (in_array('Sunday',$day, TRUE)){ echo "checked"; } ?>>Sunday
                        </label>
                      </div>
						<div class="checkbox">
                        <label>
                      <input type="checkbox" id="single" name="all_days[]" value="Monday"<?php if (in_array('Monday',$day, TRUE)){ echo "checked"; } ?> >Monday
                        </label>
                      </div>    
					 <div class="checkbox">
                        <label>
                     <input type="checkbox" id="single" name="all_days[]" value="Tuesday"<?php if (in_array('Tuesday',$day, TRUE)){ echo "checked"; } ?> >Tuesday
                        </label>
                      </div>    
					       <div class="checkbox">
                        <label>
                    <input type="checkbox" id="single" name="all_days[]" value="Wednesday"<?php if (in_array('Wednesday',$day, TRUE)){ echo "checked"; } ?> >Wednesday
                        </label>
                      </div>    
					     <div class="checkbox">
                        <label>
                       <input type="checkbox" id="single" name="all_days[]" value="Thursday"<?php if (in_array('Thursday',$day, TRUE)){ echo "checked"; } ?> >Thursday
                        </label>
                      </div>    
					       <div class="checkbox">
                        <label>
							<input type="checkbox" id="single" name="all_days[]" value="Friday"<?php if (in_array('Friday',$day, TRUE)){ echo "checked"; } ?> >Friday
                        </label>
                      </div>    
					       <div class="checkbox">
                        <label>
                    	  <input type="checkbox" id="single" name="all_days[]" value="Saturday"<?php if (in_array('Saturday',$day, TRUE)){ echo "checked"; } ?> >Saturday
                        </label>
                      </div>    
					</div>
					
					
						<div class="form-group">
					<label  for="inputEmail">Usage</label>
				
                    <div class="radio">
                        <label>
                        <input type="radio" id="single" name="deal_usage" value="0"<?php if($deal_usage==0){ echo 'checked'; }?>> 
                         single
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="multiple" name="deal_usage"  value="1"<?php if($deal_usage==1){ echo 'checked'; }?>>
                          multiple
                        </label>
                      </div>                   
					</div>
					
					<div class="form-group">
					<label  for="inputEmail">Deal based on Location </label>
                    <div class="radio">
                        <label>
                        <input type="radio" id="single" name="location" value="0"<?php if($location==0){ echo 'checked'; }?>> 
                         1 Shop
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="multiple" name="location"  value="1"<?php if($location==1){ echo 'checked'; }?>>
                          All Shop
                        </label>
                      </div>                   
					</div>
					
					<div class="form-group">
                  <label for="subcategoryname">Deal Price<span style="color:red"> *<span></label>
                  <input id="deal_amount" name="deal_amount" type="text" class="form-control" placeholder="Enter Deal Price" value="<?php echo $deal_amount; ?>" />
                </div>	
				
					<div class="form-group">
					<label  for="inputEmail">Discount</label>
                    <div class="radio">
                        <label>
                        <input type="radio" id="single" name="discount_type" value="0"<?php if($discount_type==0){ echo 'checked'; }?> > 
                         Amount
                        </label>
                        <label>
                          <input type="radio" id="multiple" name="discount_type"  value="1"<?php if($discount_type==1){ echo 'checked'; }?>>
                          Percentage
                        </label>
                      </div> 
						<div class="">
                        <label style="width: 200px;">
                         <input style="float: left; width: 190px;"  id="discountvalue" name="discount_value" type="text" class="form-control" placeholder="Enter Value"  value="<?php echo $discount_value; ?>" /><span style="color: red; float: left; margin: -2px 0px 0px 3px;"> *<span>
                        </label>
                      </div> 					  
					</div>
					
					<!--
					<div class="form-group">
					<label  for="inputEmail">Status:</label>
					<div class="">
                    <div class="radio">
                        <label>
                        <input type="radio" id="active" name="is_active" value="1"<?php if($is_active=='1'){echo 'checked';}?>> 
                         Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="active" name="is_active"  value="0"<?php if($is_active=='0'){echo 'checked';}?>>
                          Deactive
                        </label>
                      </div>                     
					</div>
				</div> 
               	-->
				
				<?php if($approval!=''){ ?>
					<div class="form-group">
					 	<?php if($is_active=='0' ||$is_active=='2')
										{ 
										?>
										<input class="submit btn bg-purple pull-right" id="is_active" name="is_active" type="button" value="Active" onclick="approve('<?php echo $base_url."deals/userstatus/";?><?php echo $deal_id; ?>',1);"/>
               
				  
										<?php }else{ ?>
										
										     <input class="submit btn bg-purple pull-right" id="is_active" type="button" id="is_active" name="is_active"  value="Inactive" onclick="deapprove('<?php echo $base_url."deals/userstatus/";?><?php echo $deal_id; ?>',0);"/>
										<?php } ?>
										
				  <a href="<?php echo $base_url;?>deals/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
                </div>
					
				
				<?php } else{ ?>
				<div class="form-group">
                  <input class="submit btn bg-purple pull-right" type="submit" value="Update" onclick="javascript:validate();return false;"/>
				  <a href="<?php echo $base_url;?>deals/lists" class="submit btn bg-purple pull-right" style="margin-right: 10px;" />Cancel</a>
                </div>
                <?php } ?>
                
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
<script type="text/javascript" src="<?php echo $base_url_views; ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $base_url_views; ?>js/bootstrap.min.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url_views; ?>js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url_views;?>css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="<?php echo $base_url_views; ?>js/date.js"></script>

<script type="text/javascript">
jQuery(document).ready(function () {
	  "use strict";
     Core.init();     
     Ajax.init();     
	 $('#deal_startdate').datepicker({
         format: 'yyyy-mm-dd',
  //  startDate: '-3d'
});
	 $('#deal_enddate').datepicker({
    format: 'yyyy-mm-dd',
   // startDate: '-3d'
});


 $('#d_startdate').datetimepicker({
   // format: 'yyyy-mm-dd',
    //startDate: '-3d'
});


	$('#d_enddate').datetimepicker({
  
});


     });
</script>
<script>
function approve(url,is_approve){
	//alert(is_approve);
		//var is_approve = document.getElementById('is_approve').value;	
		//alert(is_approve);
		if(is_approve=='1'){
		 alert('Are you sure you want to Active Register Deal ?');
			window.location.href='<?php echo $base_url ?>/deals/userstatus/<?php echo $deal_id ?>/'+is_approve;		 
			}
		
}
					function deapprove(url,is_approve){
	//alert(url);
		//var is_approve = document.getElementById('is_approve').value;	
		//alert(is_approve);
		if(is_approve=='0'){
		alert('Are you sure you want to Inactive Register Deal ?');
			window.location.href='<?php echo $base_url ?>/deals/userstatus/<?php echo $deal_id ?>/'+is_approve;	
				} 
			 
						
					}
</script>
 <script>
 function get_shop(mid)
{
	//alert(mid);
		//country id
		var url = '<?php echo $base_url ?>deals/get_shop_data';
		//window.location = url;
		$.ajax({
		url:url,
		type:'post',
		data:'mid='+mid,
		success:function(msg)
		{
			//alert(msg);
			document.getElementById('shop').innerHTML = msg ;
		}
		});
}
</script>
 <script>
 function get_subcategory(cid)
{
	//alert(cid);
		//country id
		var url = '<?php echo $base_url ?>deals/getall_subcategory';
		//window.location = url;
		$.ajax({
		url:url,
		type:'post',
		data:'cid='+cid,
		success:function(msg)
		{
			//alert(msg);
			document.getElementById('prod1').innerHTML = msg ;
		}
		});
}
</script>
<script>
	function validate(){
	
		var Merchant_id = $("#Merchant_id").val();
		if(Merchant_id == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Select Merchant Name.");
			$("#validator").css("display","block");
			return false;
		}
		
		var Shop_id = $("#Shop_id").val();
		if(Shop_id == ''){
			$("#error_msg1").html('Please Select Shop Name.');
			$("#validator").css("display","block");
			return false;
		}

		
			var category_id = $("#category_id").val();
		if(category_id == ''){
			$("#error_msg1").html('Please Select Category.');
			$("#validator").css("display","block");
			return false;
		}
	
			var subcategoryid = $("#subcategoryid").val();
		if(subcategoryid == ''){
			$("#error_msg1").html('Please Select SubCategory.');
			$("#validator").css("display","block");
			return false;
		}
	
		
		var deal_title = $("#deal_title").val();
		if(deal_title == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter Tital.");
			$("#validator").css("display","block");
			return false;
		} 
		
			var deal_description = $("#deal_description").val();
		if(deal_description == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter Description.");
			$("#validator").css("display","block");
			return false;
		} 
		
				var deal_startdate = $("#deal_startdate").val();
			if(deal_startdate == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter Start Date.");
			$("#validator").css("display","block");
			return false;
		} 
		
			
	var deal_enddate = $("#deal_enddate").val();
		if(deal_enddate == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter End Date.");
			$("#validator").css("display","block");
			return false;
		} 
		
		
		
			var d_startdate = $("#d_startdate").val();
			if(d_startdate == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter Deal Type Start Date.");
			$("#validator").css("display","block");
			return false;
			} 
		
			
		var d_enddate = $("#d_enddate").val();
		if(d_enddate == ''){
			//alert('Please Enter Category ');
			$("#error_msg1").html("Please Enter Deal Type End Date.");
			$("#validator").css("display","block");
			return false;
						}	
		
		var discountvalue = $("#discountvalue").val();
		if(discountvalue == ''){
		//alert('Please Enter Category ');
		$("#error_msg1").html("Please Enter Value.");
		$("#validator").css("display","block");
		return false;
				}
		if(Date.parse(d_startdate) > Date.parse(d_enddate)){
			
		$("#error_msg1").html("End Date should be Greater than Start date.");
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
