<?php

class ImageBestCropExtension extends Extension {
    public function BestCrop($width, $height) {
        if ($this->owner->hasExtension('FocusPointImage')) {
            return $this->owner->CroppedFocusedImage($width, $height);
        } elseif ($this->owner->hasMethod('Fill')) {
            return $this->owner->Fill($width, $height);
        } else {
            return $this->owner->setSize($width, $height);
        }
    }
}
