<?php

class AttachedGalleryExtensionTest extends TestWithImage {
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    /*
    Check for the attached gallery tab, and that a gallery can be attached
     */
    public function testGetCMSFields()
    {
        Page::add_extension('AttachedGalleryExtension');
        $page = new Page();

        $tab = $page->getCMSFields()->fieldByName('Root.AttachedGallery');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }
        $expected = array('AttachedGalleryID');
        $this->assertEquals($expected, $names);
        Page::remove_extension('AttachedGalleryExtension');
    }

    public function testInlineGalleries() {
        Page::add_extension('AttachedGalleryExtension');
        // this page is alone at the top level
        $page = $this->objFromFixture('Page', 'page02');
        $this->assertEquals(0, $page->InlineGalleries()->count());

        // Check for an attached gallery
        $gallery1 = $this->objFromFixture('GalleryPage', 'gp01');
        $page->AttachedGalleryID = $gallery1->ID;
        $page->write();
        $expected = array($page);
        $this->assertEquals('Test Gallery 1', $page->InlineGalleries()->first()->Title);
        $this->assertEquals(1, $page->InlineGalleries()->count());

        // Now add child galleries as well
        $gallery2 = $this->objFromFixture('GalleryPage', 'gp02');
        $gallery2->ParentID = $page->ID;
        $gallery2->write();

        $gallery3 = $this->objFromFixture('GalleryPage', 'gp03');
        $gallery3->ParentID = $page->ID;
        $gallery3->write();

        $this->assertEquals(3, $page->InlineGalleries()->count());
        $titles = array();
        foreach ($page->InlineGalleries() as $gallery) {
            array_push($titles, $gallery->Title);
        }
        $expected = array('Test Gallery 2', 'Test Gallery 3', 'Test Gallery 1');
        $this->assertEquals($expected, $titles);
        Page::remove_extension('AttachedGalleryExtension');

    }
}
