<?php

// More to come here ...
//
//

function list_as_ul( $pages ) {
    echo '<ul>';
    foreach( $pages as $page ) {
        echo '<li><a href="' . $page->url . '">' . $page->title . '</a></li>';
    }
    echo '</ul>';
}

function list_as_excerpts( $pages ) {
    echo '<div>';
    foreach( $pages as $page ) {
        echo '<h2><a href="' . $page->url . '">' . $page->title . '</a></h2>';
        echo '<p>' . substr( $page->body, 0, 70 ) . '</p>';
    }
    echo '</div>';
}

