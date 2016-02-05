<?php

class GalleryPage extends PageWithImage
{
    public static $has_many = array(
        'GalleryImages' => 'GalleryImage',
    );

    private static $db = array(
        'GalleryDate' => 'Date',
    );

    private static $icon = 'ss3gallery/icons/photo.png';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        //$gridFieldConfig->addComponent(new GridFieldBulkEditingTools());
        $gridFieldConfig->addComponent($gbu = new GridFieldBulkUpload());
        $editableFields = array('Title', 'Image', 'Aperture', 'ShutterSpeed');
        $gridFieldConfig->addComponent($gbm = new GridFieldBulkManager($editableFields));
        $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $galleryimagesi18n = _t('GalleryImage.PLURALNAME', 'Gallery Images');
        //$gbu->setConfig('fileRelationName','Image');

        $gbu->setUfConfig('folderName', 'galleries/'.$this->ID);
        $gbm->setConfig('editableFields', array('Title T1'));
        // This is no longer available... $gbm->setConfig('fieldsNameBlacklist', array('Lat', 'Lon', 'ZoomLevel'));
        $gridfield = new GridField('GalleryImages', $galleryimagesi18n, $this->GalleryImages()->sort('"SortOrder"'), $gridFieldConfig);
        $fields->addFieldToTab('Root.'.$galleryimagesi18n, $gridfield);

        $fields->addFieldToTab('Root.Date', new DateField('GalleryDate'));

        return $fields;
    }

    public function Map()
    {
        $photosWithLocation = $this->GalleryImages()->where('"Lat" != 0 AND "Lon" !=0');
        if ($photosWithLocation->count() == 0) {
            return 'No locations found'; // don't render a map
        }
        $map = $photosWithLocation->getRenderableMap();
        $map->setZoom(10);
        $map->setAdditionalCSSClasses('fullWidthMap');
        $map->setShowInlineMapDivStyle(true);
        $map->setClusterer(true);

        $map->setSize('100%', '600px');
        return $map;
        }
    }

class GalleryPage_Controller extends Page_Controller
{
    public static $allowed_actions = array();

    public function GetGalleryImages()
    {
        return $this->GalleryImages()->sort('SortOrder');
    }
}
