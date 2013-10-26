<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $this->load->library('facebook', array('appId' => $this->config->item('fb_key'), 'secret' => $this->config->item('fb_secret')));

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $this->facebook->api('/me');
                redirect('news');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

        $data['login_url'] = $this->facebook->getLoginUrl();

        $this->load->view('home', $data);
    }

}