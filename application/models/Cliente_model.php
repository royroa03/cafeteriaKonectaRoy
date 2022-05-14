<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los clientes
    public function getClientes($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('cliente');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de cliente
    public function save($cliente)
    {
        $this->db->insert('cliente', $cliente);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_cliente)
    {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->update('cliente', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar el cliente
    public function delete($id_cliente)
    {
        return $this->db->delete('cliente', array('id_cliente' => $id_cliente));
    }

}
