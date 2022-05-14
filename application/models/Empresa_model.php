<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
    }
    
    #Obtenemos las empresas
    public function getEmpresas($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('empresa');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de la empresa
    public function save($empresa)
    {
        $this->db->insert('empresa', $empresa);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_empresa)
    {
        $this->db->where('id_empresa', $id_empresa);
        $this->db->update('empresa', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

}
