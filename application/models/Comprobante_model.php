<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comprobante_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los comprobantes
    public function getComprobantes($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('comprobante');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de comprobante
    public function save($comprobante)
    {
        $this->db->insert('comprobante', $comprobante);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_comprobante)
    {
        $this->db->where('id_comprobante', $id_comprobante);
        $this->db->update('comprobante', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el comprobante
    public function delete($id_comprobante)
    {
        return $this->db->delete('comprobante', array('id_comprobante' => $id_comprobante));
    }

}
