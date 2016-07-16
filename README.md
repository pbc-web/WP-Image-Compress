# WP-Image-Compress
Compress Images Automatically on WordPress

Handy Little Must Use Plugin for WordPress.

Performs lossless compression on Jpeg, PNG & Gif Images using JpegOptim, OpimPNG & Gifsicle

## Requirements 
- **Installed on Server**
  - JpegOptim
  - Gifsicle
  - OptimPNG
- **PHP setup**
  - Access to `exec()` function

## Installation
Clone the directory into your mu-plugins.  The plugin will be active automatically and start compressing new images as they are uploaded.  

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


