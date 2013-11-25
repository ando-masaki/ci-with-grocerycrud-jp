<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/grocery_crud_controllers.php';

class Hostvars extends Grocery_crud_controllers
{

	public function manage($p_code='')
	{
		$p_code or show_error('Parameter p_code is required.');
		$table = strtolower(get_class($this));
		$this->grocery_crud->set_table($table);
		$this->subject = '';
		$this->grocery_crud->set_subject($this->subject);
		$this->grocery_crud->where('hostvars.p_code', $p_code);
		$this->grocery_crud->display_as('p_code', 'プロジェクトコード');
		$this->grocery_crud->display_as('hostname', 'ホスト名');
		$this->grocery_crud->display_as('name', '変数名');
		$this->grocery_crud->display_as('value', '値');
		$this->grocery_crud->required_fields(
			'p_code',
			'hostname',
			'name',
			'value'
		);
		$this->grocery_crud->field_type('p_code', 'hidden', $p_code);
		$hostnames = array();
		$ip_lists = $this->db
			->select('ipl_hostname')
			->from('ip_list')
			->where('ipl_code', $p_code)
			->group_by('ipl_hostname')
			->order_by('ipl_hostname')
			->get()
			->result();
		foreach ($ip_lists as $ip_list)
			$hostnames[] = $ip_list->ipl_hostname;
		$this->grocery_crud->field_type('hostname', 'enum', $hostnames);
		$this->grocery_crud->set_rules('name', '変数名', 'alpha_dash');
		$this->saved_at_util();
		$this->renderer = $this->grocery_crud->render();
		$this->load->view('grocery_crud_view.php', $this);
	}

}

