## Overview
This repository contains the theme code for the City of Los Angeles Department of Cultural Affairs’ website, http://culturela.org. This frontend theme code is developed for the Wordpress platform. This project is the result of a partnership between Department of Cultural Affairs (DCA) and contractor Kluge Interactive, http://klugeinteractive.com. Members of DCA and Kluge teamed up to design a template for the agency to provide the agency’s programming, facility and events information.   

This template code is a public, stable version. It can be downloaded as a zip to be installed in Wordpress. We encourage developers to use modify, merge, publish, distribute this code. Questions? Contact our team:  
Project coordinator: Umi Hsu umi.hsu@lacity.org  
Technical lead: Daniel Garcia daniel@klugeinteractive.com

## Who is this for?
Government and nonprofit arts agencies can benefit from this open source project. Organizations that don’t currently have technical staff or a content management system can leverage this theme as an entree into Wordpress, a robust and open source web authoring system. It enables non-technical staff to make content updates. This theme is ready for use for municipal agencies in large or medium-sized cities or state-level arts agencies with events, facilities, venues, cultural sites, and programming in grants, public art, and arts education. Smaller nonprofit arts agencies may adapt and modify the theme based on the scope and form of their programming needs.

## Goals
We believe that this code contribution advances our agency’s public mission, a commitment to building public-serving information infrastructures that support arts and culture. By releasing our web template code, we hope to empower arts agencies to adopt and develop digital platforms in order to augment their services, contributing to the greater knowledge commons related to arts and culture in Los Angeles and beyond. A Wordpress project, our web work also contributes to the global community committed to sharing and developing open source webmaking tools. We expect to continue our development of this theme code with plans to support digital service delivery to be designed in the near future. Contact us if you would like to learn about our development plans.

## Licensing
We have licensed this Wordpress theme code under the MIT open source license. The Department of Cultural Affairs retains the copyright of the code contained in this repository.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Technology
The theme is based in a Wordpress starter theme named Sage:

# [Sage](https://roots.io/sage/)
[![Build Status](https://travis-ci.org/roots/sage.svg)](https://travis-ci.org/roots/sage)
[![devDependency Status](https://david-dm.org/roots/sage/dev-status.svg)](https://david-dm.org/roots/sage#info=devDependencies)

Sage is a WordPress starter theme based on HTML5 Boilerplate, gulp, Bower, and Bootstrap Sass, that will help you make better themes.

* Source: [https://github.com/roots/sage](https://github.com/roots/sage)
* Homepage: [https://roots.io/sage/](https://roots.io/sage/)
* Documentation: [https://roots.io/sage/docs/](https://roots.io/sage/docs/)
* Twitter: [@rootswp](https://twitter.com/rootswp)
* Newsletter: [Subscribe](http://roots.io/subscribe/)
* Forum: [https://discourse.roots.io/](https://discourse.roots.io/)

## Requirements

| Prerequisite    | How to check | How to install
| --------------- | ------------ | ------------- |
| PHP >= 5.4.x    | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js 0.12.x  | `node -v`    | [nodejs.org](http://nodejs.org/) |
| gulp >= 3.8.10  | `gulp -v`    | `npm install -g gulp` |
| Bower >= 1.3.12 | `bower -v`   | `npm install -g bower` |

For more installation notes, refer to the [Install gulp and Bower](#install-gulp-and-bower) section in this document.
 
Styling:
The theme uses SASS and Bootstrap. 

Wordpress plugin dependencies:
- Advanced custom fields
- ACF date time picker
- ACF repeater
- Custom post type UI
- Events calendar pro
- The events calendar
- The events calendar shortcode
- The events calendar community events
- The Events Calendar: Filter Bar
- Constant contact API
- Contact Form 7
- Contact Form 7 Newsletter
- Contact Form CFDB7
- Relevanssi

## Templates

The theme includes the following template files:  
archive-artist-projects.php  
archive-contact-division.php  
archive-council_district.php  
archive-cultural_center.php  
archive-grant_and_call.php  
archive-grantee.php  
archive-program_initiative.php  
index.php  
page.php - static pages  
page-about.php - about page  
page-city-art-collection.php - city art collection page  
page-contact.php - contact page  
page-media-room.php - media room page  
page-murals-list.php - murals list page  
page-murals.php - murals page  
page-percent-public-art.php - percent public art page  
page-percent-public-art-projects.php - NEW percent for public art individual projects listing on the district pages  
page-prvate-arts-development-fee-program-pwiap.php - static pages  
page-public-works-improvements-arts-program-pwiap.php - static pages  
header.php  
sidebar.php  
footer.php  
template-events.php - NEW event detail template  
template-two-columns.php - NEW two column component  
component-image-slider.php - NEW image slider component  
content-page-ppart-projects.php - NEW content template for percent for public art listing on the district pages  
content-page-two-columns.php - NEW two column component on pages  
page-events-header.php - NEW customizations on the main events page  

## Supported elements
 
The theme supports featured images, image slider, menus and widgets and uses them as follows:
 
Featured images:
These are displayed in the archive and index templates if they are present, using the medium size.

Image slider:
A custom component can be added to pages to show multiple images on a carousel or slider.
 
Menus:
The default menu is in header.php, and uses the Menus admin.
