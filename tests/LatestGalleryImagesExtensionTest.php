<?php

class LatestGalleryImagesExtensionTest extends TestWithImage {
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    protected $requiredExtensions = array('Page' => array('LatestGalleryImagesExtension'));


    public function testLatestGalleryImagesExtension() {
        $page = $this->objFromFixture('Page', 'page02');
        $this->assertEquals(1, $page->LatestGalleryImages(1)->count());
        $this->assertEquals(2, $page->LatestGalleryImages(2)->count());
        $this->assertEquals(3, $page->LatestGalleryImages(3)->count());
        $this->assertEquals(4, $page->LatestGalleryImages(4)->count());
        // only 4 images in the fixtures
        $this->assertEquals(4, $page->LatestGalleryImages(5)->count());
        // Check classname and order of lastedited
        $lastEdited = null;
        foreach ($page->LatestGalleryImages(4) as $gi) {
            if ($lastEdited == null) {
                $lastEdited = $gi->LastEdited;
            } else {
                error_log('GalleryImage LastEdited: ' . $gi->LastEdited);
                $this->assertLessThanOrEqual($lastEdited, $gi->LastEdited);
                $lastEdited = $gi->LastEdited;
            }
            $this->assertEquals('GalleryImage', $gi->ClassName);
        }
    }

}
