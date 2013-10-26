<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function link_twitter() {
        $cfg = array(
            'consumer_key' => $this->config->item('t_key'),
            'consumer_secret' => $this->config->item('t_secret')
        );
        $this->load->library('twitteroauth', $cfg);

        $callback = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        $callback = str_replace('/home/link_twitter', '', $callback);
        
        $fritz = false;
        $url = ($fritz) ? 'http://localhost:8080/thesocialtimes' : 'http://' . $callback . '/news';
        
        $request_token = $this->twitteroauth->getRequestToken($url); //get Request Token

        if ($request_token) {
            $token = $request_token['oauth_token'];
            $this->session->set_userdata(array(
                'request_token' => $token,
                'request_token_secret' => $request_token['oauth_token_secret']
            ));

            switch ($this->twitteroauth->http_code) {
                case 200:
                    $url = $this->twitteroauth->getAuthorizeURL($token);
                    //redirect to Twitter .
                    header('Location: ' . $url);
                    break;
                default:
                    echo "Connection with Twitter failed";
                    break;
            }
        } else { //error receiving request token
            echo "Error Receiving Request Token";
        }
    }

    public function index() {

        $data = array('link_twitter' => base_url('home/link_twitter'));
        $this->load->view('home', $data);
        
    }

}
