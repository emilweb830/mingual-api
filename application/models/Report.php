<?php
	
require_once 'Mingual_Model.php';

class Report extends Mingual_Model
{
	public $primary_key = 'id_report';
	public $table_name = 'reports';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}

}
?>