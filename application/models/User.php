<?php
	
require_once 'Mingual_Model.php';

class User extends Mingual_Model
{
	public $primary_key = 'id_user';
	public $table_name = 'users';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}

}
?>