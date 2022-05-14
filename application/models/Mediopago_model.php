<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mediopago_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los medios de pagos
    public function getMediospagos($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('mediopago');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de medios de pagos
    public function save($mediopago)
    {
        $this->db->insert('mediopago', $mediopago);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_mediopago)
    {
        $this->db->where('id_mediopago', $id_mediopago);
        $this->db->update('mediopago', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el medio de pago
    public function delete($id_mediopago)
    {
        return $this->db->delete('mediopago', array('id_mediopago' => $id_mediopago));
    }

}
