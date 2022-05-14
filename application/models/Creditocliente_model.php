<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditocliente_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los créditos de clientes
    public function getCreditosClientes($where = null)
    {

        $this->db->select('creditocliente.*,
                            cliente.tipo_doc as tipo_doc_cliente,
                            cliente.nro_doc as nro_doc_cliente,
                            concat_ws(" ", cliente.nombres, cliente.apellido_paterno, cliente.apellido_materno, cliente.razon_social) as cliente,
                            venta.id_venta,
                            venta.feregistro as feregistro_venta,
                            moneda.simbolo as simbolo_moneda');
        $this->db->from('creditocliente');
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

    #Nuevo registro de credito de cliente
    public function save($creditocliente)
    {
        $this->db->insert('creditocliente', $creditocliente);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    
    #Actualización de registros
    public function update($data, $id_creditocliente)
    {
        $this->db->where('id_creditocliente', $id_creditocliente);
        $this->db->update('creditocliente', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

     
    #Anulación de registros
    public function anular($data, $id_venta)
    {
        $this->db->where('id_venta', $id_venta);
        $this->db->update('creditocliente', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

}
