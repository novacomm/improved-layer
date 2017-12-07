<?php
/**
 * @file
 * Ec_resp's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/ec_resp.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $menu_visible: Checking if the main menu is available in the
 *    region featured
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header_top']: Displayed at the top line of the header
 *    -> language switcher, links, ...
 * - $page['header_right']: Displayed in the right part of the header
 *    -> logo, search box, ...
 * - $page['featured']: Displayed below the header, take full width of screen
 *    -> main menu, global information, ...
 * - $page['tools']: Displayed on top right of content area
 *    -> login/logout buttons, author information, ...
 * - $page['sidebar_left']: Small sidebar displayed on left of the content
 *    -> navigation, pictures, ...
 * - $page['sidebar_right']: Small sidebar displayed on right of the content
 *    -> latest content, calendar, ...
 * - $page['content_top']: Displayed in middle column
 *    -> carousel, important news, ...
 * - $page['help']: Displayed between page title and content
 *    -> information about the page, contextual help, ...
 * - $page['content']: The main content of the current page.
 * - $page['content_right']: Large sidebar displayed on right of the content
 *    -> 2 column layout
 * - $page['content_bottom']: Displayed below the content, in middle column
 *    -> print button, share tools, ...
 * - $page['footer']: Displayed at bottom of the page, on full width
 *    -> latest update, copyright, ...
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see ec_resp_process_page()
 */
?>

<header class="ecl-site-header" role="banner">

  <div class="ecl-container">

    <nav class="ecl-navigation-list-wrapper ecl-u-f-r">
      <?php print $ecl_menu_u; ?>
    </nav>
  </div>

  <div class="ecl-site-switcher ecl-site-switcher--header">
    <?php print $ecl_menu_nsh; ?>
  </div>

  <div class="ecl-container ecl-site-header__banner">
    <a href="https://ec.europa.eu"
       class="ecl-logo ecl-logo--logotype ecl-site-header__logo"
       title="<?php print t('Home - European Commission'); ?>">
      <span
        class="ecl-u-sr-only"><?php print t('Home - European Commission'); ?></span>
    </a>

    <div class="ecl-lang-select-sites ecl-site-header__lang-select-sites">
      <?php print $language_selector; ?>
    </div>

    <?php print $search_form; ?>

  </div>
</header>

<div class="ecl-page-header">
  <div class="ecl-container">

    <nav class="ecl-breadcrumbs " aria-label="breadcrumbs">
      <?php print $easy_breadcrumb; ?>
    </nav>

    <div class="ecl-page-header__body">

      <div class="ecl-page-header__identity">
        <?php print $site_name; ?>
      </div>

    </div>
  </div>
</div>


YOUR HTML GOES HERE


<footer class="ecl-footer">
  <div class="ecl-footer__site-identity">
    <div class="ecl-container">
      <div class="ecl-row">
        <div class="ecl-col-sm ecl-footer__column">

          <h4 class="ecl-h4">
            <a class="ecl-link ecl-footer__link"
               href="<?php print $front_page; ?>"><?php print $site_name; ?></a>
          </h4>

        </div>
        <div class="ecl-col-sm ecl-footer__column">

          <?php print $ecl_menu_follow_us; ?>

        </div>
        <div class="ecl-col-sm ecl-footer__column">

          <?php print $ecl_menu_contact; ?>

        </div>
      </div>
    </div>
  </div>
  <div class="ecl-footer__site-corporate">
    <div class="ecl-container">
      <div class="ecl-row">
        <div class="ecl-col-sm ecl-footer__column">

          <?php print $ecl_menu_nsf; ?>

        </div>
        <div class="ecl-col-sm ecl-footer__column">

          <?php print $ecl_menu_nsm; ?>

        </div>
        <div class="ecl-col-sm ecl-footer__column">

          <?php print $ecl_menu_nil; ?>

        </div>
      </div>
    </div>
  </div>
  <div class="ecl-footer__ec">
    <div class="ecl-container">
      <div class="ecl-row">
        <div class="ecl-col-sm ">

          <?php print $ecl_menu_nsl; ?>

        </div>
      </div>
    </div>
  </div>
</footer>
