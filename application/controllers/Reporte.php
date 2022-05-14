<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Reporte extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        #Cargamos los modelos
        $this->load->model('reporte_model');

        #Detectamos el envío por Ajax
        if (!$this->input->is_ajax_request()) { exit('No direct script access allowed'); }
    }

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }


    #Obtenemos los datos de las compras por filtro
    public function getFiltroCompras()
    {
        #Obtenemos los datos enviados por POST
        $dataFiltros = $this->security->xss_clean($this->input->post());
        $response = array('status' => 0);

        $reporte_compras = $this->reporte_model->getCompras($dataFiltros['fecha_inicio'],$dataFiltros['fecha_fin'],$dataFiltros['id_comprobante'],$dataFiltros['id_mediopago'],$dataFiltros['flestado']);
        if($reporte_compras){
            $response = array('status' => 1, 'reportescompras' => $reporte_compras);
        }

        $this->responseJSON($response);
    } 

    
    #Obtenemos los datos de las ventas por filtro
    public function getFiltroVentas()
    {
        #Obtenemos los datos enviados por POST
        $dataFiltros = $this->security->xss_clean($this->input->post());
        $response = array('status' => 0);

        $reporte_ventas = $this->reporte_model->getVentas($dataFiltros['fecha_inicio'],$dataFiltros['fecha_fin'],$dataFiltros['id_comprobante'],$dataFiltros['id_mediopago'],$dataFiltros['flestado']);
        if($reporte_ventas){
            $response = array('status' => 1, 'reportesventas' => $reporte_ventas);
        }

        $this->responseJSON($response);
    } 

    
}