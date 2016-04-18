<?php

class ImageMetaDataExtension extends DataExtension
{
    private static $db = array(
        'ExifRead' => 'Boolean',
        'Aperture' => 'Varchar',
        'ShutterSpeed' => 'Varchar',
        'TakenAt' => 'Datetime',
        'ISO' => 'Int',
        'Orientation' => 'Int'
    );


    public static $defaults = array('ExifRead' => false);

    public function processExifData()
    {
        $image    = $this->owner->Image();
        $filename = BASE_PATH . '/' . $image->Filename;

        // when the image is first saved, the file will still be a temp file
        if ($image->exists()) {
            try {
                $exif = exif_read_data($filename, null, true);
                error_log(print_r($exif, 1));
                if (isset($exif['COMPUTED']['ApertureFNumber'])) {
                    $aperture = $exif['COMPUTED']['ApertureFNumber'];
                    $aperture = str_replace('f/', '', $aperture);
                    $this->owner->Aperture = $aperture;
                }


                $shutterspeed = '';
                if (isset($exif['ExposureTime'])) {
                    $shutterspeed = $exif['ExposureTime'];
                } elseif (isset($exif['EXIF']['ExposureTime'])) {
                    $shutterspeed = $exif['EXIF']['ExposureTime'];
                }

                $this->owner->ShutterSpeed = $shutterspeed;
                if (isset($exif['DateTimeOriginal'])) {
                    $this->owner->TakenAt = $exif['DateTimeOriginal'];
                } elseif (isset($exif['EXIF']['DateTimeOriginal'])) {
                    $this->owner->TakenAt = $exif['EXIF']['DateTimeOriginal'];
                }

                $iso = '';
                if (isset($exif['ISOSpeedRatings'])) {
                    $iso = $exif['ISOSpeedRatings'];
                } elseif (isset($exif['EXIF']['ISOSpeedRatings'])) {
                    $iso = $exif['EXIF']['ISOSpeedRatings'];
                }

                $this->owner->ISO = $iso;

                if (isset($exif['GPS'])) {
                    $gps      = $exif['GPS'];
                    $latarray = $gps['GPSLatitude'];
                    $degrees  = $latarray[0];
                    $parts    = explode('/', $degrees);
                    $degrees  = $parts[0] / $parts[1];
                    $minutes  = $latarray[1];
                    $parts    = explode('/', $minutes);
                    $minutes  = $parts[0] / $parts[1];
                    $seconds  = $latarray[2];
                    $parts    = explode('/', $seconds);
                    $seconds  = $parts[0] / $parts[1];
                    $latitude = $degrees + $minutes / 60 + $seconds / 3600;
                    $lonarray = $gps['GPSLongitude'];
                    $degrees  = $lonarray[0];
                    $parts    = explode('/', $degrees);
                    $degrees  = $parts[0] / $parts[1];
                    $minutes  = $lonarray[1];
                    $parts    = explode('/', $minutes);
                    $minutes  = $parts[0] / $parts[1];
                    $seconds  = $lonarray[2];
                    $parts    = explode('/', $seconds);
                    $seconds  = $parts[0] / $parts[1];

                    $longitude        = $degrees + $minutes / 60 + $seconds / 3600;
                    $this->owner->Lat = $latitude;
                    $this->owner->Lon = $longitude;
                }

                $image = $this->owner->Image();

                $this->owner->ExifRead = true;
                $this->owner->Orientation = $this->owner->Image()->getOrientation();
                $this->owner->write();
            }
            catch (Exception $e) {
                error_log($e->getMessage());
            }
        }
    }

    public function onAfterWrite()
    {
        parent::onAfterWrite();

        if (!($this->owner->ExifRead)) {
            $this->processExifData();
        }
    }

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();
        $imagesToProcess = GalleryImage::get()->filter('ExifRead', 0);
        foreach ($imagesToProcess as $image) {
            $image->processExifData();
        }

        DB::alteration_message('Updated image metadata where EXIF has not been ' . 'processed', 'changed');
    }

}
