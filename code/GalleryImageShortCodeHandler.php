<?php

class GalleryImageShortCodeHandler
{
    public static function parse_gallery_image($arguments, $caption = null, $parser = null)
    {

        // first things first, if we dont have an ID, then we don't need to
        // go any further
        if (empty($arguments['id'])) {
            return;
        }

        $customise = array();
        $galleryImage = DataObject::get_by_id('GalleryImage', $arguments['id']);
        if (!$galleryImage) {
            return 'image not found';
        }

        $customise['Image'] = $galleryImage->Image();
        $customise['Aperture'] = $galleryImage->Aperture;
        $customise['ShutterSpeed'] = $galleryImage->ShutterSpeed;

         //set the caption
        $customise['Title'] = $galleryImage->Title;

        //overide the defaults with the arguments supplied
        $customise = array_merge($customise, $arguments);

        //get our YouTube template
        $template = new SSViewer('ShortCodeGalleryImage');

        //return the customised template
        return $template->process(new ArrayData($customise));
    }
}
