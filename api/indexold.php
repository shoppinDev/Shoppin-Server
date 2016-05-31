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
		case "customer_register":
			$email=$_GET['email'];
			$password =$_GET['password'];
			/*$name =$_GET['name'];
			$mobile =$_GET['mobile'];*/
			
			$queryc = "SELECT * from `deal_customer` where customer_email = '".$email."'    ";
			
			$result =  $link->query($queryc) or die('Errant query:  '.$queryc);	
			 
			$num_rowsc = $result->num_rows;
			 
			if($num_rowsc>0) 
			{
				header('Content-type: application/json');
				$bikes[] = array('responsecode' => '0', 'message' => 'Email Already Registered', 'userid' => null);
				echo json_encode(array('data'=>$bikes));	
			} else {
				
				$query = "INSERT INTO `deal_customer` (`customer_email`, `customer_password`) VALUES ('".$email."', '".$password."')";
				
				$result =  $link->query($query) or die('Errant query:  '.$query);
				$usersid = $link->insert_id;
				$bikes = array();
				if($usersid > 0) { 
					$message = '<div style="width:700px; height:auto; margin:0 auto;"> 
						<p>Dear User,</p>
						<p>Congratulations! You have successfully created your account with Shoppin.com</p>
						<p>Your Login Details as below: </p>

						<table><tr>
						<!--<td>Name:</td><td>'.$name.'</td></tr>-->
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
		 
		case "login":
			$email=$_GET['email'];
			$password =$_GET['password'];
			$query1 = "SELECT * from deal_customer where customer_email = '".$email."'";
			$query = "SELECT * from deal_customer where customer_email = '".$email."' AND customer_password = '".$password."'  ";
			
			$result1 =  $link->query($query1) or die('Errant query:  '.$query1);	
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$num_rows_email = $result1->num_rows;
			$num_rows = $result->num_rows;
			$usersid;
			$usersname;
			if($num_rows_email>0)
			{
			if($num_rows>0) 
			{
				while($bike = $result->fetch_assoc())
				{
					$usersid = $bike['customer_id'];
					$usersname = $bike['customer_name'];
				}
				$bikes[] = array('responsecode' => '1', 'message' => 'success', 'userid' => $usersid, 'username' => $usersname);
			}else{
					$bikes[] = array('responsecode' => '0', 'message' => 'Password is Incorrect', 'userid' => null, 'username' =>null);
				}
				}else{
					$bikes[] = array('responsecode' => '0', 'message' => 'Email Id Dose Not exist', 'userid' => null, 'username' =>null);	
					
				}		
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));		
		break;
		
		
		case "forgotpassword":
			$email=$_GET['email'];
 			$query = "SELECT * from deal_customer where customer_email = '".$email."' ";
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$num_rows = $result->num_rows;
			if($num_rows>0) 
			{
				while($bike = $result->fetch_assoc())
				{
				$message = '<div style="width:700px; height:auto; margin:0 auto;">
						<p>Password is Below,</p>
						<p>Greeting from Shoppin.com .</p>
						<table>
							<tr><td>Email:</td><td>'.$bike['customer_email'].'</td></tr>
							<tr><td>Password:</td><td>'.$bike['customer_password'].'</td></tr>
						</table>
						</div>';
		  
						$to = $bike['customer_email']; 
						$subject  = 'Lost Password';  
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:  Shoppin.com <info@ibizsolutions.net>' . "\r\n" .
									'Reply-To:  info@ibizsolutions.net' . "\r\n" .
									'X-Mailer: PHP/' . phpversion();
						//$headers .= 'BCc: amvisolution@gmail.com' . "\r\n";
						mail($to,$subject,$message,$headers);  
						$overview = 'Email Sent';
				}
			} else {
				$overview = 'Invalid Email Id. Email Id doesn\'t in our System';	
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
			$query = "UPDATE deal_customer SET customer_password = '".$pass."'  WHERE customer_id  = '".$id."' ";
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$bikes[] = 'PASSWORD UPDATE SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break;
		
		case "deal_detail":
			$id = $_GET['id'];
 			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dshop.shop_addres, dshop.shop_latitude, dshop.shop_longitude,dshop.shop_name,dm.merchant_name  from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join deal_merchant dm on dm.merchant_id = d.merchant_id
						left join  deal_merchantshops dshop on dshop.shop_id = d.shop_id
						where d.deal_id = '".$id."' ";
			$result =  $link->query($query) or die('Errant query:  '.$query);	
		$bikes = array();
		$num_rows = $result->num_rows;
		
		if($result->num_rows > 0){
                           
                           while($roee = $result->fetch_assoc()){
								$asd['dealid'] = $roee['deal_id'];
							    $asd['merchantid'] = $roee['merchant_id'];
								$asd['shopid'] = $roee['shop_id'];
								$asd['dealcategory'] = $roee['deal_category'];
								$asd['dealsubcategory'] = $roee['deal_subcategory'];
								$asd['dealtitle'] = $roee['deal_title'];
								$asd['dealdescription'] = $roee['deal_description'];
								$asd['dealstartdate'] = $roee['deal_startdate'];
								$asd['dealenddate'] = $roee['deal_enddate'];
								$asd['dealamount'] = $roee['deal_amount'];
								$asd['alldays'] = $roee['all_days'];
								$asd['dealusage'] = $roee['deal_usage'];
								$asd['location'] = $roee['location'];
								$asd['discounttype'] = $roee['discount_type'];
								$asd['discountvalue'] = $roee['discount_value'];
								$asd['isactive'] = $roee['is_active'];
								$asd['addeddate'] = $roee['added_date'];
								$asd['categoryname'] = $roee['category_name'];
								$asd['subcategoryname'] = $roee['subcategory_name'];
								$asd['merchantname'] = $roee['merchant_name'];
								$asd['shopname'] = $roee['shop_name'];
								$asd['shop_latitude'] = $roee['shop_latitude'];
								$asd['shop_longitude'] = $roee['shop_longitude'];
							 if($roee['discount_type']=='0'){
								 $asd['orignal_value'] = $roee['deal_amount']-$roee['discount_value'];
								}else{
									$value=$roee['deal_amount']*($roee['discount_value']/100);
									$asd['orignal_value'] = $roee['deal_amount']-$value;
									}  
                                array_push($bikes,$asd);
                           }
                       }
		header('Content-type: application/json');
		echo json_encode(array('data'=>$bikes));			
			//packupAndSend($query,$link);		
		break;
		case "deal_list":
 			$query = " SELECT d.*,dc.category_name,ds.subcategory_name,dm.merchant_name,ms.shop_name from deal_deals d 
						left join deal_category dc on dc.category_id = d.deal_category
						left join deal_subcategory ds on ds.subcategory_id = d.deal_subcategory
						left join deal_merchant dm on dm.merchant_id = d.merchant_id
						left join deal_merchantshops ms on ms.shop_id = d.shop_id
						where d.deal_id <> 0 and  d.is_active = 1  and d.deal_startdate <= NOW() and d.deal_enddate >= NOW() ";
		$result =  $link->query($query) or die('Errant query:  '.$query);	
		$bikes = array();
		$num_rows = $result->num_rows;
		
		if($result->num_rows > 0){
                           
                           while($roee = $result->fetch_assoc()){
                               $asd['dealid'] = $roee['deal_id'];
							    $asd['merchantid'] = $roee['merchant_id'];
								$asd['shopid'] = $roee['shop_id'];
								$asd['dealcategory'] = $roee['deal_category'];
								$asd['dealsubcategory'] = $roee['deal_subcategory'];
								$asd['dealtitle'] = $roee['deal_title'];
								$asd['dealdescription'] = $roee['deal_description'];
								$asd['dealstartdate'] = $roee['deal_startdate'];
								$asd['dealenddate'] = $roee['deal_enddate'];
								$asd['dealamount'] = $roee['deal_amount'];
								$asd['alldays'] = $roee['all_days'];
								$asd['dealusage'] = $roee['deal_usage'];
								$asd['location'] = $roee['location'];
								$asd['discounttype'] = $roee['discount_type'];
								$asd['discountvalue'] = $roee['discount_value'];
								$asd['isactive'] = $roee['is_active'];
								$asd['addeddate'] = $roee['added_date'];
								$asd['categoryname'] = $roee['category_name'];
								$asd['subcategoryname'] = $roee['subcategory_name'];
								$asd['merchantname'] = $roee['merchant_name'];
								$asd['shopname'] = $roee['shop_name'];
								if($roee['discount_type']=='0'){
									$asd['orignal_value'] = $roee['deal_amount']-$roee['discount_value'];
								}else{
									$value=$roee['deal_amount']*($roee['discount_value']/100);
									$asd['orignal_value'] = $roee['deal_amount']-$value;
								}  
                              array_push($bikes,$asd);
                               
                           }
                       }
		header('Content-type: application/json');
		echo json_encode(array('data'=>$bikes));		
			//packupAndSend($query,$link);		
		break;
		
		case "redeem_book":
			$customer_id = $_GET['customer_id'];
			$deal_id = $_GET['deal_id'];
			$amount = $_GET['amount'];
			//$order_date = $_GET['order_date'];
			//$order_status = $_GET['order_status'];
			
		
			$query = "INSERT INTO `deal_order` (`customer_id`, `deal_id`, `amount`, `order_date`) VALUES ('".$customer_id."', '".$deal_id."' , '".$amount."' , '".date("Y-m-d")."')";
			 
			$result =  $link->query($query) or die('Errant query:  '.$query);	
			$bikes = array();
			$bikes[] = 'YOUR ORDER SUCCESSFULLY';
			header('Content-type: application/json');
			echo json_encode(array('data'=>$bikes));
		break;
		
		
		case "saved_offers":
			$id = $_GET['id'];
 			$query = "SELECT d.*,dl.*,ds.shop_name,ds.shop_addres, ds.shop_latitude,ds.shop_longitude  from deal_saveddeals d 
						left join deal_deals dl on dl.deal_id = d.deal_id
						left join deal_merchantshops ds on ds.shop_id = dl.shop_id
						where d.customer_id = '".$id."' ";
			packupAndSend($query,$link);		
		break;
		case "my_account":
			$id = $_GET['id'];
 			$query = " SELECT * from deal_customer where customer_id = '".$id."'";
			packupAndSend($query,$link);		
		break;
	
		case "redemmed_offers":
			$id = $_GET['id'];
 			$query = "SELECT d.*,dl.*,ds.shop_name,ds.shop_addres, ds.shop_latitude,ds.shop_longitude  from deal_order d 
						left join deal_deals dl on dl.deal_id = d.deal_id
						left join deal_merchantshops ds on ds.shop_id = dl.shop_id
						where d.customer_id = '".$id."' ";
			packupAndSend($query,$link);		
		break;
	
		case "save_dealto_drafts":
			$merchantid = $_GET['customer_id'];
			$deal_id = $_GET['deal_id'];
			$query = "INSERT INTO `deal_saveddeals` (`customer_id`,`deal_id` ) VALUES ('".$merchantid."' ,'".$deal_id."' );"; 
			packupAndSend_register($query,$link);	
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