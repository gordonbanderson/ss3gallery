<ul id="galleryArea">
<% loop getGalleryImages %>
<li>
	<% with $Image.SetRatioSize(700,700) %>
    <a href="$URL"<% end_with %> title="$Caption.XML" rel="prettyPhoto[pp_gal]">
	<% with $Image.SetHeight(100) %><img src="$URL"<% end_with %> alt="$Title.XML"/>
    </a>
</li>
<% end_loop %>
</ul>
