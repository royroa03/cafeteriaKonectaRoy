<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merma_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Obtenemos las mermas
    public function getMermas($where = null)
    {
        //Consulta
        $this->db->select('merma.*,
                            producto.nombre as nombre_producto,
                            unidad.nombre as nombre_unidad,
                            usuario.login as login_usuario    
                        ');
        $this->db->from('merma');
        $this->db->join('producto', 'producto.id_producto = merma.id_producto');
        $this->db->join('unidad', 'unidad.id_unidad = producto.id_unidad');
        $this->db->join('usuario', 'usuario.id_usuario = merma.id_usuario');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Nuevo registro de merma
    public function save($merma)
    {
        $this->db->insert('merma', $merma);
        #Retornamos del ID generado
        return $this->db->insert_id();
    }

}
