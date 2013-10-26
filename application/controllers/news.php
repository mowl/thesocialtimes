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
        /*
         * Once we figured out how to get rid of the Facebook sessions manually, we'll surely do this.
         * As for now, this is just a time waster :/
         */
    }

}

?>
