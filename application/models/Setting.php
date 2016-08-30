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
	
	public function createDefaultSetting( $id_user )
	{
		$exists = $this->getItems( "`id_user`='".$id_user."'", true );

		if( count($exists) > 0 )
			return 0;

		$arrSetting = array(
				"id_user" 	=> $id_user,
				"new_partner"	=> 1,
				"new_message"	=> 1,
				"vibration"		=> 1,
				"alert"			=> 1,
				"show_me"		=> 1,
				"id_teach_lang"	=> 0,
				"id_learn_lang"	=> 0,
				"sch_radius"	=> 100,
				"sch_city"		=> "",
				"sch_gender"	=> "m",
				"sch_age_low"	=> 18,
				"sch_age_high"	=> 100,
				"sch_type"		=> "l"
				
			);
		return $this->addItem( $arrSetting );
	}
}
?>