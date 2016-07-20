=== Plugin Name ===
Contributors: stewarty, poweredbycoffee
Donate link: http://poweredbycoffee.co.uk
Tags: images, compression, lossless
Requires at least: 3.5.0
Tested up to: 4.5.3
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Losslessly Compress Images as they are created using JpegOptim, OptiPNG & Gifsicle

== Description ==

Performs lossless compression on Jpeg, PNG & Gif Images using JpegOptim, OpimPNG & Gifsicle

## Requirements 
- **Installed on Server**
  - JpegOptim
  - Gifsicle
  - OptimPNG
- **PHP setup**
  - Access to `exec()` function


##Important##
This will not compress images already in your Media Library!  It will only work on newly uploaded images.

## Upcoming/Roadmap
- More PNG Compression Options
- MozJpeg Compression
- WP CLI tool
- Support for compressing images made by Timber
- Compress on Demand
- Filterable locations for locating the tools
- Improve the Tool Loader to use less RAM
- Internationalisation
- Include required Binaries with the Plugin


== Installation ==

## Installation

**From Github**
https://github.com/pbc-web/WP-Image-Compress
Clone the directory into your mu-plugins.  The plugin will be active automatically and start compressing new images as they are uploaded.  

**From WordPress.org**

1. Upload `pbc-image-compress.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Why Doesn't this plugin Work For Me?  =

You probably don't have the needed ImageCompression Libraries installed on your server. If you have access to your server they are quite easy to install.  if you are on a shared host then please ask your webhost to install them

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

This plugin has no UI.  It runs quietly in the background doing its thing.

== Changelog ==

= 0.1 =
* Initial Release
