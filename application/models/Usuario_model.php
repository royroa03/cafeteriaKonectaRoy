<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    #Consulta si existe el usuario y está activo
	public function existeUsuarioActivo()
	{
		#Limpiamos las variables
		$login = $this->security->xss_clean($this->input->post('login'));
		$contrasena = $this->security->xss_clean($this->input->post('contrasena'));
		#Consulta
		$this->db->select('usuario.id_usuario, 
							usuario.login, 
							usuario.contrasena, 
							usuario.flestado, 
							personal.nro_doc,
							personal.nombres,
							personal.apellido_paterno,
							personal.apellido_materno,
							perfil.nombre as perfil,
                            usuario.id_perfil,
                            personal.ruta_foto,
                            empresa.razon_social as razon_social_empresa'
						);

		$this->db->from('usuario');
		$this->db->join('personal', 'usuario.id_personal = personal.id_personal');
        $this->db->join('perfil', 'perfil.id_perfil = usuario.id_perfil');
        $this->db->join('empresa', 'empresa.id_empresa = personal.id_empresa','left');
		$this->db->where('usuario.login', $login);
		$this->db->where('usuario.contrasena', md5(md5($contrasena)));
		$this->db->where('usuario.flestado', 0);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		    return $query->result_array();
		}
		return false;

	}

	#Nuevo registro de usuario
	public function save($usuario)
	{
		$this->db->insert('usuario', $usuario);
		#Retornamos del ID genrado
		return $this->db->insert_id();
	}

	#Actualización de registros
    public function update($data, $id_usuario)
    {
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuario', $data);
        #Retornamos del ID genrado
        return $this->db->affected_rows();
    }

    #Obtenemos los usuarios
    public function getUsuarios($where = null)
    {
        //Consulta
        $this->db->select('usuario.*, per.nombre as nombre_perfil,pers.nro_doc as nro_doc_personal,pers.nombres as nombres_personal,pers.apellido_paterno as apaterno_personal,pers.apellido_materno as amaterno_personal,pers.sexo');
        $this->db->from('usuario');
        $this->db->join('perfil AS per', 'per.id_perfil = usuario.id_perfil');
        $this->db->join('personal AS pers', 'pers.id_personal = usuario.id_personal');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Eliminar el usuario
    public function delete($id_usuario)
    {
        return $this->db->delete('usuario', array('id_usuario' => $id_usuario));
    }

    #Obtenemos los usuarios
    public function getDobleUsuario($where = null)
    {
        //Consulta
        $this->db->select('*');
        $this->db->from('usuario');
        if(!empty($where)){$this->db->where($where);}
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }

        return false;
    }

    #Insertar o Actualizar el usuario
    public function insertUpdate($data, $id_personal)
    {
        $this->db->where('id_personal',$id_personal);
        $query = $this->db->get('usuario');
        
        if ( $query->num_rows() > 0 ) 
        {
           $this->db->where('id_personal',$id_personal);
           $this->db->update('usuario',$data);
           $mensaje_resultado='¡Usuario ACTUALIZADO con éxito!';
        } else {
           $this->db->set('id_personal', $id_personal);
           $this->db->insert('usuario',$data);
           $mensaje_resultado='¡Usuario REGISTRADO con éxito!';
        }

        return $mensaje_resultado;

    }



}
