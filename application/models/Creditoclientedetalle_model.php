<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditoclientedetalle_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
    }
    
    #Nuevo registro del detalle de crédito cliente 
	public function save($creditoclientedetalle)
	{
		$this->db->insert('creditoclientedetalle', $creditoclientedetalle);
		#Retornamos del ID genrado
		return $this->db->insert_id();
	}

    #Obtenemos los créditos de clientes detalles
    public function getCreditosClientesDetalles($where = null)
    {
        //Consulta
        $this->db->select('creditoclientedetalle.id_creditoclientedetalle,
                            creditoclientedetalle.feregistro as feregistro_creditoclientedetalle,
                            creditoclientedetalle.total as total_creditoclientedetalle,
                            venta.id_venta,
                            venta.feregistro as feregistro_venta,
                            venta.total as total_venta,
                            creditocliente.deuda as deuda_creditocliente,
                            cliente.tipo_doc as tipo_doc_cliente,
                            cliente.nro_doc as nro_doc_cliente,
                            concat_ws(" ", cliente.nombres, cliente.apellido_paterno, cliente.apellido_materno, cliente.razon_social) as cliente,
                            moneda.simbolo as simbolo_moneda
                        ');
        $this->db->from('creditoclientedetalle');
        $this->db->join('creditocliente', 'creditocliente.id_creditocliente = creditoclientedetalle.id_creditocliente');
        $this->db->join('venta', 'venta.id_venta = creditocliente.id_venta');
        $this->db->join('cliente', 'cliente.id_cliente = venta.id_cliente');
        $this->db->join('moneda', 'moneda.id_moneda = venta.id_moneda');

        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }


}
