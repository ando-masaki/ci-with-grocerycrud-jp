<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/grocery_crud_controllers.php';

class Hostvars extends Grocery_crud_controllers
{

	public function index()
	{
		$table = strtolower(get_class());
                $this->grocery_crud->set_table($table);
		$this->subject = '';
		$this->grocery_crud->set_subject($this->subject);
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
		$this->saved_at_util();
		$this->output = $this->grocery_crud->render();
		$this->load->view('grocery_crud_view.php', $this);
	}

}

