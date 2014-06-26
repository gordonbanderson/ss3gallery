<?php
 
class GalleryImage extends DataObject implements RenderableAsPortlet {
 
  
  public static $db = array(	
	  'SortOrder' => 'Int',
	  'Title' => 'Varchar'
  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(
    'Image' => 'Image',
    'GalleryPage' => 'GalleryPage'	
  );
 
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","GalleryPageID");
    $fields->removeFieldFromTab("Root.Main","SortOrder");
    $fields->renameField('Title', _t('GalleryImage.TITLE', 'Title'));
    $fields->renameField('Image', _t('GalleryImage.IMAGE', 'Image'));


		return $fields;		
  }
  
  // Tell the datagrid what fields to show in the table
   public static $summary_fields = array( 
       'ID' => 'ID',
	   'Title' => 'Title',
	   'Thumbnail' => 'Thumbnail'     
   );
  
  // this function creates the thumnail for the summary fields to use
   public function getThumbnail() { 
     return $this->Image()->CMSThumbnail();
  }


  public function getPortletTitle() {
    return $this->Title;
  }
  

  /**
   * An accessor method for an image for a portlet
   * @example
   * <code>
   *  return $this->NewsItemImage;
   * </code>
   *
   * @return string
   */
  public function getPortletImage() {
    return $this->Image();
  }
  
  
  /**
   * An accessor for text associated with the portlet
   * @example
   * <code>
   * return $this->Summary
   * </code>
   *
   * @return string
   */ 
  public function getPortletCaption() {
    return '';
  }


  function HorizontalMargin( $intendedWidth ) {
    //FIXME - is there a way to avoid a database call here?
    $image100 = $this->Image()->SetRatioSize(100,100);
    $result = ( $intendedWidth-$image100->Width )/2;
    error_log('HORIZONTAL MARGIN:'.$result);
    return $result;
  }

  function VerticalMargin( $intendedHeight ) {
    //FIXME - is there a way to avoid a database call here?
    $image100 = $this->Image()->SetRatioSize(100,100);
    return ( $intendedHeight-$image100->Height )/2;
  }
 
}