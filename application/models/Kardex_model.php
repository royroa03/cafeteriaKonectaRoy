<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kardex_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los kardexs
    public function getKardexs($where = null)
    {
        //Consulta
        $this->db->select('kardex.*,
                        producto.nombre as nombre_producto,
                        unidad.abreviatura as abreviatura_unidad,'
                        );
        $this->db->from('kardex');
        $this->db->join('producto', 'producto.id_producto = kardex.id_producto');
        $this->db->join('unidad', 'unidad.id_unidad = producto.id_unidad');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de kardex
    public function save($kardex)
    {
        $this->db->insert('kardex', $kardex);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_kardex)
    {
        $this->db->where('id_kardex', $id_kardex);
        $this->db->update('kardex', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el kardex
    public function delete($id_kardex)
    {
        return $this->db->delete('kardex', array('id_kardex' => $id_kardex));
    }

}
