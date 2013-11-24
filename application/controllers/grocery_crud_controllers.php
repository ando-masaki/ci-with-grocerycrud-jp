<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grocery_crud_controllers extends CI_Controller
{

	private $theme = 'twitter-bootstrap';
	public  $subject;
	public  $output;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_theme($this->theme);
	}

	public function index($param='')
	{
		redirect(site_url(array(strtolower(get_class($this)), 'manage', $param)), 'location');
	}

	public function manage($table_name='')
	{
		$table_name or show_error('Parameter table_name is required.');
		$this->grocery_crud->set_table($table_name);
		$this->subject = ucfirst($table_name);
		$this->grocery_crud->set_subject($this->subject);
		$this->output = $this->grocery_crud->render();
		$this->load->view('grocery_crud_view.php', $this);
	}

	public function saved_at_util()
	{
		$this->grocery_crud->display_as('created_at', '作成日時');
		$this->grocery_crud->display_as('updated_at', '更新日時');
		$this->grocery_crud->field_type('created_at', 'invisible');
		$this->grocery_crud->field_type('updated_at', 'invisible');
		$this->grocery_crud->callback_before_insert(array($this, 'set_saved_at'));
		$this->grocery_crud->callback_before_update(array($this, 'set_saved_at'));
	}

	public function set_saved_at($post_array, $primary_key=NULL)
	{
		$datetime = new DateTime;
		$now = $datetime->format('Y-m-d H:i:s');
		if (! $primary_key)
			$post_array['created_at'] = $now;
		$post_array['updated_at'] = $now;
		return $post_array;
	}
}

