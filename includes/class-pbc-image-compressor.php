<?php

Class PBC_Image_Compress_Compressor{

	 /*--------------------------------------------*
     * Attributes
     *--------------------------------------------*/
 
    /** Refers to a single instance of this class. */
    private static $instance = null;

    /** The Optimiser Class */
    private $optim;


	 /*--------------------------------------------*
     * Attributes
     *--------------------------------------------*/

	/**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    private function __construct() {

    	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pbc-phpimageoptim.php';

    	$this->JpegOptim = new PHPImageOptim\Tools\Jpeg\JpegOptim();
		$this->JpegOptim->setBinaryPath('/usr/bin/jpegoptim');

		$this->optiPng = new \PHPImageOptim\Tools\Png\OptiPng();
		$this->optiPng->setBinaryPath('/usr/bin/optipng');

		$this->Gifsicle = new \PHPImageOptim\Tools\Gif\Gifsicle();
		$this->Gifsicle->setBinaryPath('/usr/bin/gifsicle');

    	$this->optim = new PBC_PHPImageOptim();
 
    } // end constructor

	/**
     * Creates or returns an instance of this class.
     *
     * @return  Foo A single instance of this class.
     */
    public static function get_instance() {
 
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
 
        return self::$instance;
 
    } // end get_instance;
	


    public function compress($file, $mimetype){
    	switch($mimetype){
    		case "image/jpeg":
    			$this->compressjpeg($file);
    			break;
    		case "image/png":
    			$this->compressjpeg($file);
    			break;
    		case "image/gif":
    			$this->compressjpeg($file);
    			break;
    	}

    	$this->optim->clear_chain();
    }	

    public function compressjpeg($file){
    	$this->optim->setImage($file);
		$this->optim->chainCommand($this->JpegOptim);
		$this->optim->optimise();
    }

    public function compresspng($file){
    	$this->optim->setImage($file);
		$this->optim->chainCommand($this->optiPng);	
		$this->optim->optimise();
    }

    public function compressgif($file){
    	$this->optim->setImage($file);
		$this->optim->chainCommand($this->Gifsicle);
		$this->optim->optimise();
    }
}


