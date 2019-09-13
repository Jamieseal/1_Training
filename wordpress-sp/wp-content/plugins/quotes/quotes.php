<?php
	/**
	 * Plugin Name: quotes
	 * Description: random single quote generator
	 * Version: 1.0
	 * Author: Jamie Seal
	 */

	global $wpdb;
	$results = $wpdb->get_results("SELECT * FROM quotes");

	$quote_array = array();
	
	foreach ($results as $row)
	{
		array_push($quote_array, $row->quote);
	}

	//we have arandom number
	$random = rand(0, sizeof($quote_array) - 1);

	echo '<p style="color: #ffffff;">' . $quote_array[$random] . '</p>';
?>