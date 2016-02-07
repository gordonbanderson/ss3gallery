<?php

class GalleryImageTest extends TestWithImage {
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    public function testCMSFields() {
        $gi = new GalleryImage();
        $fields = $gi->getCMSFields();
        $tab = $fields->findOrMakeTab('Root.Main');
        $fields = $tab->FieldList();

        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }

        $expected = array('Title', 'Aperture', 'ShutterSpeed', 'TakenAt', 'ISO',
            'Orientation', 'Image');
        $this->assertEquals($expected, $names);

        $fields = $gi->getCMSFields();
        $tab = $fields->findOrMakeTab('Root.Location');
        $fields = $tab->FieldList();

        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }
        $expected = array('LatLonZoomLevel', 'MapPinIcon');
        $this->assertEquals($expected, $names);
    }

    public function testGetThumbnail() {
        $gi = $this->objFromFixture('GalleryImage', 'gi01');
        $thumbnail = $gi->getThumbnail();
        $this->assertEquals(100, $thumbnail->Width);
        $this->assertEquals(100, $thumbnail->Height);
    }

      public function testGetPortletTitle() {
        $gi = $this->objFromFixture('GalleryImage', 'gi01');
        $this->assertEquals($gi->Title, $gi->getPortletTitle());
        $gi->Title = 'Another title';
        $this->assertEquals($gi->Title, $gi->getPortletTitle());
    }

    public function testGetPortletImage() {
        $gi = $this->objFromFixture('GalleryImage', 'gi01');
        $this->assertEquals($gi->getPortletImage()->Filename,
                                        'assets/TestImageSS3Gallery/test.jpg');
    }

    public function testGetPortletCaption() {
        $gi = $this->objFromFixture('GalleryImage', 'gi01');
        $this->assertEquals('', $gi->getPortletCaption());
    }
}
