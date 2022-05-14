<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Producto extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('producto_model');
        $this->load->model('stock_model');

        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el producto
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('id_categoria', 'Categoría', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('id_unidad', 'Unidad', 'trim|required');
        $this->form_validation->set_rules('id_moneda', 'Moneda', 'trim|required');
        $this->form_validation->set_rules('precio_unitario', 'Precio Unitario', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_producto'));
        }else {
            $imgprod = '';
            if (!($_FILES['imgprod']['error']>0)) {
                $ext = explode('.', $_FILES['imgprod']['name']);
                #Guardamos la foto del trabajador
                $imgprod = $this->cargarArchivo('imgprod', 'producto');
                if (!$imgprod) {
                    #Ocurrio un error en la carga de la imagen del producto
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- No se pudo cargar la imagen del producto.</div>');
                    redirect(base_url('panel/mant_producto'));
                }
            }
            
            #Datos
            $producto = array(
                'id_categoria'      => $this->security->xss_clean($this->input->post('id_categoria')),
                'nombre'      => $this->security->xss_clean($this->input->post('nombre')),
                'descripcion'      => $this->security->xss_clean($this->input->post('descripcion')),
                'ruta_imagen'      => $imgprod,
                'cantidad'      => $this->security->xss_clean($this->input->post('cantidad')),
                'id_unidad'      => $this->security->xss_clean($this->input->post('id_unidad')),
                'id_moneda'      => $this->security->xss_clean($this->input->post('id_moneda')),
                'precio_unitario'      => $this->security->xss_clean($this->input->post('precio_unitario'))
            );
            #Enviamos los datos 
            $id_producto=$this->producto_model->save($producto);

            #Datos
            $stock = array(
                'id_producto'      => $id_producto
            );
            #Agregar el stock al producto
            $this->stock_model->save($stock);

            #Redirecionamos a la lista de productos
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Producto REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_producto'));
        }
    }
    
    #Actualizamos el producto
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_id_categoria', 'Categoría', 'trim|required');
        $this->form_validation->set_rules('edit_nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('edit_cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('edit_id_unidad', 'Unidad', 'trim|required');
        $this->form_validation->set_rules('edit_id_moneda', 'Moneda', 'trim|required');
        $this->form_validation->set_rules('edit_precio_unitario', 'Precio Unitario', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_producto'));
        }else {
            #Obtenemos el valor
            $id_producto = $this->security->xss_clean($this->input->post('id_producto'));

            $imgprod = '';
            $producto=[];

            if (!($_FILES['editimgprod']['error']>0)) {
                $ext = explode('.', $_FILES['editimgprod']['name']);
                #Guardamos la foto del trabajador
                $imgprod = $this->cargarArchivo('editimgprod', 'producto');
                if (!$imgprod) {
                    #Ocurrio un error en la carga de la imagen del producto
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- No se pudo cargar la imagen del producto.</div>');
                    redirect(base_url('panel/mant_producto'));
                }

                #Datos del producto 
                $producto = array(
                    'id_categoria'      => $this->security->xss_clean($this->input->post('edit_id_categoria')),
                    'nombre'      => $this->security->xss_clean($this->input->post('edit_nombre')),
                    'descripcion'      => $this->security->xss_clean($this->input->post('edit_descripcion')),
                    'ruta_imagen'      => $imgprod,
                    'cantidad'      => $this->security->xss_clean($this->input->post('edit_cantidad')),
                    'id_unidad'      => $this->security->xss_clean($this->input->post('edit_id_unidad')),
                    'id_moneda'      => $this->security->xss_clean($this->input->post('edit_id_moneda')),
                    'precio_unitario'      => $this->security->xss_clean($this->input->post('edit_precio_unitario'))
                );

            }else{
                #Datos del producto 
                $producto = array(
                    'id_categoria'      => $this->security->xss_clean($this->input->post('edit_id_categoria')),
                    'nombre'      => $this->security->xss_clean($this->input->post('edit_nombre')),
                    'descripcion'      => $this->security->xss_clean($this->input->post('edit_descripcion')),
                    'cantidad'      => $this->security->xss_clean($this->input->post('edit_cantidad')),
                    'id_unidad'      => $this->security->xss_clean($this->input->post('edit_id_unidad')),
                    'id_moneda'      => $this->security->xss_clean($this->input->post('edit_id_moneda')),
                    'precio_unitario'      => $this->security->xss_clean($this->input->post('edit_precio_unitario'))
                );
            }

            

            #Enviamos los datos del producto para registrar
            $this->producto_model->update($producto,$id_producto);

            #Redirecionamos a la lista de productos
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Producto ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_producto'));
        }
    }

    #Eliminar producto
    public function eliminar()
    {   
        $id_producto=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_producto)){
            #Eliminamos el producto
            $this->producto_model->delete($id_producto);
            $response = array('status' => 1, 'msg' => 'Se eliminó el producto con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el producto.');
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