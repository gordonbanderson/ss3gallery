<?php

class GalleryImageShortCodeHandlerTest extends SapphireTest {
	protected static $fixture_file = 'ss3gallery/tests/ss3gallery.yml';

    public function testValidImage()
    {
        $page = $this->objFromFixture('Page', 'page02');

        $galleryImage = $this->objFromFixture('GalleryImage' , 'gi01');
        $content = "[GalleryImage id='{$galleryImage->ID}']";
        $page->Content = $content;
        $page->write();
        $html = ShortcodeParser::get_active()->parse($page->Content);

        $this->assertEquals('<div class="imageWithCaption centercontents ">
<img src=""><div class="meta">
    <p class="exif">f s </p>
    <p class="caption">Test Image 1</p>
</div>
</div>

', $html);
	}


    public function testNonExistentImage()
    {
        $page = $this->objFromFixture('Page', 'page02');

        $galleryImage = $this->objFromFixture('GalleryImage' , 'gi01');
        $nonExistentID = 1000 + $galleryImage->ID;
        // his will not exist
        $content = "[GalleryImage id='{$nonExistentID}']";
        $page->Content = $content;
        $page->write();
        $html = ShortcodeParser::get_active()->parse($page->Content);

        $this->assertEquals('image not found', $html);
    }
}
