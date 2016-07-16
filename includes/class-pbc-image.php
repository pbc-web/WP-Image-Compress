<?php

Class PBC_Compress_Image(){

	var $url;
	var $uri;
	var $compressor

	function __construct($url, $compressor){
		$this->url = $url;
	}


	function url_to_uri(){
		$upload = wp_get_upload_dir();
		$this->uri = str_replace($upload['baseurl'], $upload['basedie'] $this->url);
	}

	function compress(){

	}
}