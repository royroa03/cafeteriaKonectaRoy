<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caja_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos los cajas
    public function getCajas($where = null)
    {
        //Consulta
        $this->db->select('caja.*,usu.login as login_usuario,per.nombres as nombres_personal,per.apellido_paterno as apellido_paterno_personal,per.apellido_materno as apellido_materno_personal,mon.simbolo as simbolo_moneda');
        $this->db->from('caja');
        $this->db->join('usuario AS usu', 'usu.id_usuario = caja.id_usuario');
        $this->db->join('personal AS per', 'per.id_personal = usu.id_personal');
        $this->db->join('moneda AS mon', 'mon.id_moneda = caja.id_moneda','left');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de caja
    public function save($caja)
    {
        $this->db->insert('caja', $caja);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

    #Actualización de registros
    public function update($data, $id_caja)
    {
        $this->db->where('id_caja', $id_caja);
        $this->db->update('caja', $data);
        #Retornamos del ID generado
        return $this->db->affected_rows();
    }

    #Eliminar la caja
    public function delete($id_caja)
    {
        return $this->db->delete('caja', array('id_caja' => $id_caja));
    }

    #Verificar caja aperturada por usuario
    public function getAperturaPorUsuario($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('caja');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

}
