<?php

class ImageMetaDataExtensionTest extends TestWithImage
{
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
        $this->markTestSkipped('TODO');
    }

}
