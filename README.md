Viasocial | Advanced Social Plugin
==================================
Author  	:  [Viaprestige Web Agency](viaprestige-agency.com)
Package 	:  Viasocial | Facebook class
Version 	:  1.0 Comma release @01/09/2015


----------


**Viasocial** is a simple PHP plugin, that makes the possibility to **fetch comments from facebook**'s database, using the [Graph API](https://developers.facebook.com/docs/graph-api).
Viasocial is created specially for [WordPress](https://wordpress.org/), under [Avada](http://theme-fusion.com/avada/) template.

The Source of Ideas
-----------------------
Two weeks ago we decide to replace the default WordPress comments with [facebook social plugin](https://developers.facebook.com/products/social-plugins) , so at this step  everything is clear except that for example; we can't show the latest comments* in the sidebar, because that facebook social plugin is iframed, means that comments are outside website, and neither WordPress or WordPress's plugins  can do that at this moment (no official methods).
So we decide to make something simple & clean, then we have chosen PHP, and we avoided using jQuery.


----------


The bases
-----------------------

 - With the facebook's Graph API, we can get a json response from server to navigator, this response contains : comments count, shares count, likes count, comments, authors, date&time, author's ID...
 - Viasocial gets these informations from navigator.

The Work Space
-----------------------

We choose WordPress as the best work space for our plugin, and we made it **100% compatible** with Avada.
For other templates : Our official 'Viasocial' plugin w'll be available soon at Wordpress.org. (we are working on it right now)


----------


Functionalities
-----------------------

 - **Get Comments count** for posts in [website](http://viaprestige-agency.com/optimiser-son-site-internet/).
 - Get **Shares & Likes count**.
 - **Get Comments**, authors, date&Time, Author's ID, Post's ID, Profile picture.
 - Share the current page in facebook, using **share()**.
 - Avoid installing unnecessary plugins in your website.
 - Compatible with Avada .po .
 - Viasocial is crystal clear, and simple to manipulate.


----------


Requirements
--------------------

 - [Facebook comments plugin](https://developers.facebook.com/docs/plugins/comments) (JS).
 - Wordpress & Avada updates.

Compatibility
-------------------

Since [Wordpress 4.2](https://wordpress.org/download/) & [Avada 3.8.5](http://themeforest.net/item/avada-responsive-multipurpose-theme/2833226)


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

The object is for example [this article](http://www.viaprestige-lifestyle.com/Tendances/la-cle-usb-google-nouveaute-pour-securiser-les-donnees/)

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
	
See the [demo](https://www.facebook.com/sharer/sharer.php?u=http://viaprestige-agency.com/).


----------


### Wordpress intagration (Avada)

 1. Copy all contents of **. /  includes** folder into your website :

		/wp-content/themes/Avada/includes
	
	Using [FTP client](https://filezilla-project.org/download.php?type=client).

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

You'll find Demo in Sample folder.
if your are using localhost, please define {url} :
	    
	    // Debuging
	    // $this->settings['url'] = '{url}';


### Installation via git

	$ mkdir my-fantazy-sidebar
	$ cd my-fantazy-sidebar
	$ git clone https://github.com/Viaprestige/Viasocial
	$ cd ..
	$ start my-fantazy-sidebar
	
