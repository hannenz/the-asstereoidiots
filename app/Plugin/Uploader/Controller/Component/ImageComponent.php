<?php
/*
 * image.php
 *
 * Copyright 2011 Johannes Braun <me@hannenz.de>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 * Image Manipulation component for CakePHP as used in UploaderPlugin.
 * Allows resizing, cropping and desaturating JPG, PNG and GIF images.
 *
 */
class ImageComponent extends Component {

	private $filename;
	private $image;
	private $type;
	private $width;
	private $height;
	private $ratio;

	public function types(){
		return (array('image/jpeg', 'image/gif', 'image/png'));
	}

/* Load the image that will be used for further processing
 *
 * name: load
 * @param string $filename
 * 		Full path to the image file to be processed
 *
 * @return boolean
 * 		success
 */
	public function load($filename){
		if (!file_exists($filename)){
			return (false);
		}
		$this->filename = $filename;
		$info = getimagesize($filename);
		$this->type = $info[2];
		switch ($this->type){
			case IMAGETYPE_JPEG:
				$this->image = imagecreatefromjpeg($filename);
				break;
			case IMAGETYPE_PNG:
				$this->image = imagecreatefrompng($filename);
				break;
			case IMAGETYPE_GIF:
				$this->image = imagecreatefromgif($filename);
				break;
			default:
				die ("Unknown Image Type!");
		}
		$this->width = imagesx($this->image);
		$this->height = imagesy($this->image);
		$this->ratio = $this->width / $this->height;
		return (true);
	}

/* Save the (propably) modified image to disk
 *
 * name: save
 * @param string $filename
 * 		Output filename
 * @param int $type:
 * 		IMAGE_TYPE_[JPEG|GIF|PNG], the output type
 * @param int $compression
 * 		Compression rate (JPG only)
 * @param int $permissions
 * 		Access permissions of the created file as UNIX mask
 * 		(null = don't change permissions, keep system's default)
 *
 * @return boolean
 * 		success
 */
	public function save($filename = null, $type = null, $compression = 75, $permissions = null){
		if ($this->image == null){
			return (false);
		}
		if ($type == null){
			$type = $this->type;
		}
		if ($filename == null){
			$filename = $this->filename;
		}
		switch ($type){
			case IMAGETYPE_JPEG:
				imagejpeg($this->image, $filename, $compression);
				break;
			case IMAGETYPE_PNG:
				imagepng($this->image, $filename);
				break;
			case IMAGETYPE_GIF:
				imagegif($this->image, $filename);
				break;
		}

		if ($permissions != null){
			chmod($filename, $permissions);
		}
		return (true);
	}

/* Outputs an image directly to the browser (not saving to disk)
 *
 * name: out
 * @param int $type
 * 		IMAGE_TYPE_[JPEG|GIF|PNG]
 * @param int $compression
 * 		JPEG compression rate
 *
 * @return boolean
 * 		success
 */
	public function out($type = null, $compression = 75){
		if ($this->image == null){
			return (false);
		}
		if ($type == null){
			$type = $this->type;
		}
		switch ($type){
			case IMAGETYPE_JPEG:
				header('content-type: image/jpeg');
				imagejpeg($this->image);
				break;
			case IMAGETYPE_PNG:
				header('content-type: image/png');
				imagepng($this->image);
				break;
			case IMAGETYPE_GIF:
				header('content-type: image/gif');
				imagegif($this->image);
				break;
		}
		return (true);
	}


/* Resize the image to the given width and/or height
 *
 * name: resize
 * @param int $width
 * 		The resulting width or null
 * @param $height
 * 		The resulting height or null
 * @param boolean  $shrinkOnly
 * 		Only resize larger images
 * 		:TODO: ot implemented yet !!!
 *
 * @return boolean
 * 		sucess
 */
	public function resize($options){
		$options = array_merge(array(
			'width' => null,
			'height' => null,
			'shrinkOnly' => true
		), $options);
		/* :TODO: Shrinkonly! */

		if ($this->image == null){
			return (false);
		}

		extract ($options);

		if ($width == null){
			$width = $height * $this->ratio;
		}
		if ($height == null){
			$height = $width / $this->ratio;
		}

		if ($shrinkOnly === true){
			if ($width > $this->width || $height > $this->height){
				return true;
			}
		}

		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);

		$this->set_image($new_image);
		return (true);
	}

/* Scale the image by factor
 *
 * name: scale
 * @param float $factor:
 * 		Scaling factor as float (1.0 = no scaling)
 *
 * @return boolean
 * 		success
 */
	public function scale($options){
		return ($this->resize($this->width * $options['factor'], $this->height * $options['factor']));
	}


/* Crop image
 *
 * Crops the image to the specified width/ height at an offset x/y.
 * For backwards compatibility, default parameters are set, so that if
 * called without parameters it will crop a rectangular centered area
 * with the original image's smaller edge as the rectangle's edge length
 *
 * name: crop
 * @param mixed $x
 * 		if numeric, x-offset
 * 		"center": x-offset will be centered by original width
 * 		"right" : x-offset calculated from the right edge
 * @param mixed $y
 * 		if numeric, y-offset
 * 		"center": y-offset will be centered by original height
 * 		"bottom" : y-offset calculated from the bottom edge
 * @param mixed $width
 * 		if numeric: Resulting width
 * 		"smallest": smaller edge of original will be used
 * 		"original": The original image's width
 * 		you can specify a percentage of the original's width
 * @param mixed $height
 * 		if numeric: Resulting height
 * 		"smallest": smaller edge of original will be used
 * 		"original": The original image's height
 * 		you can specify a percentage of the original's height
 * @return boolean
 * 		success
 */
	public function crop($options = array()){
		$options = array_merge(array(
			'x' =>'center',
			'y' => 'center',
			'width' => 'smallest',
			'height' => 'smallest'
		), $options);

		if ($this->image == null){
			return false;
		}

		extract ($options);

		if ($width == 'smallest'){
			$width = $this->width < $this->height ? $this->width : $this->height;
		}
		if ($width == 'original'){
			$width = $this->width;
		}
		if (substr($width, -1) == '%'){
			$width = $this->width * (int)$width / 100;
		}

		if ($height == 'smallest'){
			$height = $this->width < $this->height ? $this->width : $this->height;
		}
		if ($height == 'original'){
			$height = $this->height;
		}
		if (substr($height, -1) == '%'){
			$height = $this->height * (int)$height / 100;
		}

		if ($x == 'center'){
			$x = ($this->width - $width) / 2;
		}
		if ($y == 'center'){
			$y = ($this->height - $height) / 2;
		}

		if ($x == 'right'){
			$x = $this->width - $width;
		}
		if ($y == 'bottom'){
			$y = $this->height - $height;
		}

		if ($width + $x > $this->width){
			$width = $this->width - $x;
		}
		if ($height + $y > $this->height){
			$height = $this->height - $y;
		}

		$new_image = imagecreatetruecolor($width, $height);
		imagecopy($new_image, $this->image, 0, 0, $x, $y, $width, $height);

		$this->set_image($new_image);
		return true;
	}






/* Desaturate the image
 *
 * name: desaturate
 *
 * @return boolean
 * 		success
 */
	public function desaturate(){
		if ($this->image == null){
			return (false);
		}

		if (function_exists('imagefilter')){
			imagefilter($this->image, IMG_FILTER_GRAYSCALE);
		}
		else {
			imagetruecolortopalette($this->image, false, 256);
			for ($c = 0; $c < imagecolorstotal($this->image); $c++){
				$col = imagecolorsforindex($this->image, $c);
				$gray = round(0.299 * $col['red'] + 0.587 * $col['green'] + 0.114 * $col['blue']);
				imagecolorset($this->image, $c, $gray, $gray, $gray);
			}
		}
		return (true);
	}

/* Re-apply image properties (width, height and ratio) after
 * modification
 *
 * name: set_image
 * @param $im
 * 		The image
 */
	private function set_image($im){
		$this->image = $im;
		$this->width = imagesx($im);
		$this->height = imagesy($im);
		$this->ratio = $this->width / $this->height;
	}
}
