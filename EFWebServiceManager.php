<?php
require_once('WebResponse/EFDisambiguateTextWebResponse.php');
require_once('WebResponse/EFDisambiguateShortTextWebResponse.php');
require_once('WebResponse/EFDisambiguateTermWebResponse.php');
require_once('WebResponse/EFDisambiguatePDFWebResponse.php');
require_once('WebResponse/EFConceptWebResponse.php');
require_once('WebResponse/EFTermWebResponse.php');
require_once('WebResponse/EFLanguageWebResponse.php');
require_once('WebResponse/EFSegmentationWebResponse.php');

final class EFWebServiceManager
{
    private static $baseUrl=null;

    //create the private instance variable
    private static $myInstance=null;

    //make constructor private so no one create object using new Keyword
    private function  __construct(){}

    //no one clone the object
    private function  __clone(){}

    //avoid serialazation
    public function __wakeup(){}

    //ony one way to create  object
    public static  function  getInstance($base_url = "http://nerd.huma-num.fr/nerd/service"){
        if(self::$myInstance==null){
            self::$myInstance=new EFWebServiceManager();
            self::$baseUrl = $base_url;
        }
        return self::$myInstance;
    }


	public function disambiguateText($search_text, $lang) {
		return EFWebServiceManager::disambiguate($search_text, NULL, NULL, NULL, $lang);
	}
	
	public function disambiguateShortText($short_text, $lang) {
		
		return EFWebServiceManager::disambiguate(NULL, $short_text, NULL, NULL, $lang);
	}
	
	public function disambiguateTermVector($term_vector, $lang) {
		return EFWebServiceManager::disambiguate(NULL, NULL, $term_vector, NULL, $lang);
	}
	
	public function disambiguatePDF($file_path, $lang) {
		return EFWebServiceManager::disambiguate(NULL, NULL, NULL, $file_path, $lang);
	}
	
	private function disambiguate($search_text, $short_text, $term_vector, $file_path, $lang) {
		$query = array(
				'entities' => [],
				'onlyNER' => FALSE,
				'resultLanguages' => array('en', 'de', 'fr'),
				'nbest' => FALSE,
				'sentence' => FALSE,
				'customisation' => 'generic'
		);
		if (!$file_path){
			$query['text'] = $search_text?$search_text:'';
			$query['shortText'] = $short_text?$short_text:'';
			$query['termVector'] = $term_vector?$term_vector:[];
		}
		
		if ($lang){
			$query['language'] = array('lang' => $lang);
		}
		
		$data = array('query' => json_encode($query));
		if ($file_path){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$finfo = finfo_file($finfo, $file_path);
			$data['file'] = new CurlFile($file_path, $finfo, basename($file_path));
		}

        $url = $this::$baseUrl."/disambiguate";
		$request = curl_init($url);
		curl_setopt ($request, CURLOPT_POST, 1);
		curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
		
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
		
		$response = curl_exec($request);

		if ($search_text){
			$ekt_response = new EFDisambiguateTextWebResponse($request, $response);
			return $ekt_response;
		}
		else if ($short_text){
			$ekt_response = new EFDisambiguateShortTextWebResponse($request, $response);
			return $ekt_response;
		}
		else if ($term_vector){
			$ekt_response = new EFDisambiguateTermWebResponse($request, $response);
			return $ekt_response;
		}
		else if ($file_path){
			$ekt_response = new EFDisambiguatePDFWebResponse($request, $response);
			return $ekt_response;
		}
		
		return NULL;
	}
	
	public function concept($concept_id, $lang) {
	
		$url = $this::$baseUrl."/kb/concept/".$concept_id;
		if ($lang){
			$url .= "?lang=".$lang;
		}
		
		$request = curl_init($url);
		curl_setopt($request, CURLOPT_POST, 0);
		curl_setopt($request, CURLOPT_HTTPGET, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		$response = curl_exec($request);
		
		$ekt_response = new EFConceptWebResponse($request, $response);
		return $ekt_response;
	}
	
	public function term($concept_id, $lang) {
	
		$url = $this::$baseUrl."/kb/term/".$concept_id;
		if ($lang){
			$url .= "?lang=".$lang;
		}
	
		$request = curl_init($url);
		curl_setopt($request, CURLOPT_POST, 0);
		curl_setopt($request, CURLOPT_HTTPGET, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		$response = curl_exec($request);
	
		$ekt_response = new EFTermWebResponse($request, $response);
		return $ekt_response;
	}
	
	public function language($text) {
		$data = array('text' => $text);
	
		$url = $this::$baseUrl."/language";
		$request = curl_init($url);
		curl_setopt ($request, CURLOPT_POST, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
	
		$response = curl_exec($request);
	
		$ekt_response = new EFLanguageWebResponse($request, $response);
		return $ekt_response;
	}
	
	public function segmentation($text) {
		$data = array('text' => $text);
	
		$url = $this::$baseUrl."/segmentation";
		$request = curl_init($url);
		curl_setopt ($request, CURLOPT_POST, 1);
		curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
	
		curl_setopt($request, CURLOPT_POSTFIELDS, $data);
	
		$response = curl_exec($request);
	
		$ekt_response = new EFSegmentationWebResponse($request, $response);
		return $ekt_response;
	}
}