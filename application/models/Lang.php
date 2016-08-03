<?php
	
require_once 'Mingual_Model.php';

class Lang extends Mingual_Model
{
	public $primary_key = 'id_lang';
	public $table_name = 'languages';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}

}
?>