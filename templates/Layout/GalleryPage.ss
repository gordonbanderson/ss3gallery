<% require css(ss3gallery/css/ss3Gallery.css) %>
<% require css(ss3gallery/css/prettyPhoto.css) %>
<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(ss3gallery/javascript/jquery.prettyPhoto.js) %>
<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<ul id="galleryArea">
       <% loop getGalleryImages %>
       <li>

       		<% with $Image.SetRatioSize(700,700) %>
            <a href="$URL" title="$Parent.Title" rel="prettyPhoto[pp_gal]"><% end_with %>
        	$Image.SetHeight(100)
            </a>
       </li>
       <% end_loop %>
       </ul>
	</article>
		$Form
		$CommentsForm
</div>



<script type="text/javascript">
(function($) {

      $(document).ready(function() {
        $(document).ready(function(){
		    $("a[rel^='prettyPhoto']").prettyPhoto();
		  });
      });
})(jQuery);
</script>
