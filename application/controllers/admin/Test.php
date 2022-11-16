<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
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

        $arr = array(22, 30, 22, 29, 21, 28);

        print_r($this->stdev_p($arr));
        // print_r($this->Stand_Deviation($arr));
    }

    function Stand_Deviation($arr)
    {
        $num_of_elements = count($arr);

        $variance = 0.0;

        // calculating mean using array_sum() method 
        $average = array_sum($arr) / $num_of_elements;

        foreach ($arr as $i) {
            // sum of squares of differences between  
            // all numbers and means. 
            $variance += pow(($i - $average), 2);
        }

        return (float)sqrt($variance / $num_of_elements);
    }

    function stdev_p($arr)
    {
        $arr2 = array();
        $mean = array_sum($arr) / count($arr);
        for ($x = 0; $x < count($arr); $x++) {
            $arr2[$x] = pow($arr[$x] - $mean, 2);
        }
        return sqrt(array_sum($arr2) / count($arr));
    }
}
