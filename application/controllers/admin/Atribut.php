<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atribut extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $_SESSION['act'] = 'atribut';
    }

    public function index()
    {
        $data['title']  = 'Atribut';
        $data['page']   = 'admin/atribut/index';
        $this->load->view('admin/template', $data);
    }

    public function add()
    {
        $data['title']  = 'Atribut Add';
        $data['page']   = 'admin/atribut/add';
        $this->load->view('admin/template', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Atribut Edit';
        $data['data']   = $this->db->where('id', $id)->get('atribut')->row_array();
        $data['page']   = 'admin/atribut/edit';
        $this->load->view('admin/template', $data);
    }

    function getAtribut()
    {
        $data = $this->db
            ->get('atribut')->result_array();
        if ($data) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil ambil data !!', 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal ambil data !!'));
        }
    }

    public function store()
    {
        if ($this->get_validation()) {
            $data = array(
                'nama' => $_POST['nama'],
                'status' => $_POST['status']
            );

            if ($_POST['status'] == 1) {
                $dat = array(
                    'status' => 0
                );
                $this->db->update('atribut', $dat);
            }
            if (!empty($_POST['id'])) {
                $this->db->where('id', $_POST['id']);
                $query = $this->db->update('atribut', $data);
            } else {
                $query = $this->db->insert('atribut', $data);
            }
            if ($query) {
                echo json_encode(array('status' => 1, 'pesan' => 'Berhasil disimpan !!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal disimpan !!'));
            }
        } else {
            $array = array(
                'error'   => true,
                'nama' => form_error('nama'),
                'status' => form_error('status'),
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function destroy()
    {
        $id = $_POST['id'];
        $this->db->where('id', $id);
        $destroy = $this->db->delete('atribut');
        if ($destroy) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil dihapus !!'));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal dihapus !!'));
        }
    }

    private function get_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'nama',
            '',
            'required',
            array(
                'required' => 'Nama harus diisi'
            )
        );
        $this->form_validation->set_rules(
            'status',
            '',
            'required',
            array(
                'required' => 'Status harus diisi'
            )
        );
        return $this->form_validation->run();
    }
}
