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

	public function checkLogin( $token )
	{
		$exists = $this->getItems( "`token`='".$token."' AND active =1", true );

		if( count($exists) > 0 )
			return $exists->id_user;
		
		return false;
	}

	public function getFullProfileById( $id_user )
	{
		$user = $this->getItems( "id_user=". $id_user. " AND active=1", true );
		if( empty( $user ) || count($user) < 1)
			return false;
		if( $user->id_country )
			$user->country = $this->Country->getItemById( $user->id_country );
		unset( $user->id_country );

		$user->teach_lang = $this->Lang->getItemById( $user->teach_lang );

		$user->learn_lang = $this->Lang->getItemById( $user->learn_lang );

		$user->photos = $this->Photo->getItems( "id_user=".$id_user );

		if( isset($user->country) )
			$user->country->flag = $this->Country->getFlagUrl( $user->country->country_code );
		
		if( isset( $user->token ) )
			unset( $user->token );
		return $user;
	}

	public function searchUserBySetting( $id_user, $arrOptions, $offset = 0 )
	{
		$current_user = $this->getItemById( $id_user );

		$lat = $current_user->latitude;
		$lon = $current_user->longitude;
		$r = $arrOptions->sch_radius;

		$this->__construct();
		$this->_db->select( "users.id_user");
		$this->_db->join( "settings", "settings.id_user = ".$this->table_name.".".$this->primary_key , 'left');
		$this->_db->join( "minguals", "minguals.id_partner1 = ".$this->table_name.".".$this->primary_key . " OR minguals.id_partner2 = ".$this->table_name.".".$this->primary_key, 'left');

		// build query
        $where = "1";
        $where .= " AND users.`id_user`!= ". $id_user;

	    if( $arrOptions->sch_gender != "b" )
        	$where .= " AND `gender`='".$arrOptions->sch_gender."'";

        if( $arrOptions->id_teach_lang > 0 )
            $where .= " AND `teach_lang`=".$arrOptions->id_teach_lang;

        if( $arrOptions->id_learn_lang > 0 )
            $where .= " AND `learn_lang`=".$arrOptions->id_learn_lang;

        if( $arrOptions->sch_city != "" && $arrOptions->sch_type == "g" )
            $where .= " AND `hometown` like '%".$arrOptions->sch_city."%'";

        if( $arrOptions->sch_type == "l")
	        // calculate distance as mile
	        // earth's radius: 6371 km, 3959 ml
	        $where .= " AND 3959 * 2 * ASIN(SQRT( POW(SIN(($lat - ".$this->table_name.".latitude) * pi()/180 / 2), 2) + COS($lat * pi()/180) * COS(".$this->table_name.".latitude * pi()/180) * POW(SIN(($lon - ".$this->table_name.".longitude) * pi()/180 / 2), 2) )) < $r";

        $where .= " AND `age` > ". $arrOptions->sch_age_low." AND `age` < ".$arrOptions->sch_age_high;
        $where .= " AND settings.`show_me`=1 AND users.`active`=1";
		$where .= " AND (!( (`id_partner1`=".$id_user." && `mingual_status1`='1' && `id_partner2`=users.id_user) OR (`id_partner2`=".$id_user." && `mingual_status2`='1' && `id_partner1`=users.id_user)) OR ( (`id_partner1` is NULL) && (`id_partner2` is NULL) ))";

		$this->_db->where( $where );
		$count = 0;
		$count = $this->_db->count_all_results();

		/* get the result */ 
		$this->__construct();
		$this->_db->select( "*, users.id_user");
		$this->_db->join( "settings", "settings.id_user = ".$this->table_name.".".$this->primary_key , 'left');
		$this->_db->join( "minguals", "minguals.id_partner1 = ".$this->table_name.".".$this->primary_key . " OR minguals.id_partner2 = ".$this->table_name.".".$this->primary_key, 'left');
		$this->_db->where( $where );

		if( $offset > 0 )
			$this->_db->limit( $this->config->item('rows_per_page') , $offset);
		else
			$this->_db->limit( $this->config->item('rows_per_page') );

		$query = $this->_db->get();
		if($query->num_rows() > 0)
		{
			$rows = $query->result();
			foreach( $rows as &$v)
			{

				$v = $this->getFullProfileById( $v->id_user );
				$v->distance 	= 3959 * 2 * ASIN(SQRT( POW(SIN(($lat - $v->latitude) * pi()/180 / 2), 2) + COS($lat * pi()/180) * COS( $v->latitude * pi()/180) * POW(SIN(($lon - $v->longitude) * pi()/180 / 2), 2) ));
			}

			return array( "count" => $count, "offset"=>$offset, "data"=> $rows );
		}

        return NULL;
	}
}
?>