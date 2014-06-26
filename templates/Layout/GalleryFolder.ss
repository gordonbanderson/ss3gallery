<div class="row">
<% if Level(2) %>
<div class="medium-9 columns medium-push-3">
<% else %>
<div class="small-12 columns">
<% end_if %>
<h1>$Title</h1>
$Content
<% loop AllChildren %>
<div class="row rideListing">
<div class="medium-3 columns"><img class="shadowbox" alt="Photograph of $Top.Title"  data-interchange="[$PortletImage.SetWidth(228).URL, (default)],[$PortletImage.SetWidth(228).URL, (medium)],[$PortletImage.SetWidth(228).URL, (large)], [$PortletImage.SetWidth(640).URL, (small)]"></div>
<div class="medium-9 columns"><h2><a href="$Link">$Title</a></h2>$Summary</div>
</div>
<% end_loop %>
$Form
<% include PrevNextSiblingNav %>
<% include TopAndLike %>
</div>
<div class="medium-3 columns medium-pull-9 sidebar"><% include SideBar %></div>
</div>