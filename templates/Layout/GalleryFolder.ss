<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">
		$Content
		<% loop AllChildren %>
			<h2><a href="$Link">$Title</a></h2>
			$Summary
			<a href="$Link"><img alt="Photograph of $Top.Title" src="$PortletImage.BestCrop(300,200).URL"/></a>
		<% end_loop %>
		</div>
	</article>
	$Form
	$CommentsForm
</div>
