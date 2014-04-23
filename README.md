PW Utils
========

Utility functions for writing templates for the ProcessWire CMS.

Might even be viewed as a kind of optional "template language" for ProcessWire.

Basic idea
----------
The basic idea of this micro-library is to make writing things like this simpler:
````
echo "<ul>";
echo "<li>Home</li>";
foreach( $page->children as $child ) {
    echo "<li><a href='" . $child->url . "'>" . $child->title . "</a></li>";
}
echo "</ul>";
````
With PW Utils, one could instead write:
````
echo ul( li( 'Home' ) . li_foreach_page( $page->children ) );
````

Installation
------------
# cd <processwire-root>/site/templates
# git clone https://github.com/samuell/pwutils.git
# ln -s pwtutils/pwutils.php .
# Add the following code at the top, inside your template php files:

````
<?php include("pwutils.php"); ?>
````

Example Usage
-------------
Find a few more examples below:

