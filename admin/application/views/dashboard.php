<body class="dashboard-page"><script> var boxtest = localStorage.getItem('boxed'); if (boxtest === 'true') {document.body.className+=' boxed-layout';} </script> 
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" > <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" > <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" > <!--<![endif]-->
<?php include('include/header.php');?><!-- Start: Main --><div id="main">    <?php include('include/sidebar_left.php');?>  <!-- Start: Content -->  <section id="content_wrapper">    <div id="topbar">      <div class="topbar-left">        <ol class="breadcrumb">          <li class="crumb-active"><a href="javascript:void(0);">Dashboard</a></li>          <li class="crumb-icon"><a href="javascript:void(0);"><span class="glyphicon glyphicon-home"></span></a></li>          <li class="crumb-link"><a href="javascript:void(0);">Home</a></li>          <li class="crumb-trail">Dashboard</li>        </ol>      </div>        </div>   


<?php if($this->session->userdata('role_id')=='1'){?>

 <div id="content">    



 <div id="widget-dropdown" class="row">        				
 <div class="col-sm-3"> 
 <div class="panel panel-overflow mb10">           


		<div class="panel-body pn pl20">         
			<div class="icon-bg"><i class="fa fa-bar-chart-o text-teal"></i></div> 
			<h2 class="mt15 lh15 text-teal2"><b><?php echo  $this->admin->list_admin();?></b></h2>           
			<h5 class="text-muted"><a style="text-decoration:none;" href="<?php echo $base_url; ?>admin_user/lists">Admin User</a></h5>    
        </div>    

		

	 </div>        
	 </div>    
	 <div class="col-sm-3">    
	 <div class="panel panel-overflow mb10">   
	 <div class="panel-body pn pl20">            
	 <div class="icon-bg"><i class="fa fa-comments-o text-blue"></i></div>         
     <h2 class="mt15 lh15 text-blue2"><b><?php echo  $this->admin->list_merchant();?></b></h2>   
	 <h5 class="text-muted"><a style="text-decoration:none;" href="<?php echo $base_url; ?>merchant/lists">Merchant</a></h5>     
	 </div>          
	 </div>   
     </div>			
	 <div class="col-sm-3">   
	 <div class="panel panel-overflow mb10">     
	 <div class="panel-body pn pl20">            
	 <div class="icon-bg"><i class="fa fa-bar-chart-o text-teal"></i></div>          
	 <h2 class="mt15 lh15 text-teal2"><b><?php echo  $this->admin->list_customers();?></b></h2>    
	 <h5 class="text-muted"><a style="text-decoration:none;" href="<?php echo $base_url; ?>customer/lists">Customers</a></h5>  
	 </div>     
     </div>   
     </div>      
     </div>        
	 </div>	
	
	<div class="col-md-12">  


	 <div class="panel">         
	 <div class="panel-heading"> 
	 <span class="panel-title"><i class="fa fa-pencil"></i>Customers</span>    
	 <ul class="nav panel-tabs">       
	<!-- <li class=""><a data-toggle="tab" href="#tab1">Statistics</a></li>      
	 <li class=""><a data-toggle="tab" href="#tab2">Social</a></li>    -->    
	 <li class="active"><a data-toggle="tab" href="#tab3">Customers</a></li>    
	 </ul>     
	 </div>            <div class="panel-body pn">              <div class="tab-content border-none pn">               			   <div class="tab-pane p15" id="tab1">                  <div class="row">                    <div class="col-lg-4 visible-lg pl5">                      Coming Soon.!!                    </div>                  </div>                </div>				                <div class="tab-pane" id="tab2">                  <div class="row">                    <div class="col-sm-9 p20 pb35">                      Coming Soon.!!!                    </div>                  </div>                </div>				              
	<div class="tab-pane p15 active" id="tab3">                  <div id="datatable_wrapper" class="dataTables_wrapper form-inline no-footer"><div class="row"><div class="col-sm-12 datatables-toolbar"><div class="pull-right"></div><div class="pull-left"></div><div class="clearfix"></div></div></div>				  				  <table id="datatable" class="table table-widget table-striped table-checklist mt15 dataTable no-footer" role="grid">                    <?php  					$currentuser = $this->admin->currentuser();					?>					<thead>						<tr role="row">							<th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Task: activate to sort column ascending">Name</th>							<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Progress: activate to sort column ascending">Email</th>							<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Progress: activate to sort column ascending">Phone</th>							<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Skills: activate to sort column ascending">Status</th>							<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Notes: activate to sort column ascending">Join Date</th>						</tr>                    </thead>                    <tbody>					<?php if($currentuser != '' && count($currentuser) > 0) {  					foreach($currentuser as $pro) { ?> 						<tr role="row" class="odd">							<td class="text-slash text-muted"><small><?php echo $pro->customer_name; ?></small></td>							<td class="text-slash text-muted"><small><?php echo $pro->customer_email; ?></small></td>							<td class="text-slash text-muted"><small><?php echo $pro->customer_mobile; ?></small></td>							<td class="text-slash text-muted"><small><?php if($pro->is_active=="1"){ echo "Active"; }else { echo "De-Active"; } ?></small></td>							<td class="text-slash text-muted"><small><?php echo $pro->added_date; ?></small></td>						</tr>						<?php }} else { ?>							<tr role="row" class="odd">							 							<td colspan="4"class="text-slash text-muted"><small>No Recent Activity.!!</small></td>						</tr>					<?php }  ?>																	</tbody>                  </table>				  				 </div>                </div>              </div>            </div>                     </div>        </div> 

	<?php } else{?>
	
	<div class="tab-pane p15 active" id="tab3">    
		<h2>Welcome to Shoppin.</h2>
	</div>
	<?php }?>
	</section> 


	 <?php include('include/sidebar_right.php');?> </div><!-- End #Main --> 
<?php include('include/footer.php')?></body></html>