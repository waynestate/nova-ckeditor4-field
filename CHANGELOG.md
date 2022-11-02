# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/) and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [1.1.4] - 2022-11-02
### Fixed
* Add check for migrations to make sure the table doesn't exist before trying to create it. by @chrispelzer in https://github.com/waynestate/nova-ckeditor4-field/pull/68 https://github.com/waynestate/nova-ckeditor4-field/issues/67

## [1.1.3] - 2022-10-13
### Changed
* Updated packagist badges

### Fixed
* Keep custom config when file upload is enabled by @shaffe-fr in https://github.com/waynestate/nova-ckeditor4-field/pull/66

## [1.1.2] - 2022-07-30
### Changed
* Require Laravel Nova v4.0 within the composer.json which will then allow Nova 4 Support to be tagged properly for the CKEditor 4 field which it now supports.

### Fixed
* update dist/field.js - `npm run prod` was never ran with the default string for CKEditor.js, this corrects it with the correct field.js build.
  https://github.com/waynestate/nova-ckeditor4-field/commit/586d2ee3338b77c1ededbe2c2f4409106b6872ba This case would never have been met due to the merging of the configuration default for the package.

## [1.1.1] - 2022-07-28
### Fixed
* Switch back to full-all instead of standard that was put into some places when updating to v4.19.1

## [1.1.0] - 2022-07-28
### Changed
* Drag/Drop Image Upload and Namespace specificy by @chrispelzer in https://github.com/waynestate/nova-ckeditor4-field/pull/65
  Special thanks to @whchi who started this a while ago with #38 but never got put into the package.

### Breaking Changes
Due to making the namespace more specific to the package, you must now update the use for the Field resource
from `use Waynestate\Nova\CKEditor` to now `use Waynestate\Nova\CKEditor4Field\CKEditor`

## [1.0.2] - 2022-07-25
### Fixed
* Fix saving of CKEditor field if using the default full plugin config that is loaded by CKEditor by @chrispelzer in https://github.com/waynestate/nova-ckeditor4-field/pull/64

## [1.0.1] - 2022-07-18
### Fixed
* Fixed a bug that wasn't updating the field value when only copying and pasting into the CKEditor.

## [1.0.0] - 2022-07-18
### Changed
* Update for support for Nova v4 by @chrispelzer in https://github.com/waynestate/nova-ckeditor4-field/pull/59

## [0.7.0] - 2022-07-18
### Changed
* Update CKEditor to latest v4.14.0 due to XSS vulnerability in the WebSpellChecker plugin by @chrispelzer in https://github.com/waynestate/nova-ckeditor4-field/pull/34

## [0.6.0] - 2020-01-02
### Changed
* Update README command with compatibility for all OSes https://github.com/waynestate/nova-ckeditor4-field/pull/26 - @f-liva
* Change the FormField to use `field.attribute` for the ID to use the column name if there are multiple instances of CKEditor https://github.com/waynestate/nova-ckeditor4-field/pull/32 https://github.com/waynestate/nova-ckeditor4-field/pull/33

## [0.4.0] - 2019-07-25
### Fixed
* Fixes FormField component layout to use the Nova Default Field component which includes standard field options like errors and help text https://github.com/waynestate/nova-ckeditor4-field/issues/22

## [0.3.0] - 2019-03-06
### Changed
* renamed file for PSR-4 compliance by @dsampaolo in https://github.com/waynestate/nova-ckeditor4-field/pull/15
* Update the default CKEditor from 4.11.2 to 4.11.3 https://github.com/waynestate/nova-ckeditor4-field/commit/ba138ccc71931bdcf046356f45ad50a1e33581b2

### Fixed
* Version mistake in README.md

## [0.2.0] - 2019-01-19
### Changes
* Updated to use the Full CKEditor Preset instead of Standard https://github.com/waynestate/nova-ckeditor4-field/issues/12 https://github.com/waynestate/nova-ckeditor4-field/commit/efc1c5c4ad8dbe3ca831e29809749e95e5a7ad05
* Reorder the config file https://github.com/waynestate/nova-ckeditor4-field/commit/d21fdeb5f372f3258f62154505044919178c94d4

### Fixed
* Don't serve blank `field.css` https://github.com/waynestate/nova-ckeditor4-field/issues/9 https://github.com/waynestate/nova-ckeditor4-field/commit/1a17b21eef63ed6c10c0da9020c407df92fd2c8b

### Notes
* If you have already published a config, you'll need to manually update the URL for `ckeditor_url` to use the latest CKEditor v4.11.2 to `https://cdn.ckeditor.com/4.11.2/full-all/ckeditor.js`

## [0.1.4] - 2018-12-04
### Changed
* Remove the version number from the composer.json file. This allows us to manage it one spot (the tag).

## [0.1.3] - 2018-12-04
### Changed
* Added a ':' to allow name to be bound by @iHazzam in https://github.com/waynestate/nova-ckeditor4-field/pull/2
* Add expandable trait so the detail view can collapse the content. by @robertvrabel in https://github.com/waynestate/nova-ckeditor4-field/pull/7
* Update the distributed JS by @robertvrabel in https://github.com/waynestate/nova-ckeditor4-field/pull/8

## [0.1.2] - 2018-12-04
### Changed
* Add expandable trait so the detail view can collapse the content. (@robertvrabel)

## [0.1.1] - 2018-11-01
### Changed
* Bind :id to allow multiple CKEditors instances to be used (@iHazzam) https://github.com/waynestate/nova-ckeditor4-field/pull/2

## [0.1.0] - 2018-10-29
Initial release
