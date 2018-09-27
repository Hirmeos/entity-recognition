<h1>PHP Client for NERD entity fishing API</h1>

This is a PHP library/wrapper of the <a target="_blank" href="http://nerd.readthedocs.io/">NERD API</a>. High level method calls that parse the JSON API response to PHP classes for ease of use.

<h2>Installation</h2>

<h3>Method 1</h3>

Just copy the following files in your project:

1. Folder: Domain
1. Folder: WebResponse
1. File: EFWebServiceManager.php
 
<h3>Method 2</h3>

Method 2 relies on Packagist (https://packagist.org/)

    {
	    "require": {
	
	  	    "hirmeos/entity-fishing-php-wrapper" : "*"
	    }
	}

See the composer documentation here: https://packagist.org/ and here: https://getcomposer.org/doc/01-basic-usage.md#package-versions

<h2>Usage</h2>

Include: EFWebServiceManager.php in your file

`require_once('EFWebServiceManager.php');`

<b>Disambiguate Text</b>

`EFWebServiceManager::disambiguateText(String searchText, String lang);`

Returns object of type: `EFDisambiguateTextWebResponse`

<b>Disambiguate Short Text</b>

`EFWebServiceManager::disambiguateShortText(String searchText, String lang);`

Returns object of type: `EFDisambiguateShortTextWebResponse`

<b>Disambiguate Term Vector</b>

`EFWebServiceManager::disambiguateTermVector(Array searchText, String lang);`

Returns object of type: `EFDisambiguateTermWebResponse`

<b>Disambiguate PDF</b>

`EFWebServiceManager::disambiguatePDF(String pdf_file_path, String lang);`

Returns object of type: `EFDisambiguatePDFWebResponse`

<b>Concept</b>

`EFWebServiceManager::concept(int concept_id, String lang);`

Returns object of type: `EFConceptWebResponse`

<b>Term</b>

`EFWebServiceManager::term(int term_id, String lang);`

Returns object of type: `EFTermWebResponse`

<b>Language</b>

`EFWebServiceManager::language(String text);`

Returns object of type: `EFLanguageWebResponse`

<b>Segmentation</b>

`EFWebServiceManager::segmentation(String text);`

Returns object of type: `EFSegmentationWebResponse`

<h3>Responses</h3>

All response objects have the following three public variables:

`public $has_error;`
 
`public $status_code;`
  
`public $error_msg;`

Use the variables to check for API request errors before proceeding to the actual response data.
  
