<?php

class GalleryPageTest extends SapphireTest
{
    public function testGetCMSFields()
    {
        $gp = new GalleryPage();
        $tab = $gp->getCMSFields()->fieldByName('Root.Main');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }
        $expected = array('InstallWarningHeader', 'Title', 'URLSegment',
                        'MenuTitle', 'BriefIntroduction', 'Content');
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
