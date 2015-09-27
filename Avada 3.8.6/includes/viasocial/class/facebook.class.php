<?php
/**
* @author  :  Viaprestige | JIHAD SINNAOUR
* @package :  Viasocial | Facebook class
* @version :  1.0 Xtrem release @01/09/2015
* @param   :  Facebook Graph API v2.4
* @return  :  json, Array[], String
*/

Class Facebook {


    protected $_settings = array(
        'api'       => 'https://graph.facebook.com/',    // Graph API Base URL
        'parameter' => '',							    // Graph API Parameters
        'fields' 	=> '',                             // Graph API Fields
        'version'   => 'v2.4',                        // API Version
        'appId'     => '',                           // Client ID
        'appSecret' => '',                          // Client Secret Access
        'grant'     => 'client_credentials',       // Client Grant Type
        'tokenUrl'  => 'oauth/access_token?',     // Access Token Request URL
        'url'       => '',                       // Current URL
        'request'   => '',                      // Request's URL
        'response'  => ''                      // Facebook Response
        );

    private $_results  = array(
        'token'         => '',             // Facebook Access Token
        'sourceId'      => '',            // Post's ID
        'sourceType'    => '',           // Post's Type
        'sourceUrl'     => '',          // Post's Full URL 
        'shareCount'    => '',         // Post's Total Shares
        'commentCount'  => '',        // Post's Total Comments
        'authorId'      => '',       // Author's ID
        'author'        => '',      // Author's Full Name
        'picture'       => '',     // Author's Profile Picture
        'message'       => '',    // Comment's Content
        'datetime'      => '',   // Comment's Publishing Date & Time
        'date'          => '',  // Comment's Publishing Date
        'time'          => ''  // Comment's Publishing Time
        );

    private $_plugins  = array(
        'connect'       => '//connect.facebook.net/',       // Comment plugin Base URL
        'language'      => 'fr_FR/',                       // Comment plugin Language
        'parameter'     => 'sdk.js#',                     // Comment plugin paramater
        'xfbml'         => '1',                          // XFBML value
        'width'         => '830',                       // Comment plugin width
        'numposts'      => '10',                       // Comment plugin number of posts
        'colorscheme'   => 'light',                   // Comment plugin colors cheme
        'mobile'        => 'Auto-detected',          // Comment plugin responsive
        'order'         => 'social'                 // Comment plugin order comments
        );

    private $_JSDK = '';

    private $_HTML = '';

public function __construct($id,$secret){
    
    // Disable errors display
    self::_error('enable');
    // Generate current URL
    self::_url('current');
    // Generate access token
    self::_app($id,$secret);

    // Debuging
    // $this->_settings['url'] = '{url}';

}

public function __set($property,$value){

    $this->$property = $value;
    return $this->_property;

}

public function __get($property){

    return $this->_property;

}

/**
* Facebook Access Token generator
* @since 1.0
* @see app('get') | https://github.com/Viaprestige/Viasocial
*/
private function _app($id,$secret){

    $this->_settings['appId']     = array('client_id'     => $id );
    $this->_settings['appSecret'] = array('client_secret' => $secret );
    $this->_settings['grant']     = array('grant_type'    => $this->_settings['grant'] );



    $this->_settings['request']   =  $this->_settings['api']
                                    .$this->_settings['tokenUrl']

                                    .key($this->_settings['appId']).'='
                                    .$this->_settings['appId']['client_id'].'&'
                                    .key($this->_settings['appSecret']).'='
                                    .$this->_settings['appSecret']['client_secret'].'&'
                                    .key($this->_settings['grant']).'='
                                    .$this->_settings['grant']['grant_type'];
    
    $this->_settings['response']                = file_get_contents($this->_settings['request']);
    $this->_settings['token']                   = null;

    parse_str($this->_settings['response'], $this->_settings['token']);

    $this->_settings['token']['access_token']   = urlencode($this->_settings['token']['access_token']);
    $this->_settings['token']                   = $this->_settings['token']['access_token'];
    return $this->_settings['token'];

}

/**
* Vicasocial error handler
* @since 1.0
* @see _error('{option}') | https://github.com/Viaprestige/Viasocial
*/
private function _error($option){

    switch ($option) {

        case 'enable':
            // Enable Error Reporting :
            error_reporting(~0);
            ini_set('display_errors', 1);
            break;

        case 'disable':
            // Disable Error Reporting :
            error_reporting(E_ALL|E_STRICT);
            ini_set('display_errors', 0);
            break;
        
        default:
            error_reporting(~0);
            ini_set('display_errors', 1);
            break;
    }
}

/**
* Get the current URL, which is the ID in Facebook's database
* @since 1.0
* @see _url('current') | https://github.com/Viaprestige/Viasocial
*/
private function _url($option){

    switch ($option) {

        case 'current':
            $this->_settings['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            return $this->_settings['url'];
            break;
        
        default:
            if (!empty($option)) {
            $this->_settings['url'] = 'http://'.$option;
            return $this->_settings['url'];
            }
            else{
                echo '<li class="via-error">Error 1, Empty or not found URL option</li>';
            }
            break;
    }
}

/**
 * Get response from Facebook Graph API using file_get_contents
 * @since 1.0
 * @see _jsonfile('decode') | https://github.com/Viaprestige/Viasocial
 */
private function _jsonfile($option){

    switch ($option) {

        case 'decode':
            $this->_settings['response']  =  json_decode(file_get_contents($this->_settings['request']), true);
            return $this->_settings['response'];
            break;
        // Debugin
        case 'encode':
            $this->_settings['response']  =  json_encode(file_get_contents($this->_settings['request']), true);
            return $this->_settings['response'];
            break;

        default:
            echo '<li class="via-error">Error 2, Empty or not found _jsonfile parameter</li>';           
            break;
    }

}

/**
 * Get response from Facebook Graph API using Curl 
 * @since 1.0
 * @see _jsoncurl('decode') | https://github.com/Viaprestige/Viasocial
 */
private function _jsoncurl($option){

    //  Initiate curl method
    $chanel = curl_init();
    // SSL verification
    curl_setopt($chanel, CURLOPT_SSL_VERIFYPEER, false);
    // Returns response if true, else print response
    curl_setopt($chanel, CURLOPT_RETURNTRANSFER, true);
    // Set the URL (Request)
    curl_setopt($chanel, CURLOPT_URL,$this->_settings['request']);
    // Execute request
    $this->_settings['response']  = curl_exec($chanel);
    // Close chanel
    curl_close($chanel);    

    switch ($option) {

        case 'decode':
             $this->_settings['response']  = json_decode($this->_settings['response'],true); // False Debug
            return $this->_settings['response'];
            break;
        // Debugin
        case 'encode':
             $this->_settings['response']  = json_encode($this->_settings['response'],true);
            return $this->_settings['response'];
            break;

        default:
            echo '<li class="via-error">Error 2-1, Empty or not found _jsoncurl parameter</li>';           
            break;
    }

}

/**
 * Get user's profile picture from Facebook's databas using CURL
 * @since 1.0
 * @see _picture('{url}') | https://github.com/Viaprestige/Viasocial
 */
private function _picture($url){

	//  Initiate curl method
    $chanel = curl_init($url);
    // Body response value
    curl_setopt($chanel, CURLOPT_NOBODY, 1);
    // Follow redirections
    curl_setopt($chanel, CURLOPT_FOLLOWLOCATION, 1);
    // Auto refer URL
    curl_setopt($chanel, CURLOPT_AUTOREFERER, 1);
    // Execute request
    curl_exec($chanel);
    // Returns effective URL
    $src = curl_getinfo($chanel, CURLINFO_EFFECTIVE_URL);
    // close chanel
    curl_close($chanel);

    if (isset($src)) {
        
        return $src;
    }
    else{

        return false;
        
    }

}

/**
 * Get Shares & Likes Count, Comments count, SourceId, Source Type, Source URL
 * @since 1.0
 * @see count('{option}') | https://github.com/Viaprestige/Viasocial
 */
public function count($option){


    $this->_settings['parameter'] =  array('?id' => $this->_settings['url'] );
    
    $this->_settings['request']   =  $this->_settings['api']
    								.$this->_settings['version'].'/'
                                    .key($this->_settings['parameter']).'='
                                    .$this->_settings['parameter']['?id'].'&'
                                    .'access_token='
                                    .$this->_settings['token'];

    self::_jsoncurl('decode');

    if (isset($this->_settings['response']['og_object']['id'])) {

        $this->_results['sourceId'] =  $this->_settings['response']['og_object']['id'];
    }
    else{

        $this->_results['sourceId'] = 0;

    }

    if (isset($this->_settings['response']['og_object']['type'])) {

        $this->_results['sourceType'] =  $this->_settings['response']['og_object']['type'];
    }
    else{

        $this->_results['sourceType'] = 0;

    }

    if (isset($this->_settings['response']['og_object']['url'])) {

        $this->_results['sourceUrl'] =  $this->_settings['response']['og_object']['url'];
    }
    else{

        $this->_results['sourceUrl'] = 0;

    }

    if (isset($this->_settings['response']['share']['comment_count'])) {

        $this->_results['commentCount'] =  $this->_settings['response']['share']['comment_count'];
    }
    else{

        $this->_results['commentCount'] = 0;

    }

    if (isset($this->_settings['response']['share']['share_count'])) {

        $this->_results['shareCount'] =  $this->_settings['response']['share']['share_count'];
       
       }
    else{

        $this->_results['shareCount'] = 0;

    }


    switch ($option) {

        case 'sourceId':
            return $this->_results['sourceId'];
            break;

        case 'sourceType':
            return $this->_results['sourceType'];
            break;

        case 'sourceUrl':
            return $this->_results['sourceUrl'];
            break;

        case 'commentCount':
            return $this->_results['commentCount'];
            break;

        case 'shareCount':
            return $this->_results['shareCount'];
            break;

        default:
            echo '<li class="via-error">Error 3, Empty or not found counter object</li>';
            break;
    }
}

/**
* Fetch Comments, Authors, Publishing date & time, Profiles pictures
* @since 1.0
* @see fetch('{options}') | https://github.com/Viaprestige/Viasocial
*/
public function fetch($option,$limit){

    $this->_settings['parameter'] =  array('id' 	   => $this->_settings['url']);
    $this->_settings['fields'] 	  =  array('?fields'   => 'og_object{comments}');

    $this->_settings['request']   =  $this->_settings['api']
    								.$this->_settings['version'].'/'
    								.key($this->_settings['fields']).'='
    								.$this->_settings['fields']['?fields'].'&'
                                    .key($this->_settings['parameter']).'='
                                    .$this->_settings['parameter']['id'].'&'
                                    .'access_token='
                                    .$this->_settings['token'];
	self::_jsoncurl('decode');

	for ($i=0; $i <= $limit; $i++) {
	        
	    if (isset($this->_settings['response']['og_object']['comments']['data'][$i]['from']['id'])) {

	        $this->_results['authorId'] = $this->_settings['response']['og_object']['comments']['data'][$i]['from']['id'];

	    }
	    else{

	        $this->_results['authorId'] = 'unknown';
            return null;

	    }

	    if (isset($this->_settings['response']['og_object']['comments']['data'][$i]['from']['name'])) {

	        $this->_results['author'] = $this->_settings['response']['og_object']['comments']['data'][$i]['from']['name'];
	    }
	    else{

	        $this->_results['author'] = 'unknown';
            return null;

	    }

	    if (isset($this->_results['authorId'])) {

	        $this->_results['picture'] =  self::_picture($this->_settings['api']
                                                        .$this->_settings['version'].'/'
                                                        .$this->_results['authorId'].'/picture');

	    }
	    else{

	        $this->_results['picture'] = 'no picture';
            return null;

	    }

	    if (isset($this->_settings['response']['og_object']['comments']['data'][$i]['message'])) {

	        $this->_results['message'] = ($this->_settings['response']['og_object']['comments']['data'][$i]['message']);

	    }

	    else{

	        $this->_results['message'] = 'nothing';
            return null;

	    }

	    if (isset($this->_settings['response']['og_object']['comments']['data'][$i]['created_time'])) {

	        $this->_results['datetime'] = $this->_settings['response']['og_object']['comments']['data'][$i]['created_time'];
	        $this->_results['date'] = substr($this->_results['datetime'], 0, 10);
	        $this->_results['time'] = substr($this->_results['datetime'], 12, -5);

	        $this->_results['datetime'] = '<span class="via-datetime">'.$this->_results['date'].' '.$this->_results['time'].'</span>';

	    }
	    else{

	        $this->_results['datetime'] = 'unknown';
            return null;
	    }

        if (strlen($this->_results['message']) > 100) {

            $this->_results['message'] = substr($this->_results['message'], -80).' <a href="#fb-root">(...)</a>';

        }

		switch ($option) {

	        case 'all':
	            echo '<li>';
	            echo '<div class="via-picture-box">';
	            echo '<img src="'.$this->_results['picture']                      .'"><br>';
	            echo '</div>';
	            echo '<div class="via-item">';
	            echo '<span class="via-author">'     .$this->_results['author']   .'</span><br>';
	            echo '<span class="via-datetime">'   .$this->_results['datetime'] .'</span><br>';
	            echo '<span class="via-message">'    .$this->_results['message']  .'</span><br>';
	            echo '</div>';
	            echo '</li>';
	            break;

	        case 'custom':
	            echo '<li>';
	            echo '<div class="via-picture-box">';
	            echo '<img src="./assets/img/'. $limit--               			  .'.png"><br>';
	            echo '</div>';
	            echo '<div class="via-item">';
	            echo '<span class="via-author">'     .$this->_results['author']   .'</span><br>';
	            echo '<span class="via-datetime">'   .$this->_results['datetime'] .'</span><br>';
	            echo '<span class="via-message">'    .$this->_results['message']  .'</span><br>';
	            echo '</div>';
	            echo '</li>';
	            break;

	        case 'authorId':
	           	echo '<li>';
	            echo '<span class="via-id">'         .$this->_results['authorId'] .'</span><br>';
	            echo '</li>';
	            break;
	            
	        case 'author':
	            echo '<li>';
	            echo '<span class="via-author">'     .$this->_results['author']   .'</span><br>';
	            echo '</li>';
	            break;

	        case 'picture':
	            echo '<li>';
	            echo '<img class="via-picture" src="'.$this->_results['picture']  .'"><br>';
	            echo '</li>';
	            break;

	        case 'message':
	            echo '<li>';
	            echo '<span class="via-message">'    .$this->_results['message']  .'</span><br>';
	            echo '</li>';
	            break;              

	        case 'datetime':
	            echo '<li>';
	            echo '<span class="via-datetime">'   .$this->_results['datetime'] .'</span><br>';
	            echo '</li>';
	            break;

	        case 'date':
	            echo '<li>';
	            echo '<span class="via-date">'       .$this->_results['date']     .'</span><br>';
	            echo '</li>';
	            break;

	        case 'time':
	            echo '<li>';
	            echo '<span class="via-time">'       .$this->_results['time']     .'</span><br>';
	            echo '</li>';
	            break;

	        default:
	            echo '<li class="via-error">Error 4, Empty or not found json parameter</li>';
	            break;
		}
	}
}
/**
* Include Official Facebook plugins, Comments, Likes, Shares, Send, Follow
* @since 1.0
* @see plugin('{options}') | https://github.com/Viaprestige/Viasocial
*/
public function plugin($option){

    // Facebook SDK for JavaScript
	$this->_JSDK  = '<!-- Facebook comment plugin | Viaprestige Web Agency-->'
                    .'<div id="fb-root"></div>'
                    .'<script>'
                    .'(function(d, s, id) {'
                    .'var js, fjs = d.getElementsByTagName(s)[0];'
                    .'if (d.getElementById(id)) return;'
                    .'js = d.createElement(s); js.id = id;'
                    .'js.src = "'.$this->_plugins['connect']
                    .$this->_plugins['language']
                    .$this->_plugins['parameter']
                    .'xfbml='
                    .$this->_plugins['xfbml']
                    .'&version='
                    .$this->_settings['version']
                    .'&appId='
                    .$this->_settings['appId']['client_id'].'";'
                    .'fjs.parentNode.insertBefore(js, fjs);'
                    ."}(document, 'script', 'facebook-jssdk'));"
                    .'</script>';

    echo $this->_JSDK;

    switch ($option) {
        case 'comment':

            // Facebook comments plugin tag
            $this->_HTML = '<div class="fb-comments" data-href="'
                            .self::_url('current').'" data-width="'
                            .$this->_plugins['width'].'px" data-numposts="'
                            .$this->_plugins['numposts'].'" data-colorscheme="'
                            .$this->_plugins['colorscheme'].'" data-mobile="'
                            .$this->_plugins['mobile'].'" data-order-by="'
                            .$this->_plugins['order'].'"></div>';

            echo $this->_HTML;

            break;
        
        default:
            echo '<li class="via-error">Error 66, Empty or not found plugin parameter</li>';
            break;
    }
}
}
?>