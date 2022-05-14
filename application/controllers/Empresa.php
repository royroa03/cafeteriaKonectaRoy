<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Empresa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('empresa_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos la empresa
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('nro_doc', 'Número de Documento', 'trim|required');
        $this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required');
        $this->form_validation->set_rules('telefono1', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_empresa'));
        }else {
            $imgemp = '';
            if (!($_FILES['imgemp']['error']>0)) {
                $ext = explode('.', $_FILES['imgemp']['name']);
                #Guardamos la foto del trabajador
                $imgemp = $this->cargarArchivo('imgemp', 'empresa');

                if (!$imgemp) {
                    #Ocurrio un error en la carga de la imagen de la empresa
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- No se pudo cargar la imagen de la empresa.</div>');
                    redirect(base_url('panel/mant_empresa'));
                }
            }

            #Datos
            $empresa = array(
                'tipo_doc'      => $this->security->xss_clean($this->input->post('tipo_doc')),
                'nro_doc'       => $this->security->xss_clean($this->input->post('nro_doc')),
                'razon_social'       => $this->security->xss_clean($this->input->post('razon_social')),
                'telefono1'         => $this->security->xss_clean($this->input->post('telefono1')),
                'telefono2'         => $this->security->xss_clean($this->input->post('telefono2')),
                'direccion'         => $this->security->xss_clean($this->input->post('direccion')),
                'referencia'        => $this->security->xss_clean($this->input->post('referencia')),
                'ruta_imagen'        => $imgemp
            );
            #Enviamos los datos 
            $this->empresa_model->save($empresa);

            #Redirecionamos a la lista de empresas
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Empresa REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_empresa'));
        }
    }
    
    #Actualizamos la empresa
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('edit_nro_doc', 'Número de Documento', 'trim|required');
          $this->form_validation->set_rules('edit_razon_social', 'Razón Social', 'trim|required');
        $this->form_validation->set_rules('edit_telefono1', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('edit_direccion', 'Dirección', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_empresa'));
        }else {
            $edit_imgemp = '';
            $empresa =[];

            #Obtenemos el valor
            $id_empresa = $this->security->xss_clean($this->input->post('id_empresa'));

            if (!($_FILES['editimgemp']['error']>0)) {
                $ext = explode('.', $_FILES['editimgemp']['name']);
                #Guardamos la foto del trabajador
              $edit_imgemp = $this->cargarArchivo('editimgemp', 'empresa');

                if (!$edit_imgemp) {
                    #Ocurrio un error en la carga de la imagen de la empresa
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- No se pudo cargar la imagen de la empresa.</div>');
                    redirect(base_url('panel/mant_empresa'));
                }
                #Datos de la empresa 
                $empresa = array(
                    'tipo_doc' 		=> $this->security->xss_clean($this->input->post('edit_tipo_doc')),
                    'nro_doc' 		=> $this->security->xss_clean($this->input->post('edit_nro_doc')),
                    'razon_social' 		=> $this->security->xss_clean($this->input->post('edit_razon_social')),
                    'telefono1' 		=> $this->security->xss_clean($this->input->post('edit_telefono1')),
                    'telefono2' 		=> $this->security->xss_clean($this->input->post('edit_telefono2')),
                    'direccion' 		=> $this->security->xss_clean($this->input->post('edit_direccion')),
                    'referencia' 		=> $this->security->xss_clean($this->input->post('edit_referencia')),
                    'ruta_imagen'        => $edit_imgemp
                );
            }else{
                #Datos de la empresa 
                $empresa = array(
                    'tipo_doc' 		=> $this->security->xss_clean($this->input->post('edit_tipo_doc')),
                    'nro_doc' 		=> $this->security->xss_clean($this->input->post('edit_nro_doc')),
                    'razon_social' 		=> $this->security->xss_clean($this->input->post('edit_razon_social')),
                    'telefono1' 		=> $this->security->xss_clean($this->input->post('edit_telefono1')),
                    'telefono2' 		=> $this->security->xss_clean($this->input->post('edit_telefono2')),
                    'direccion' 		=> $this->security->xss_clean($this->input->post('edit_direccion')),
                    'referencia' 		=> $this->security->xss_clean($this->input->post('edit_referencia'))
                );
            }

            #Enviamos los datos del personal para registrar
            $this->empresa_model->update($empresa,$id_empresa);

            #Redirecionamos a la lista de empresas
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Empresa ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_empresa'));
        }
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