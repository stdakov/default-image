<?php
namespace App\Service;

class ImageGenerator
{
    /** @var  integer $height */
    protected $height;
    /** @var  integer $width */
    protected $width;
    /** @var  string $prefix */
    protected $prefix;
    /** @var  string $fileName */
    protected $fileName = 'image.jpg';
    /** @var  string $storeDir */
    protected $storeDir = 'media/storage';
    /** @var  string $imageFile */
    protected $imageFile;
    /** @var string $text */
    protected $text = 'NO IMAGE';
    /** @var string $fontPath */
    protected $fontPath = 'media/fonts/visitor1.ttf';
    /** @var  string $rootPath */
    protected $rootPath;

    public function __construct($rootPath)
    {
        $this->setRootPath($rootPath);
    }

    /**
     * @return $this
     */
    public function init()
    {
        $this->initPath();
        $this->initPrefix();
        $this->initImageFile();

        return $this;
    }

    /**
     * @return string
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param string $rootPath
     * @return $this
     */
    public function setRootPath($rootPath)
    {
        $this->rootPath = $rootPath;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = (int)$height;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = (int)$width;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getStoreDir()
    {
        return $this->storeDir;
    }

    /**
     * @param string $storeDir
     * @return $this
     */
    public function setStoreDir($storeDir)
    {
        $this->storeDir = $storeDir;
        return $this;
    }

    /**
     * @return $this
     */
    public function initPrefix()
    {
        $this->setPrefix($this->getWidth() . 'x' . $this->getHeight());
        return $this;
    }

    /**
     * @return $this
     */
    public function initPath()
    {
        // Create storage dir if not exists
        if (!is_dir($this->getStoreDir())) {
            mkdir($this->getStoreDir(), 0777, true);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function initImageFile()
    {
        $imageFile = trim($this->getStoreDir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->getPrefix() . '_' . $this->getFileName();
        $this->setImageFile($imageFile);

        return $this;
    }

    /**
     * @return string
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageFile
     * @return $this
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getFontPath()
    {
        return $this->fontPath;
    }

    protected function rootPath($path)
    {
        return rtrim($this->getRootPath(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    /**
     * @param string $fontPath
     * @return $this
     */
    public function setFontPath($fontPath)
    {
        $this->fontPath = $fontPath;
        return $this;
    }

    public function generate()
    {
        $this->init();

        if (!file_exists($this->rootPath($this->getImageFile()))) {
            $this->generateImage();
        }

        return $this->getImageFile();

    }

    private function generateImage()
    {
        // Create the image
        $img = imagecreate($this->getWidth(), $this->getHeight());

        // set background and text color
        imagecolorallocate($img, 204, 204, 204);
        $textColor = imagecolorallocate($img, 124, 124, 124);
        // The text to draw
        $text = strtoupper($this->getText());
        $text = $this->getPrefix();
        //$text .= "\n ".$this->getPrefix();
        // font path
        $font = $this->rootPath($this->getFontPath());
        $fontSize = round($this->getWidth() / 18);

        // text dimensions
        $textBox = $this->imagettfbboxextended($fontSize, 0, $font, $text);
        
        // calculate text position
        $x = ($this->getWidth() - $textBox['width']) / 2;
        $y = ($this->getHeight() + $textBox['height']) / 2;
        // Add the text
        imagettftext($img, $fontSize, 0, $x, $y, $textColor, $font, $text);

        $lineColor = imagecolorallocate($img, 180, 180, 180);
        imageline($img,0,$this->getHeight(),$this->getWidth(),0,$lineColor);
        imageline($img,0,0,$this->getWidth(),$this->getHeight(),$lineColor);

        // Generate image
        imagejpeg($img, $this->rootPath($this->getImageFile()), 100);
        imagedestroy($img);
    }

     // Source: http://php.net/manual/en/function.imagettfbbox.php#75407
     private function imagettfbboxextended($size, $angle, $fontfile, $text) {
        /*this function extends imagettfbbox and includes within the returned array
        the actual text width and height as well as the x and y coordinates the
        text should be drawn from to render correctly.  This currently only works
        for an angle of zero and corrects the issue of hanging letters e.g. jpqg*/
        $bbox = imagettfbbox($size, $angle, $fontfile, $text);
    
        //calculate x baseline
        if($bbox[0] >= -1) {
            $bbox['x'] = abs($bbox[0] + 1) * -1;
        } else {
            //$bbox['x'] = 0;
            $bbox['x'] = abs($bbox[0] + 2);
        }
    
        //calculate actual text width
        $bbox['width'] = abs($bbox[2] - $bbox[0]);
        if($bbox[0] < -1) {
            $bbox['width'] = abs($bbox[2]) + abs($bbox[0]) - 1;
        }
    
        //calculate y baseline
        $bbox['y'] = abs($bbox[5] + 1);
    
        //calculate actual text height
        $bbox['height'] = abs($bbox[7]) - abs($bbox[1]);
        if($bbox[3] > 0) {
            $bbox['height'] = abs($bbox[7] - $bbox[1]) - 1;
        }
    
        return $bbox;
    }
}
