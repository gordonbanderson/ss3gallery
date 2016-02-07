<?php

class GalleryImageTest extends SapphireTest {
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
}
