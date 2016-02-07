<?php

class TestWithImage extends SapphireTest {
    public function setUp() {
        error_log('Test with image T1');
        parent::setUp();

        error_log('Test with image T2');
        $folder = Folder::find_or_make('/ImageMetaDataExtensionTest/');
        $testfilePath = 'assets/ImageMetaDataExtensionTest/test.jpg'; // Important: No leading slash

        $sourcePath = getcwd() . '/ss3gallery/tests/test.jpg';
        copy($sourcePath, $testfilePath);
error_log('Test with image T3');
        $image = new Image();
        $image->Title = 'Test Image';
        $image->Filename = $testfilePath;
        // TODO This should be auto-detected
        $image->ParentID = $folder->ID;
        $image->write();
        error_log('Test with image T4');
    }

    public function tearDown() {
        unlink('assets/ImageMetaDataExtensionTest/test.jpg');
        parent::tearDown();
    }
}
