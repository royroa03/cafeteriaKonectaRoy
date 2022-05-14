<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los productos
    public function getProductos($where = null)
    {
        //Consulta
        $this->db->select('producto.*, 
                            cat.nombre as nombre_categoria, 
                            unid.nombre as nombre_unidad,
                            unid.abreviatura as abreviatura_unidad, 
                            mon.simbolo as simbolo_moneda,
                            sto.cantactual as cantactual_stock
                            ');
        $this->db->from('producto');
        $this->db->join('categoria AS cat', 'cat.id_categoria = producto.id_categoria');
        $this->db->join('unidad AS unid', 'unid.id_unidad = producto.id_unidad');
        $this->db->join('moneda AS mon', 'mon.id_moneda = producto.id_moneda');
        $this->db->join('stock AS sto', 'sto.id_producto = producto.id_producto');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de producto
    public function save($producto)
    {
        $this->db->insert('producto', $producto);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_producto)
    {
        $this->db->where('id_producto', $id_producto);
        $this->db->update('producto', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el producto
    public function delete($id_producto)
    {
        return $this->db->delete('producto', array('id_producto' => $id_producto));
    }

}
