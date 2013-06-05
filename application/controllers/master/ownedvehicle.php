<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ownedvehicle extends CI_Controller {
	
	public function index() {
		
		$this->section();
	}
	
	public function section() {
		
		$section = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		$id = ($this->uri->segment(5)) ? $this->uri->segment(5) : '';
		
		switch ($section) {
			case 'ownedvehicle':
				$this->_ownedVehicle();
				break;				
			case 'addownedvehicle':
				$this->_addOwnedVehicle();
				break;
			default:
				$this->_ownedVehicle();
		}
	}
	
	private function _ownedVehicle() {
		
		$this->load->model('mdl_ownedvehicle');		
		$dataset = $this->mdl_ownedvehicle->retrieve();
		$data['records'] = $dataset['records'];
		$data['count'] = $dataset['count'];
		$data['main_content'] = 'master/vehicle_owner/vehicle_owner_view';
		$this->load->view('includes/template', $data);
	}
	
	private function _addOwnedVehicle() {
		
		$data['main_content'] = 'master/vehicle_owner/vehicle_owner_add_view';
		$this->load->view('includes/template', $data);
	}
	
	public function validateaddownedvehicle() {
		
		$this->load->library('form_validation');
		
		$validation = $this->form_validation;
		
		$validation->set_rules('plateno', 'Plate No.', 'required');
		$validation->set_rules('makecode', 'Make', 'required');
		$validation->set_rules('make', 'Make', 'required');
		$validation->set_rules('colorcode', 'Color', 'required');
		$validation->set_rules('color', 'Color', 'required');
		$validation->set_rules('description', 'Description');
		$validation->set_rules('customercode', 'Owner', 'required');
		$validation->set_rules('owner', 'Owner', 'required');
		
		if($validation->run() === FALSE) {
			$this->_addOwnedVehicle();
		}else {
			$this->load->model('mdl_ownedvehicle');
			
			if($this->mdl_ownedvehicle->add())
				redirect(base_url('master/ownedvehicle'));
			else
				echo 'Inserting record failed.';
		}
		
	}
	
} 