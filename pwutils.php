<?php

/*
 * Utility functionality for writing templates for the ProcessWire CMS
 * Copyright 2014 Samuel Lampa - samuel.lampa@gmail.com
 */

function tag( $name, $text, $attrs=array() ) {
    $tag = '<' . $name;
    foreach( $attrs as $attrName => $attrContent ) {
        $tag .= ' ' . $attrName . '="' . $attrContent . '"';
    }
    if ( $text !== '' ) {
        $tag .= '>' . $text . '</' . $name . '>';
    } else {
        $tag .= ' />';    
    }
    return $tag;
}

/*
 * Common HTML function
 */

function p( $text, $attrs ) { return tag( 'p', $text, $attrs ); }

function a( $url, $title, $attrs = array() ) { 
    $attrs = array_merge( $attrs, array( 'href' => $url ));
    return tag( 'a', $title, $attrs );
}

function img( $src, $alt, $attrs = array() ) { 
    $attrs = array_merge( array( 'src' => $src, 'alt' => $alt ), $attrs );
    return tag( 'img', $text = '', $attrs );
}

function li( $text ) { return tag( 'li', $text ); }

function h1( $text ) { return tag( 'h1', $text ); }
function h2( $text ) { return tag( 'h2', $text ); }
function h3( $text ) { return tag( 'h4', $text ); }
function h4( $text ) { return tag( 'h4', $text ); }
function h5( $text ) { return tag( 'h5', $text ); }
function h6( $text ) { return tag( 'h6', $text ); }


/*
 * Listing function
 */
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

/*
 * Utility functions
 */
function formatDate( $date ) {
    if(is_int($date)) {
        // get date format from our 'date' field, for consistency
        $date = FieldtypeDatetime::formatDate($date, "%Y-%m-%d");
    }   
    return $date; 
}

