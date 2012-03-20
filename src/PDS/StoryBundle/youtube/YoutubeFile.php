<?php

namespace PDS\StoryBundle\Youtube;

use Symfony\Component\HttpFoundation\File\File;

class YoutubeFile extends File
{

    private $title;

    public function __construct($title, $path)
    {
        $this->title = $title;
        parent::__construct($path);
    }

    /**
     * @return \Zend_Gdata_YouTube_VideoEntry
     */
    public function upload()
    {
        return Uploader::upload($this);
    }

    public function getContentType()
    {
        $types = array_flip(File::$defaultExtensions);
        $ext = $this->getExtension();
        if (isset($types[$ext])) {
            return $types[$ext];
        }
        throw new \Exception("Unknown extension " . $ext);
    }

    public function getTitle()
    {
        return $this->title;
    }

}