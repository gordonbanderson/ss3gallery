<?php


class GalleryFolder extends PageWithImage
{
    private static $allowed_children = array(
        'GalleryFolder',
        'GalleryPage',
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->renameField('Content', 'Brief Summary');

        return $fields;
    }

    /* Summary is a remapping of the content */
    public function Summary()
    {
        return $this->Content;
    }
}

class GalleryFolder_Controller extends PageWithImage_Controller
{
}
