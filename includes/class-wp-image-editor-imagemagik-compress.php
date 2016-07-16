<?php
/**
 * WordPress ImageMagik Image Editor
 *
 * @package PBC Image Compress
 * @subpackage Image_Editor
 */

/**
 * WordPress Image Editor Class for Image Manipulation through GD With Compression
 *
 * @since 1.0.0
 * @package PBC Image Compress
 * @subpackage Image_Editor
 * @uses WP_Image_Editor_GD Extends class
 */
class WP_Image_Editor_Imagick_Compress extends WP_Image_Editor_Imagick {
	

	/**
	 * @param resource $image
	 * @param string|null $filename
	 * @param string|null $mime_type
	 * @return WP_Error|array
	 */
	protected function _save( $image, $filename = null, $mime_type = null ) {
		list( $filename, $extension, $mime_type ) = $this->get_output_format( $filename, $mime_type );

		if ( ! $filename )
			$filename = $this->generate_filename( null, null, $extension );

		try {
			// Store initial Format
			$orig_format = $this->image->getImageFormat();

			$this->image->setImageFormat( strtoupper( $this->get_extension( $mime_type ) ) );
			$this->make_image( $filename, array( $image, 'writeImage' ), array( $filename ) );

			// Reset original Format
			$this->image->setImageFormat( $orig_format );
		}
		catch ( Exception $e ) {
			return new WP_Error( 'image_save_error', $e->getMessage(), $filename );
		}

		// Set correct file permissions
		$stat = stat( dirname( $filename ) );
		$perms = $stat['mode'] & 0000666; //same permissions as parent folder, strip off the executable bits
		@ chmod( $filename, $perms );

		$compressor = PBC_Image_Compress_Compressor::get_instance();
		$compressor->compress($filename, $mime_type);

		/** This filter is documented in wp-includes/class-wp-image-editor-gd.php */
		return array(
			'path'      => $filename,
			'file'      => wp_basename( apply_filters( 'image_make_intermediate_size', $filename ) ),
			'width'     => $this->size['width'],
			'height'    => $this->size['height'],
			'mime-type' => $mime_type,
		);
	}

}
