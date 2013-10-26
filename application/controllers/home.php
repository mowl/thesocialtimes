<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {

        $cfg = array(
            'consumer_key' => $this->config->item('t_key'),
            'consumer_secret' => $this->config->item('t_secret')
        );
        $this->load->library('twitteroauth', $cfg);

        $request_token = $this->twitteroauth->getRequestToken('http://' . $_SERVER['SERVER_NAME'] . ':8080/news'); //get Request Token

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
                    echo "Coonection with twitter Failed";
                    break;
            }
        } else { //error receiving request token
            echo "Error Receiving Request Token";
        }

        $this->load->view('home', $data);
    }

}