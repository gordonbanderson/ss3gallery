<?php

class GalleryPageTest extends SapphireTest
{
    protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

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
        $this->assertContains('data-mapmarkers=\'[{"latitude":13.2,"longitude":100.1,"html":"","category":"default","icon":false},{"latitude":13.14,"longitude":99.7,"html":"","category":"default","icon":false},{"latitude":13.4,"longitude":104.2,"html":"","category":"default","icon":false}]\'', $map);

        // Check the map markers
        $lines = explode("\n", $map);
        foreach ($lines as $line) {
            $start = substr($line, 0, 15);
            if ($start == 'data-mapmarkers') {
                $markers = substr($line, 17);
                $markers = str_replace('\'', '', $line);
                $markers = trim($markers);
                $markers = substr($markers, 16);

                $json = json_decode($markers, true);
                $expected = array(
                    array(
                        'latitude' => 13.2,
                        'longitude' => 100.1,
                        'html' => '',
                        'category' => 'default',
                        'icon' => false
                        ),
                    array(
                        'latitude' => 13.14,
                        'longitude' => 99.7,
                        'html' => '',
                        'category' => 'default',
                        'icon' => false
                        ),
                    array(
                        'latitude' => 13.4,
                        'longitude' => 104.2,
                        'html' => '',
                        'category' => 'default',
                        'icon' => false
                        )
                );
                $this->assertEquals($expected, $json);
            }
        }
    }

    public function testGalleryWithMoMappedImages()
    {
        // zeroed coordinates mean no location
        foreach (GalleryImage::get() as $gi) {
            $gi->Lat = 0;
            $gi->Lon = 0;
            $gi->write();
        }
        $gp = $this->objFromFixture('GalleryPage', 'gp01');
        $map = $gp->Map();

        $this->assertEquals('<!-- no image locations found -->', $map);
    }

    public function testGetGalleryImages()
    {
        $this->markTestSkipped('TODO');
    }
}
