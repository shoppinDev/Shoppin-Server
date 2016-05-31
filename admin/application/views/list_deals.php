<?php include('include/header.php');?>


<!-- Start: Main -->
<div id="main"> 
  
 <?php include('include/sidebar_left.php');?>
  <!-- Start: Content -->
  <!-- Start: Content -->
  <section id="content_wrapper">
    <div id="topbar">
      <div class="topbar-left">
        <ol class="breadcrumb">
          <li class="crumb-active"><a href="#">Deals</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>         
          <li class="crumb-trail">Deals</li>
        </ol>
      </div>
    </div>
    <div id="content">
      
      <div class="row">
                
<?php if($this->session->flashdata('L_strErrorMessage')) 
  { ?>
		  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> <?php echo $this->session->flashdata('L_strErrorMessage',5); ?>
                                    </div>
                                    
                                    
                  
  <?php } 


  ?>


<?php if($this->session->flashdata('flashError')!='') { ?>
<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error!</b> <?php echo $this->session->flashdata('flashError',5); ?>
                                    </div>
<?php }  ?>

		<div class="col-md-12">
			<a href="javascript:void('0');" onclick="deletecountry();" class="btn btn-danger pull-right"  style="margin-left:10px"><i class="fa fa-trash-o"></i> Delete</a>
			<a href="<?php echo $base_url;?>deals/add/" class="btn btn-alert pull-right"><i class="fa fa-plus"></i> Add Deals</a>
		</div>
		<div class="clearfix">&nbsp;</div>
			  
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-list-alt"></span> Deals Listing </span> </div>
            <div class="panel-body">
			  <form action="<?php echo $base_url."deals/deletes";?>" method="post" enctype="multipart/form-data" id="form">
			  <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
   
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Select</th>
					   <th>Deal ID</th>
					  <th>Title</th>
					   <th>Category Name</th>
					    <th>Subcategory Name</th>
						 <th>Merchant Name</th>
                         <th>Shop Name</th>
						  <th>Status</th>	
                      <th>Edit</th>                      
                    </tr>
                  </thead>
				  
                  <tbody>
                <?php
                  if($result){
					for($i=0;$i<count($result);$i++){
				?>
				<tr>
				
				
				
				
					<td><input name="selected[]" id="selected[]" value="<?php echo $result[$i]->deal_id ; ?>" type="checkbox"  class="minimal-red"></td>
			<td><?php echo $result[$i]->deal_id; ?></td>
			
		      	<td><?php echo $result[$i]->deal_title; ?></td>
				
				
					<td><?php echo $this->deals_model->get_categoryname($result[$i]->deal_category); ?></td>
					
						<td><?php echo $this->deals_model->get_subcategoryname($result[$i]->deal_subcategory); ?></td>
						
							<td><?php echo $this->deals_model->get_merchant($result[$i]->merchant_id); ?></td>
							
							<td><?php echo $this->deals_model->get_shop($result[$i]->shop_id); ?></td>
							
							<td>
							
							
								<?php if($result[$i]->is_active=='2')
										{ 
										?>
				<a  title="Pending approval"  href="<?php echo $base_url."deals/edit/"; ?><?php echo $result[$i]->deal_id ?>/approval">
											<b><i>Pending approval</i></b>
										</a> 
										<?php }elseif($result[$i]->is_active=='1')
										{ 
										?>
										<a  title="Active "  href="<?php echo $base_url."deals/edit/"; ?><?php echo $result[$i]->deal_id ?>/approval">
											<p>
<font color="green"><b><i>Active</i></b></font></p>
										</a> 
										<?php }else
										{ 
										?>
										<a style="font-color:red" title="Inactive "  href="<?php echo $base_url."deals/edit/"; ?><?php echo $result[$i]->deal_id ?>/approval">
											<p>
<font color="red"><b><i>Inactive</i></b></font></p>
										</a> 
										<?php }?>
							<!--<select id="is_approve" name="is_approve" onchange="approve('<?php echo $base_url."deals/userstatus/";?><?php echo $result[$i]->deal_id ?>',this.value);" >
				<option value="2"<?php if($result[$i]->is_active=='2'){ echo 'selected'; } ?>>Pending approval </option>
				<option value="1"<?php if($result[$i]->is_active=='1'){ echo 'selected'; } ?>>Active</option>
				<option value="0"<?php if($result[$i]->is_active=='0'){ echo 'selected'; } ?>>Inactive</option>
				</select>--></td>
			
					<td><a class="" title="Edit" href="<?php echo $base_url."deals/edit/"; ?><?php echo $result[$i]->deal_id ; ?>">
					<i class="fa fa-pencil"></i></a></td>
					
				</tr>
				<?php
				  } } else {
					  echo 'No Subcategory Found';
				  }
                ?>
				                 
                  </tbody>
                </table>
              </div>
			  </form>
			</div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      
      
    </div>
  </section>
  
  <?php include('include/sidebar_right.php');?>
 </div>
<!-- End #Main --> 
<?php include('include/footer.php')?>


<!-- DATA TABES SCRIPT -->
	<link href="<?php echo $base_url_views; ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $base_url_views; ?>plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo $base_url_views; ?>plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<link href="<?php echo $base_url_views; ?>plugins/iCheck/minimal/_all.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $base_url_views; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	
 <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $('#example1').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
		
	   $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
		
      });
    </script>
      

<script>
function deletecountry(){
	var checked = $("#form input:checked").length > 0;
    if (!checked)
	{
        alert("Please select at least one record to delete");
        return false;
    }
	else
	{
		var conf = confirm("Do you want to delete?");
		if(conf == true){
			$('#form').submit(); 
			return true;
		}else{
			return false;
		}
		
	}
	 
    }
</script>
<script type="text/javascript">
	$(document).ready(function($){
		$('#reset').click(function(){
			var base_url = '<?php echo $base_url.'subcategory/lists'; ?>';
			window.location = base_url;
		});
		
		$("#sbutton").click(function(){
			var countryname = $("#countryname").val();
			
			if(countryname=='')
			{
				alert("Please Enter atleast one search condition.");
				return false;
			}
			else
			{
				return true;
			}
		});

		$.ajax({
		   url:'<?php echo $base_url; ?>subcategory/ajaxlist_country',
		   type:'POST',
		   data:'',
		   success:function(msg)
		   {
				//alert(msg);
				var  c = msg.split(",");
				var availableTags = [msg];	
				$( "#countryname" ).autocomplete({
					source: c
				});
			}
		
		
		});
	});
</script>
<script>
function approve(url,is_approve){
	//alert(url);
		//var is_approve = document.getElementById('is_approve').value;	
		//alert(is_approve);
		if(is_approve=='1'){
		var t = confirm('Are you sure you want to Active Register Deal ?');	
			}
		else if(is_approve=='0'){
		var t = confirm('Are you sure you want to Inactive Register Deal ?');
				}
			else{
		var t = confirm('Are you sure you want to Pending approval Register Deal ?');
				}
			if(t){
			window.location.href=url+"/"+is_approve;
				} 
			else {
				return false; 
						}
					}
</script>
     