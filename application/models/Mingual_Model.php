<?php

class Mingual_Model extends CI_Model
{
	public $table_name;
	public $primary_key;
	public $order_by_field;
	public $order_by_type = "DESC";

	function __construct(){

		parent::__construct();

		$this->_db = $this->load->database('default', TRUE);
		$this->_db->from( $this->table_name );
		if( $this->order_by_field )
			$this->_db->order_by( $this->table_name.".".$this->order_by_field, $this->order_by_type);
		else
			$this->_db->order_by( $this->table_name.".".$this->primary_key, $this->order_by_type);
	}

	public function getItems( $where = '', $first = false ){

		$this->__construct();

		if( $where != '' )
			$this->_db->where( $where );

		$query = $this->_db->get();

		if($query->num_rows() > 0)
		{
			$rows = $query->result();
			if( $first )
				return $rows[0];

			return $rows;
		}

		return NULL;
	}

	public function getItemById( $id )
	{
		$where = $this->table_name.".".$this->primary_key ."=".$id;
		$ret = $this->getItems( $where, true );

		if( !$ret )
			return NULL;
		else
			return $ret;
	}

	public function addItem( $rowData = array() ){

		if( empty($rowData) || !count($rowData) )
			return 0;

		if( $this->_db->insert( $this->table_name, $rowData ))
			return $this->_db->insert_id();
		else
			return 0;
	}

	public function deleteItem( $key_value ){

		if( !$key_value )
			return false;

		$this->_db->where("`".$this->primary_key."` = {$key_value}");

		return $this->_db->delete( $this->table_name );
	}

	public function updateItem( $rowData = array() ){

		if( !isset($rowData[$this->primary_key]) )
			return false;

		foreach( $rowData as $key => $value )
			$this->_db->set( $key, $value );

		$this->_db->where( $this->primary_key, $rowData[$this->primary_key] );

		return $this->_db->update( $this->table_name );
	}
}
?>