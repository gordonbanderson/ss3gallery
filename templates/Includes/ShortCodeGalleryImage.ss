<div class="imageWithCaption centercontents <% if Position == left %>pull-left span4<% end_if %><% if Position == right %>pull-right span4<% end_if %>">
<img src="$Image.SetWidth(1024).URL">
<div class="meta">
	<p class="exif">f{$Aperture} {$ShutterSpeed}s $TakenAt.Nice</p>
	<p class="caption">$Title</p>
</div>
</div>
<% if Position == center %><div class="clearall">&nbsp;</div><% end_if %>

