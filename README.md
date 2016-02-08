# SS3 Gallery
[![Build Status](https://travis-ci.org/gordonbanderson/ss3gallery.svg?branch=master)](https://travis-ci.org/gordonbanderson/ss3gallery)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gordonbanderson/ss3gallery/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gordonbanderson/ss3gallery/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/gordonbanderson/ss3gallery/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gordonbanderson/ss3gallery/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/gordonbanderson/ss3gallery/badges/build.png?b=master)](https://scrutinizer-ci.com/g/gordonbanderson/ss3gallery/build-status/master)
[![codecov.io](https://codecov.io/github/gordonbanderson/ss3gallery/coverage.svg?branch=master)](https://codecov.io/github/gordonbanderson/ss3gallery?branch=master)

[![Latest Stable Version](https://poser.pugx.org/weboftalent/ss3gallery/version)](https://packagist.org/packages/weboftalent/ss3gallery)
[![Latest Unstable Version](https://poser.pugx.org/weboftalent/ss3gallery/v/unstable)](//packagist.org/packages/weboftalent/ss3gallery)
[![Total Downloads](https://poser.pugx.org/weboftalent/ss3gallery/downloads)](https://packagist.org/packages/weboftalent/ss3gallery)
[![License](https://poser.pugx.org/weboftalent/ss3gallery/license)](https://packagist.org/packages/weboftalent/ss3gallery)
[![Monthly Downloads](https://poser.pugx.org/weboftalent/ss3gallery/d/monthly)](https://packagist.org/packages/weboftalent/ss3gallery)
[![Daily Downloads](https://poser.pugx.org/weboftalent/ss3gallery/d/daily)](https://packagist.org/packages/weboftalent/ss3gallery)

[![Dependency Status](https://www.versioneye.com/php/weboftalent:ss3gallery/badge.svg)](https://www.versioneye.com/php/weboftalent:ss3gallery)
[![Reference Status](https://www.versioneye.com/php/weboftalent:ss3gallery/reference_badge.svg?style=flat)](https://www.versioneye.com/php/weboftalent:ss3gallery/references)

![codecov.io](https://codecov.io/github/gordonbanderson/ss3gallery/branch.svg?branch=master)

## Maintainers

* Gordon Anderson (Nickname: nontgor)
	<gordon.b.anderson@gmail.com>

##Introduction
This gallery module enables bulk upload of images, and displays them using the
jQuery plugin PrettyPhoto.  It will by default try to import photographic 
metadata, including geographic location.  A map can then be displayed along with
the images from the photographic template.

Forked from https://github.com/OpticBlaze/ss3Gallery and adapted to use other
modules from Web of Talent to aid rendering.
 
##Installation
```
composer require weboftalent/ss3gallery
```

##Usage
###Uploading Images

###Editing Images
For showing the main point of interest in an image, it is highly recommended to
install the Focus Point module (`composer require jonom/focuspoint`).  Below is
an example of editing an image so the main area of interest, the head of the
statue, is not cropped out.

![Automatically cropped image of the statue, around it's centre.  The head is all
but missing.]
(https://raw.githubusercontent.com/gordonbanderson/ss3gallery/master/screenshots/crop001.png
"Automatically cropped image of the statue, around it's centre.  The head is all
but missing.")
![Edit the focus point, in the case the face of the statue]
(https://raw.githubusercontent.com/gordonbanderson/ss3gallery/master/screenshots/crop002.png
"Edit the focus point, in the case the face of the statue")
![Same image but with it's focus point now on the face of the statue]
(https://raw.githubusercontent.com/gordonbanderson/ss3gallery/master/screenshots/crop003.png
"Same image but with it's focus point now on the face of the statue")

##Templating
###Maps
When rendering a GalleryPage simply have `$Map` in your template.

##Extensions
###MapExtension (Enabled by default)
Images can have their location edited, and also imported if the GPS coordinates
are present in the EXIF data.

To remove this functionality add the following to mysite/_config.php

```
GalleryImage::remove_extension('MapExtension')
```

###ImageMetaDataExtension (Enabled by default)
Creates fields for a number of photographic metadata fields such as aperture,
shutterspeed and film speed.  Also imports EXIF data when an image is written
to the database and EXIF data has not previously been read.

###LatestGalleryImagesExtension (Enabled by default)
This simply adds a template method allowing one to get the latest N images from
the database.  This might be of use for say a 'Newest Images' widget.

###AttachedGalleryExtension
This optional extension allows one to attach a GalleryPage to an existing page
type and render it inline.  One can add GalleryPages in 1 of 2 manners:
* Use the tab 'Attached Gallery' and select a gallery existing elsewhere in the
site.
* Add child pages, as many as you wish, of type GalleryPage.
* In the page template for the relevant page type, add 
`<% include InlineGalleries %>` where you want to the images to appear.

##Requirements
* SilverStripe 3.1 or 3.2
* Mappable module
* Page With Image module
* Portlets module

All of these are automatically installed by Composer.

Optionally:
* Focus Point module - images can be cropped to say a square, but still have the
main focus point of the image visible.

##TODO
* It would be good to have versions of the template ready for popular frameworks
such as Zurb Foundation or Bootstrap.  I envisage likes of an extra tab
containing a dropdown with a choice of templating/viewing library to use.

