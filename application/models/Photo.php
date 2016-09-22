<?php
	
require_once 'Mingual_Model.php';

class Photo extends Mingual_Model
{
	public $primary_key = 'id_photo';
	public $table_name = 'photos';
	public $order_by_field = 'sort';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}

}
?>