<?php

class AttachedGalleryExtensionTest extends TestWithImage {
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    protected $requiredExtensions = array('Page' => array('AttachedGalleryExtension'));


    /*
    Check for the attached gallery tab, and that a gallery can be attached
     */
    public function testGetCMSFields()
    {
        $this->assertEquals(1,2);
    }

}
