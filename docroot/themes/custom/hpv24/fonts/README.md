# hpv24 Fonts

Have your needed custom webfonts locate them at this fonts folder.
List the files in the templates/includes/preload.twig file
Select if the preload is for all the site or LTR or RTL or per language.
Add the font-face definition files to the hpv24/global-styles
 or hpv24/global-styles-rtl libraries.

Other ways could be used to attach or add fonts in your sites.
This way is to have a better performance and code coverage.

* Issue [#3212956](https://www.drupal.org/i/3212956): 
        Fixed hpv24 performance code coverage for preloaded RTL fonts
* Issue [#3209970](https://www.drupal.org/i/3209970):
        Fixed hpv24 performance code coverage for preloaded remote CDN 
        Font Awesome library to a packaged one for better pre-loading of icons
