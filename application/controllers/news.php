<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    public function index() {
        $this->load->library('facebook', array('appId' => $this->config->item('fb_key'), 'secret' => $this->config->item('fb_secret')));

        $data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url('news/logout')));
        $this->load->view('news', $data);
    }

    public function logout() {
        $_SESSION['fb_' . $this->config->item('fb_key') . '_user_id'] = '';
        $_SESSION['fb_' . $this->config->item('fb_key') . '_access_token'] = '';
        
        redirect('home');
    }

}

?>
