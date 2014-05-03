PW Utils
========

Utility functions for writing templates for the [ProcessWire CMS](http://processwire.com/)

Might even be viewed as a kind of optional "template language" for ProcessWire.

Basic idea
----------
The basic idea of this micro-library is to make writing things like this simpler:
````php
echo "<ul>";
echo "<li>Home</li>";
foreach( $page->children as $child ) {
    echo "<li><a href='" . $child->url . "'>" . $child->title . "</a></li>";
}
echo "</ul>";
````
With PW Utils, one would instead write:

````php
echo ul( li( 'Home' ) . 
        do_for( $page->children, function($p) { 
            return li( a( $p->title, $p->url ) ); 
        })
    );
````

This might not look as very big changes at first, but our experience is that when working 
practically with the templating, the more "functional" (rather than string-padding:y)
approach in PWUtils, makes it much easier to make changes to the code without breaking
the number of quotes, and also tends to make the code a slight bit easier to read, in 
our opinion.

Installation
------------
1. cd <processwire-root>/site/templates
2. git clone https://github.com/samuell/pwutils.git
3. ln -s pwtutils/pwutils.php .
4. Add the following code at the top, inside your template php files:

````php
<?php include("pwutils.php"); ?>
````

More Examples
-------------
Find a few more examples below:

### Linking Sibling pages
#### Without PWUtils
````php
echo '<div class="w-col w-col-8 navigation-column">';
echo "<a href='/' class='nav-link'>Welcome</a>";
foreach( $page->siblings as $sibling ) {
    echo "<a href='" . $sibling->url . "' class='nav-link'>" . $sibling->title . "</a>";
}
echo '</div>';
````
#### With PWUtils
````php
$acssAttrs = array( 'class' => 'nav-link' );
$divCssAttrs = array( 'class' => 'w-col w-col-8 navigation-column' );
echo div( a( '/', 'Welcome', $acssAttrs ) .
        do_for( $page->siblings, function($p) {
            return a( $p->url, $p->title, $acssAttrs );
        } ), 
        $divCssAttrs
    );
````
### Linking and styling images

#### Without PWUtils
````php
foreach( $page->image as $img ) { 
    echo "<a href='" . $img->url . "' ><img src='" . $img->url . "' alt='Some alt-text' style='border: 1px solid black;' /></a>";
}
````

#### With PWUtils
````php
$styleattrs = array( 'style' => 'border: 1px solid black;' );

foreach( $page->image as $img ) { 
    echo a( $img->url, img( $img->url, 'Some alt-text', $styleattrs ));
}
````

