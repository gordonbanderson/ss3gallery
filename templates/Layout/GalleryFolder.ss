<div class="row">
<% if Level(2) %>
<div class="medium-9 columns medium-push-3">
<% else %>
<div class="small-12 columns">
<% end_if %>
<h1>$Title</h1>
$Content
<% loop AllChildren %>
<div class="row">
<div class="small-push-0 medium-push-3 medium-9 columns"><h2><a href="$Link">$Title</a><small>&nbsp;$RideDate.Nice</small></h2>$Summary</div>
<div class="small-pull-0 medium-pull-9 medium-3 columns"><img class="shadowbox" alt="Photograph of $Top.Title"  data-interchange="[$PortletImage.CroppedFocusedImage(268,147).URL, (default)],[$PortletImage.CroppedFocusedImage(640,427).URL, (small)],[$PortletImage.CroppedFocusedImage(220,157).URL, (medium)],[$PortletImage.CroppedFocusedImage(268,179).URL, (large)]"></div>
</div>
<% end_loop %>
Level test:
<hr/>
<% if Level(1) %>Level 1<% else %>Not level 1<% end_if %>
<hr/>

$Form


<% if Level(2) %><% include PrevNextSiblingNav %><% end_if %>
<% include TopAndLike %>
</div>
<div class="medium-3 columns medium-pull-9 sidebar"><% include SideBar %></div>
</div>