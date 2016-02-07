<?php

class AttachedGalleryExtensionTest extends TestWithImage {
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    protected $requiredExtensions = array('Page' => array('AttachedGalleryExtension'));

}
