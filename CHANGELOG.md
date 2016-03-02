# Changelog

All notable changes to this project will be documented in this file. This project adheres to [Semantic Versioning](http://semver.org/).

**1.7.1**
- Added SiteOrigin Page Builder plugin support.
- Rewrote Aesop Story Engine plugin styles.

**1.7**
- Added post format support with default colors (backgrounds for post listings like archives and searches, header color for single posts and pages).
- Added footer widget area.
- Added option to display timestamps as relative (for example, "2 days ago" instead of "February 20, 2016").
- Changed comment section background color to differentiate it from post/page content.
- Changed Aesop Story Engine plugin support to prevent loading plugin's stylesheet and load completely custom styles instead.
- Fixed submenu toggle script, which was also affecting nested comments ([issue 50](https://github.com/peiche/cover/issues/50)).
- Fixed comment paging links.
- Fixed Aesop Story Engine plugin's Parallax component styles (this also affected Quote and Content components when parallax functionality was enabled).
- Fixed Aesop Story Engine plugin's Collection component grid display.
- Fixed Aesop Story Engine plugin's content wrapper default width.
- Fixed Aesop Story Engine plugin's Chapter component's full chapter height.
- Fixed Jetpack logo styles.
- Fixed horizontal scrolling bug for long post titles.
- Reorganized template parts and includes.
- Removed Aesop chapter component hack because it's been fixed.
- Removed Skrollr styles (Skrollr itself was removed in v1.6.4).

**1.6.4**
- Updated TGM Plugin Activation to latest version of [fork that passes wp.org theme-check](https://github.com/TGMPA/TGM-Plugin-Activation/issues/475#issuecomment-155816019).
- Updated markup for accessibility.
- Updated chapter component styles in Aesop Story Engine plugin.
- Improved Headroom functionality.
- Fixed sticky map component in Aesop Story Engine plugin.
- Fixed hover opacity on image components in Aesop Story Engine plugin.
- Removed Skrollr.
- Removed author data shim to mirror [_s commit](https://github.com/Automattic/_s/commit/2580a0a69f091b98272bc74e35c347b34a20a52d).
- Removed custom paging function in favor of core navigation function.

**1.6.3**
- Added link on posts to view featured image.
- Added link on posts with featured images to jump straight to content.
- Added support for my fork of the [Threads](https://github.com/peiche/wp-threads/) plugin.
- Added widget area on search overlay.
- Updated to Font Awesome 4.5.
- Fixed missing translation text in post navigation.
- Fixed color theme for Chrome on Android Lollipop.
- [Fixed broken `customizer.js` link](https://github.com/peiche/cover/issues/43) (thanks [@michaelbeil](https://github.com/michaelbeil)).
- Stylesheet fixes.

**1.6.2**
- Escaped theme option outputs.
- Fixed missing margin for Minimal view. (Fixes [this issue](https://github.com/peiche/cover/issues/41).)
- Updated TGM Plugin Activation class.

**1.6.1**
- Extended nested menu logic for all hierarchical items, including categories.
- Fixed caption styles for Aesop video components.
- Fixed featured content slider format issue.
- Added support for Naked Social Share plugin.

**1.6.0**
- Upgraded to FontAwesome 4.4.
- Updated Vimeo icon (per [this FontAwesome issue](https://github.com/FortAwesome/Font-Awesome/issues/2197)).
- Added overlay color option: dark or light.
- Added Unslider plugin for more than one featured post.
- Increased featured post maximum from one to five.
- Added post view option: minimal or grid.
- Added custom background color option for grid view.
- Added custom background image option for grid view.
- Added column option for grid view.
- Added Masonry plugin for grid view.
- Tweaked profile layout for small screens.
- Tweaked post spacing for small screens.

**1.5.6**
- Fixed margin for comment and paging navigation.
- Fixed site description for small screens.
- Fixed footer for small screens.
- Overhauled blockquote styles, for both the default and the Aesop Story Engine component.

**1.5.5**
- Fixed sticky post style inconsistencies.
- Fixed undefined variable in `content.php`.
- Fixed full size featured images for posts with long titles (thanks to [@Music47ell](https://github.com/Music47ell)).
- Fixed site header for long site titles.
- Fixed debug error in `inc/cover-archive.php`.
- Fixed single page/post featured image styles.

**1.5.4**
- [Removed 62.5% antipattern](http://eichefam.net/2015/06/30/anti-antipattern/) (thanks to [@Music47ell](https://github.com/Music47ell)).

**1.5.3**
- Added overlay for Aesop Story Engine Content component to make text more readable.
- Fixed [non-object property bug](https://github.com/peiche/cover/issues/29) in post navigation (thanks [@uusijani](https://github.com/uusijani)).
- Fixed post background for sticky posts displayed in the loop.
- Fixed header background transition timing.
- Fixed post navigation margins.

**1.5.2**
- Fixed header for touch screen devices.
- Fixed widget menus.
- Fixed overlay text color.
- Code cleanup.

**1.5.1**
- Fixed header color for Color Posts plugin.

**1.5.0**
- Added support for Jetpack's Site Logo module.
- Added Customizer option to change header color.
- Added Customizer option to change link color.
- Added support for the [Color Posts](https://wordpress.org/plugins/color-posts/) plugin to set the header color based on post images. (Please note that this requires [Jetpack](https://wordpress.org/plugins/jetpack/) to function.)
- Added TGM Plugin Activation class to suggest Aesop Story Engine.
- Added caption styles for Aesop Story Engine image gallery types (Grid, Thumbnail, Sequence, Photoset, Parallax).
- Added styles for Aesop Story Engine to darken the image behind the text in the chapter component, similar to the header.
- Added background image for sticky posts in The Loop.

**1.4.0**
- Jetpack's Infinite Scrolling module now detects whether or not the footer social menu is present.
- Updated Google Fonts URL to be protocol-relative (thanks to [@BforBen](https://github.com/BforBen)).
- Added WordPress.org installation directions.

**1.3.1**
- Initial release on the [WordPress.org Theme Directory](https://wordpress.org/themes/cover/).