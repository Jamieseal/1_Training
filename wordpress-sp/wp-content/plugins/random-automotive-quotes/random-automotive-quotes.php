<?php

	/**
	 * Plugin Name: Random Automotive Quotes
	 * Description: A random automotive quote and author generator that displays a random quote from the SQL database on refresh
	 * Version: 1.0
	 * Author: Jamie Seal
	 */

	if ( ! defined('ABSPATH') ) {
		echo "Access denied!";
	die;
	}


function get_random_automotive_quote() {
	global $wpdb;
	$results = $wpdb->get_results('SELECT * FROM quotes');

	$quote_array = array();
	
	foreach ($results as $row)
	{
		array_push($quote_array, $row->quote . '<br>' . '<span class="quote-author">&dash;&nbsp;' . $row->author .'</span>');
	}

	//we have a random number
	$random = rand(0, sizeof($quote_array) - 1);

	// function to able to call the quote

    echo '<p class="quote">' . $quote_array[$random] . '</p>';

}