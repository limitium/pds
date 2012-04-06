<?php

namespace PDS\StoryBundle\Youtube;

class Uploader
{
    private $authenticationURL = 'https://www.google.com/accounts/ClientLogin';
    private $uploadUrl = 'http://uploads.gdata.youtube.com/feeds/api/users/default/uploads';

    private $devKey = "AI39si4W6QZ0x9lK4kBmLM0mxqMKYotCEcUZdz971RmCYHIbGaGmMSy9n0A7fqepT8i6cCnRpMzhJrUYT5wwpUc7yFhbiGDGYg";
    private $username = 'mystories.eu@gmail.com';
    private $password = 'Xk@l456Kkd';
    private $service = 'youtube';
    private $source = 'mystories.eu'; // a short string identifying your application
    /**
     * @var \Zend_Gdata_YouTube
     */
    private $yt = null;

    private function __construct()
    {
        $this->yt = $this->initYoutube();
    }

    private static $inst;

    /**
     * @static
     * @return Uploader
     */
    public static function create()
    {
        if (!self::$inst) {
            self::$inst = new self;
        }
        return self::$inst;
    }

    /**
     * @return \Zend_Gdata_HttpClient
     */
    private function getClient()
    {
        try {
            return \Zend_Gdata_ClientLogin::getHttpClient(
                $username = $this->username,
                $password = $this->password,
                $service = $this->service,
                $client = null,
                $source = $this->source,
                $loginToken = null,
                $loginCaptcha = null,
                $this->authenticationURL);
        } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
            echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
            echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
        } catch (Zend_Gdata_App_AuthException $ae) {
            echo 'Problem authenticating: ' . $ae->exception() . "\n";
        }

        // Note that this example creates an unversioned service object.
        // You do not need to specify a version number to upload content
        // since the upload behavior is the same for all API versions.

    }

    /**
     * @return \Zend_Gdata_YouTube
     */
    private function initYoutube()
    {
        return new \Zend_Gdata_YouTube($this->getClient(),
            $applicationId = 'MyStories.eu uploader',
            $clientId = null,
            $developerKey = $this->devKey
        );
    }

    /**
     * @param YoutubeFile $yf
     * @return \Zend_Gdata_YouTube_VideoEntry
     */
    public function uploadFile(YoutubeFile $yf)
    {
        // create a new VideoEntry object
        $myVideoEntry = new \Zend_Gdata_YouTube_VideoEntry();

        // create a new Zend_Gdata_App_MediaFileSource object
        $filesource = $this->yt->newMediaFileSource($yf->getPathname());

        $filesource->setContentType($yf->getContentType());
        // set slug header
        $filesource->setSlug("slug");

        // add the filesource to the video entry
        $myVideoEntry->setMediaSource($filesource);

        $myVideoEntry->setVideoTitle($yf->getTitle());
        $myVideoEntry->setVideoDescription("");
        // The category must be a valid YouTube category!
        $myVideoEntry->setVideoCategory('People');

        // Set keywords. Please note that this must be a comma-separated string
        // and that individual keywords cannot contain whitespace 'cars, funny'
        $myVideoEntry->setVideoTags("");

        // set some developer tags -- this is optional
        // (see Searching by Developer Tags for more details)
//                $myVideoEntry->setVideoDeveloperTags(array('mydevtag', 'anotherdevtag'));

        // set the video's location -- this is also optional
//                $yt->registerPackage('Zend_Gdata_Geo');
//                $yt->registerPackage('Zend_Gdata_Geo_Extension');
//                $where = $yt->newGeoRssWhere();
//                $position = $yt->newGmlPos('37.0 -122.0');
//                $where->point = $yt->newGmlPoint($position);
//                $myVideoEntry->setWhere($where);

        // upload URI for the currently authenticated user


        // try to upload the video, catching a Zend_Gdata_App_HttpException,
        // if available, or just a regular Zend_Gdata_App_Exception otherwise
        try {
            return $newEntry = $this->yt->insertEntry($myVideoEntry, $this->uploadUrl, 'Zend_Gdata_YouTube_VideoEntry');
        } catch (\Zend_Gdata_App_HttpException $httpException) {
            echo $httpException->getRawResponseBody();
        } catch (\Zend_Gdata_App_Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @static
     * @param YoutubeFile $yf
     * @return \Zend_Gdata_YouTube_VideoEntry
     */
    public static function upload(YoutubeFile $yf)
    {
        return self::create()->uploadFile($yf);
    }

}
