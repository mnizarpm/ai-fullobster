<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $_SESSION['act'] = 'home';
    }

    public function index()
    {
        $data['dataset'] = $this->db->select('count(id) as jml')->get('dataset')->row_array()['jml'];
        $data['user'] = $this->db->select('count(id_user) as jml')->get('user')->row_array()['jml'];
        $data['title']  = "Home";
        $data['page']   = 'home/index';
        $this->load->view('admin/template', $data);
    }
}
