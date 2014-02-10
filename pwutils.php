<?php

// More to come here ...
//
//

function formatDate( $date ) {
    if(is_int($date)) {
        // get date format from our 'date' field, for consistency
        $date = FieldtypeDatetime::formatDate($date, "%Y-%m-%d");
    }   
    return $date; 
}

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
        echo '<p style="font-size: 0.8em;">Posted on ' . formatDate( $page->created ) . '</p>';
        echo '<p>' . substr( $page->body, 0, 70 ) . '</p>';
    }
    echo '</div>';
}

