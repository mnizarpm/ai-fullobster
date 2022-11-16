<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('id_user')) {
        redirect('auth');
    }
}

function act($string)
{
    if ($_SESSION['act'] == $string) {
        return "active";
    } else {
        return null;
    }
}

function selected($string)
{
    if ($_SESSION['act'] == $string) {
        return "selected";
    } else {
        return null;
    }
}
