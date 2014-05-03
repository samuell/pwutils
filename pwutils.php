<?php

/* =========================================================================
 * Utility functionality for writing templates for the ProcessWire CMS
 * (See processwire.com)
 * Copyright 2014 Samuel Lampa - samuel.lampa@gmail.com
 * ========================================================================= */


/* -------------------------------------------------------------------------
 * General function for applying a function / callback to each item of a
 * PageArray and return a joined string with the results.
 * ------------------------------------------------------------------------- */

function do_for( $page_array, $func, $attrs = array(), $separator = '' ) {
    $result = '';
    foreach( $page_array as $page ) {
        $result .= $separator . $func( $page, $attrs );
    }
    return $result;
}


/* -------------------------------------------------------------------------
 * Common HTML function
 * ------------------------------------------------------------------------- */

function p( $text, $attrs ) { return tag( 'p', $text, $attrs ); }

function a( $text, $href, $attrs = array() ) { 
        $attrs = array_merge( $attrs, array( 'href' => $href ));
        return tag('a', $text, $attrs );
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


/* -------------------------------------------------------------------------
 * Listings of various kinds
 * ------------------------------------------------------------------------- */

function ul( $text, $attrs = array() ) { 
    return tag( 'ul', $text, $attrs );
}

function li( $text ) { return tag( 'li', $text );
 }

function excerpt( $pages ) {
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


/* -------------------------------------------------------------------------
 * Utility functions
 * ------------------------------------------------------------------------- */

/*
 * Generate HTML tags from text content and attributes
 */
function tag( $name, $text, $attrs=array() ) {
    // If the content item is a PageArray, apply the tag
    // on the title field of each of the pages in the PageArray.
    if ( isPageArray( $text ) ) {
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


function formatDate( $date ) {
    if(is_int($date)) {
        // get date format from our 'date' field, for consistency
        $date = FieldtypeDatetime::formatDate($date, "%Y-%m-%d");
    }   
    return $date; 
}

function isPageArray( $obj ) {
    if ( get_class( $obj ) === "PageArray" ) {
        return true;
    } else {
        return false;
    }
}

function isPage( $obj ) {
    if ( get_class( $obj ) === "Page" ) {
        return true;
    } else {
        return false;
    }
}


