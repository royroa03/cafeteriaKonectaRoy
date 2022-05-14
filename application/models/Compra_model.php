<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compra_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos las compras
    public function getCompras($where = null)
    {
        //Consulta
        $this->db->select('
                            compra.id_compra,
                            compra.fecha,
                            compra.subtotal,
                            compra.descuento,
                            compra.total,
                            compra.flestado,
                            compra.feregistro,
                            compra.conversion,
                            compra.efectivo,
                            compra.vuelto,
                            proveedor.nro_doc as nrodoc_proveedor,
                            concat_ws(" ", proveedor.razon_social) as proveedor,
                            comprobante.descripcion as comprobante,
                            mediopago.nombre as mediopago,
                            moneda.nombre as moneda
                        ');
        $this->db->from('compra');
        $this->db->join('proveedor', 'proveedor.id_proveedor = compra.id_proveedor');
        $this->db->join('comprobante', 'comprobante.id_comprobante = compra.id_comprobante');
        $this->db->join('mediopago', 'mediopago.id_mediopago = compra.id_mediopago');
        $this->db->join('moneda', 'moneda.id_moneda = compra.id_moneda');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de compra
    public function save($compra)
    {
        $this->db->insert('compra', $compra);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_compra)
    {
        $this->db->where('id_compra', $id_compra);
        $this->db->update('compra', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar la compra
    public function delete($id_compra)
    {
        return $this->db->delete('compra', array('id_compra' => $id_compra));
    }

}
