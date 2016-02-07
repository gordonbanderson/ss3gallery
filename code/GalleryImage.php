<?php

class GalleryImage extends DataObject implements RenderableAsPortlet
{
    public static $db = array(
        'SortOrder' => 'Int',
        'Title' => 'Varchar',
    );

    // One-to-one relationship with gallery page
    public static $has_one = array(
        'Image' => 'Image',
        'GalleryPage' => 'GalleryPage',
    );

    // tidy up the CMS by not showing these fields
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab('Root.Main', 'GalleryPageID');
        $fields->removeFieldFromTab('Root.Main', 'ExifRead');
        $fields->removeFieldFromTab('Root.Main', 'SortOrder');
        $fields->renameField('Title', _t('GalleryImage.TITLE', 'Title'));
        $fields->renameField('Image', _t('GalleryImage.IMAGE', 'Image'));
        return $fields;
    }

    // Tell the datagrid what fields to show in the table
    public static $summary_fields = array(
        'ID' => 'ID',
        'Title' => 'Title',
        'Thumbnail' => 'Thumbnail',
    );

    // this function creates the thumnail for the summary fields to use
    public function getThumbnail()
    {
        return $this->Image()->CMSThumbnail();
    }

    public function getPortletTitle()
    {
        return $this->Title;
    }

    /**
    * An accessor method for an image for a portlet.
    *
    * @example
    * <code>
    *  return $this->NewsItemImage;
    * </code>
    *
    * @return string
    */
    public function getPortletImage()
    {
        return $this->Image();
    }

    /**
    * An accessor for text associated with the portlet.
    *
    * @example
    * <code>
    * return $this->Summary
    * </code>
    *
    * @return string
    */
    public function getPortletCaption()
    {
        return '';
    }
}
