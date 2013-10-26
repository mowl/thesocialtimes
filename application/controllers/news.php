<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    private function resolve_url($url) {
        // This is really slow, especially if we handle a lot of resolves.
        // Must look for an alternative if time allows me to.      
        $fp = fopen(APPPATH . 'cache/url_resolve.txt', "a+");
        $token = md5($url);

        // Do we have this stuff in cache? (Cache :_D)
        if ($fp) {
            while (($line = fgets($fp)) !== false) {
                $hash = substr($line, 0, 32);

                if ($hash == $token) {
                    fclose($fp);
                    return substr($line, 33);
                }
            }
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);

        $info = curl_getinfo($ch);
        $url_for_cache = $info['url'];

        fwrite($fp, $token . '|' . $url_for_cache . "\r\n");
        fclose($fp);
        return $url_for_cache;
    }

    private $_blacklist = array(
        't', 'twitter', 'instagram', 'facebook', 'fb', 'pinterest', 'tinyurl', 'tumblr', 'linkedin', 'dribbble'
    );

    private function is_blacklisted_url($url) {
        // Note, at this point, our URL is meant to be valid, no need to recheck
        $parsed = parse_url($url);
        if (isset($parsed['host'])) {
            $host = $parsed['host'];
            $part = explode('.', $host);

            end($part);
            $domain = prev($part);

            return (in_array($domain, $this->_blacklist));
        }

        return true; // if ever?!
    }

    public function index() {
        // $this->load->library('facebook', array('appId' => $this->config->item('fb_key'), 'secret' => $this->config->item('fb_secret')));
        // $data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url('news/logout')));

        if (isset($_GET['oauth_token'])) {

            $cfg = array(
                'consumer_key' => $this->config->item('t_key'),
                'consumer_secret' => $this->config->item('t_secret'),
                'request_token' => $this->session->userdata('request_token'),
                'request_token_secret' => $this->session->userdata('request_token_secret')
            );
            $this->load->library('twitteroauth', $cfg);

            $access_token = $this->twitteroauth->getAccessToken($_REQUEST['oauth_verifier']);
            if ($access_token) {
                $params = array();
                $params['include_entities'] = 0;
                $content = $this->twitteroauth->get('account/verify_credentials', $params);

                if ($content && isset($content->screen_name) && isset($content->name)) {

                    $params['count'] = 100;
                    $params['include_entities'] = 1;
                    $tweets = $this->twitteroauth->get('statuses/home_timeline', $params);

                    $i = 0;

                    $articles = array();
                    
                    foreach ($tweets as $tweet) {
                        if ($i == 10)
                            break;

                        if ($tweet->text) {
                            preg_match_all('((https?|ftp|gopher|telnet|file|notes|ms-help):' .
                                    '((//)|(\\\\))+[\w\d:#@%/;$()~_?\+-=\\\.&]*)', $tweet->text, $matches, PREG_PATTERN_ORDER);

                            if (count($matches) && (count($matches[0]) == 1)) {
                                $m = $matches[0][0];
                                if (filter_var($m, FILTER_VALIDATE_URL) && (substr($m, 0, 8) !== "https://")) {
                                    
                                    $resolved = $this->resolve_url($m);

                                    if (!$this->is_blacklisted_url($resolved)) {
                                        
                                        array_push($articles, $resolved);
                                        
                                        $i++;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    // Re-authenticate
                    redirect('home');
                }
            }

            $articles_info = array();
            
            if (isset($articles)) {
                foreach ($articles as $article) {
                    $url = 'http://api.embed.ly/1/extract?key=6ea607da81da4c86b00cef510798fe2a&url=' . urlencode($article) .'&maxwidth=500&maxheight=700&format=json';
                    $json = json_decode(file_get_contents($url));
                    
                    array_push($articles_info, $json);
                }
            }
            
            $data = array('articles' => $articles_info);
            $this->load->view('templates/header');
            $this->load->view('news', $data);
             $this->load->view('templates/footer');

        }
    }

    function logout() {
        /*
         * Once we figured out how to get rid of the Facebook sessions manually, we'll surely do this.
         * As for now, this is just a time waster :/
         */
    }

}

?>
