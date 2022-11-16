<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $_SESSION['act'] = 'user';
    }

    public function index()
    {
        $data['title']  = 'User';
        $data['page']   = 'admin/user/index';
        $this->load->view('admin/template', $data);
    }

    public function add()
    {
        $data['title']  = 'User Add';
        $data['page']   = 'admin/user/add';
        $this->load->view('admin/template', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'User Edit';
        $data['data']   = $this->db->where('id_user', $id)->get('user')->row_array();
        $data['page']   = 'admin/user/edit';
        $this->load->view('admin/template', $data);
    }

    function getUser()
    {
        $data = $this->db
            ->get('user')->result_array();
        if ($data) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil ambil data !!', 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal ambil data !!'));
        }
    }

    public function getPenggunaById()
    {
        $id = $_POST['id'];
        $data['data'] = $this->db->where('id_user', $id)->get('user')->row_array();
        echo json_encode(array('status' => 1, 'data' => $data));
    }

    public function store()
    {
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
            if (!empty($_POST['id_user'])) {
                $image = $this->db->select('image')->where('id_user', $_POST['id_user'])->get('user')->row()->image;
                $data = array(
                    'nama' => $_POST['nama'],
                    'username' => $_POST['username'],
                    'level' => $_POST['level']
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
                $this->db->where('id_user', $_POST['id_user']);
                $query = $this->db->update('user', $data);
            } else {
                $data = array(
                    'nama' => $_POST['nama'],
                    'image' => $data_image['file_name'],
                    'username' => $_POST['username'],
                    'password' => $this->generatePasswordHash($_POST['password']),
                    'level' => $_POST['level']
                );
                $query = $this->db->insert('user', $data);
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
                'level' => form_error('level'),
                'image' => form_error('image'),
                'message' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function destroy()
    {
        $id = $_POST['id_user'];
        $image = $this->db->select('image')->where('id_user', $_POST['id_user'])->get('user')->row()->image;
        $this->db->where('id_user', $id);
        $destroy = $this->db->delete('user');
        if ($destroy) {
            if (!empty($image)) {
                unlink('./uploads/user/foto/' . $image);
            }
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
            'Nama Lengkap',
            'required',
            array(
                'required' => 'Nama harus diisi'
            )
        );
        if (!empty($_POST['id_user'])) {
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required',
                array(
                    'required' => 'Username harus diisi'
                )
            );
        } else {
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required|is_unique[user.username]',
                array(
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah ada'
                )
            );
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
            // if (empty($_FILES['image']['name'])) {
            //     $this->form_validation->set_rules(
            //         'image',
            //         'Foto',
            //         'required',
            //         array(
            //             'required' => 'Foto Harus Diisi'
            //         )
            //     );
            // }
        }
        $this->form_validation->set_rules(
            'level',
            'Level',
            'required',
            array(
                'required' => 'Level harus diisi'
            )
        );
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
