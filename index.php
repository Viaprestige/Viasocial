<?php
include_once('Avada 3.8.6/viasocial/class/facebook.class.php');

$object = new Facebook('{app-id}','{app-secret}');

// count('{option}') :

$object->count('sourceId'); // Returns the object's ID

$object->count('sourceType'); // Returns the object's Type eg. Website

$object->count('sourceUrl'); // Returns the object's URL

$object->count('commentCount'); // Returns comments count

$object->count('shareCount'); // Returns shares & likes count *

// * shares and likes are both counted in the same time

// fetch('{option},{limit}') :

$object->fetch('all','5'); // Returns full data : comment, author, date&time, limited by 5

$object->fetch('custom','5'); // Returns full data except profile picture

$object->fetch('authorId','5'); // Returns authors IDs

$object->fetch('author','5'); // Returns authors names

$object->fetch('picture','5'); // Returns user's profile picture

$object->fetch('message','5'); // Returns messages (comments)

$object->fetch('datetime','5'); // Returns date&time of publishing

$object->fetch('date','5'); // Returns date of publishing

$object->fetch('time','5'); // Returns time of publishing

// plugin('{option}') :

$object->plugin('comment'); // Returns the Facebook comments plugin

?>