<?php

class GalleryImageTest extends SapphireTest
{
    public function testGetCMSFields()
    {
        $gi = new GalleryImage();
        $tab = $gi->getCMSFields()->fieldByName('Root.Main');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }
        $expected = array('Title', 'Aperture', 'ShutterSpeed', 'TakenAt',
                            'ISO', 'Orientation', 'Image');
        $this->assertEquals($expected, $names);
    }

    public function testMap()
    {
        $this->markTestSkipped('TODO');
    }

    public function testGetGalleryImages()
    {
        $this->markTestSkipped('TODO');
    }
}
