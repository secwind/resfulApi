<?php

namespace App\Secvices;

/**
 * 
 */
class Twitter 
{
	protected $apiKey;

	function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
	}
}