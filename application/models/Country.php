<?php
	
require_once 'Mingual_Model.php';

class Country extends Mingual_Model
{
	public $primary_key = 'id_country';
	public $table_name = 'countries';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}

	public function getFlagUrl( $code)
	{
		return base_url()."uploads/flag/".strtolower( $code ).".png";
	}
}
?>