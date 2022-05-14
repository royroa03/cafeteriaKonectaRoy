<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditoproveedordetalle_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
    }
    
    #Nuevo registro del detalle de crédito proveedor 
	public function save($creditoproveedordetalle)
	{
		$this->db->insert('creditoproveedordetalle', $creditoproveedordetalle);
		#Retornamos del ID genrado
		return $this->db->insert_id();
	}

    #Obtenemos los créditos de proveedores detalles
    public function getCreditosProveedoresDetalles($where = null)
    {
        //Consulta
        $this->db->select('creditoproveedordetalle.id_creditoproveedordetalle,
                            creditoproveedordetalle.feregistro as feregistro_creditoproveedordetalle,
                            creditoproveedordetalle.total as total_creditoproveedordetalle,
                            compra.id_compra,
                            compra.feregistro as feregistro_compra,
                            compra.total as total_compra,
                            creditoproveedor.deuda as deuda_creditoproveedor,
                            proveedor.tipo_doc as tipo_doc_proveedor,
                            proveedor.nro_doc as nro_doc_proveedor,
                            concat_ws(" ", proveedor.razon_social) as proveedor,
                            moneda.simbolo as simbolo_moneda
                        ');
        $this->db->from('creditoproveedordetalle');
        $this->db->join('creditoproveedor', 'creditoproveedor.id_creditoproveedor = creditoproveedordetalle.id_creditoproveedor');
        $this->db->join('compra', 'compra.id_compra = creditoproveedor.id_compra');
        $this->db->join('proveedor', 'proveedor.id_proveedor = compra.id_proveedor');
        $this->db->join('moneda', 'moneda.id_moneda = compra.id_moneda');

        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }


}
