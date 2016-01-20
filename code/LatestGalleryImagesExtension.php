<?php

class LatestGalleryImagesExtension extends DataExtension
{
    public function LatestGalleryImages($amount = 4)
    {
        return GalleryImage::get()->sort('LastEdited DESC')->limit($amount);
    }
}
