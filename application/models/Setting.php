<?php
	
require_once 'Mingual_Model.php';

class Setting extends Mingual_Model
{
	public $primary_key = 'id';
	public $table_name = 'settings';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}
	
}
?>