<?php

/**
 * Description of RTMediaUpload
 * Controller class to upload the media
 * @author joshua
 */
class RTMediaUpload {

    private $default_modes = array('file_upload', 'link_input');
    var $file = NULL;
    var $media = NULL;
    var $url = NULL;
    var $media_ids = NULL;

    /**
     *
     * @param type $uploaded
     * @return boolean
     */
    public function __construct($uploaded) {
        /**
         * prepare to upload a file
         */
        $this->file = new RTMediaUploadFile($uploaded);
        /**
         * prepare to upload a url
         */
        $this->url = new RTMediaUploadUrl();
        /**
         * prepare media object to populate the album
         */
        $this->media = new RTMediaMedia();

        /**
         * upload the intity according to the mode of request
         * either file_upload or link_input
         */
        $file_object = $this->upload($uploaded);

        /**
         * if upload successful then populate the rtMedia database and insert the media into album
         */
        if ($file_object && $uploaded) {
            $this->media_ids= $this->media->add($uploaded, $file_object);
            if ($this->media_ids) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * upload a file or a link input
     * @param type $uploaded
     * @return type
     */
    function upload($uploaded) {
        switch ($uploaded['mode']) {
            case 'file_upload': return $this->file->init($uploaded['files']);
                break;
            case 'link_input': return $this->url->init($uploaded);
                break;
            default:
                do_action('rtmedia_upload_' . $uploaded['mode'], $uploaded);
        }
    }

}

?>