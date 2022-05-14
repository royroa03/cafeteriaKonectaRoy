<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los stocks
    public function getStocks($where = null)
    {
        //Consulta
        $this->db->select('stock.*,producto.nombre as nombre_producto,unidad.nombre as nombre_unidad');
        $this->db->from('stock');
        $this->db->join('producto', 'producto.id_producto = stock.id_producto');
        $this->db->join('unidad', 'unidad.id_unidad = producto.id_unidad');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de stock
    public function save($stock)
    {
        $this->db->insert('stock', $stock);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_stock)
    {
        $this->db->where('id_stock', $id_stock);
        $this->db->update('stock', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el stock
    public function delete($id_stock)
    {
        return $this->db->delete('stock', array('id_stock' => $id_stock));
    }

}
