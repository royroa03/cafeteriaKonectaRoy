<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('usuario_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el usuario
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('id_personal', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('id_perfil', 'Número de Documento', 'trim|required');
        $this->form_validation->set_rules('login', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('contrasena', 'Apellido Paterno', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_usuario'));
        }else {
            #Datos
            $usuario = array(
                'id_personal'      => $this->security->xss_clean($this->input->post('id_personal')),
                'id_perfil'      => $this->security->xss_clean($this->input->post('id_perfil')),
                'login'      => $this->security->xss_clean($this->input->post('login')),
                'contrasena'      => md5(md5($this->security->xss_clean($this->input->post('contrasena'))))
            );

            #Enviamos los datos del usuario para registrar
            $this->usuario_model->insertUpdate($usuario,$this->security->xss_clean($this->input->post('id_personal')));

            #Redirecionamos a la lista de usuarios
            $mensaje_resultado=$this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- '.$mensaje_resultado.'.</div>');
            redirect(base_url('panel/mant_usuario'));

            //$usuario_doble=$this->usuario_model->getDobleUsuario(array('id_personal' => $this->security->xss_clean($this->input->post('id_personal'))));
            
            /*if($usuario_doble){
                $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>El usuario ya tiene un perfil asignado. Intente nuevamente.</div>');
                #Redirigimos al formulario y mostramos el mensaje
                redirect(base_url('panel/mant_usuario'));
            }else{
                #Enviamos los datos 
                $this->usuario_model->save($usuario);
                #Redirecionamos a la lista de usuarios
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Usuario REGISTRADO con éxito!.</div>');
                redirect(base_url('panel/mant_usuario'));
                
            }*/

        }
    }
    
    #Actualizamos el usuario
    public function update(){
        #Validamos los campos del formulario
          $this->form_validation->set_rules('edit_id_personal', 'Personal', 'trim|required');
        $this->form_validation->set_rules('edit_id_perfil', 'Perfil', 'trim|required');
        $this->form_validation->set_rules('edit_login', 'Login', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_usuario'));
        }else {
            #Obtenemos el valor
            $id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
            #Datos del usuario
            $usuario = array(
                'id_personal'      => $this->security->xss_clean($this->input->post('edit_id_personal')),
                'id_perfil'      => $this->security->xss_clean($this->input->post('edit_id_perfil')),
                'login'      => $this->security->xss_clean($this->input->post('edit_login'))
            );

            #Enviamos los datos del usuario para registrar
            $mensaje_resultado=$this->usuario_model->insertUpdate($usuario,$this->security->xss_clean($this->input->post('edit_id_personal')));

            #Redirecionamos a la lista de usuarios
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- '.$mensaje_resultado.'.</div>');
            redirect(base_url('panel/mant_usuario'));

            /*$usuario_doble=$this->usuario_model->getDobleUsuario(array('id_personal' => $this->security->xss_clean($this->input->post('edit_id_personal'))));

            if($usuario_doble){
                $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>El usuario ya tiene un perfil asignado. Intente nuevamente.</div>');
                #Redirigimos al formulario y mostramos el mensaje
                redirect(base_url('panel/mant_usuario'));
            }else{
                #Enviamos los datos del usuario para registrar
                $this->usuario_model->update($usuario,$id_usuario);

                #Redirecionamos a la lista de usuarios
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Usuario ACTUALIZADO con éxito!.</div>');
                redirect(base_url('panel/mant_usuario'));
            }*/
            
        }
    }

    #Cambiar contraseña del usuario
    public function cambiarcontrasena(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_contrasena', 'Contraseña', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_usuario'));
        }else {
            #Obtenemos el valor
            $id_usuario = $this->security->xss_clean($this->input->post('contrasena_id_usuario'));
            #Datos del usuario
            $usuario = array(
                'contrasena'      => md5(md5($this->security->xss_clean($this->input->post('edit_contrasena'))))
            );
            #Enviamos los datos del usuario para registrar
            $this->usuario_model->update($usuario,$id_usuario);

            #Redirecionamos a la lista de usuarios
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Contraseña del Usuario ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_usuario'));
        }
    }

    #Eliminar usuario
    public function eliminar()
    {   
        $id_usuario=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_usuario)){
            #Eliminamos el usuario
            $this->usuario_model->delete($id_usuario);
            $response = array('status' => 1, 'msg' => 'Se eliminó el usuario con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el usuario.');
        }
        $this->responseJSON($response);
    }
}