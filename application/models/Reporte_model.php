<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos el reporte de compras
    public function getCompras($fecha_inicio='', $fecha_fin='', $id_comprobante='', $id_mediopago='', $flestado='')
    {
        //Consulta
        $this->db->select('compra.id_compra,
                            compra.fecha,
                            compra.subtotal,
                            compra.descuento, 
                            compra.total,
                            compra.feregistro,
                            compra.id_comprobante,
                            compra.id_mediopago,
                            proveedor.nro_doc as nro_doc_proveedor,
                            concat_ws(" ", proveedor.razon_social) as proveedor,
                            comprobante.descripcion as comprobante,
                            mediopago.nombre as mediopago,
                            case compra.flestado when 0 then \'Pagada\' when 1 then \'Pendiente\'  when 2 then \'Anulada\'  end as flestado
                        ');
        $this->db->from('compra');
        $this->db->join('proveedor', 'proveedor.id_proveedor = compra.id_proveedor');
        $this->db->join('comprobante', 'comprobante.id_comprobante = compra.id_comprobante');
        $this->db->join('mediopago', 'mediopago.id_mediopago = compra.id_mediopago');
        
        if(!empty($fecha_inicio)){
			$this->db->where('date(compra.fecha) >=', $fecha_inicio);
        }
        if(!empty($fecha_fin)){
			$this->db->where('date(compra.fecha) <=', $fecha_fin);
        }
        if(!empty($id_comprobante)){
			$this->db->where('compra.id_comprobante', $id_comprobante);
        }
        if(!empty($id_mediopago)){
			$this->db->where('compra.id_mediopago', $id_mediopago);
        }
        if(!empty($flestado)){
			$this->db->where('compra.flestado', $flestado);
        }
        
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }
    
    
    #Obtenemos el reporte de ventas
    public function getVentas($fecha_inicio='', $fecha_fin='', $id_comprobante='', $id_mediopago='', $flestado='')
    {
        //Consulta
        $this->db->select('venta.id_venta,
                            venta.fecha,
                            venta.subtotal,
                            venta.descuento, 
                            venta.total,
                            venta.feregistro,
                            venta.id_comprobante,
                            venta.id_mediopago,
                            cliente.nro_doc as nro_doc_cliente,
                            concat_ws(" ", cliente.nombres, cliente.apellido_paterno, cliente.apellido_materno, cliente.razon_social) as cliente,
                            comprobante.descripcion as comprobante,
                            mediopago.nombre as mediopago,
                            case venta.flestado when 0 then \'Pagada\' when 1 then \'Pendiente\'  when 2 then \'Anulada\'  end as flestado
                        ');
        $this->db->from('venta');
        $this->db->join('cliente', 'cliente.id_cliente = venta.id_cliente');
        $this->db->join('comprobante', 'comprobante.id_comprobante = venta.id_comprobante');
        $this->db->join('mediopago', 'mediopago.id_mediopago = venta.id_mediopago');
        
        if(!empty($fecha_inicio)){
			$this->db->where('date(venta.fecha) >=', $fecha_inicio);
        }
        if(!empty($fecha_fin)){
			$this->db->where('date(venta.fecha) <=', $fecha_fin);
        }
        if(!empty($id_comprobante)){
			$this->db->where('venta.id_comprobante', $id_comprobante);
        }
        if(!empty($id_mediopago)){
			$this->db->where('venta.id_mediopago', $id_mediopago);
        }
        if(!empty($flestado)){
			$this->db->where('venta.flestado', $flestado);
        }
        
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }


}
