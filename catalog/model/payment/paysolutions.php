<?php 
class ModelPaymentPaysolutions extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('payment/paysolutions');
		
		if ($this->config->get('paysolutions_status')) {
       		$status = TRUE;
      	} else {
			$status = FALSE;
		}
		
		$method_data = array();
	
		if ($status) {  
      	$method_data = array( 
        	'code'       => 'paysolutions',
        	'title'      => $this->language->get('text_title'),
			'sort_order' => $this->config->get('paysolutions_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
	
	/*
	public function paysolutions_recheck($psbmail, $cart, $psbRef, $amount=-1){
	
		$query = "invoiceNo=$cart&merchantEmail=$psbmail&strApCode=$psbRef";

		// Request URI (Secure)
		if ($this->config->get('paysolutions_status')=="1") {
		
    		$ch = curl_init( "http://ebookingadmin_test.thaiepay.com/opencart/get_api.php");
  		} else {
			$ch = curl_init( "http://ebookingadmin_test.thaiepay.com/opencart/get_api.php");
		}			

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$query");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$xmlResponse  = curl_exec($ch);
		curl_close($ch);


		$StatusResult	= $this->XMLGetValue($xmlResponse, 'StatusResult');
		$AmountResult	= $this->XMLGetValue($xmlResponse, 'AmountResult');
		$MethodResult	= $this->XMLGetValue($xmlResponse, 'MethodResult');

		if ($StatusResult != 'Accept')
		{
			return -1; // Reject the payment.
		} else {
			return $AmountResult; // OK. Verified.
		}
	}	
	
	public function XMLGetValue($msg, $str){
		$str1 = "<$str>";
		$str2 = "</$str>";
		$start_pos = strpos($msg, $str1);
		$stop_post = strpos($msg, $str2);
		$start_pos += strlen($str1);
		return substr($msg, $start_pos, $stop_post - $start_pos);
	}	
	
	public function getuserip() {

	   if (isset($_SERVER)) {

		  if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			 return $_SERVER["HTTP_X_FORWARDED_FOR"];
		  
		  if (isset($_SERVER["HTTP_CLIENT_IP"]))
			 return $_SERVER["HTTP_CLIENT_IP"];

		  return $_SERVER["REMOTE_ADDR"];
	   }

	   if (getenv('HTTP_X_FORWARDED_FOR'))
		  return getenv('HTTP_X_FORWARDED_FOR');

	   if (getenv('HTTP_CLIENT_IP'))
		  return getenv('HTTP_CLIENT_IP');

	   return getenv('REMOTE_ADDR');
	}

	public function http_parse_query( $array = NULL, $convention = '%s' ){      
		if( count( $array ) == 0 ){      
			return '';          
		} else {          
			if( function_exists( 'http_build_query' ) ){          
				$query = http_build_query( $array );              
			} else {              
				$query = '';                 
				foreach( $array as $key => $value ){                  
					if( is_array( $value ) ){                      
						$new_convention = sprintf( $convention, $key ) . '[%s]'; 
						$query .= http_parse_query( $value, $new_convention );                          
					} else {                      
						$key = urlencode( $key ); 
						$value = urlencode( $value );                          
						$query .= sprintf( $convention, $key ) . "=$value&";                          
					}                      
				}                  
			}          
			return $query;              
		}          
	}	
*/	
	
}
?>