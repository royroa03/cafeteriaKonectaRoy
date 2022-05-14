<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moneda_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos las monedas
    public function getMonedas($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('moneda');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

}
