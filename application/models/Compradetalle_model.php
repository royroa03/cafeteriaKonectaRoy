<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compradetalle_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
    }
    
      #Obtenemos el detalle de compras
      public function getComprasDetalles($where = null)
      {
          //Consulta
          $this->db->select('
                                compradetalle.*,
                                producto.nombre as producto,
                                producto.nombre as producto,
                                moneda.simbolo as simbolo,
                                unidad.abreviatura as abreviatura
                          ');
          $this->db->from('compradetalle');
          $this->db->join('producto', 'producto.id_producto = compradetalle.id_producto');
          $this->db->join('unidad', 'unidad.id_unidad = producto.id_unidad');
          $this->db->join('moneda', 'moneda.id_moneda = producto.id_moneda');
          if(!empty($where)){$this->db->where($where);}
          $query = $this->db->get();
          if($query->num_rows() > 0)
          {
              return $query->result();
          }
  
          return false;
      }

    #Nuevo registro de la compra de detalle
    public function save($compradetalle)
    {
        $this->db->insert('compradetalle', $compradetalle);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

}
