<?php

class GalleryFolderTest extends SapphireTest
{
    public function testGetCMSFields()
    {
        $gf = new GalleryFolder();
        $tab = $gf->getCMSFields()->fieldByName('Root.Main');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            array_push($names, $field->getName());
        }
        $expected = array('InstallWarningHeader', 'Title', 'URLSegment',
                        'MenuTitle', 'BriefIntroduction', 'Content');
        $this->assertEquals($expected, $names);
    }

    public function testSummary()
    {
        $gf = new GalleryFolder();
        $gf->Content = 'This is actually used for the summary';
        $this->assertEquals($gf->Content, $gf->Summary());
    }
}
