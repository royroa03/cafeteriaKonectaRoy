<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acceso_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	#Nuevo registro de accesos
	public function save($acceso)
	{
		$this->db->insert('acceso', $acceso);
		#Retornamos del ID genrado
		return $this->db->insert_id();
	}

}
