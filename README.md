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
With PW Utils, one could instead write:
````php
echo ul( li( 'Home' ) . li_a( $page->children ) );
````

... or, if you want to do some custom stuff for each page in a PageArray, you can send an anonymous function to "do_for()":

````php
$custom_func = function($p) { return li( a( $p->url, $p->title ) ); }
echo ul( li( 'Home' ) . 
        do_for( $page->children, function($p) { 
            return li( 
                a( $p->title, $p->url ) 
            ); 
        } )
    );
````


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
    a_foreach_page( $page->siblings, $acssAttrs ),  
    $divCssAttrs
);
````
### Linking and styling images

#### Without PWUtils
````php
foreach( $page->image as $img ) { 
    echo "<a href="' . $img->url . "' ><img src='" . $img->url . "' style='border: 1px solid black;' /></a>";
}
````

#### With PWUtils
````php
$styleattrs = array( 'style' => 'border: 1px solid black;' );
foreach( $page->image as $img ) { 
    echo a( $img->url, img( $img->url, '', $styleattrs ));
}
````

