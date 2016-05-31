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
          <li class="crumb-active"><a href="javascript:void(0);">Admin User</a></li>
          <li class="crumb-icon"><a href="<?php echo $base_url; ?>"><span class="glyphicon glyphicon-home"></span></a></li>         
          <li class="crumb-trail">Admin User</li>
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
			
			<a href="<?php echo $base_url;?>admin_user/add/" class="btn btn-alert pull-right"><i class="fa fa-plus"></i> Add Admin User</a>
			
		<!--	<span class="panel-heading">  
			 
			 
			 <a style="margin:0px 14px 0 0;" class="skin-modal-open btn bg-purple2 pull-right" href="<?php echo $base_url; ?>regusers/download"> <span  class="glyphicons glyphicons-download_alt"></span> DOWNLOAD </a>
			 </span>-->
		</div>
		<div class="clearfix">&nbsp;</div>
			  
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading"> <span class="panel-title"> <span class="glyphicon glyphicon-list-alt"></span> Admin User Listing </span> 
			  
			
			</div>
			
            <div class="panel-body">
			  <form action="<?php echo $base_url."admin_user/deletes";?>" method="post" enctype="multipart/form-data" id="form">
			  <INPUT TYPE="hidden" NAME="hidPgRefRan" VALUE="<?php echo rand();?>">
   
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Select</th>
					   <th>Role</th>
					   <th>Name</th>
					  <th>Email</th> 
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
					<td><input name="selected[]" id="selected[]" value="<?php echo $result[$i]->admin_id; ?>" type="checkbox"  class="minimal-red"></td>
					<td><?php echo $this->admin_user_model->get_role($result[$i]->role_id)?></td>
					<td><?php echo $result[$i]->admin_name; ?></td>
					<td><?php echo $result[$i]->admin_email; ?></td>					
					
					<!--	<td><?php 
							 $adate=$result[$i]->added_date;
							 $rr=date("d-m-Y",strtotime($adate)); 
							 echo $rr;
				?></td>-->
					
				
				<td>
									<?php if($result[$i]->status=='1')
										{ 
										?>
												<a  title="Active"  href="<?php echo $base_url."admin_user/edit/"; ?><?php echo $result[$i]->admin_id ?>/approval">
											<p>
<font color="green"><b><i>Active</i></b></font></p>
										</a> 
										<?php
										}
										else
										{ 
										?>
										<a style="font-color:red" title=" Inactive"  href="<?php echo $base_url."admin_user/edit/"; ?><?php echo $result[$i]->admin_id ?>/approval">
											<p>
<font color="red"><b><i>Inactive</i></b></font></p>
										</a>
												
										<?php
										} ?>
									</td>
									
					<?php /*<td><?php if($result[$i]->enable=='0')
				{ ?>
						<a class="btn bg-purple2" title="Active" onclick="reguserenabled(<?php echo $result[$i]->id; ?>,<?php echo $result[$i]->enable;?>);">
					Active</a>
				<?php }
				else
				{ ?>
						<a class="btn bg-purple2" title="Inactive" onclick="reguserenabled(<?php echo $result[$i]->id; ?>,<?php echo $result[$i]->enable;?>);">
					Inactive</a>
				<?php }?></td>*/?>
				
				
				<?php  
			
				/*	if($this->session->userdata('adminId') !='')
					{
		   	$uid = $this->session->userdata('adminId');
			$getuser['data'] = $this->footer->getuser($uid);
			$category = $getuser['data'][0]->role_id;
			$usercategory = $this->footer->usercategory($category);
			$permission1=$usercategory[0]->module_id;
			$permission1 = explode(',',$permission1);
		   */
					?> 
					<?php // if(in_array('1',$permission1)){ ?>
					<td><a title="Edit" href="<?php echo $base_url."admin_user/edit/"; ?><?php echo $result[$i]->admin_id; ?>">
					<i class="fa fa-pencil"></i></a></td>
				
				<!--	<?php // } else { ?> 
					<td><a class="btn bg-purple2" title="Edit" href="javascript:void(0);">
					Access Denied</a></td>-->
				<?php // }
				//} ?> 
				</tr>
				<?php
                  } } else {
					  echo 'No Users Found';
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
/*function reguserenabled(id,enablestatus){
	var url = '<?php echo $base_url ?>/regusers/reguserenabled/';
		//window.location = url;
		$.ajax({
		url:url,
		type:'post',
		data:{id:id, enablestatus:enablestatus},
		success:function(msg)
		{
			//alert(msg);
			location.reload();
		}
		});
}*/
function approve(url){
					var t = confirm('Are you sure you want to approve Register Admin User?');
					if(t){
						window.location.href = url;
					} else {
						return false; 
					}

				}

				function disapprove(url){
					var t = confirm('Are you sure you want to Disapprove Register Admin User?');
					if(t){
						window.location.href = url;
					} else {
						return false; 
					}

				}
</script>
 
     