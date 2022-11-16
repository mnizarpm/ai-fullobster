<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/login');
    }

    public function login()
    {
        if ($this->get_validation()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->security->xss_clean($username);
            $pass = $this->security->xss_clean($password);

            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('username', $user);
            $this->db->limit(1);
            $query = $this->db->get();
            $result = false;
            if ($query->num_rows() == 1) {
                $userpass = $query->result_array()[0]['password'];
                if (password_verify($pass, $userpass)) {
                    $result = $query->result();
                } else {
                    echo json_encode(array('status' => 0, 'pesan' => 'Password tidak sesuai !!'));
                    die;
                }
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Username tidak terdaftar !!'));
                die;
            }
            if ($result) {
                $sess_array = array();
                foreach ($result as $row) {
                    if (!empty($row->image)) {
                        $image = $row->image;
                    } else {
                        $image = 'default-user.png';
                    }
                    $sess_array = array(
                        'id_user' => $row->id_user,
                        'username' => $row->username,
                        'nama' => $row->nama,
                        'level' => $row->level,
                        'image' => $image,
                    );
                    $this->session->set_userdata($sess_array);
                }
                echo json_encode(array('status' => 1, 'pesan' => 'Berhasil masuk !!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal Masuk !!'));
            }
        } else {
            $array = array(
                'error'   => true,
                'username' => form_error('username'),
                'password' => form_error('password'),
                'message' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function logout()
    {
        $sess_array = array(
            'id_user' => false,
            'username' => false,
            'nama' => false,
            'level' => false,
            'image' => false,
        );
        $this->session->set_userdata($sess_array);
        redirect('/');
    }

    private function get_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required',
            array(
                'required' => 'Username harus diisi'
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
