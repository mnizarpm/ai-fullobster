<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Naive extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $_SESSION['act'] = 'naive';
    }

    public function index()
    {
        $data['title']  = 'Naive';
        $data['page']   = 'admin/naive/index';
        $this->load->view('admin/template', $data);
    }

    public function add()
    {
        $data['title']  = 'Naive Add';
        $data['page']   = 'admin/naive/add';
        $this->load->view('admin/template', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Naive Edit';
        $data['data']   = $this->db->where('id', $id)->get('naive')->row_array();
        $data['page']   = 'admin/naive/edit';
        $this->load->view('admin/template', $data);
    }

    public function getViewMean()
    {
        $data1 = $this->db
            ->select('avg(suhu) as suhu, avg(ph) as ph, avg(tds) as tds, avg(do) as do, avg(amonia) as amonia, avg(nitrit) as nitrit')
            ->where('hasil', 1)
            ->get('dataset')->row_array();
        $update1 = [
            'suhu' => $data1['suhu'],
            'ph' => $data1['ph'],
            'tds' => $data1['tds'],
            'do' => $data1['do'],
            'amonia' => $data1['amonia'],
            'nitrit' => $data1['nitrit'],
        ];
        $query1 = $this->db->where('id', 1)->update('mean', $update1);
        if ($query1) {
            $data2 = $this->db
                ->select('avg(suhu) as suhu, avg(ph) as ph, avg(tds) as tds, avg(do) as do, avg(amonia) as amonia, avg(nitrit) as nitrit')
                ->where('hasil', 2)
                ->get('dataset')->row_array();
            $update2 = [
                'suhu' => $data2['suhu'],
                'ph' => $data2['ph'],
                'tds' => $data2['tds'],
                'do' => $data2['do'],
                'amonia' => $data2['amonia'],
                'nitrit' => $data2['nitrit'],
            ];
            $query2 = $this->db->where('id', 2)->update('mean', $update2);
            if ($query2) {
                $data3 = $this->db
                    ->select('avg(suhu) as suhu, avg(ph) as ph, avg(tds) as tds, avg(do) as do, avg(amonia) as amonia, avg(nitrit) as nitrit')
                    ->where('hasil', 3)
                    ->get('dataset')->row_array();
                $update3 = [
                    'suhu' => $data3['suhu'],
                    'ph' => $data3['ph'],
                    'tds' => $data3['tds'],
                    'do' => $data3['do'],
                    'amonia' => $data3['amonia'],
                    'nitrit' => $data3['nitrit'],
                ];
                $query3 = $this->db->where('id', 3)->update('mean', $update3);
                if ($query3) {
                    $this->load->view('admin/naive/mean');
                }
            }
        }
    }

    function getMean()
    {
        $data = $this->db
            ->get('mean')->result_array();
        if ($data) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil ambil data !!', 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal ambil data !!'));
        }
    }

    public function getViewDeviasi()
    {
        $data1 = $this->db
            ->select('STDDEV(suhu) as suhu, STDDEV(ph) as ph, STDDEV(tds) as tds, STDDEV(do) as do, STDDEV(amonia) as amonia, STDDEV(nitrit) as nitrit')
            ->where('hasil', 1)
            ->get('dataset')->row_array();
        $update1 = [
            'suhu' => $data1['suhu'],
            'ph' => $data1['ph'],
            'tds' => $data1['tds'],
            'do' => $data1['do'],
            'amonia' => $data1['amonia'],
            'nitrit' => $data1['nitrit'],
        ];
        $query1 = $this->db->where('id', 1)->update('deviasi', $update1);
        if ($query1) {
            $data2 = $this->db
                ->select('STDDEV(suhu) as suhu, STDDEV(ph) as ph, STDDEV(tds) as tds, STDDEV(do) as do, STDDEV(amonia) as amonia, STDDEV(nitrit) as nitrit')
                ->where('hasil', 2)
                ->get('dataset')->row_array();
            $update2 = [
                'suhu' => $data2['suhu'],
                'ph' => $data2['ph'],
                'tds' => $data2['tds'],
                'do' => $data2['do'],
                'amonia' => $data2['amonia'],
                'nitrit' => $data2['nitrit'],
            ];
            $query2 = $this->db->where('id', 2)->update('deviasi', $update2);
            if ($query2) {
                $data3 = $this->db
                    ->select('STDDEV(suhu) as suhu, STDDEV(ph) as ph, STDDEV(tds) as tds, STDDEV(do) as do, STDDEV(amonia) as amonia, STDDEV(nitrit) as nitrit')
                    ->where('hasil', 3)
                    ->get('dataset')->row_array();
                $update3 = [
                    'suhu' => $data3['suhu'],
                    'ph' => $data3['ph'],
                    'tds' => $data3['tds'],
                    'do' => $data3['do'],
                    'amonia' => $data3['amonia'],
                    'nitrit' => $data3['nitrit'],
                ];
                $query3 = $this->db->where('id', 3)->update('deviasi', $update3);
                if ($query3) {
                    $this->load->view('admin/naive/deviasi');
                }
            }
        }
    }

    function getDeviasi()
    {
        $data = $this->db
            ->get('deviasi')->result_array();
        if ($data) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil ambil data !!', 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal ambil data !!'));
        }
    }

    public function getViewProhasil()
    {
        $all = $this->db
            ->select('count(id) as jml')
            ->get('dataset')->row_array()['jml'];
        $data1 = $this->db
            ->select('count(id) as jml')
            ->where('hasil', 1)
            ->get('dataset')->row_array();
        $update1 = [
            'nilai' => $data1['jml'] / $all,
        ];
        $query1 = $this->db->where('id', 1)->update('prohasil', $update1);
        if ($query1) {
            $data2 = $this->db
                ->select('count(id) as jml')
                ->where('hasil', 2)
                ->get('dataset')->row_array();
            $update2 = [
                'nilai' => $data2['jml'] / $all,
            ];
            $query2 = $this->db->where('id', 2)->update('prohasil', $update2);
        if ($query2) {
            $data3 = $this->db
                ->select('count(id) as jml')
                ->where('hasil', 3)
                ->get('dataset')->row_array();
             $update3 = [
                'nilai' => $data3['jml'] / $all,
            ];
        $query3 = $this->db->where('id', 3)->update('prohasil', $update3);
        if ($query3) {
            $this->load->view('admin/naive/prohasil');
        }
        }
        }
    }

    function getProhasil()
    {
        $data = $this->db
            ->get('prohasil')->result_array();
        if ($data) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil ambil data !!', 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal ambil data !!'));
        }
    }

    public function getViewDatates()
    {
        $id = $_POST['id'];
        $naive = $this->db->where('id', $id)->get('naive')->row_array();
        $mean = $this->db->get('mean')->result_array();
        $deviasi = $this->db->get('deviasi')->result_array();
        $suhu1 = 1 / sqrt(2 * pi() * $deviasi[0]['suhu']) * exp(- (pow($naive['suhu'] - $mean[0]['suhu'], 2) / (2 * pow($deviasi[0]['suhu'], 2))));
        $ph1 = 1 / sqrt(2 * pi() * $deviasi[0]['ph']) * exp(- (pow($naive['ph'] - $mean[0]['ph'], 2) / (2 * pow($deviasi[0]['ph'], 2))));
        $tds1 = 1 / sqrt(2 * pi() * $deviasi[0]['tds']) * exp(- (pow($naive['tds'] - $mean[0]['tds'], 2) / (2 * pow($deviasi[0]['tds'], 2))));
        $do1 = 1 / sqrt(2 * pi() * $deviasi[0]['do']) * exp(- (pow($naive['do'] - $mean[0]['do'], 2) / (2 * pow($deviasi[0]['do'], 2))));
        $amonia1 = 1 / sqrt(2 * pi() * $deviasi[0]['amonia']) * exp(- (pow($naive['amonia'] - $mean[0]['amonia'], 2) / (2 * pow($deviasi[0]['amonia'], 2))));
        $nitrit1 = 1 / sqrt(2 * pi() * $deviasi[0]['nitrit']) * exp(- (pow($naive['nitrit'] - $mean[0]['nitrit'], 2) / (2 * pow($deviasi[0]['nitrit'], 2))));
        $suhu2 = 1 / sqrt(2 * pi() * $deviasi[1]['suhu']) * exp(- (pow($naive['suhu'] - $mean[1]['suhu'], 2) / (2 * pow($deviasi[1]['suhu'], 2))));
        $ph2 = 1 / sqrt(2 * pi() * $deviasi[1]['ph']) * exp(- (pow($naive['ph'] - $mean[1]['ph'], 2) / (2 * pow($deviasi[1]['ph'], 2))));
        $tds2 = 1 / sqrt(2 * pi() * $deviasi[1]['tds']) * exp(- (pow($naive['tds'] - $mean[1]['tds'], 2) / (2 * pow($deviasi[1]['tds'], 2))));
        $do2 = 1 / sqrt(2 * pi() * $deviasi[1]['do']) * exp(- (pow($naive['do'] - $mean[1]['do'], 2) / (2 * pow($deviasi[1]['do'], 2))));
        $amonia2 = 1 / sqrt(2 * pi() * $deviasi[1]['amonia']) * exp(- (pow($naive['amonia'] - $mean[1]['amonia'], 2) / (2 * pow($deviasi[1]['amonia'], 2))));
        $nitrit2 = 1 / sqrt(2 * pi() * $deviasi[1]['nitrit']) * exp(- (pow($naive['nitrit'] - $mean[1]['nitrit'], 2) / (2 * pow($deviasi[1]['nitrit'], 2))));
        $suhu3 = 1 / sqrt(2 * pi() * $deviasi[2]['suhu']) * exp(- (pow($naive['suhu'] - $mean[2]['suhu'], 2) / (2 * pow($deviasi[2]['suhu'], 2))));
        $ph3 = 1 / sqrt(2 * pi() * $deviasi[2]['ph']) * exp(- (pow($naive['ph'] - $mean[2]['ph'], 2) / (2 * pow($deviasi[2]['ph'], 2))));
        $tds3 = 1 / sqrt(2 * pi() * $deviasi[2]['tds']) * exp(- (pow($naive['tds'] - $mean[2]['tds'], 2) / (2 * pow($deviasi[2]['tds'], 2))));
        $do3 = 1 / sqrt(2 * pi() * $deviasi[2]['do']) * exp(- (pow($naive['do'] - $mean[2]['do'], 2) / (2 * pow($deviasi[2]['do'], 2))));
        $amonia3 = 1 / sqrt(2 * pi() * $deviasi[2]['amonia']) * exp(- (pow($naive['amonia'] - $mean[2]['amonia'], 2) / (2 * pow($deviasi[2]['amonia'], 2))));
        $nitrit3 = 1 / sqrt(2 * pi() * $deviasi[2]['nitrit']) * exp(- (pow($naive['nitrit'] - $mean[2]['nitrit'], 2) / (2 * pow($deviasi[2]['nitrit'], 2))));
        $data1 = [
            'suhu' => $suhu1,
            'ph' => $ph1,
            'tds' => $tds1,
            'do' => $do1,
            'amonia' => $amonia1,
            'nitrit' => $nitrit1,
            'hasil' => $suhu1 * $ph1 * $tds1 * $do1 * $amonia1 * $nitrit1,
        ];
        $query1 = $this->db->where('id', 1)->update('datates', $data1);
        $data2 = [
            'suhu' => $suhu2,
            'ph' => $ph2,
            'tds' => $tds2,
            'do' => $do2,
            'amonia' => $amonia2,
            'nitrit' => $nitrit2,
            'hasil' => $suhu2 * $ph2 * $tds2 * $do2 * $amonia2 * $nitrit2,
        ];
        $query2 = $this->db->where('id', 2)->update('datates', $data2);
        $data3 = [
            'suhu' => $suhu3,
            'ph' => $ph3,
            'tds' => $tds3,
            'do' => $do3,
            'amonia' => $amonia3,
            'nitrit' => $nitrit3,
            'hasil' => $suhu3 * $ph3 * $tds3 * $do3 * $amonia3 * $nitrit3,
        ];
        $query3 = $this->db->where('id', 3)->update('datates', $data3);
        $data['hasil'] = "Layak";
        $data['alert'] = "success";
        if ($data1['hasil'] < $data2['hasil']) {
            $data['hasil'] = "Tidak Layak";
            $data['alert'] = "danger";
        }
        if ($data2['hasil'] < $data3['hasil']) {
            $data['hasil'] = "Optimal";
            $data['alert'] = "warning";
        }
        $this->load->view('admin/naive/datates', $data);
    }

    function getDatates()
    {
        $data = $this->db
            ->get('datates')->result_array();
        if ($data) {
            echo json_encode(array('status' => 1, 'pesan' => 'Berhasil ambil data !!', 'data' => $data));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal ambil data !!'));
        }
    }

    function getNaive()
    {
        $data = $this->db
            ->get('naive')->result_array();
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
            );
            $query = $this->db->insert('naive', $data);
            if ($query) {
                echo json_encode(array('status' => 1, 'pesan' => 'Berhasil disimpan !!', 'data' => $this->db->insert_id()));
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
