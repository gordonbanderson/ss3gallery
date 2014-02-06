<h1>Gallery page override</h1>
    
    	<div class="typography">
        
            <h2>$Title</h2>
            $Content
            $Form
           
           <ul id="galleryArea" class="polaroids">
           <% loop getGalleryImages %>
           <li>
           		<% with $Image.SetRatioSize(1400,1000) %>
                <a href="$URL" title="$Title" rel="$Width"><% end_with %>
            	$Image.SetSize(200,200)
                </a>
           </li>
           <% end_loop %>
           </ul>

           	<div class="clear"></div>
            
           
    
    
			</div>

		</div>


<script type="text/javascript">
      $(document).ready(function() {
        $('#galleryArea').magnificPopup({
          delegate: 'a',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
          }
        });
      });
</script>