<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos las categorías
    public function getCategorias($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('categoria');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de categoría
    public function save($categoria)
    {
        $this->db->insert('categoria', $categoria);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_categoria)
    {
        $this->db->where('id_categoria', $id_categoria);
        $this->db->update('categoria', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar la categoria
    public function delete($id_categoria)
    {
        return $this->db->delete('categoria', array('id_categoria' => $id_categoria));
    }

}
