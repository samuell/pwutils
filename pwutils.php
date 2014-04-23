<?php

/*
 * Utility functionality for writing templates for the ProcessWire CMS
 * Copyright 2014 Samuel Lampa - samuel.lampa@gmail.com
 */

function tag( $name, $text, $attrs=array() ) {
    $tag = "";
    $tag .= '<' . $name;
    foreach( $attrs as $attrName => $attrContent ) {
        $tag .= ' ' . $attrName . '="' . $attrContent . '"';
    }
    $tag .= '>' . $text . '</' . $name . '>';
    return $tag;
}
function a( $url, $title ) {
    return tag( 'a', $title, array( 'href' => $url ));
}
function li( $text ) {
    return tag( 'li', $text );
}
function h2( $text ) {
    return tag( 'h2', $text );
}
function p( $text, $attrs ) {
    return tag( 'p', $text, $attrs );
}

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
        echo li( a( $page->url, $page->title ) );
    }
    echo '</ul>';
}

function list_as_excerpts( $pages ) {
    echo '<div>';
    foreach( $pages as $page ) {
        $crUser = $page->createdUser;
        echo h2( a( $page->url, $page->title ) );
        $postedText = 'Posted on ' . 
            formatDate( $page->created ) . 
            ', by ' . 
            a( $crUser->url, $crUser->name );
        echo p( $postedText,  array('style' => 'font-size: 0.8em;' ) );
        echo p( substr( $page->body, 0, 70 ) );
    }
    echo '</div>';
}

