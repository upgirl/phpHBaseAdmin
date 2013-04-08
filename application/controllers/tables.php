<?php

class Tables extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Index()
	{
		$this->lang->load('commons');
		$this->load->model('hbase_table_model','table');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		
		$data['common_table_list'] = $this->lang->line('common_table_list');
		$this->load->view('nav_bar',$data);
		
		#Generate div container
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');
		
		//$tables_list = $this->table->get_table_names();
		//$data['table_list'] = $tables_list;
		
		$this->load->view('table_lists',$data);
		
		$this->load->view('table_admin', $data);
		
		$this->load->view('div_end');
		$this->load->view('div_end');
		
		$this->load->view('footer');
	}
	
	public function TableList()
	{
		$this->load->model('hbase_table_model', 'table');
		$table_list = $this->table->get_table_names();
		$table_list = array('table_names' => $table_list);
		echo json_encode($table_list);
	}
	
	public function GetTableRegions($table_name)
	{
		$this->load->model('hbase_table_model', 'table');
		$regions = $this->table->get_table_regions($table_name);
		echo json_encode($regions);
	}
}

?>