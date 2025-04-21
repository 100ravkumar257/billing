<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategory extends CMS_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/subcategory_model');
		
		$this->check_isvalidated();
	}	
	
	public function index($page_no = '')
	{
		$this->page($page_no);
	}
		
	public function page($page_no)
	{
		$data['heading']='Sub Category'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$per_page=50;
		$total_record	= $this->subcategory_model->getTotalRecord();		
		$config['base_url'] = site_url().'admin/subcategory/index';
		$config['total_rows'] = $total_record;
		$config['per_page'] = $per_page;
		$config["uri_segment"] = 4;
		
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		
		if($page_no=='')
			$limit=0;
		else
			$limit=$config["per_page"]*($page_no-1);
			
		$offset = ($limit) ? $limit : 0;
		
		$search_data['name'] = $this->input->post('name');
		$data['search_data'] = $search_data;
		
		$array_records = $this->subcategory_model->GetRecords($offset, $per_page);
		$data['records'] = $array_records; 
		
		$this->load->view('admin/subcategory', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param = '')
	{
		if(is_numeric($param)){
			$data['heading']='Edit Sub Category'; 
			
		}else{
			$data['heading']='Add Sub Category'; 
		}
		$subcategory_id = $param;
		if($subcategory_id){
			$array_records = $this->subcategory_model->GetRecordById($subcategory_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-subcategory', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if($this->form_validation->run() == FALSE){
			redirect('admin/subcategory/addedit');
		}
		else{
			
			$save = $this->subcategory_model->saveSubcategory();
			
			if($save){
				redirect('admin/subcategory');
			}else{
				
			}
		}	
	}	
}
?>