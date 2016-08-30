<?php
	
require_once 'Mingual_Model.php';

class Mingual extends Mingual_Model
{
	public $primary_key = 'id';
	public $table_name = 'minguals';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	function __construct(){

		parent::__construct();
	}

	public function makeMingual( $id_user, $partner_id )
	{
		return true;
	}

	public function unmatch( $partner_id )
	{
		return true;
	}

	public function getPartnerList( $id_user )
}
?>