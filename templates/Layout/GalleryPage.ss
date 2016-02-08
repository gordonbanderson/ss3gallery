<% require css(ss3gallery/css/ss3Gallery.css) %>
<% require css(ss3gallery/css/prettyPhoto.css) %>
<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(ss3gallery/javascript/jquery.prettyPhoto.js) %>
<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
		<% include InlineGallery %>

	</article>
		$Form
		$CommentsForm
</div>
<% include PrimeGalleryJS %>
