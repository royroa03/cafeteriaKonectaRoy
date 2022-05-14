<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Personal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('personal_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el personal
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('nro_doc', 'Número de Documento', 'trim|required');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required');
        $this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required');
        $this->form_validation->set_rules('sexo', 'Sexo', 'trim|required');
        $this->form_validation->set_rules('telefono1', 'Teléfono', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_personal'));
        }else {

            $id_empresa_val=null;
            if ($this->security->xss_clean($this->input->post('id_empresa')) === '') {
                $id_empresa_val = null;
            }else{
                $id_empresa_val = $this->security->xss_clean($this->input->post('id_empresa'));
            };

            $fotopers = '';
            if (!($_FILES['fotopers']['error']>0)) {
                $ext = explode('.', $_FILES['fotopers']['name']);
                #Guardamos la foto del personal
                $fotopers = $this->cargarArchivo('fotopers', 'personal');
                if (!$fotopers) {
                    #Ocurrio un error en la carga de la imagen del personal
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- No se pudo cargar la imagen del personal.</div>');
                    redirect(base_url('panel/mant_personal'));
                }
            }
            #Datos
            $personal = array(
                'tipo_doc'      => $this->security->xss_clean($this->input->post('tipo_doc')),
                'nro_doc'       => $this->security->xss_clean($this->input->post('nro_doc')),
                'id_empresa'       => $id_empresa_val,
                'nombres'       => $this->security->xss_clean($this->input->post('nombres')),
                'apellido_paterno'      => $this->security->xss_clean($this->input->post('apellido_paterno')),
                'apellido_materno'      => $this->security->xss_clean($this->input->post('apellido_materno')),
                'sexo'      => $this->security->xss_clean($this->input->post('sexo')),
                'telefono1'         => $this->security->xss_clean($this->input->post('telefono1')),
                'telefono2'         => $this->security->xss_clean($this->input->post('telefono2')),
                'direccion'         => $this->security->xss_clean($this->input->post('direccion')),
                'referencia'        => $this->security->xss_clean($this->input->post('referencia')),
                'ruta_foto'      => $fotopers
            );
            #Enviamos los datos 
            $this->personal_model->save($personal);

            #Redirecionamos a la lista de personales
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Personal REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_personal'));
        }
    }
    
    #Actualizamos el personal
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('edit_nro_doc', 'Número de Documento', 'trim|required');
          $this->form_validation->set_rules('edit_nombres', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('edit_apellido_paterno', 'Apellido Paterno', 'trim|required');
        $this->form_validation->set_rules('edit_apellido_materno', 'Apellido Materno', 'trim|required');
        $this->form_validation->set_rules('edit_sexo', 'Sexo', 'trim|required');
        $this->form_validation->set_rules('edit_telefono1', 'Teléfono', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_personal'));
        }else {
            #Obtenemos el valor
            $id_personal = $this->security->xss_clean($this->input->post('id_personal'));

            $fotopers = '';
            $personal = [];

            $edit_id_empresa_val=null;
            if ($this->security->xss_clean($this->input->post('edit_id_empresa')) === '') {
                $edit_id_empresa_val = null;
            }else{
                $edit_id_empresa_val = $this->security->xss_clean($this->input->post('edit_id_empresa'));
            }

            if (!($_FILES['editfotopers']['error']>0)) {
                $ext = explode('.', $_FILES['editfotopers']['name']);
                #Guardamos la foto del personal
                $fotopers = $this->cargarArchivo('editfotopers', 'personal');
                if (!$fotopers) {
                    #Ocurrio un error en la carga de la imagen del personal
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- No se pudo cargar la imagen del personal.</div>');
                    redirect(base_url('panel/mant_personal'));
                }
                #Datos del personal 
                $personal = array(
                    'tipo_doc' 		=> $this->security->xss_clean($this->input->post('edit_tipo_doc')),
                    'nro_doc' 		=> $this->security->xss_clean($this->input->post('edit_nro_doc')),
                    'id_empresa' 		=> $edit_id_empresa_val,
                    'nombres' 		=> $this->security->xss_clean($this->input->post('edit_nombres')),
                    'apellido_paterno' 		=> $this->security->xss_clean($this->input->post('edit_apellido_paterno')),
                    'apellido_materno' 		=> $this->security->xss_clean($this->input->post('edit_apellido_materno')),
                    'sexo'      => $this->security->xss_clean($this->input->post('edit_sexo')),
                    'telefono1' 		=> $this->security->xss_clean($this->input->post('edit_telefono1')),
                    'telefono2' 		=> $this->security->xss_clean($this->input->post('edit_telefono2')),
                    'direccion' 		=> $this->security->xss_clean($this->input->post('edit_direccion')),
                    'referencia' 		=> $this->security->xss_clean($this->input->post('edit_referencia')),
                    'ruta_foto'      => $fotopers
                );
            }else{
                #Datos del personal 
                $personal = array(
                    'tipo_doc' 		=> $this->security->xss_clean($this->input->post('edit_tipo_doc')),
                    'nro_doc' 		=> $this->security->xss_clean($this->input->post('edit_nro_doc')),
                    'id_empresa' 		=> $edit_id_empresa_val,
                    'nombres' 		=> $this->security->xss_clean($this->input->post('edit_nombres')),
                    'apellido_paterno' 		=> $this->security->xss_clean($this->input->post('edit_apellido_paterno')),
                    'apellido_materno' 		=> $this->security->xss_clean($this->input->post('edit_apellido_materno')),
                    'sexo'      => $this->security->xss_clean($this->input->post('edit_sexo')),
                    'telefono1' 		=> $this->security->xss_clean($this->input->post('edit_telefono1')),
                    'telefono2' 		=> $this->security->xss_clean($this->input->post('edit_telefono2')),
                    'direccion' 		=> $this->security->xss_clean($this->input->post('edit_direccion')),
                    'referencia' 		=> $this->security->xss_clean($this->input->post('edit_referencia'))
                );
            }
            
            #Enviamos los datos del personal para registrar
            $this->personal_model->update($personal,$id_personal);

            #Redirecionamos a la lista de personales
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Personal ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_personal'));
        }
    }

    #Eliminar personal
    public function eliminar()
    {   
        $id_personal=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_personal)){
            #Eliminamos el personal
            $this->personal_model->delete($id_personal);
            $response = array('status' => 1, 'msg' => 'Se eliminó el personal con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el personal.');
        }
        $this->responseJSON($response);
    }

    
    #Upload de Archivos
    public function cargarArchivo($inpFoto, $carpeta)
    {
        $config['upload_path'] = './imagenes/'.$carpeta;
        $config['allowed_types'] = 'jpg|jpeg|png|JPG|PNG|JPEG';
        $config['max_size'] = '5000';
        $config['encrypt_name']  = TRUE;
        #Cargamos la librería y pasamos los parametros
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($inpFoto)){
            $data = $this->upload->display_errors();
            return false;
        }else{
            $data = $this->upload->data();
            return $data['file_name'];
        }
    }
}