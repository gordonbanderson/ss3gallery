<?php

class TestWithImage extends SapphireTest {
    public function setUp() {
        parent::setUp();

        $folder = Folder::find_or_make('/TestImageSS3Gallery/');
        $testfilePath = 'assets/TestImageSS3Gallery/test.jpg'; // Important: No leading slash

        $sourcePath = getcwd().'/ss3gallery/tests/test.jpg';
        copy($sourcePath, $testfilePath);

        $image = new Image();
        $image->Title = 'Test Image';
        $image->Filename = $testfilePath;
        // TODO This should be auto-detected
        $image->ParentID = $folder->ID;
        $image->write();
    }

    public function tearDown() {
        unlink('assets/TestImageSS3Gallery/test.jpg');
        parent::tearDown();
    }
}
