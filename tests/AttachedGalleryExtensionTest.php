<?php

class AttachedGalleryExtensionTest extends TestWithImage {
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    protected $requiredExtensions = array('Page' => array('AttachedGalleryExtension'));


    /*
    Check for the attached gallery tab, and that a gallery can be attached
     */
    public function testGetCMSFields()
    {
        $page = new Page();
        $tab = $page->getCMSFields()->fieldByName('Root.AttachedGallery');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }
        $expected = array('AttachedGalleryID');
        $this->assertEquals($expected, $names);
    }

}
