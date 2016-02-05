<?php

class ImageMetaDataExtensionTest extends SapphireTest
{
    public function testProcessExifData()
    {
        $gi = new GalleryImage();

        $gi->Title = 'Gallery Image Example';

        $folder = Folder::find_or_make('/ImageMetaDataExtensionTest/');
        $testfilePath = 'assets/ImageMetaDataExtensionTest/test.jpg'; // Important: No leading slash

        $sourcePath = getcwd() . '/ss3gallery/tests/test.jpg';
        copy($sourcePath, $testfilePath);
        $image = new Image();
        $image->Filename = $testfilePath;
        // TODO This should be auto-detected
        $image->ParentID = $folder->ID;
        $image->write();

        error_log('IMAGE FILENAME: ' . $image->ID);
        $this->assertEquals('assets/ImageMetaDataExtensionTest/test.jpg', $image->Filename);

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

    public function testOnAfterWriteNOT()
    {
        $this->markTestSkipped('TODO');
    }

    public function testRequireDefaultRecordsNOT()
    {
        $this->markTestSkipped('TODO');
    }

    public function testGetMappableLatitude()
    {
        $this->markTestSkipped('TODO');
    }

    public function testGetMappableLongitude()
    {
        $this->markTestSkipped('TODO');
    }

    public function testGetMappableMapContent()
    {
        $this->markTestSkipped('TODO');
    }

    public function testGetMappableMapPin()
    {
        $this->markTestSkipped('TODO');
    }
}
