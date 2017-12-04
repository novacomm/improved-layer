1. Upgrade platform to latest 2.4 (set `platform.package.reference` in build.properties.local) 
1. Update library link in site.make with latest stable release of ECL.
1. Copy and rename hooks from template.php into the theme template.php file.
1. Copy `YOUR_CORE_FEATURE_update_7101` from `features/your_core_feature/your_core_feature.install` in a core Feature `.install` file (create if not exists) and rename it according other update hooks. 
1. Execute `composer install & ./bin/phing build-dev` is project root folder.
1. Copy `platform/sites/default/default.settings.php` to `platform/sites/default/settings.php` and update `$databases` variable.
1. Drop current database `drush sql-drop` and import production dump with `drush sql-cli < /PATH/TO/DUMP/FILE.sql`
1. Execute `drush rr & drush cc all & drush updb -y`.
1. Edit (create if not exists) `page.tpl.php` and add html for `Site header`, `Page header basic` and `Footers`
1. Add menus and search form in the page using regions/blocks or via template.php (preprocess_page hook)
 



