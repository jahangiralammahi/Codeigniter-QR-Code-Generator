<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrgenerate extends CI_Controller {
	// QR page load
	public function index()
	{
		$this->load->view('qr_generate_page');
	}
	//QR-Code Generator
	public function qrgenerator(){
		$this->load->library('ciqrcode');
		$config['cacheable']    = true; //boolean, the default is true
		$config['cachedir']     = ''; //string, the default is application/cache/
		$config['errorlog']     = ''; //string, the default is application/logs/
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		//Create QR code image create

		$params['data']  = $this->input->post('qr_code');
		$params['level'] = $this->input->post('qr_level');
		$params['size'] = 10;
		$data['image_name'] = sha1($params['data'].time()).'.png';
		$params['savename'] = FCPATH.'assets/QR/'.$data['image_name'];
		$this->ciqrcode->generate($params);
		$this->load->view('qr_generate_page',$data);
	}
}
