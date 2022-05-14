<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditoproveedor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los créditos de proveedores
    public function getCreditosProveedores($where = null)
    {
        //Consulta
        $this->db->select('creditoproveedor.*,
                        proveedor.tipo_doc as tipo_doc_proveedor,
                        proveedor.nro_doc as nro_doc_proveedor,
                        concat_ws(" ", proveedor.razon_social) as proveedor,
                        compra.id_compra,
                        compra.feregistro as feregistro_compra,
                        moneda.simbolo as simbolo_moneda
                        ');
        $this->db->from('creditoproveedor');
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

    #Nuevo registro de credito de proveedor
    public function save($creditoproveedor)
    {
        $this->db->insert('creditoproveedor', $creditoproveedor);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    
    #Actualización de registros
    public function update($data, $id_creditoproveedor)
    {
        $this->db->where('id_creditoproveedor', $id_creditoproveedor);
        $this->db->update('creditoproveedor', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

     
    #Anulación de registros
    public function anular($data, $id_compra)
    {
        $this->db->where('id_compra', $id_compra);
        $this->db->update('creditoproveedor', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

}
