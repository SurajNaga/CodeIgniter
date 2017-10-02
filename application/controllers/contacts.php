<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	/**
	 * Address Data
	 * List, add
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('contact');
    }

	public function list()
	{
		$data = array();

		if($this->input->post()) {
			$data['search_name'] = $this->input->post('search_name');
		}

		$data['returnType'] = 'count';
		$config['base_url'] = $this->config->base_url().'contacts/list';
		$config['total_rows'] = $this->contact->getRows($data);
		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		$data['contact_data'] = $this->contact->getRows();
		$this->load->view('contacts/list', $data);
	}

	public function create()
	{
		$data = array();
		$data['success_msg'] = '';
		$data['error_msg'] = '';
		$data['error_status'] = 0;

		if($this->input->post()) {
			$this->form_validation->set_rules('cnt_name', 'Name', 'required|min_length[5]|max_length[40]');
			$this->form_validation->set_rules('cnt_email', 'Email', 'trim|required|is_unique[contact.cnt_email]');
			$this->form_validation->set_rules('cnt_address', 'Address', 'required|min_length[10]|max_length[250]');
			$this->form_validation->set_rules('cnt_phone', 'Phone', 'required|min_length[8]|max_length[20]');
			//$this->form_validation->run();
			//die(print_r($this->form_validation->error_array()));

			$contactData = array(
                'cnt_name' => strip_tags($this->input->post('cnt_name')),
                'cnt_email' => strip_tags($this->input->post('cnt_email')),
                'cnt_address' => strip_tags($this->input->post('cnt_address')),
                'cnt_phone' => strip_tags($this->input->post('cnt_phone'))
            );

            if ($this->form_validation->run() == true) {
            	$insert = $this->contact->insert($contactData);
                if($insert){
                    $data['success_msg'] = 'Address was stored successfully.';
                    $data['error_status'] = 1;
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                    $data['error_status'] = 0;
                }
            } else {
				$data['error_msg'] = 'Some problems occured, please try again.';
				$data['error_status'] = 0;
            }

		}

		echo json_encode($data);
	}
}
