<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidad_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos las unidades
    public function getUnidades($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('unidad');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de unidad
    public function save($unidad)
    {
        $this->db->insert('unidad', $unidad);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_unidad)
    {
        $this->db->where('id_unidad', $id_unidad);
        $this->db->update('unidad', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar la unidad
    public function delete($id_unidad)
    {
        return $this->db->delete('unidad', array('id_unidad' => $id_unidad));
    }

}
