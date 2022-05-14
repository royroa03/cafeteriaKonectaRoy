<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('usuario_model');
		$this->load->model('caja_model');
		$this->load->model('acceso_model');

        
	}

	public function index()
	{
		#Título de la página
		$data['titulo'] = "LOGIN";

    	#Validación del formulario
		if($_POST){
			#Reglas de validación
			$this->form_validation->set_rules('login', 'Usuario', 'trim|required');
			$this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required');
			#Mensajes para la validación
			$this->form_validation->set_message('login', 'Debe ingresar el nombre de usuario.');
			$this->form_validation->set_message('contrasena', 'Debe ingresar la contraseña del usuario.');

			if ($this->form_validation->run() == TRUE)
			{
				#Verificamos que el usuario existe y está activo
				$usuario = $this->usuario_model->existeUsuarioActivo();
				if($usuario){
					if($usuario[0]['id_perfil']>0 ){ #Perfil: Administrador
						$this->session->set_userdata($usuario[0]);

						$caja_apertura=$this->caja_model->getAperturaPorUsuario(array('flestado' => 2, 'id_usuario' => $usuario[0]['id_usuario']));
						#Almacenar caja asignada al usuario
                		$this->session->set_userdata(array('id_caja' => $caja_apertura[0]->id_caja,'estado_caja' => $caja_apertura[0]->flestado));
						#Almacenar el Log de Accesso
						$acceso = array(
							'id_usuario'      => $usuario[0]['id_usuario'],
							'ip'      => $this->getRealIP()
						);
						#Enviamos los datos 
						$this->acceso_model->save($acceso);
						redirect(base_url('panel'));
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">El Usuario y/o Contraseña son incorrectos.</div>');
	                    redirect(base_url('login'));
					}
				}
			}
		}
	    $data['msg'] = '';
		$this->load->view('login/header', $data);
		$this->load->view('login/index', $data);
	}

	public function logout()
	{
	    $user_data = $this->session->all_userdata();
	    foreach ($user_data as $key => $value) {
	        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	            $this->session->unset_userdata($key);
	        }
	    }

	    redirect(base_url());
	}

	function getRealIP()
	{

		if (isset($_SERVER["HTTP_CLIENT_IP"]))
		{
			return $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
		{
			return $_SERVER["HTTP_X_FORWARDED"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
		{
			return $_SERVER["HTTP_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED"]))
		{
			return $_SERVER["HTTP_FORWARDED"];
		}
		else
		{
			return $_SERVER["REMOTE_ADDR"];
		}

	}
}

