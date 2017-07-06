<?php
class ControllerPaymentPaysolutions extends Controller {

	protected function index() {

		$this->language->load('payment/paysolutions');
		$this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		//เปลี่ยนภาษา
		$paysolutions_languages=array(
			'th'=>'TH',
			'en'=>'EN'
			
		);
		
		if (array_key_exists($this->session->data['language'],$paysolutions_languages)){
			$lang=$paysolutions_languages[$this->session->data['language']];
		}else{
			$lang='th';//default Thai language
		}		

		//ส่งไปหน้า Paysolutions
	
			$this->data['action'] = 'https://www.thaiepay.com/epaylink/payment.aspx?lang='.$lang;
	

		
		$this->load->model('checkout/order');
		
		if ($order_info) {
			
			$this->data['button_confirm'] = $this->language->get('button_confirm');
			$this->data['button_back'] = $this->language->get('button_back');
			
			//ค่าส่งไป Paysolutions

			$this->data['youraccount'] = html_entity_decode($this->config->get('paysolutions_email'), ENT_QUOTES, 'UTF-8');
			$this->data['paysolutions_transaction'] = $this->config->get('paysolutions_transaction');

			
				
			
			$this->data['invoice'] = $this->session->data['order_id'] ;
			$this->data['price'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		
			//ดึงชื่อสินค้ามาแสดง
			$this->data['products'] = array();
			
			foreach ($this->cart->getProducts() as $product) {		
				$this->data['products'][] = array(
					'name'     => $product['name']
				);
				$title_item[]=$product['name'];
			}
			$this->data['description'] =implode(",", $title_item);	
	
			//เปลี่ยนค่าเงิน 

			 $cur=$this->currency->getCode() ;

			$currencies = array(
				'AUD',
				'CAD',
				'EUR',
				'GBP',
				'JPY',
				'USD',
				'NZD',
				'CHF',
				'HKD',
				'SGD',
				'SEK',
				'DKK',
				'PLN',
				'NOK',
				'HUF',
				'CZK',
				'ILS',
				'MXN',
				'MYR',
				'BRL',
				'PHP',
				'TWD',
				'THB',
				'TRY',
				'THB'
			);
			
			$paysolutions_currencies= array(
				'THB'=>'764',
				'AUD'=>'036',
				'GBP'=>'826',
				'EUR'=>'978',
				'HKD'=>'344',
				'JPY'=>'392',
				'NZD'=>'554',
				'SGD'=>'702',
				'CHF'=>'756',
				'USD'=>'840'
			);
				
			
			if (in_array($order_info['currency_code'], $currencies)) {
				if (array_key_exists($order_info['currency_code'],$paysolutions_currencies)){
					$currency = $paysolutions_currencies[$order_info['currency_code']];
					//$currency = $order_info['currency_code'];
				}else{
					$currency = '764';//Default THB
				}
			} else {
				$currency = '764';//Default THB
			}			
						
			$this->data['currencyCode'] =$currency;
			$this->data['postURL'] =$this->url->link('payment/paysolutions/callback');
			
			
		
		/*	if ($this->config->get('paysolutions_transaction')=="1") {
				$this->data['paymentaction'] = 'Payment';
			} else {
				$this->data['paymentaction'] = 'Test';
			}
			*/	
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paysolutions.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/payment/paysolutions.tpl';
			} else {
				$this->template = 'default/template/payment/paysolutions.tpl';
			}	
			$this->render();	
		}
		
		}
	
	

	public function callback() {


		$this->load->model('payment/paysolutions');
		$this->load->model('checkout/order');
		
	
		  
		$refno	 = $this->request->post['refno'];
		$total  = $this->request->post['total'];
		$merchantid = $this->request->post['merchantid'];
		$status = $this->request->post['status'];
		
		$error = '';
		

		
			if ($status =="CP") {
			
					$this->model_checkout_order->confirm($refno , $this->config->get('paysbuy_order_status_id'));
				
			}
		} 
			
	
			
}

?>