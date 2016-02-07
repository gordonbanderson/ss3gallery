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

    public function testGalleryWithMappedImages()
    {
        $gp = $this->objFromFixture('GalleryPage', 'gp01');
        $map = $gp->Map()->forTemplate()->getValue();

        // Use assert contains to check for map related HTML
        $this->assertContains('div id="google_map_1" data-google-map-lang="en"  style="width:100%; height: 400px;"', $map);
        $this->assertContains('class="fullWidthMap mappable', $map);
        $this->assertContains('data-map', $map);
        $this->assertContains('data-centre=\'{"lat":48.856614,"lng":2.3522219}\'', $map);

        // Markers are tricky as SQLite does not have trailing zeroes.  Assert sig dig only
        $this->assertContains('13.2', $map);
        $this->assertContains('13.14', $map);
        $this->assertContains('13.4', $map);
        $this->assertContains('100.1', $map);
        $this->assertContains('99.7', $map);
        $this->assertContains('104.2', $map);
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
