<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $_SESSION['act'] = 'dataset';
    }

    public function index()
    {
        $data['title']  = 'Dataset';
        $data['page']   = 'admin/dataset/index';
        $this->load->view('admin/template', $data);
    }

    public function add()
    {
        $data['title']  = 'Dataset Add';
        $data['page']   = 'admin/dataset/add';
        $this->load->view('admin/template', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Dataset Edit';
        $data['data']   = $this->db->where('id', $id)->get('dataset')->row_array();
        $data['page']   = 'admin/dataset/edit';
        $this->load->view('admin/template', $data);
    }

    function getDataset()
    {
        $data = $this->db
            ->get('dataset')->result_array();
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
                'suhu' => $_POST['suhu'],
                'ph' => $_POST['ph'],
                'tds' => $_POST['tds'],
                'do' => $_POST['do'],
                'amonia' => $_POST['amonia'],
                'nitrit' => $_POST['nitrit'],
                'hasil' => $_POST['hasil'],
            );
            if (!empty($_POST['id'])) {
                $this->db->where('id', $_POST['id']);
                $query = $this->db->update('dataset', $data);
            } else {
                $query = $this->db->insert('dataset', $data);
            }
            if ($query) {
                echo json_encode(array('status' => 1, 'pesan' => 'Berhasil disimpan !!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal disimpan !!'));
            }
        } else {
            $array = array(
                'error'   => true,
                'suhu' => form_error('suhu'),
                'ph' => form_error('ph'),
                'tds' => form_error('tds'),
                'do' => form_error('do'),
                'amonia' => form_error('amonia'),
                'nitrit' => form_error('nitrit'),
                'hasil' => form_error('hasil'),
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    private function get_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'suhu',
            '',
            'required|numeric',
            array(
                'required' => 'suhu harus diisi',
                'numeric' => 'suhu harus angka',
            )
        );
        $this->form_validation->set_rules(
            'ph',
            '',
            'required|numeric',
            array(
                'required' => 'ph harus diisi',
                'numeric' => 'ph harus angka',
            )
        );
        $this->form_validation->set_rules(
            'tds',
            '',
            'required|numeric',
            array(
                'required' => 'tds harus diisi',
                'numeric' => 'tds harus angka',
            )
        );
        $this->form_validation->set_rules(
            'do',
            '',
            'required|numeric',
            array(
                'required' => 'do harus diisi',
                'numeric' => 'do harus angka',
            )
        );
        $this->form_validation->set_rules(
            'amonia',
            '',
            'required|numeric',
            array(
                'required' => 'amonia harus diisi',
                'numeric' => 'amonia harus angka',
            )
        );
        $this->form_validation->set_rules(
            'nitrit',
            '',
            'required|numeric',
            array(
                'required' => 'nitrit harus diisi',
                'numeric' => 'nitrit harus angka',
            )
        );
        $this->form_validation->set_rules(
            'hasil',
            '',
            'required|numeric',
            array(
                'required' => 'hasil harus diisi',
                'numeric' => 'hasil harus angka',
            )
        );
        return $this->form_validation->run();
    }

    public function destroy()
    {
        $id = $_POST['id'];
        $this->db->where('id', $id);
        $destroy = $this->db->delete('dataset');
        if ($destroy) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil dihapus !!'));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal dihapus !!'));
        }
    }
}
