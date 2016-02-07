<?php

class AttachedGalleryExtension extends DataExtension
{
    private static $has_one = array(
        'AttachedGallery' => 'GalleryPage',
    );

    public function updateCMSFields(FieldList $fields)
    {
        $galleryField = new TreeDropdownField(
            'AttachedGalleryID',
            _t('AttachedGalleryExtension.CHOOSE_A_GALLERY', 'Choose another gallery to show on this page'),
            'GalleryPage'
        );

        $fields->addFieldToTab('Root.'._t('AttachedGalleryExtension.ATTACHED_GALLERY', 'Attached Gallery'), $galleryField);
    }

    /*
    Return a list of the attached gallery and any child galleries
    */
    public function InlineGalleries()
    {
        $result = new ArrayList();

        // find child galleries
        foreach ($this->owner->AllChildren() as $child) {
            if ($child->ClassName == 'GalleryPage') {
                $result->push($child);
            }
        }

        if ($this->owner->AttachedGalleryID != 0) {
            $result->push($this->owner->AttachedGallery());
        }

        return $result;
    }
}
