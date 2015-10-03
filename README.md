Viasocial | Advanced Social Plugin
==================================
[![Latest Stable Version](https://poser.pugx.org/viaprestige/viasocial/version)](https://packagist.org/packages/viaprestige/viasocial) [![Latest Unstable Version](https://poser.pugx.org/viaprestige/viasocial/v/unstable)](//packagist.org/packages/viaprestige/viasocial) [![Total Downloads](https://poser.pugx.org/viaprestige/viasocial/downloads)](https://packagist.org/packages/viaprestige/viasocial)

Author  	:  <a href="http://viaprestige-agency.com" target="_blanc">Viaprestige Web Agency</a><br>
Package 	:  Viasocial | Facebook class<br>
Version 	:  1.0 Stable release<br>
Graph API	:  2.4<br>
Official website : http://viaprestige.github.io/Viasocial<br>
Demo : <a href="http://apps.jihadsinnaour.com/Viasocial/" target="_blanc">Viasocial demo website</a>

@01/09/2015


----------


**Viasocial** is a simple PHP plugin, that makes the possibility to **fetch comments from facebook**'s database, using the <a href="https://developers.facebook.com/docs/graph-api" target="_blank">Graph API</a>.
Viasocial is created specially for <a href="https://wordpress.org/" target="_blanc">WordPress</a>, under <a href="http://theme-fusion.com/avada/" target="_blanc">Avada</a> template.

The Source of Ideas
-----------------------
Two weeks ago we decide to replace the default WordPress comments with <a href="https://developers.facebook.com/products/social-plugins" target="_blanc">facebook social plugin</a>, so at this step  everything is clear except that for example; we can't show the latest comments* in the sidebar, because that facebook social plugin is iframed, means that comments are outside website, and thats generate <a href="https://fr.wikipedia.org/wiki/Optimisation_pour_les_moteurs_de_recherche" target="_blanc">SEO</a> problems. At this moment neither WordPress or WordPress's plugins  can do that (no <a href="https://profiles.wordpress.org/facebook/" target="_blanc">official</a> methods).
So we decide to make something simple & clean, then we have chosen PHP, and we avoided using jQuery.<br>
<strong>Notice</strong> : this plugin is totally different than <a href="https://wordpress.org/plugins/facebook/" target="_blanc">Facebook WordPress plugin</a>, and nothing is inspired form it at all.


----------


The bases
-----------------------

 - With the facebook's Graph API, we can get a json response from server to navigator, this response contains : comments count, shares count, likes count, comments, Authors, Date & Time, Author's ID and  more...
 - Viasocial gets these informations from navigator and includes it to website.

The Work Space
-----------------------

We choose WordPress as the best work space for our plugin, and we made it **100% compatible** with Avada.
For other <a href="http://themeforest.net/popular_item/by_category?category=wordpress" target="_blanc">templates</a> :<br>
Use our official plugin <a href="https://wordpress.org/plugins/viasocial/" target="_blanc">Visaocial for WordPress</a>. 


----------


Functionalities
-----------------------

 - **Get Comments count** for posts in <a href="http://viaprestige-agency.com/optimiser-son-site-internet/" target="_blanc">website</a>.
 - Get **Shares & Likes count**.
 - **Get Comments**, **Authors**, **Profile picture**, **Date & Time**, Author's ID, Post's ID & more ...
 - Customize yourself the template and avoid installing unnecessary plugins on your website.
 - Include official Facebook plugins
 - Compatible with Avada .po .
 - Fully customizable, with additional CSS class.
 - Viasocial is crystal clear, and simple to manipulate.


Upcoming
-----------------------
 - Share the current page in facebook, using **share()**.
 - Show 1 comment from each post in Blog

----------


Compatibility
-------------------

Since <a href="https://wordpress.org/download/" target="_blanc">Wordpress 4.2</a> & <a href="http://themeforest.net/item/avada-responsive-multipurpose-theme/2833226" target="_blanc">Avada 3.8.5</a>

Viasocial startup release is simple & flexible & compatible with popular CMS :<br>
<a href="http://drupalfr.org/" target="_blanc"><img src="http://viaprestige.github.io/Viasocial/img/viasocial_drupal.png" alt="Drupal" style="max-width:100%;"></a> | <a href="https://www.joomla.org/" target="_blanc"><img src="http://viaprestige.github.io/Viasocial/img/viasocial_joomla.png" alt="Joomla!" style="max-width:100%;"></a> | <a href="https://www.prestashop.com/fr/" target="_blanc"><img src="http://viaprestige.github.io/Viasocial/img/viasocial_prestashop.png" alt="Prestashop" style="max-width:100%;"></a> | <a href="http://magento.com/" target="_blanc"><img src="http://viaprestige.github.io/Viasocial/img/viasocial_magento.png" alt="Magento" style="max-width:100%;"></a> | <a href="http://modx.com/" target="_blanc"><img src="http://viaprestige.github.io/Viasocial/img/viasocial_modx.png" alt="Modx" style="max-width:100%;"></a><br>
Depending on your customization.

----------

And tested with success with popular plugins :<br>
The powerfull cache engine : <a href="http://wp-rocket.me/fr/" target="_blanc">WP Rocket</a><br>

Tested with success with latest WordPress core : <a href="https://github.com/WordPress/WordPress" target="_blanc">v4.4</a>

----------

Requirements
--------------------

 - PHP 5.4
 - Curl
 - <a href="https://developers.facebook.com/docs/javascript" target="_blanc">Facebook Javascript SDK.</a>
 - <a href="https://developers.facebook.com/docs/plugins/comments" target="_blanc">Facebook comments plugin (JS).</a>
 - <a href="https://developers.facebook.com/docs/apps/register" target="_blanc">Facebook App ID & App Secret</a>
 - Wordpress & Avada updates.

----------

Components
----------------

Viasocial folder :

	.Viasocial
	+-- class
	|   --- facebook.class.php
	+-- assets
	|   +-- css
	|   +-- js
	|   +-- img

Avada folder :  

	.Avada 3.8.6
	|+--.includes
	|	|   +-- .Viasocial
	|	|   --- .class-fusion-widget-tabs.php
	|	|   --- .class-fusion-widget-tabs.php.bak


----------


Installation
----------------

### Startup intagration (developers)
Install Viasocial/facebook.class.php via composer :

	$ composer require viaprestige/viasocial
	
Clone repo via Git

	$ mkdir Viasocial
	$ cd Viasocial
	$ git clone https://github.com/Viaprestige/Viasocial
	$ cd ..
	$ start Viasocial
	
Include the facebook class in your project and make a call to it :

	include_once('class/facebook.class.php');
	
Create instance and define {app-id} & {app-secret} :

	$object = new Facebook('{app-id}','{app-secret}');
	
See more informations about {app-id} & {app-secret} <a href="#faqs">HERE</a>
	
Use **count('{option}')** function :

The object, is for example this <a href="http://www.viaprestige-lifestyle.com/Tendances/la-cle-usb-google-nouveaute-pour-securiser-les-donnees/" target="_blanc">article</a>

Returns the object's ID :

	$object->count('sourceId'); 
	
Returns the object's Type :

	$object->count('sourceType'); 
	
Returns the object's URL :

	$object->count('sourceUrl'); 

Returns comments count :

	$object->count('commentCount'); 

Returns shares & likes count * :

	$object->count('shareCount'); 

**Notice** : * shares and likes are both counted in the same time
	
----------

Use function **fetch('{option},{limit}')** :

Returns full data : comment, author,picture, date & time, limited by 5
	
	$object->fetch('all','5');
 
Returns full data with custom profile picture

	$object->fetch('custom','5'); 

Returns authors IDs

	$object->fetch('authorId','5');

Returns authors names

	$object->fetch('author','5'); 

Returns user's profile picture

	$object->fetch('picture','5'); 

Returns messages (comments)

	$object->fetch('message','5'); 

Returns date & time of publishing

	$object->fetch('datetime','5'); 

Returns date of publishing

	$object->fetch('date','5'); 

Returns time of publishing

	$object->fetch('time','5'); 

----------

Use **plugin('{option}')** function :

Returns <a href="https://developers.facebook.com/docs/plugins" target="_blanc">Facebook social plugins</a>

	$plugin_object = new Facebook('','');
	$plugin_object->plugin('');

----------

Use **share()** (Upcoming) function :

Returns the current URL to share on Facebook

	$object->share();
	
See the <a href="https://www.facebook.com/sharer/sharer.php?u=http://viaprestige-agency.com/" target="_blanc">share demo</a>.


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
		.via-datetime{
    		font-size: 12px;
		}
		.via-author {
    		text-transform: uppercase;
		}

----------
### Demonstration

To run a demo, just put the main folder in your localhost WWW.
then you have to edite facebook.class.php, by defining {url} in constructor :
	    
	    // Debuging
	    // $this->settings['url'] = '{url}';
	


----------

FAQ's
----------------

 - How to create Facebook App and get App ID & App Secret ?

Read this <a href="https://support.appmachine.com/hc/en-us/articles/203645706-Create-a-Facebook-App-ID-App-Secret" target="_blanc">article</a>.

----------

License
----------------
[![License](https://poser.pugx.org/viaprestige/viasocial/license)](https://packagist.org/packages/viaprestige/viasocial)
