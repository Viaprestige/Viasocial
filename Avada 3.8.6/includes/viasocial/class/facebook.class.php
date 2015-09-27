<?php
/**
*@author  :  Viaprestige | JIHAD SINNAOUR 
*@package :  Viasocial | Facebook class
*@version :  1.0 Comma release @01/09/2015
*@param   :  Facebook Graph API
*@return  :  json, Array[], String
*/

Class Facebook {

    private $settings = array(
        'api'       => 'https://graph.facebook.com/',
        'parameter' => '',
        'url'       => '',
        'request'   => '',
        'response'  => ''
        );
    private $results  = array(
        'sourceId'  	=> '',
        'sharesCount'   => '',
        'commentsCount' => '',
        'authorId'		=> '',
        'author'		=> '',
        'picture'		=> '',
        'message'		=> '',
        'datetime'		=> '',
        'date'          => '',
        'time'          => ''
        );

public function __construct(){

}

public function __set($property,$value){

    $this->$property = $value;
    return $this->property;

}

public function __get($property){

    return $this->$property;

}

/**
 * Get the current URL, which is the ID in Facebook's database
 * @since 1.0
 * @see url('current') | https://github.com/Viaprestige/Viasocial
 */
public function url($option){

	switch ($option) {

		case 'current':
			$this->settings['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			return $this->settings['url'];
			break;
		
		default:
			if (!empty($option)) {
			$this->settings['url'] = 'http://'.$option;
			return $this->settings['url'];
			}
			else{
				echo '<li class="via-error">Error 1, Empty or not found url option</li>';
			}
			break;
	}
}


/**
 * Get response from Facebook Graph API 
 * @since 1.0
 * @see json('decode') | https://github.com/Viaprestige/Viasocial
 */
private function json($option){

    switch ($option) {

        case 'decode':
            $this->settings['response']  =  json_decode(file_get_contents($this->settings['request']), true);
            return $this->settings['response'];
            break;
        // Debugin
        case 'encode':
            $this->settings['response']  =  json_encode(file_get_contents($this->settings['request']), true);
            return $this->settings['response'];
            break;

        default:
        	error_reporting(E_ALL & ~E_NOTICE);
            echo '<li class="via-error">Error 2, Empty or not found json parameter</li>';        	
            break;
    }

}

/**
 * Get user's profile picture from Facebook's databas using CURL
 * @since 1.0
 * @see picture('{url}') | https://github.com/Viaprestige/Viasocial
 */
private function picture($url){

    $pictureOrigin = curl_init($url);
    curl_setopt($pictureOrigin, CURLOPT_NOBODY, 1);
    curl_setopt($pictureOrigin, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($pictureOrigin, CURLOPT_AUTOREFERER, 1);
    curl_exec($pictureOrigin);

    $pictureSource = curl_getinfo($pictureOrigin, CURLINFO_EFFECTIVE_URL);
    curl_close($pictureOrigin);

    if (isset($pictureSource)) {
        
        return $pictureSource;
    }
    else{
        return false;
    }

}

/**
 * Get Shares&Likes Count, Comments count, sourceId
 * @since 1.0
 * @see count('{option}') | https://github.com/Viaprestige/Viasocial
 */
public function count($option){

	self::url('current');

    // Debuging
    // $this->settings['url'] = '{url}';

    $this->settings['parameter'] =  array('?ids' => $this->settings['url'] );
    $this->settings['request']   =  $this->settings['api'].
                                    key($this->settings['parameter']).'='.
                                    $this->settings['parameter']['?ids'];

    self::json('decode');

    if (isset($this->settings['response'][$this->settings['url']]['id'])) {

    	$this->results['sourceId'] =  $this->settings['response'][$this->settings['url']]['id'];
    }
    else{

    	$this->results['sourceId'] = 0;

    }


    if (isset($this->settings['response'][$this->settings['url']]['comments'])) {

    	$this->results['commentsCount'] =  $this->settings['response'][$this->settings['url']]['comments'];
    }
    else{

    	$this->results['commentsCount'] = 0;

    }

    if (isset($this->settings['response'][$this->settings['url']]['shares'])) {

       	$this->results['sharesCount'] =  $this->settings['response'][$this->settings['url']]['shares'];
       
       }
    else{

    	$this->results['sharesCount'] = 0;

    }


    switch ($option) {

        case 'sourceId':
            return $this->results['sourceId'];
            break;

        case 'commentsCount':
            return $this->results['commentsCount'];
            break;

        case 'sharesCount':
            return $this->results['sharesCount'];
            break;

        default:
            error_reporting(E_ALL & ~E_NOTICE);
            echo '<li class="via-error">Error 3, Empty or not found counter object</li>';
            break;
    }
}

/**
 * Fetch Comments, Authors, Date&Time, Profiles pictures
 * @since 1.0
 * @see fetch('{options}') | https://github.com/Viaprestige/Viasocial
 */
public function fetch($option,$limit){

	self::url('current');

    // Debuging
    // $this->settings['url'] = '{url}';

    $this->settings['parameter'] =  array('comments?id' => $this->settings['url'] );
    $this->settings['request']   =  $this->settings['api'].
                                  	key($this->settings['parameter']).'='.
                                    $this->settings['parameter']['comments?id'];

	self::json('decode');

	for ($i=0; $i <= $limit; $i++) { 
		
	if (isset($this->settings['response']['data'][$i]['from']['id'])) {

		$this->results['authorId'] = $this->settings['response']['data'][$i]['from']['id'];
	}
	else{

		$this->results['authorId'] = 'unknown';
	}

	if (isset($this->settings['response']['data'][$i]['from']['name'])) {

		$this->results['author'] = $this->settings['response']['data'][$i]['from']['name'];
	}
	else{

		$this->results['author'] = 'unknown';
	}

	if (isset($this->results['authorId'])) {

		$this->results['picture'] = self::picture($this->settings['api'].$this->results['authorId'].'/picture');
	}
	else{

		$this->results['picture'] = 'no_picture';
	}


	if (isset($this->settings['response']['data'][$i]['message'])) {

		$this->results['message'] = ($this->settings['response']['data'][$i]['message']);
	}
	else{

		$this->results['message'] = 'nothing';
	}

	if (isset($this->settings['response']['data'][$i]['created_time'])) {

		$this->results['datetime'] = $this->settings['response']['data'][$i]['created_time'];
        $this->results['date'] = substr($this->results['datetime'], 0, 10);
        $this->results['time'] = substr($this->results['datetime'], 12, -5);

        $this->results['datetime'] = '<span class="via-datetime">'.$this->results['date'].' '.$this->results['time'].'</span>';

	}
	else{

		$this->results['datetime'] = 'unknown';
	}

    if ($this->results['message'] == 'nothing' || strlen($this->results['message']) > 150) {
        return 0;
    }

	switch ($option) {

		case 'all':
            echo '<li>';
            echo '<div class="via-picture-box">';
			echo '<img src="'.$this->results['picture']  					 .'"><br>';
			echo '</div>';
			echo '<div class="via-item">';
			echo '<span class="via-author">'     .$this->results['author']   .'</span><br>';
            echo '<span class="via-datetime">'   .$this->results['datetime'] .'</span><br>';
			echo '<span class="via-message">'    .$this->results['message']  .'</span><br>';
			echo '</div>';
            echo '</li>';
			break;

		case 'custom':
            echo '<li>';
            echo '<div class="via-picture-box">';
            echo '<img src="./viasocial/assets/img/'. $limit-- 				 .'.png"><br>';
            echo '</div>';
            echo '<div class="via-item">';
			echo '<span class="via-author">'     .$this->results['author']   .'</span><br>';
			echo '<span class="via-datetime">'   .$this->results['datetime'] .'</span><br>';
			echo '<span class="via-message">'    .$this->results['message']  .'</span><br>';
			echo '</div>';
            echo '</li>';
			break;

		case 'authorId':
            echo '<li>';
			echo '<span class="via-id">'         .$this->results['authorId'] .'</span><br>';
            echo '</li';
			break;
			
		case 'author':
            echo '<li>';
			echo '<span class="via-author">'     .$this->results['author']   .'</span><br>';
            echo '</li>';
			break;

		case 'picture':
            echo '<li>';
			echo '<img class="via-picture" src="'.$this->results['picture']  .'"><br>';
            echo '</li>';
			break;

		case 'message':
            echo '<li>';
			echo '<span class="via-message">'    .$this->results['message']  .'</span><br>';
            echo '</li>';
			break;				

		case 'datetime':
            echo '<li>';
			echo '<span class="via-datetime">'   .$this->results['datetime'] .'</span><br>';
			echo '</li>';
            break;

        case 'date':
            echo '<li>';
            echo '<span class="via-date">'       .$this->results['date']     .'</span><br>';
            echo '</li>';
            break;

        case 'time':
            echo '<li>';
            echo '<span class="via-time">'       .$this->results['time']     .'</span><br>';
            echo '</li>';
            break;

		default:
        	error_reporting(E_ALL & ~E_NOTICE);
            echo '<li class="via-error">Error 4, Empty or not found json parameter</li>';
			break;
		}
	}
}

/**
 * Share current URL in facebook, usin sharer.php
 * @since 1.0
 * @see share() | https://github.com/Viaprestige/Viasocial
 */
public function share(){

    self::url('current');

    // Debuging
    // $this->settings['url'] = '{url}';

    $this->settings['api']       =  'https://www.facebook.com/sharer/sharer.php';
    $this->settings['parameter'] =  array('?u' => $this->settings['url'] );
    $this->settings['request']   =  $this->settings['api'].
                                    key($this->settings['parameter']).'='.
                                    $this->settings['parameter']['?u'];

    return $this->settings['request'];
}
}
?>