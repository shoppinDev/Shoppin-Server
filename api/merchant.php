<?php
	if(!isset($_GET['webmethod']))
	{
		die("Please specify webmethod");
	}
	$webMethod=$_GET['webmethod'];
	$format = 'json'; 
	/* connect to the db production*/
	//$link = new mysqli('localhost','root','','dealwala') or die('Cannot connect to the DB'); 
	/* connect to the db local*/
	$link = new mysqli('localhost','ibizsm8j_dealwal','dealwala123','ibizsm8j_dealwala') or die('Cannot connect to the DB');
	
	switch($webMethod)
	{
		case "merchant_register":
			$email=$_GET['email'];
			$password =$_GET['password'];
			$name =$_GET['name'];
			$mobile =$_GET['mobile'];
			$queryc = "SELECT * from `deal_merchant` where merchant_email = '".$email."'    ";
			
			$result =  $link->query($queryc) or die('Errant query:  '.$queryc);	
			 
			$num_rowsc = $result->num_rows;
			 
			if($num_rowsc>0) 
			{
				header('Content-type: application/json');
				$bikes[] = array('responsecode' => '0', 'message' => 'Email Already Registered', 'userid' => null);
				echo json_encode(array('data'=>$bikes));	
			} else {
				//echo date("Y-m-d"); die;
				$query = "INSERT INTO `deal_merchant` (`merchant_email`, `merchant_password`, `merchant_name`, `merchant_mobile`, `added_date`) VALUES ('".$email."', '".$password."', '".$name."', '".$mobile."','".date("Y-m-d")."')";
				//echo $query; die;
				$result =  $link->query($query) or die('Errant query:  '.$query);
				$usersid = $link->insert_id;
				$bikes = array();
				if($usersid > 0) { 
					$message = '<div style="width:700px; height:auto; margin:0 auto;"> 
						<p>Dear User,</p>
						<p>Congratulations! You have successfully created your account with Shoppin.com</p>
						<p>Your Login Details as below: </p>

						<table><tr>
						<tr><td>Name:</td><td>'.$name.'</td></tr>
						<tr><td>Email:</td><td>'.$email.'</td></tr>
						<tr><td>Password:</td><td>'.$password.'</td>
						</tr></table>
						
						<p>If you have any question get in touch with customer care team:</p>
						<div background:#1a76b9; border-radius:7px; font-size:16px; text-align:center; width:250px; padding:20px; margin:40px auto 0; border:1px solid #000000;>
							Shoppin.com
						</div>
						 
						</div>';
		  
						$to = $email; 
						$subject  = 'Thank you for Registering with Shoppin.com';  
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:  Shoppin.com <info@ibizsolutions.net>' . "\r\n" .
									'Reply-To:  info@ibizsolutions.net' . "\r\n" .
									'X-Mailer: PHP/' . phpversion();
						//$headers .= 'BCc: amvisolution@gmail.com' . "\r\n";
						mail($to,$subject,$message,$headers); 
				} 
				$bikes[] = array('responsecode' => '1', 'message' => 'Register Successfully', 'userid' => $usersid);
				echo json_encode(array('data'=>$bikes));	
			}	
		break;
		
		case "edit_profile":
			$id =$_GET['merchant_id'];
			$name =$_GET['name'];
			$mobile =$_GET['mobile'];
			
			$query = "UPDATE deal_merchant SET merchant_name='".$name."',merchant_mobile='".$mobile."' WHERE merchant_id= '".$id."' ";
			//echo $query; die;
			$result =  $link->query($query) or die('Errant query:  '.$query);	
		//	echo $result;  die;
			$bikes = array();
			$bikes[] = 'PROFILE UPDATE SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break;
		
		
		case "login":
			$email=$_GET['email'];
			$password =$_GET['password'];
			$query = "SELECT * from deal_merchant where merchant_email = '".$email."' AND merchant_password = '".$password."'  ";
			
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$num_rows = $result->num_rows;
			$usersid;
			$usersname;
			if($num_rows>0) 
			{
				//print_r($result->fetch_assoc()); die;
				while($bike = $result->fetch_assoc())
				{
					$usersid = $bike['merchant_id'];
					$usersname = $bike['merchant_name'];
				}
				$bikes[] = array('responsecode' => '1', 'message' => 'success', 'userid' => $usersid, 'username' => $usersname);
			} else {
				$bikes[] = array('responsecode' => '0', 'message' => 'failed' , 'userid' => null, 'username' => null);
			}
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));		
		break;
		
		
		case "forgotpassword":
			$email=$_GET['email'];
 			$query = "SELECT * from deal_merchant where merchant_email = '".$email."' ";
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$num_rows = $result->num_rows;
			if($num_rows>0) 
			{
				while($bike = $result->fetch_assoc())
				{
				$message = '<div style="width:700px; height:auto; margin:0 auto;">
						<p>Dear User,</p>
						<p>Please Find Your Login Details Below:</p>
						<table>
							<tr><td>Email:</td><td>'.$bike['merchant_email'].'</td></tr>
							<tr><td>Password:</td><td>'.$bike['merchant_password'].'</td></tr>
						</table>
						</div>';
		  
						$to = $bike['merchant_email']; 
						$subject  = 'Forgot Password';  
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:  Shoppin.com <info@ibizsolutions.net>' . "\r\n" .
									'Reply-To:  info@ibizsolutions.net' . "\r\n" .
									'X-Mailer: PHP/' . phpversion();
						//$headers .= 'BCc: amvisolution@gmail.com' . "\r\n";
						mail($to,$subject,$message,$headers);  
						$overview = 'Email has been sent to your registered Email Address';
				}
			} else {
				$overview = 'Invalid Email Id. Email id doesn\'t exists in our system';	
			} 
			$bikes = $overview; 	
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break;
		
		
		/*case "merchant_login":
			$email=$_GET['email'];
			$password =$_GET['password'];
			$query = "SELECT * from deal_merchant where merchant_email = '".$email."' AND customer_password = '".$password."'  ";
			
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$num_rows = $result->num_rows;
			$usersid;
			$usersname;
			if($num_rows>0) 
			{
				while($bike = $result->fetch_assoc())
				{
					$usersid = $bike['id'];
					$usersname = $bike['display_name'];
				}
				$bikes[] = array('responsecode' => '1', 'message' => 'success', 'userid' => $usersid, 'username' => $usersname);
			} else {
				$bikes[] = array('responsecode' => '0', 'message' => 'failed' , 'userid' => null, 'username' => null);
			}
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));		
		break;*/
		
		case "changepassword":
			$id = $_GET['id'];
			$pass = $_GET['password'];	
			$query = "UPDATE deal_merchant SET merchant_password= '".$pass."'  WHERE merchant_id= '".$id."' ";
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$bikes[] = 'PASSWORD UPDATE SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break;
		
		
		case "addshop":
			$id = $_GET['userid'];
			$name = $_GET['name'];
			$shop_addres = $_GET['shop_addres'];
			$shop_latitude = $_GET['shop_latitude'];
			$shop_longitude = $_GET['shop_longitude'];
			$shop_email = $_GET['shop_email'];
			$shop_mobile = $_GET['shop_mobile'];
 			//$shop_add = $_GET['shop_add'];
			$shop_city = $_GET['shop_city'];
			$shop_state = $_GET['shop_state'];
			$shop_zip = $_GET['shop_zip'];
			$shop_country = $_GET['shop_country'];
			
			$query = "INSERT INTO `deal_merchantshops` (`merchant_id`, `shop_name`, `shop_addres`, `shop_latitude`, `shop_longitude`, `shop_email`, `shop_mobile`, `shop_city`, `shop_state`, `shop_zip`, `shop_country`, `added_date`) VALUES ('".$id."', '".$name."' , '".$shop_addres."' , '".$shop_latitude."' , '".$shop_longitude."' , '".$shop_email."' , '".$shop_mobile."' , '".$shop_city."' , '".$shop_state."' , '".$shop_zip."' , '".$shop_country."' , '".date("Y-m-d")."');";
			
			$result =  $link->query($query) or die('Errant query:  '.$query);
			$response = $link->insert_id;
			require_once 'qrcode/qrlib.php'; 
			$filename = $_SERVER['DOCUMENT_ROOT']."/dealwala/upload/qrcode_image/".$id.$response."code.png";
			
			QRcode::png($id.$response,$filename);
		
			$image=$id.$response."code.png";
			$query = "UPDATE deal_merchantshops SET qr_image='".$image."'  WHERE shop_id= '".$response."' ";
			//echo $query; die;
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$bikes[] = 'SHOP ADDED SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break; 
		
		case "editshop":
			$id = $_GET['shop_id'];
			$name = $_GET['name'];
			$shop_addres = $_GET['shop_addres'];
			$shop_latitude = $_GET['shop_latitude'];
			$shop_longitude = $_GET['shop_longitude'];
			$shop_email = $_GET['shop_email'];
			$shop_mobile = $_GET['shop_mobile'];
 			//$shop_add = $_GET['shop_add'];
			$shop_city = $_GET['shop_city'];
			$shop_state = $_GET['shop_state'];
			$shop_zip = $_GET['shop_zip'];
			$shop_country = $_GET['shop_country'];
			
			$query = "UPDATE deal_merchantshops SET shop_name='".$name."',shop_addres='".$shop_addres."',shop_latitude='".$shop_latitude."',shop_longitude='".$shop_longitude."',shop_email='".$shop_email."',shop_mobile='".$shop_mobile."',shop_city='".$shop_city."',shop_state='".$shop_state."',shop_zip='".$shop_zip."',shop_country='".$shop_country."'  WHERE shop_id= '".$id."' ";
			//echo $query; die;
			$result =  $link->query($query) or die('Errant query:  '.$query);	
		//	echo $result;  die;
			$bikes = array();
			$bikes[] = 'SHOP ADDED SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break; 
		
		case "adddeal":
			$merchant_id = $_GET['merchant_id'];
			$shop_id = $_GET['shop_id'];
			$deal_category = $_GET['deal_category'];
			$deal_subcategory = $_GET['deal_subcategory'];
			$deal_title = $_GET['deal_title'];
			$deal_description = $_GET['deal_description'];
			$deal_startdate = $_GET['deal_startdate'];
 			$deal_enddate = $_GET['deal_enddate'];
			$deal_amount = $_GET['deal_amount'];
			$all_days = $_GET['all_days'];
			$deal_usage = $_GET['deal_usage'];
			$location = $_GET['location'];
			$discount_type = $_GET['discount_type'];
			$discount_value= $_GET['discount_value'];
			$query = "INSERT INTO `deal_deals` (`merchant_id`, `shop_id`, `deal_category`, `deal_subcategory`, `deal_title`, `deal_description`, `deal_startdate`, `deal_enddate`, `deal_amount`, `all_days`, `deal_usage`, `location`, `discount_type`, `discount_value`,`is_active`,`added_date`) VALUES ('".$merchant_id."', '".$shop_id."' , '".$deal_category."' , '".$deal_subcategory."' , '".$deal_title."' , '".$deal_description."' , '".$deal_startdate."' , '".$deal_enddate."' ,  '".$deal_amount."' , '".$all_days."' , '".$deal_usage."' , '".$location."'  , '".$discount_type."'  , '".$discount_value."'  ,'1', '".date("Y-m-d")."')";
			 
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$bikes[] = 'Deals ADDED SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break; 
		
		case "editdeal":
			$id = $_GET['deal_id'];
			$merchant_id = $_GET['merchant_id'];
			$shop_id = $_GET['shop_id'];
			$deal_category = $_GET['deal_category'];
			$deal_subcategory = $_GET['deal_subcategory'];
			$deal_title = $_GET['deal_title'];
			$deal_description = $_GET['deal_description'];
			$deal_startdate = $_GET['deal_startdate'];
 			$deal_enddate = $_GET['deal_enddate'];
			$deal_amount = $_GET['deal_amount'];
			$all_days = $_GET['all_days'];
			$deal_usage = $_GET['deal_usage'];
			$location = $_GET['location'];
			$discount_type = $_GET['discount_type'];
			$discount_value= $_GET['discount_value'];
			
			$query = "UPDATE `deal_deals` SET merchant_id='".$merchant_id."',shop_id='".$shop_id."',deal_category='".$deal_category."',deal_subcategory='".$deal_subcategory."',deal_title='".$deal_title."',deal_description='".$deal_description."',deal_startdate='".$deal_startdate."' ,deal_amount='".$deal_amount."' ,deal_enddate='".$deal_enddate."',all_days='".$all_days."',deal_usage='".$deal_usage."' ,location='".$location."' ,discount_type='".$discount_type."' ,discount_value='".$discount_value."'  WHERE deal_id= '".$id."' ";
			//echo $query; die;
			$result =  $link->query($query) or die('Errant query:  '.$query);	
		//	echo $result;  die;
			$bikes = array();
			$bikes[] = 'Deals UPDATE SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break;
		
		
		
		case "deal_detail":
			$id = $_GET['id'];
 			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dshop.shop_addres, dshop.shop_latitude, dshop.shop_longitude,dshop.shop_name  from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join  deal_merchantshops dshop on dshop.shop_id = d.shop_id
						where d.deal_id = '".$id."' ";
			packupAndSend($query,$link);		
		break;
		
		case "my_account":
			$id = $_GET['id'];
 			$query = " SELECT * from deal_merchant where merchant_id = '".$id."' ";
			packupAndSend($query,$link);		
		break;
		
		case "deal_list":
 			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dm.merchant_name,ms.shop_name from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join deal_merchant dm on dm.merchant_id = d.merchant_id
						left join deal_merchantshops ms on ms.shop_id = d.shop_id
						where d.deal_id <> 0 ";
			packupAndSend($query,$link);		
		break;
		
		case "active_my_deal":
			$merchantid = $_GET['merchantid'];
			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dm.merchant_name,ms.shop_name,( select COUNT(do.deal_id) as count_redeem from deal_order do where do.deal_id = d.deal_id  )  as count_redeem from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join deal_merchant dm on dm.merchant_id = d.merchant_id
						left join deal_merchantshops ms on ms.shop_id = d.shop_id
						where d.deal_id <> 0 and d.is_active='1' and d.merchant_id = '".$merchantid."'  group by d.deal_id ";
						
 		//	$query = " SELECT * from deal_deals where deal_id <> 0  and merchant_id = '".$merchantid."' ";
			packupAndSend($query,$link);		
		break;
		
		
		case "deactive_my_deal":
			$merchantid = $_GET['merchantid'];
			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dm.merchant_name,ms.shop_name,( select COUNT(do.deal_id) as count_redeem from deal_order do where do.deal_id = d.deal_id  )  as count_redeem from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join deal_merchant dm on dm.merchant_id = d.merchant_id
						left join deal_merchantshops ms on ms.shop_id = d.shop_id
						where d.deal_id <> 0 and d.is_active='0' and d.merchant_id = '".$merchantid."' ";
 		//	$query = " SELECT * from deal_deals where deal_id <> 0  and merchant_id = '".$merchantid."' ";
			packupAndSend($query,$link);		
		break;
		
		case "my_deal":
			$merchantid = $_GET['merchantid'];
			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dm.merchant_name,ms.shop_name,ms.qr_image from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join deal_merchant dm on dm.merchant_id = d.merchant_id
						left join deal_merchantshops ms on ms.shop_id = d.shop_id
						where d.deal_id <> 0 and d.merchant_id = '".$merchantid."' ";
						 
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$num_rows = $result->num_rows; 
			if($result->num_rows > 0){               
				while($roee = $result->fetch_assoc()){
					$asd['deal_id'] = $roee['deal_id'];
					$asd['merchant_id'] = $roee['merchant_id'];
					$asd['shop_id'] = $roee['shop_id'];
					$asd['deal_category'] = $roee['deal_category'];
					$asd['deal_subcategory'] = $roee['deal_subcategory'];
					$asd['deal_title'] = $roee['deal_title'];
					$asd['deal_description'] = $roee['deal_description'];
					$asd['deal_startdate'] = $roee['deal_startdate'];
					$asd['deal_enddate'] = $roee['deal_enddate'];
					$asd['deal_amount'] = $roee['deal_amount'];
					$asd['all_days'] = $roee['all_days'];
					$asd['discount_value'] = $roee['discount_value'];
					$asd['discount_type'] = $roee['discount_type'];
					$asd['location'] = $roee['location'];
					$asd['deal_usage'] = $roee['deal_usage'];
					$asd['is_active'] = $roee['is_active'];
					$asd['added_date'] = $roee['added_date'];
					$asd['category_name'] = $roee['category_name'];
					$asd['subcategory_name'] = $roee['subcategory_name'];
					$asd['merchant_name'] = $roee['merchant_name'];
					$asd['shop_name'] = $roee['shop_name'];
					$asd['qr_image'] = "http://ibizsolutions.net/dealwala/upload/qrcode_image/".$roee['qr_image']; 
					
					/*$asd['shop_addres'] = $roee['shop_addres'];
					$asd['shop_latitude'] = $roee['shop_latitude'];
					$asd['shop_longitude'] = $roee['shop_longitude'];
					
					if($roee['discount_type']=='0'){
						$asd['orignal_value'] = $roee['deal_amount']-$roee['discount_value'];
					}else{
						$value=$roee['deal_amount']*($roee['discount_value']/100);
						$asd['orignal_value'] = $roee['deal_amount']-$value;
					}*/  
					array_push($bikes,$asd);
				}
			}
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
			//	$query = " SELECT * from deal_deals where deal_id <> 0  and merchant_id = '".$merchantid."' ";
			//packupAndSend($query,$link);		
		break;
		case "my_shop":
			$merchantid = $_GET['merchantid'];
			$query = " SELECT d.*,  dm.merchant_name from deal_merchantshops d  
						left join deal_merchant dm on dm.merchant_id = d.merchant_id 
						where d.shop_id <> 0 and d.merchant_id = '".$merchantid."' "; 
			packupAndSend($query,$link);		
		break;
		
		
		
		case "my_drafts":
			$merchantid = $_GET['merchantid'];
			$query = " SELECT d.*,dc.*, dd.*, dm.merchant_name from deal_saveddeals d  
						inner join deal_customer dc on dc.customer_id = d.customer_id
						inner join deal_deals dd on dd.deal_id = d.deal_id 
						inner join deal_merchant dm on dm.merchant_id = dd.merchant_id 	and dm.merchant_id = '".$merchantid."'					
						where d.save_id <> 0  "; 
			packupAndSend($query,$link);		
		break;
		
		case "my_purchase":
			$merchantid = $_GET['merchantid'];
			$query = " SELECT d.*,dc.*, dd.*, dm.merchant_name from deal_order d  
						inner join deal_customer dc on dc.customer_id = d.customer_id
						inner join deal_deals dd on dd.deal_id = d.deal_id 
						inner join deal_merchant dm on dm.merchant_id = dd.merchant_id 	and dm.merchant_id = '".$merchantid."'					
						where d.order_id <> 0  "; 
			packupAndSend($query,$link);		
		break;
		
		case "add_personalcategory":
			$cname=$_GET['cname'];
			$userid =$_GET['userid'];
			$query = "INSERT INTO `category` (`cname`,`userid` ) VALUES ('".$cname."' ,'".$userid."' );"; 
			packupAndSend_register($query,$link);		
		break;
		 
		
		case "delete_journal":
			$id=$_GET['id'];
			$query = "delete from `journal` where id = '".$id."' "; 
			packupAnd_delete($query,$link);		
		break;
		
	  
		case "category":
 			$query = " SELECT * from deal_category where category_id <> 0 ";
			packupAndSend($query,$link);		
		break;
		
		case "subcategory":
			$id=$_GET['category'];
 			$query = " SELECT * from deal_subcategory where subcategory_id <> 0 ";
			if($id !=''){
				$query .= " and category_id ='".$id."'";
			}
			//echo $query;  die;
			packupAndSend($query,$link);		
		break;
		
		case "getshop":
			$id=$_GET['userid'];
 			$query = " SELECT * from deal_merchantshops where merchant_id ='".$id."'";
			packupAndSend($query,$link);		
		break;
		
		
		case "cms":
 			$query = " SELECT * from cms where id <> 0 ";
			packupAndSend($query,$link);		
		break;
		 
		
		
		 
		case "addaddress":
			$id = $_GET['userid'];
			$fname = $_GET['name'];
			$postcode = $_GET['postcode'];
			$address = $_GET['address'];
			$city = $_GET['city'];
			$state = $_GET['state'];
			$country = $_GET['country'];
 			$mobno = $_GET['mobno'];
			
			$query = "INSERT INTO `address` (`fname`, `address`, `country`, `city`, `county`, `postcode`, `mobno`, `userid` ) VALUES ('".$fname."', '".$address."' , '".$country."' , '".$city."' , '".$state."' , '".$postcode."' , '".$mobno."' , '".$id."');";
			
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$bikes[] = 'ADDRESS ADDED SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break; 
		 
		 
		break;
		case "edit_personalcategory":
			$id=$_GET['id'];
			$cname=$_GET['cname'];
			$query = "update  `category`  SET `cname`= '".$cname."'  WHERE id = '".$id."' "; 
			packupAnd_update($query,$link);	
		break;
		
		 
		
	}
 
	mysqli_close($link);
	 
	 
	 
	 
	function packupAndSend($query,$link)
	{
		$result =  $link->query($query) or die('Errant query:  '.$query);	
		$bikes = array();
		$num_rows = $result->num_rows;
		if($num_rows>0) 
		{
			while($bike = $result->fetch_assoc())
			{
				$bikes[] = $bike;
			}
		} else {
			$bikes = array();
		}
		header('Content-type: application/json');
		echo json_encode(array('data'=>$bikes));
	}
	
	function packupAndSend_register($query,$link)
	{
		$result =  $link->query($query) or die('Errant query:  '.$query);	
		$bikes = array();
 		$bikes = 'DATA INSERTED';
		header('Content-type: application/json');
		echo json_encode(array('data'=>$bikes));
	}
	function packupAnd_update($query,$link)
	{
		$result =  $link->query($query) or die('Errant query:  '.$query);	
		$bikes = array();
 		$bikes = 'DATA UPDATE';
		header('Content-type: application/json');
		echo json_encode(array('data'=>$bikes));
	}
	function packupAnd_delete($query,$link)
	{
		$result =  $link->query($query) or die('Errant query:  '.$query);	
		$bikes = array();
 		$bikes = 'DATA DELETE SUCCESSFULLY';
		header('Content-type: application/json');
		echo json_encode(array('data'=>$bikes));
	}
	
?>