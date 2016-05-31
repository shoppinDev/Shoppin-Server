<?php
$front_base_url = $this->config->item('front_base_url');
$base_url 		= $this->config->item('base_url');
$http_host 		= $this->config->item('http_host');
$base_url_views = $this->config->item('base_url_views');
$base_upload = $this->config->item('upload');
?>
 <!-- Start: Sidebar -->
  <aside id="sidebar_left">
    <div class="user-info">
      <div class="media"> <a class="pull-left" href="javascript:void(0);">
        <div class="media-object border border-purple br64 bw2 p2"> <img height="40" class="br64" src="<?php echo $base_url_views;?>images/admin_logo.jpg" alt="Shoppin"> </div>
        </a>
        <div class="mobile-link"> <span class="glyphicons glyphicons-show_big_thumbnails"></span> </div>
        <div class="media-body">
          <h5 class="media-heading mt5 mbn fw700 cursor"><?php echo strtoupper($this->session->userdata('uname'));?><!--span class="caret ml5"></span--></h5>
          <div class="media-links fs11"><!--a href="javascript:void(0);">Menu</a--><i class="fa fa-circle text-muted fs3 p8 va-m"></i><a href="<?php echo $base_url;?>welcome/logout">Sign Out</a></div>
        </div>
      </div>
    </div>
    <div class="sidebar-menu">
		<?php
			if($this->session->userdata('adminId') !='')
			{
			$uid = $this->session->userdata('adminId');
			$getuser['data'] = $this->footer->getadmin($uid);
			$role_id = $getuser['data'][0]->role_id;
			$all_model_id= $this->footer->userrole($role_id);
			//print_r($all_model_id); die;
			for($i=0;$i<count($all_model_id);$i++){
				$array_model_id[]=$all_model_id[$i]->module_id;
			}
			for($j=0;$j<count($array_model_id);$j++){		
				$name[]=$this->footer->model_name($array_model_id[$j]);
			}
		?>
      <ul class="nav">
    
		<li class="active"> <a class="ajax-disable" href="<?php echo $base_url;?>home"><span class="glyphicons fa fa-tachometer"></span><span class="sidebar-title">Dashboard</span></a> </li>

		<li> <a class="accordion-toggle " href="#resources"><span class="glyphicons glyphicons-vcard"></span><span class="sidebar-title">Admin Management</span><span class="caret"></span></a>
          <ul id="resources" class="nav sub-nav">
		  
		<!--	
			<?php if(in_array('Module',$name)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>module/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Module</a></li>
				  <?php } ?>
				-->
				
				 <?php if(in_array('Role',$name)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>role/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Role</a></li>
			  <?php } ?>
					
				 <?php if(in_array('Admin User',$name)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>admin_user/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Admin User</a></li>
				  <?php } ?>
				 
				 
				 
			</ul>
        </li>
<!--
		<li> <a class="accordion-toggle " href="#resources"><span class="glyphicons glyphicons-vcard"></span><span class="sidebar-title">Main Management</span><span class="caret"></span></a>
          <ul id="resources" class="nav sub-nav">
		  <!--
			
			<?php if(in_array('Category',$name)){ ?>		 
			<li><a class="ajax-disable" href="<?php echo $base_url;?>category/lists"><span class="glyphicons glyphicons-book"></span> Category </a></li>
			<li class="divider"></li>
				 <?php }?>
				 
				 
				 
				 <?php if(in_array('Subcategory',$name)){ ?>
	        <li><a class="ajax-disable" href="<?php echo $base_url;?>subcategory/lists"><span class="glyphicons glyphicons-book"></span>Sub Category </a></li>	
				 <?php } ?>
				
			</ul>
        </li>
		 -->
		
		
		
			<li> <a class="accordion-toggle " href="#resources"><span class="glyphicons glyphicons-group"></span><span class="sidebar-title">User Management</span><span class="caret"></span></a>
			<ul id="resources" class="nav sub-nav">
			<li class="divider"></li> 
			
					 
		
				  <?php if(in_array('Customer',$name)){ ?>	
		
				<li><a class="ajax-disable" href="<?php echo $base_url;?>customer/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Customers </a></li>
				  <?php } ?>
					 
					 
					 <?php if(in_array('Merchant',$name)){ ?>	
				<li><a class="ajax-disable" href="<?php echo $base_url;?>merchant/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Merchant</a></li>
				  <?php } ?>
				  
				 <?php if(in_array('Shop',$name)){ ?>	
				<li><a class="ajax-disable" href="<?php echo $base_url;?>Shop_list/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Shop</a></li>
				  <?php } ?>
				   
			</ul>
        </li>

        <li> <a class="accordion-toggle " href="#resources"><span class="glyphicons glyphicons-vcard"></span><span class="sidebar-title">Deals Management</span><span class="caret"></span></a>
          <ul id="resources" class="nav sub-nav">
		  
			 <?php if(in_array('Deals',$name)){ ?>
					<li><a class="ajax-disable" href="<?php echo $base_url;?>deals/lists"><span class="glyphicons glyphicons-book"></span>Deals </a></li>				
			<?php } ?>
			<?php if(in_array('Category',$name)){ ?>		 
			<li><a class="ajax-disable" href="<?php echo $base_url;?>category/lists"><span class="glyphicons glyphicons-book"></span> Category </a></li>
			<li class="divider"></li>
				 <?php }?>
				 
				 
				 
				 <?php if(in_array('Subcategory',$name)){ ?>
	        <li><a class="ajax-disable" href="<?php echo $base_url;?>subcategory/lists"><span class="glyphicons glyphicons-book"></span>Sub Category </a></li>	
				 <?php } ?>
			<!--
			<?php if(in_array('Saved deals',$name)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>save_deals/lists"><span class="glyphicons glyphicons-book"></span>Save Deals </a></li>				
			<?php } ?>
			  -->
				 
			</ul>
        </li>
		
	
      </ul>
			<?php  } ?>
    </div>
	
  </aside>
