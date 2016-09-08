<?php
	
require_once 'Mingual_Model.php';

class Mingual extends Mingual_Model
{
	public $primary_key = 'id';
	public $table_name = 'minguals';
	public $order_by_field = '';
	public $order_by_type = "ASC";

	public function makeMingual( $id_user, $partner_id )
	{
		$where = "(`id_partner1`=$id_user AND `id_partner2`=$partner_id) OR (`id_partner2`=$id_user AND `id_partner1`=$partner_id)";
		$exist = $this->getItems( $where, true );

		if( !empty($exist) && count($exist) > 0 )
		{
			if( $exist->status == 0 )
				return array("status"=>false, "message"=>"Already unmatched each other."); 

			if( $exist->id_partner1 == $id_user )
			{
				if( $exist->mingual_status1 == 1 )
					return array("status"=>false, "message"=> "Already mingualed with that user."); 

				$this->updateItem(array("id" => $exist->id, "mingual_status1" => 1));
				return array("status"=>true, "mingual"=> $this->getItemById($exist->id)); 
			}
			if( $exist->id_partner2 == $id_user )
			{
				if( $exist->mingual_status2 == 1 )
					return array("status"=>false, "message"=> "Already mingualed with that user."); 
				$this->updateItem(array("id" => $exist->id, "mingual_status2" => 1));
				return array("status"=>true, "mingual"=> $this->getItemById($exist->id)); 
			}
		}

		$id = $this->addItem( array("id_partner1"=>$id_user, "id_partner2"=>$partner_id, "mingual_status1"=>1, "mingual_status2"=>0, "status"=>1));
		return array("status"=>true, "mingual"=> $this->getItemById($id)); 
	}

	public function unmatch( $id_user, $partner_id )
	{
		$where = "(`id_partner1`=$id_user AND `id_partner2`=$partner_id) OR (`id_partner2`=$id_user AND `id_partner1`=$partner_id)";
		$exist = $this->getItems( $where, true );

		if( empty($exist) && count($exist) == 0 )
			return false;

		if( $exist->status == 0 )
			return false;

		if( $exist->id_partner1 == $id_user )
		{
			if( $exist->mingual_status2 == 0 )
				$this->updateItem(array("id" => $exist->id, "mingual_status1" => 0, "mingual_status2" => 0, "status" => 0));
			else
				$this->updateItem(array("id" => $exist->id, "mingual_status1" => 0));

			return true;
		}

		if( $exist->id_partner2 == $id_user )
		{
			if( $exist->mingual_status1 == 0 )
				$this->updateItem(array("id" => $exist->id, "mingual_status1" => 0, "mingual_status2" => 0, "status" => 0));
			else
				$this->updateItem(array("id" => $exist->id, "mingual_status2" => 0));

			return true;
		}

		return false;
	}

	public function getPartnerList( $id_user, $offset = 0 )
	{
		$where = "(`id_partner1`=$id_user OR `id_partner2`=$id_user) AND `status`=1";

		$this->__construct();
		$this->_db->select( "*");
		$this->_db->where( $where );

		$count = 0;
		$count = $this->_db->count_all_results();

		$this->__construct();
		$this->_db->select( "*");
		$this->_db->where( $where );

		if( $offset > 0 )
			$this->_db->limit( $this->config->item('rows_per_page'), $offset);
		else
			$this->_db->limit( $this->config->item('rows_per_page') );

		$query = $this->_db->get();
		if($query->num_rows() > 0)
		{
			$rows = $query->result();

			foreach( $rows as &$val ){
				$id_partner = ( $id_user == $val->id_partner1 )? $val->id_partner2 : $val->id_partner1;
				$val = $this->User->getFullProfileById( $id_partner );
			}

			return array( "count" => $count, "offset"=>$offset, "data"=> $rows );
		}

		return NULL;
	}
}
?>