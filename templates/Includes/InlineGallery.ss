<% require css(ss3gallery/css/ss3Gallery.css) %>
<% require css(ss3gallery/css/prettyPhoto.css) %>
<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(ss3gallery/javascript/jquery.prettyPhoto.js) %>
<% require javascript(ss3gallery/javascript/ss3gallery-pretty-photo.js) %>

<div id="galleryArea">
<% loop getGalleryImages %>
 <div class="col-xs-6 col-md-3">
	<% with $Image.SetRatioSize(1000,1000) %>
    <a href="$URL"<% end_with %> title="$Caption.XML" class="thumbnail" rel="prettyPhoto[pp_gal]">
	<% with $Image.CroppedFocusedImage(200,200) %><img src="$URL"<% end_with %> alt="$Title.XML"/>
    </a>
</div>
<% end_loop %>
</div>
