<?php
/**
 * WordPress GD Image Editor
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
class WP_Image_Editor_GD_Compress extends WP_Image_Editor_GD {
	

	/**
	 * @param resource $image
	 * @param string|null $filename
	 * @param string|null $mime_type
	 * @return WP_Error|array
	 */
	protected function _save( $image, $filename = null, $mime_type = null ) {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pbc-image-compressor.php';
		$compressor = PBC_Image_Compress_Compressor::get_instance();

		list( $filename, $extension, $mime_type ) = $this->get_output_format( $filename, $mime_type );

		if ( ! $filename )
			$filename = $this->generate_filename( null, null, $extension );

		if ( 'image/gif' == $mime_type ) {
			if ( ! $this->make_image( $filename, 'imagegif', array( $image, $filename ) ) )
				return new WP_Error( 'image_save_error', __('Image Editor Save Failed') );
			$compressor->compress($filename, $mime_type);
		}
		elseif ( 'image/png' == $mime_type ) {
			// convert from full colors to index colors, like original PNG.
			if ( function_exists('imageistruecolor') && ! imageistruecolor( $image ) )
				imagetruecolortopalette( $image, false, imagecolorstotal( $image ) );

			if ( ! $this->make_image( $filename, 'imagepng', array( $image, $filename ) ) )
				return new WP_Error( 'image_save_error', __('Image Editor Save Failed') );
			$compressor->compress($filename, $mime_type);

			
		}
		elseif ( 'image/jpeg' == $mime_type ) {
			if (! $this->make_image( $filename, 'imagejpeg', array( $image, $filename, $this->get_quality() ) ) )
				return new WP_Error( 'image_save_error', __('Image Editor Save Failed') );
			
			$compressor->compress($filename, $mime_type);
			
		}
		else {
			return new WP_Error( 'image_save_error', __('Image Editor Save Failed') );
		}

		// Set correct file permissions
		$stat = stat( dirname( $filename ) );
		$perms = $stat['mode'] & 0000666; //same permissions as parent folder, strip off the executable bits
		@ chmod( $filename, $perms );

		/**
		 * Filter the name of the saved image file.
		 *
		 * @since 2.6.0
		 *
		 * @param string $filename Name of the file.
		 */
		return array(
			'path'      => $filename,
			'file'      => wp_basename( apply_filters( 'image_make_intermediate_size', $filename ) ),
			'width'     => $this->size['width'],
			'height'    => $this->size['height'],
			'mime-type' => $mime_type,
		);
	}

}
