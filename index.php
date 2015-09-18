<?php
include_once('Avada 3.8.6/viasocial/class/facebook.class.php');

$object = new Facebook();

// count('{option}') :

$object->count('sourceId'); // Returns the object's ID

$object->count('commentsCount'); // Returns comments count

$object->count('sharesCount'); // Returns shares & likes count *

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

// share() :

$object->share(); // Returns the current URL to share on Facebook

?>