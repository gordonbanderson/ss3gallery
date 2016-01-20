<?php

class GalleryImageShortCodeHandler
{
    // taken from http://www.ssbits.com/tutorials/2010/2-4-using-short-codes-to-embed-a-youtube-video/ and adapted for SS3
    public static function parse_gallery_image($arguments, $caption = null, $parser = null)
    {
        //  public static function link_shortcode_handler($arguments, $content = null, $parser = null) {

        // first things first, if we dont have a video ID, then we don't need to
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
