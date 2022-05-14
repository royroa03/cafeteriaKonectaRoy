<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los perfiles
    public function getPerfiles($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('perfil');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de perfil
    public function save($perfil)
    {
        $this->db->insert('perfil', $perfil);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_perfil)
    {
        $this->db->where('id_perfil', $id_perfil);
        $this->db->update('perfil', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el perfil
    public function delete($id_perfil)
    {
        return $this->db->delete('perfil', array('id_perfil' => $id_perfil));
    }

}
