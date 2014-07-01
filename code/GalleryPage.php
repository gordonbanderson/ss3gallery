<?php

class GalleryPage extends Page {
	
	public static $has_many = array(
    	'GalleryImages' => 'GalleryImage'
  	);

   private static $icon = 'ss3gallery/icons/photo.png'; 

  
   public function getCMSFields() {
   		$fields = parent::getCMSFields();
		$gridFieldConfig = GridFieldConfig_RecordEditor::create(); 
		//$gridFieldConfig->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfig->addComponent($gbu = new GridFieldBulkUpload());  
		$gridFieldConfig->addComponent($gbm = new GridFieldBulkManager()); 
		$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    
		$galleryimagesi18n = _t('GalleryImage.PLURALNAME', "Gallery Images");
		//$gbu->setConfig('fileRelationName','Image');
		$gbu->setConfig('folderName', 'galleries/'.$this->ID);
		//$gbm->setConfig('editableFields', array('Title'));
		$gbm->setConfig('fieldsNameBlacklist', array('Lat','Lon','ZoomLevel'));
		$gridfield = new GridField("GalleryImages", $galleryimagesi18n, $this->GalleryImages()->sort("SortOrder"), $gridFieldConfig);
		$fields->addFieldToTab('Root.'.$galleryimagesi18n, $gridfield);
		return $fields;
  }



  public function Map() {
  	$photosWithLocation = $this->GalleryImages()->where('Lat != 0 AND Lon !=0');
    if ($photosWithLocation->count() == 0) {
      return 'No locations found'; // don't render a map
    }
    $map = $photosWithLocation->getRenderableMap();
    // $map->setDelayLoadMapFunction( true );
    $map->setZoom( 10 );
    $map->setAdditionalCSSClasses( 'fullWidthMap' );
    $map->setShowInlineMapDivStyle( true );
    $map->setClusterer(true);
    /*
    foreach($this->MapLayers() as $layer) {
      $map->addKML($layer->KmlFile()->getAbsoluteURL());
    }
    */


    //$map->addKML('http://assets.tripodtravel.co.nz/cycling/meuang-nont-to-bang-sue-loop.kml');
    $map->setSize('100%','600px');
    return $map;
  }

}
class GalleryPage_Controller extends Page_Controller {
	
	public static $allowed_actions = array (
	);
	
	public function GetGalleryImages() {
		return $this->GalleryImages()->sort("SortOrder");
	}
}