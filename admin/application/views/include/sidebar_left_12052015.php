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
        <div class="media-object border border-purple br64 bw2 p2"> <img class="br64" src="<?php echo $base_url_views;?>images/login_img.png" alt="..."> </div>
        </a>
        <div class="mobile-link"> <span class="glyphicons glyphicons-show_big_thumbnails"></span> </div>
        <div class="media-body">
          <h5 class="media-heading mt5 mbn fw700 cursor"><?php echo strtoupper($this->session->userdata('username'));?><!--span class="caret ml5"></span--></h5>
          <div class="media-links fs11"><!--a href="javascript:void(0);">Menu</a--><i class="fa fa-circle text-muted fs3 p8 va-m"></i><a href="<?php echo $base_url;?>welcome/logout">Sign Out</a></div>
        </div>
      </div>
    </div>
    <!--div class="user-divider"></div-->
    <!--div class="user-menu">
      <div class="row text-center mb15">
        <div class="col-xs-4"> <a href="javascript:void(0);"> <span class="glyphicons glyphicons-home fs22 text-blue2"></span>
          <h5 class="fs11">Home</h5>
          </a> </div>
        <div class="col-xs-4"> <a href="javascript:void(0);"> <span class="glyphicons glyphicons-inbox fs22 text-orange2"></span>
          <h5 class="fs11">Inbox</h5>
          </a> </div>
        <div class="col-xs-4"> <a href="javascript:void(0);"> <span class="glyphicons glyphicons-bell fs22 text-purple2"></span>
          <h5 class="fs11">Data</h5>
          </a> </div>
      </div>
      <div class="row text-center">
        <div class="col-xs-4 text-center"> <a href="javascript:void(0);"> <span class="glyphicons glyphicons-imac fs22 text-grey3"></span>
          <h5 class="fs11">Views</h5>
          </a> </div>
        <div class="col-xs-4"> <a href="javascript:void(0);"> <span class="glyphicons glyphicons-settings fs22 text-green2"></span>
          <h5 class="fs11">Settings</h5>
          </a> </div>
        <div class="col-xs-4"> <a href="javascript:void(0);"> <span class="glyphicons glyphicons-restart fs22 text-light6"></span>
          <h5 class="fs11">Images</h5>
          </a> </div>
      </div>
    </div-->
    <div class="sidebar-menu">
		<?php
			if($this->session->userdata('adminId') !='')
			{
			$uid = $this->session->userdata('adminId');
			$getuser['data'] = $this->footer->getuser($uid);
			$category = $getuser['data'][0]->ucategory;
			$usercategory = $this->footer->usercategory($category);
			$permission1=$usercategory[0]->permission;
			$permission1 = explode(',',$permission1);
	 
		?>
      <ul class="nav">
    
        <li class="active"> <a href="javascript:void(0);"><span class="glyphicons fa fa-tachometer"></span><span class="sidebar-title">Dashboard</span></a> </li>
		<li> <a class="accordion-toggle " href="#resources"><span class="glyphicons glyphicons-vcard"></span><span class="sidebar-title">Master</span><span class="caret"></span></a>
          <ul id="resources" class="nav sub-nav">
		    
			<?php if(in_array('1',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>position/lists"><span class="glyphicons fa fa-columns"></span> Banner Position </a></li>
			<li class="divider"></li>	
			<?php } ?>
			
			 <?php if(in_array('2',$permission1)){ ?>
		     <li><a class="ajax-disable" href="<?php echo $base_url;?>banner/lists"><span class="glyphicons fa fa-stop"></span> Banner </a></li>
			<li class="divider"></li>	
			<?php } ?>
			
		
			<?php if(in_array('17',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>product_group/lists"><span style="font-size:14px;" class="fa fa-users"></span>Manage Group</a></li><li class="divider"></li> 
			<?php } ?>
		
			
			 <?php if(in_array('4',$permission1)){ ?>
            <li><a class="ajax-disable" href="<?php echo $base_url;?>category/lists"><span class="glyphicons glyphicons-book"></span> Category </a></li>
			<li class="divider"></li>	
			<?php } ?>
			
			<?php if(in_array('5',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>subcategory/lists"><span class="glyphicons fa fa-life-ring"></span> Sub Category </a></li>
			<li class="divider"></li>	
			<?php } ?>
			
				 
			 <?php if(in_array('13',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>brand/lists"><span class="glyphicon glyphicon-fire"></span> Brand </a></li>
			<li class="divider"></li>
			<?php } ?>
			
				<?php if(in_array('3',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>country/lists"><span class="glyphicons glyphicons-global"></span> Country </a></li>
            <li class="divider"></li>
			
			<?php if(in_array('22',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>state/lists"><span class="glyphicons glyphicons-globe_af"></span> State</a></li>
			<li class="divider"></li>
			<?php } ?> 	
				
			<?php if(in_array('23',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>city/lists"><span class="glyphicon fa fa-map-marker"></span> City</a></li>
			<li class="divider"></li>	 
			<?php } ?> 	
			
			<?php if(in_array('39',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>style/lists"><span class="glyphicon fa fa-asterisk"></span> Style </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			<?php if(in_array('40',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>blouse/lists"><span class="glyphicon fa fa-users"></span> Blouse Master </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			<?php if(in_array('41',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>length/lists"><span class="glyphicon fa fa-arrows-v"></span> Length</a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			
				<?php if(in_array('16',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>size/lists"><span class="fa fa-sitemap"></span>  Size </a></li>
			<li class="divider"></li>
			<?php } ?>   
			
			
			<?php if(in_array('33',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>sizechart/lists"><span class="fa fa-bar-chart"></span> Size Chart </a></li>
			<li class="divider"></li>	
			<?php } ?>
			
					
			 <?php if(in_array('6',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>color/lists"><span style="font-size:14px;" class="glyphicon glyphicon-certificate"></span> Color </a></li>
			<li class="divider"></li>
			<?php } ?>
			
			 <?php if(in_array('7',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>fabric/lists"><span style="font-size:15px;" class="glyphicon fa fa-male"></span> Fabric </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			 <?php if(in_array('35',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>pattern/lists"><span class="glyphicon glyphicon-list-alt"></span> Pattern </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			 <?php if(in_array('36',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>collar/lists"><span class="fa fa-bookmark" style="font-size: 15px;"></span> Collar </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			 <?php if(in_array('37',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>sleeve/lists"><span style="font-size:15px;" class="fa fa-bookmark-o"></span> Sleeve </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			<?php if(in_array('38',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>neck/lists"><span style="font-size:14px;" class="glyphicons fa fa-user"></span> Neck </a></li>
			<li class="divider"></li>		
			<?php } ?>
			
			<?php if(in_array('8',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>work/lists"><span style="font-size:14px;" class="fa fa-briefcase"></span> Work </a></li>
			<li class="divider"></li>
			<?php } ?>
			
			<?php if(in_array('10',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>fit/lists"><span style="font-size:14px;" class="fa fa-file-archive-o"></span> FIT </a></li>
			<li class="divider"></li>	
			<?php } ?>
			
		
			
			
			 <?php if(in_array('9',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>occasions/lists"><span style="font-size:14px;" class="fa fa-hand-o-down"></span> Occasions </a></li>
			<li class="divider"></li>
			<?php } ?>
			 
			 <?php if(in_array('11',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>movie/lists"><span class="glyphicon glyphicon-film"></span> Movies </a></li>
			<li class="divider"></li>
			<?php } ?>
			
			<?php if(in_array('12',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>celebrity/lists"><span style="font-size:14px;" class="fa fa-trello"></span> Celebrity </a></li>
			<li class="divider"></li>
			<?php } ?>
		
			 <?php if(in_array('14',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>design/lists"><span style="font-size:14px;" class="fa fa-crosshairs"></span>  Design </a></li>
			<li class="divider"></li>
			<?php } ?>
			
			<?php if(in_array('15',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>cms/lists"><span style="font-size:14px;" class="glyphicon fa fa-asterisk"></span>  CMS </a></li>
			<li class="divider"></li>
			<?php } ?>
			
				<?php if(in_array('29',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>weight/lists"><span style="font-size:14px;" class="fa fa-square"></span>  Weight </a></li>
			<li class="divider"></li>
			<?php } ?>
			
				<?php if(in_array('28',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>catalogue/lists"><span style="font-size:14px;" class="fa fa-database"></span>  Catalogue </a></li>
			<li class="divider"></li>
			<?php } ?>
			
			
			 
			
			 <?php if(in_array('27',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>stitch/lists"><span class="glyphicon glyphicon-retweet"></span>Manage Stitchs</a></li>
			<li class="divider"></li> 
			<?php } ?>
					
			</ul>
        </li>
		
		
		<li> 
			<a class="accordion-toggle " href="#resources"><span class="glyphicons fa fa-users"></span><span class="sidebar-title">Product Master</span><span class="caret"></span></a>
			<ul id="resources" class="nav sub-nav">
				
				<?php if(in_array('18',$permission1)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>product/lists">	 <span style="font-size:14px;" class="fa fa-plus-square-o"></span>Add Product</a></li>
				<li class="divider"></li> 
				<?php } ?>
				
					<?php if(in_array('34',$permission1)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>Productorder/lists">	 <span class="glyphicon glyphicon-list-alt"></span>Product Order</a></li>
				<li class="divider"></li> 
				<?php } ?>
				
			</ul>
        </li>
		
		
			<li> <a class="accordion-toggle " href="#resources"><span class="glyphicons fa fa-user"></span><span class="sidebar-title">User Management</span><span class="caret"></span></a>
			<ul id="resources" class="nav sub-nav">
			
			 
				 <?php if(in_array('19',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>permission/list_permission"><span style="font-size:14px;" class="fa fa-hand-o-up"></span> User Permission</a></li>
				 <?php } ?>
				 
				 	 <?php if(in_array('20',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>users/lists"><span style="font-size:14px;" class="fa fa-lock"></span>Admin User </a></li>
				 <?php } ?>
				 
				  <?php if(in_array('30',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>vendor/lists"><span style="font-size:14px;" class="fa fa-male"></span>Vendor</a></li>
				 <?php } ?>
				 
				  <?php if(in_array('24',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>regusers/lists"><span style="font-size:14px;" class="glyphicons glyphicons-group"></span>Customers </a></li>
				 <?php } ?>
			</ul>
        </li>
		
		<li> <a class="accordion-toggle " href="#resources"><span class="glyphicons fa fa-desktop"></span><span class="sidebar-title">Systems</span><span class="caret"></span></a>
			<ul id="resources" class="nav sub-nav">
			 <?php if(in_array('26',$permission1)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>coupan/lists">	 <span style="font-size:14px;" class="fa fa-building-o"></span>Coupon</a></li>
				<li class="divider"></li> 
				<?php } ?>
				
					 <?php if(in_array('31',$permission1)){ ?>
				<li><a class="ajax-disable" href="<?php echo $base_url;?>shipping/lists">	 <span style="font-size:14px;" class="fa fa-simplybuilt"></span>Shipment</a></li>
				<li class="divider"></li> 
				<?php } ?>
				
				<?php if(in_array('21',$permission1)){ ?>
			
			<li><a class="ajax-disable" href="<?php echo $base_url;?>etemplate/edit/1"><span style="font-size:13px;" class="glyphicons glyphicons-message_full"></span>  E-template </a></li>
			<li class="divider"></li>
			<?php } ?> 		
			 
				 <?php if(in_array('25',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>courier/lists"><span style="font-size:14px;" class="fa fa-file-code-o"></span>Courier</a></li>
				 <?php } ?>
				
				<?php if(in_array('42',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>pricerange/lists"><span style="font-size:14px;" class="fa fa-money"></span>Price Range Slider</a></li>
			 		 <?php } ?>
			 <?php if(in_array('32',$permission1)){ ?>
				<li class="divider"></li> 
				<li><a class="ajax-disable" href="<?php echo $base_url;?>pincode/lists"><span style="font-size:14px;" class="fa fa-upload"></span>Zip-Upload</a></li>
			 		 <?php } ?>
					 
			<?php if(in_array('43',$permission1)){ ?>
			<li><a class="ajax-disable" href="<?php echo $base_url;?>delivery/lists"><span class="glyphicon glyphicon-retweet"></span>Delivery Days</a></li>
			<li class="divider"></li> 
			<?php } ?>
				 	 
			</ul>
        </li>
       
      </ul>
			<?php } } ?>
    </div>
	
  </aside>
  