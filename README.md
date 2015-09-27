Viasocial | Advanced Social Plugin
==================================
<img src="http://viaprestige.github.io/Viasocial/img/7465722e737667.svg" alt="Security" style="max-width:100%;">
<img src="http://viaprestige.github.io/Viasocial/img/2f6a656b796c6c2.svg" alt="Dependency Status" style="max-width:100%;">

Author  	:  <a href="http://viaprestige-agency.com" target="_blanc">Viaprestige Web Agency</a><br>
Package 	:  Viasocial | Facebook class<br>
Version 	:  1.0 Comma release @01/09/2015<br>
Official website: http://viaprestige.github.io/Viasocial


----------


**Viasocial** is a simple PHP plugin, that makes the possibility to **fetch comments from facebook**'s database, using the <a href="https://developers.facebook.com/docs/graph-api" target="_blank">Graph API</a>.
Viasocial is created specially for <a href="https://wordpress.org/" target="_blanc">WordPress</a>, under <a href="http://theme-fusion.com/avada/" target="_blanc">Avada</a> template.

The Source of Ideas
-----------------------
Two weeks ago we decide to replace the default WordPress comments with <a href="https://developers.facebook.com/products/social-plugins" target="_blanc">facebook social plugin</a>, so at this step  everything is clear except that for example; we can't show the latest comments* in the sidebar, because that facebook social plugin is iframed, means that comments are outside website, and neither WordPress or WordPress's plugins  can do that at this moment (no official methods).
So we decide to make something simple & clean, then we have chosen PHP, and we avoided using jQuery.


----------


The bases
-----------------------

 - With the facebook's Graph API, we can get a json response from server to navigator, this response contains : comments count, shares count, likes count, comments, authors, date&time, author's ID...
 - Viasocial gets these informations from navigator.

The Work Space
-----------------------

We choose WordPress as the best work space for our plugin, and we made it **100% compatible** with Avada.
For other templates : Our **official 'Viasocial' plugin** w'll be available soon at Wordpress.org. (we are working on it right now)


----------


Functionalities
-----------------------

 - **Get Comments count** for posts in <a href="http://viaprestige-agency.com/optimiser-son-site-internet/" target="_blanc">website</a>.
 - Get **Shares & Likes count**.
 - **Get Comments**, authors, date&Time, Author's ID, Post's ID, Profile picture.
 - Share the current page in facebook, using **share()**.
 - Avoid installing unnecessary plugins in your website.
 - Compatible with Avada .po .
 - Fully customizable, with additional CSS class.
 - Viasocial is crystal clear, and simple to manipulate.


----------


Requirements
--------------------

 - <a href="https://developers.facebook.com/docs/plugins/comments" target="_blanc">Facebook comments plugin(JS).
 - Wordpress & Avada updates.

Compatibility
-------------------

Since <a href="https://wordpress.org/download/" target="_blanc">Wordpress 4.2</a> & <a href="http://themeforest.net/item/avada-responsive-multipurpose-theme/2833226" target="_blanc">Avada 3.8.5</a>


----------


Components
----------------

Viasocial folder :

	.viasocial
	+-- class
	|   --- facebook.class.php
	+-- assets
	|   +-- css
	|   +-- js
	|   +-- img

Avada folder :  

	.Avada 3.8.6
	|+--.includes
	|	|   +-- .viasocial
	|	|   --- .class-fusion-widget-tabs.php
	|	|   --- .class-fusion-widget-tabs.php.bak


----------


Installation
----------------

### Standard intagration (developers)
Include the facebook class in your project and make a call to it :

	include_once('class/facebook.class.php');
	$object = new Facebook();
	
Use function **count('{option}')** :

The object, is for example this <a href="http://www.viaprestige-lifestyle.com/Tendances/la-cle-usb-google-nouveaute-pour-securiser-les-donnees/" target="_blanc">article</a>

	$object->count('sourceId'); 
	// Returns the object's ID
	$object->count('commentsCount'); 
	// Returns comments count
	$object->count('sharesCount'); 
	// Returns shares & likes count *
	// * shares and likes are both counted in the same time
	
Use function **fetch('{option},{limit}')** :

	$object->fetch('all','5'); 
	// Returns full data : comment, author, date&time, limited by 5
	$object->fetch('custom','5'); 
	// Returns full data with custom profile picture
	$object->fetch('authorId','5'); 
	// Returns authors IDs
	$object->fetch('author','5'); 
	// Returns authors names
	$object->fetch('picture','5'); 
	// Returns user's profile picture
	$object->fetch('message','5'); 
	// Returns messages (comments)
	$object->fetch('datetime','5'); 
	// Returns date&time of publishing
	$object->fetch('date','5'); 
	// Returns date of publishing
	$object->fetch('time','5'); 
	// Returns time of publishing

Use function **share()** :

	$object->share(); 
	// Returns the current URL to share on Facebook*
	
See the <a href="https://www.facebook.com/sharer/sharer.php?u=http://viaprestige-agency.com/" target="_blanc">demo</a>.


----------


### Wordpress intagration (Avada)

 1. Copy all contents of **. /  includes** folder into your website :

		/wp-content/themes/Avada/includes
	
	Using <a href="https://filezilla-project.org/download.php?type=client" target="_blanc">FTP client</a>.

 2. In your WordPress backoffice / Theme options / blog /
 deactivate comments to turn on Viasocial.
 3. Put this custom css in your style :

		.via-picture-box{
		    float: left;
		    margin-right: 15px;
		    height: 50px;
		    width: 50px;
		}

----------
### Demonstration

To run a demo, just put the main folder in your localhost WWW.
then you have to edite facebook.class.php, by defining {url} :
	    
	    // Debuging
	    // $this->settings['url'] = '{url}';


### Installation via git

	$ mkdir my-Viasocial
	$ cd my-Viasocial
	$ git clone https://github.com/Viaprestige/Viasocial
	$ cd ..
	$ start my-Viasocial
	
----------
License
----------------
See <a href="https://github.com/Viaprestige/Viasocial/blob/master/LICENSE">Viasocial licence</a>
