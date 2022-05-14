<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los proveedores
    public function getProveedores($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('proveedor');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de proveedor
    public function save($proveedor)
    {
        $this->db->insert('proveedor', $proveedor);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_proveedor)
    {
        $this->db->where('id_proveedor', $id_proveedor);
        $this->db->update('proveedor', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el proveedor
    public function delete($id_proveedor)
    {
        return $this->db->delete('proveedor', array('id_proveedor' => $id_proveedor));
    }

}
