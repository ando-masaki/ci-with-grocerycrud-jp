<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class grocery_CRUD_Controller extends CI_Controller
{

	private $crud;
	private $theme = 'twitter-bootstrap';
	private $table;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
                $this->crud = new grocery_CRUD();
                $this->crud->set_theme($this->theme);
                $this->table = strtolower(get_class());
                $this->crud->set_table($this->table);
	}

	public function index()
	{
		$output = $this->crud->render();
		$this->load->view('grocery_crud_view.php', $output);
	}

}

