<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $_SESSION['act'] = 'profil';
    }

    function index()
    {
        $data['title']  = 'Profil';
        $data['data'] = $this->db->where('id_user', $this->session->userdata('id_user'))->get('user')->row_array();
        $data['page']   = 'admin/profil/index';
        $this->load->view('admin/template', $data);
    }

    public function store()
    {
        $id = $this->session->userdata('id_user');
        if ($this->get_validation()) {
            $data_image['file_name'] = '';
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']          = './uploads/user/foto/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
                $config['max_size']             = 2048;
                $config['remove_spaces']        = TRUE;
                $config['file_name']            = $_POST['nama'] . "-" . date("Y_m_d His");
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                    echo json_encode(array('status' => 2, 'pesan' => "<b>Gagal upload gambar</b> <br>" . $this->upload->display_errors()));
                    die;
                } else {
                    $data_image = $this->upload->data();
                }
            }
            $query = null;
            if ($id) {
                $image = $this->db->select('image')->where('id_user', $id)->get('user')->row()->image;
                $data = array(
                    'nama' => $_POST['nama'],
                    'username' => $_POST['username']
                );
                if (!empty($data_image['file_name'])) {
                    $data['image'] = $data_image['file_name'];
                    if (!empty($image)) {
                        unlink($config['upload_path'] . $image);
                    }
                }
                if (!empty($_POST['password'])) {
                    $data['password'] = $this->generatePasswordHash($_POST['password']);
                }
                $this->db->where('id_user', $id);
                $query = $this->db->update('user', $data);
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
                'username' => form_error('username'),
                'password' => form_error('password'),
                'cpassword' => form_error('cpassword'),
                'image' => form_error('image'),
                'message' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    private function get_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required',
            array(
                'required' => 'Nama harus diisi'
            )
        );
        if ($this->session->userdata('username') != $_POST['username']) {
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required|is_unique[user.username]',
                array(
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah ada'
                )
            );
        }
        if (!empty($_POST['password']) || !empty($_POST['cpassword'])) {
            $this->form_validation->set_rules(
                'password',
                'Password',
                'required',
                array(
                    'required' => 'Password harus diisi'
                )
            );
            $this->form_validation->set_rules(
                'cpassword',
                'Confirm Password',
                'required|matches[password]',
                array(
                    'required' => 'Confirm Password harus diisi',
                    'matches' => 'Confirm Password tidak sama'
                )
            );
        }
        return $this->form_validation->run();
    }

    public function generatePasswordHash($string)
    {
        // Pastikan inputnya adalah string
        $string = is_string($string) ? $string : strval($string);
        // Buat hash password
        $pwHash = password_hash($string, PASSWORD_BCRYPT);
        // Cek kekuatan hash, regenerate jika masih lemah
        if (password_needs_rehash($pwHash, PASSWORD_BCRYPT)) {
            $pwHash = password_hash($string, PASSWORD_BCRYPT);
        }
        return $pwHash;
    }
}
