<?php

class ExifTask extends BuildTask
{
    protected $title = 'Process EXIF data in galleries';

    protected $description = 'Ascertain aperture,shutter speed, time taken and location from EXIF data';

    protected $enabled = true;

    public function run($request)
    {
        $imagesToProcess = GalleryImage::get()->filter('ExifRead', false);
        foreach ($imagesToProcess->getIterator() as $image) {
            echo 'Processing image '.$image->Title.'<br/>';
            $image->processExifData();
        }
    }
}
