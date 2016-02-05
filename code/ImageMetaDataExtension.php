<?php

class ImageMetaDataExtension extends MapExtension
{
    public static $db = array(
        'ExifRead' => 'Boolean',
        'Aperture' => 'Varchar',
        'ShutterSpeed' => 'Varchar',
        'TakenAt' => 'Datetime',
        'ISO' => 'Int',
        'Orientation' => 'Int',
    );

    public function processExifData()
    {
        $filename = BASE_PATH.'/'.$this->owner->Image()->Filename;

        // when the image is first saved, the file will still be a temp file
        if (file_exists($filename)) {
            try {
            $exif = exif_read_data($filename, 0, true);

            $aperture = $exif['COMPUTED']['ApertureFNumber'];

            $aperture = str_replace('f/', '', $aperture);
            error_log('APERTURE:'.$aperture);

            $this->owner->Aperture = $aperture;

            $shutterspeed = '';
            if (isset($exif['ExposureTime'])) {
                $shutterspeed = $exif['ExposureTime'];
            } else {
                $shutterspeed = $exif['EXIF']['ExposureTime'];
            }

            error_log('EXPOSURE:'.$shutterspeed);
            $this->owner->ShutterSpeed = $shutterspeed;
            if (isset($exif['DateTimeOriginal'])) {
                $this->owner->TakenAt = $exif['DateTimeOriginal'];
            } else {
                $this->owner->TakenAt = $exif['EXIF']['DateTimeOriginal'];
            }

            $iso = '';
            if (isset($exif['ISOSpeedRatings'])) {
                $iso = $exif['ISOSpeedRatings'];
            } else {
                $iso = $exif['EXIF']['ISOSpeedRatings'];
            }

            $this->owner->ISO = $iso;
            error_log('ISO:'.$iso);

            // coors
            if (isset($exif['GPS'])) {
                $gps = $exif['GPS'];
                $latarray = $gps['GPSLatitude'];
                $degrees = $latarray[0];
                $parts = explode('/', $degrees);
                $degrees = $parts[0] / $parts[1];
                $minutes = $latarray[1];
                $parts = explode('/', $minutes);
                $minutes = $parts[0] / $parts[1];
                $seconds = $latarray[2];
                $parts = explode('/', $seconds);
                $seconds = $parts[0] / $parts[1];

                error_log('LATITUDE: DMS='.$degrees.','.$minutes.','.$seconds);
                $latitude = $degrees + $minutes / 60 + $seconds / 3600;
                error_log('LAT:'.$latitude);

                error_log('LATITUDE:'.$latitude);

                $lonarray = $gps['GPSLongitude'];
                $degrees = $lonarray[0];
                $parts = explode('/', $degrees);
                $degrees = $parts[0] / $parts[1];
                $minutes = $lonarray[1];
                $parts = explode('/', $minutes);
                $minutes = $parts[0] / $parts[1];
                $seconds = $lonarray[2];
                $parts = explode('/', $seconds);
                $seconds = $parts[0] / $parts[1];

                $longitude = $degrees + $minutes / 60 + $seconds / 3600;
                $this->owner->Lat = $latitude;
                $this->owner->Lon = $longitude;
                } // else no gps data

                $image = $this->owner->Image();
                if ($image->Height > $image->Width) {
                    $this->owner->Orientation = 90;
                }

                $this->owner->ExifRead = true;
                $this->owner->write();
            } catch (Exception $e) {
                error_log($e);
            }
        }
    }

    public function onAfterWriteNOT()
    {
        parent::onAfterWrite();

        if (!($this->owner->ExifRead)) {
            $this->processExifData();
        }
    }

    public function requireDefaultRecordsNOT()
    {
        parent::requireDefaultRecords();
        $imagesToProcess = GalleryImage::get()->filter('ExifRead', false);
        foreach ($imagesToProcess->getIterator() as $image) {
            $image->processExifData();
        }
    }

}
