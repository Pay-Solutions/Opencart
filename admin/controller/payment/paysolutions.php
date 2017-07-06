<?php 
class ControllerPaymentPaysolutions extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/paysolutions');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

			$this->load->model('setting/setting');

			$this->model_setting_setting->editSetting('paysolutions', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?token=' . $this->session->data['token'] . '&route=extension/payment');
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_authorization'] = $this->language->get('text_authorization');
		$this->data['text_sale'] = $this->language->get('text_sale');
	
		$this->data['text_updatestatus_callback'] = $this->language->get('text_updatestatus_callback');
		$this->data['text_updatestatus_callbackground_process'] = $this->language->get('text_updatestatus_callbackground_process');		
		
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_transaction'] = $this->language->get('entry_transaction');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');	
		$this->data['entry_author'] = $this->language->get('entry_author');
		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}



		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/paysolutions', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('payment/paysolutions', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/paysolutions', 'token=' . $this->session->data['token'], 'SSL');


		if (isset($this->request->post['paysolutions_email'])) {
			$this->data['paysolutions_email'] = $this->request->post['paysolutions_email'];
		} else {
			$this->data['paysolutions_email'] = $this->config->get('paysolutions_email');
		}

		if (isset($this->request->post['paysolutions_transaction'])) {
			$this->data['paysolutions_transaction'] = $this->request->post['paysolutions_transaction'];
		} else {
			$this->data['paysolutions_transaction'] = $this->config->get('paysolutions_transaction');
		}
		
		if (isset($this->request->post['paysbuy_order_status_id'])) {
			$this->data['paysbuy_order_status_id'] = $this->request->post['paysbuy_order_status_id'];
		} else {
			$this->data['paysbuy_order_status_id'] = $this->config->get('paysbuy_order_status_id'); 
		} 
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		

		if (isset($this->request->post['paysolutions_status'])) {
			$this->data['paysolutions_status'] = $this->request->post['paysolutions_status'];
		} else {
			$this->data['paysolutions_status'] = $this->config->get('paysolutions_status');
		}
		
		if (isset($this->request->post['paysolutions_sort_order'])) {
			$this->data['paysolutions_sort_order'] = $this->request->post['paysolutions_sort_order'];
		} else {
			$this->data['paysolutions_sort_order'] = $this->config->get('paysolutions_sort_order');
		}
		
		$this->template = 'payment/paysolutions.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/paysolutions')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['paysolutions_email']) {
			$this->error['email'] = $this->language->get('error_email');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>