<?php

class ImageMetaDataExtensionTest extends TestWithImage
{
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    public function testProcessExifData()
    {
        $gi = new GalleryImage();
        $gi->Title = 'Gallery Image Example';
        $image = Image::get()->filter('Title', 'Test Image')->first();
        $this->assertEquals('assets/TestImageSS3Gallery/test.jpg', $image->Filename);
        $gi->ImageID = $image->ID;
        //This will trigger processExifData method
        $gi->write();

        $this->assertTrue($gi->ExifRead);
        $this->assertEquals('2.4', $gi->Aperture);
        $this->assertEquals('10/160', $gi->ShutterSpeed);
        $this->assertEquals(400, $gi->ISO);
        $this->assertEquals('2015:09:19 17:40:54', $gi->TakenAt);
        $this->assertEquals(Image::ORIENTATION_PORTRAIT, $gi->Orientation);
        $this->assertEquals(13.860741666667, $gi->Lat);
        $this->assertEquals(100.44168916667, $gi->Lon);
    }

    public function testRequireDefaultRecords()
    {
        // Reset using SQL, otherwise SS triggers a re-read of the exif data
        DB::query('UPDATE "GalleryImage" SET "ExifRead" = 0');
        DB::query('UPDATE "GalleryImage" SET "Lon" = 0');
        DB::query('UPDATE "GalleryImage" SET "Lat" = 0');

        $image = new GalleryImage();
        $image->requireDefaultRecords();

        // all images point to the same image file so can assert same details
        foreach (GalleryImage::get() as $gi) {
            $this->assertEquals(1, $gi->ExifRead);
            $this->assertEquals('2.4', $gi->Aperture);
            $this->assertEquals('10/160', $gi->ShutterSpeed);
            $this->assertEquals(400, $gi->ISO);
            $this->assertEquals('2015-09-19 17:40:54', $gi->TakenAt);
            $this->assertEquals(Image::ORIENTATION_PORTRAIT, $gi->Orientation);
            $this->assertEquals(13.860741666667, $gi->Lat);
            $this->assertEquals(100.44168916667, $gi->Lon);
        }

        $this->assertEquals(4, GalleryImage::get()->count());
    }

}
