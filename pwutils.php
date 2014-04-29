<?php

/*
 * Utility functionality for writing templates for the ProcessWire CMS
 * Copyright 2014 Samuel Lampa - samuel.lampa@gmail.com
 */

/*
 * Generate HTML tags from text content and attributes
 */

function tag( $name, $text, $attrs=array() ) {
    // If the content item is a PageArray, apply the tag
    // on the title field of each of the pages in the PageArray.
    if ( get_class( $text ) === "PageArray" ) {
        $tag = '';
        foreach( $text as $item ) {
            $tag .= tag( $name, $item->title, $attrs );
        }       
        return $tag;
    } else {
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
}

/**
 * Apply a function foreach page in a PageArray and return a joined string of results
 */
function do_foreach( $page_array, $func, $attrs = array(), $separator = '' ) {
    $result = '';
    foreach( $page_array as $page ) {
        $result .= $separator . $func( $page, $attrs );
    }
    return $result;
}

/*
 * Common HTML function
 */

function p( $text, $attrs ) { return tag( 'p', $text, $attrs ); }

function a( $url, $title, $attrs = array() ) { 
    $attrs = array_merge( $attrs, array( 'href' => $url ));
    return tag( 'a', $title, $attrs );
}

function a_foreach( $pages, $attrs = array(), $separator = '' ) {
    return do_foreach( $pages, function ( $p ) { return a( $p->url, $p->title ); }, $attrs, $separator );
}

function img( $src, $alt, $attrs = array() ) { 
    $attrs = array_merge( array( 'src' => $src, 'alt' => $alt ), $attrs );
    return tag( 'img', $text = '', $attrs );
}

function h1( $text, $attrs=array() ) { return tag( 'h1', $text, $attrs ); }
function h2( $text, $attrs=array() ) { return tag( 'h2', $text, $attrs ); }
function h3( $text, $attrs=array() ) { return tag( 'h4', $text, $attrs ); }
function h4( $text, $attrs=array() ) { return tag( 'h4', $text, $attrs ); }
function h5( $text, $attrs=array() ) { return tag( 'h5', $text, $attrs ); }
function h6( $text, $attrs=array() ) { return tag( 'h6', $text, $attrs ); }


/*
 * Lists
 */
function ul( $text, $attrs = array() ) { 
    return tag( 'ul', $text, $attrs );
}
function li( $text ) { return tag( 'li', $text );
 }
function li_foreach( $pages ) {
    return do_foreach( $pages, function( $p ) { return li( $p->title ); } );
}
function li_a_foreach( $pages ) {
    return do_foreach( $pages, function( $p ) { return li( a( $p->url, $p->title ) ); } );
}
function link_foreach( $pages ) {
    return li_a_foreach( $pages );
}

function excerpt_foreach_page( $pages ) {
    $excerpts = '';
    foreach( $pages as $page ) {
        $crUser = $page->createdUser;
        $excerpts .= h2( a( $page->url, $page->title ) );
        $postedText = 'Posted on ' . 
            formatDate( $page->created ) . 
            ', by ' . 
            a( $crUser->url, $crUser->name );
        $excerpts .= p( $postedText,  array('style' => 'font-size: 0.8em;' ) );
        $excerpts .= p( substr( $page->body, 0, 70 ) );
    }
    return $excerpts;
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


