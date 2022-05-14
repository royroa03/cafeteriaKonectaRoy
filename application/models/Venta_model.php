<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venta_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos las ventas
    public function getVentas($where = null)
    {
        //Consulta
        $this->db->select('
                            venta.id_venta,
                            venta.fecha,
                            venta.subtotal,
                            venta.descuento,
                            venta.total,
                            venta.flestado,
                            venta.feregistro,
                            venta.conversion,
                            venta.efectivo,
                            venta.vuelto,
                            cliente.nro_doc as nrodoc_cliente,
                            concat_ws(" ", cliente.nombres, cliente.apellido_paterno, cliente.apellido_materno, cliente.razon_social) as cliente,
                            comprobante.descripcion as comprobante,
                            comprobante.id_comprobante,
                            mediopago.nombre as mediopago,
                            moneda.nombre as moneda
                        ');
        $this->db->from('venta');
        $this->db->join('cliente', 'cliente.id_cliente = venta.id_cliente');
        $this->db->join('comprobante', 'comprobante.id_comprobante = venta.id_comprobante');
        $this->db->join('mediopago', 'mediopago.id_mediopago = venta.id_mediopago');
        $this->db->join('moneda', 'moneda.id_moneda = venta.id_moneda');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de venta
    public function save($venta)
    {
        $this->db->insert('venta', $venta);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_venta)
    {
        $this->db->where('id_venta', $id_venta);
        $this->db->update('venta', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar la venta
    public function delete($id_venta)
    {
        return $this->db->delete('venta', array('id_venta' => $id_venta));
    }


}
