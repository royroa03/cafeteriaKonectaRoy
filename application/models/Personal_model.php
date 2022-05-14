<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los personales
    public function getPersonales($where = null)
    {
        //Consulta
        $this->db->select('personal.*, empresa.razon_social as razon_social_empresa ');
        $this->db->from('personal');
        $this->db->join('empresa', 'empresa.id_empresa = personal.id_empresa','left');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de personal
    public function save($personal)
    {
        $this->db->insert('personal', $personal);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_personal)
    {
        $this->db->where('id_personal', $id_personal);
        $this->db->update('personal', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el personal
    public function delete($id_personal)
    {
        return $this->db->delete('personal', array('id_personal' => $id_personal));
    }

}
