<?php

/**
 * Implements template_preprocess_page().
 */
function YOUR_THEME_preprocess_page(&$variables) {

  // Load ECL css.
  libraries_load('ecl');

  // Define menus and blocks for use in page.tpl.php.
  $easy_breadcrumb = module_invoke('easy_breadcrumb', 'block_view', 'easy_breadcrumb');
  $variables['easy_breadcrumb'] = render($easy_breadcrumb['content']);
  $variables['language_selector'] = _YOUR_THEME_language_selector();
  $search_form = drupal_get_form('nexteuropa_europa_search_search_form');
  $variables['search_form'] = render($search_form);

  $variables['ecl_menu_u'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('user-menu'),
    'attributes' => [
      'id' => 'user-menu-links',
      'class' => [
        'ecl-navigation-list',
        'ecl-navigation-list--small',
      ],
    ],
    'heading' => [
      'text' => t('User menu'),
      'level' => 'h2',
      'class' => ['ecl-u-sr-only'],
    ],
  ]);

  $variables['ecl_menu_nsf'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-nexteuropa-site-links'),
    'attributes' => [
      'id' => 'ecl-site-switcher-footer',
      'class' => ['ecl-footer__menu'],
    ],
    'heading' => [
      'text' => t('European Commission'),
      'level' => 'h4',
      'class' => [
        'ecl-h4',
        'ecl-footer__title',
      ],
    ],
  ]);

  $variables['ecl_menu_nsh'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-nexteuropa-site-links'),
    'attributes' => [
      'id' => 'ecl-site-switcher-header',
      'class' => [
        'ecl-site-switcher__list',
        'ecl-container',
      ],
    ],
  ]);

  $variables['ecl_menu_follow_us'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-ecl-follow-us'),
    'attributes' => [
      'id' => 'menu-ecl-follow-us',
      'class' => [
        'ecl-footer__menu',
        'ecl-list--inline',
        'ecl-footer__social-links',
      ],
    ],
    'heading' => [
      'text' => t('Follow us:'),
      'level' => 'p',
      'class' => [
        'ecl-footer__label',
      ],
    ],
  ]);

  $variables['ecl_menu_contact'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-ecl-contact'),
    'attributes' => [
      'id' => 'menu-ecl-contact',
      'class' => [
        'ecl-footer__menu',
        'ecl-list--unstyled',
      ],
    ],
  ]);

  $variables['ecl_menu_nsm'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-nexteuropa-social-media'),
    'attributes' => [
      'id' => 'menu-nexteuropa-social-media',
      'class' => [
        'ecl-footer__menu',
        'ecl-list--inline',
        'ecl-footer__social-links',
      ],
    ],
    'heading' => [
      'text' => t('Follow the European Commission'),
      'level' => 'h4',
      'class' => [
        'ecl-h4',
        'ecl-footer__title',
      ],
    ],
  ]);

  $variables['ecl_menu_nil'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-nexteuropa-inst-links'),
    'attributes' => [
      'id' => 'menu-nexteuropa-inst-links',
      'class' => [
        'ecl-footer__menu',
      ],
    ],
    'heading' => [
      'text' => t('European Union'),
      'level' => 'h4',
      'class' => [
        'ecl-h4',
        'ecl-footer__title',
      ],
    ],
  ]);

  $variables['ecl_menu_nsl'] = theme('links__ecl_menus', [
    'links' => menu_navigation_links('menu-nexteuropa-service-links'),
    'attributes' => [
      'id' => 'menu-nexteuropa-service-links',
      'class' => [
        'ecl-list--inline',
        'ecl-footer__menu',
      ],
    ],
  ]);
}

/**
 * File contains theme functions for implementation of the Improved layer.
 */

/**
 * Implements hook_css_alter().
 *
 * Load europa.css at the end.
 */
function YOUR_THEME_css_alter(&$css) {
  foreach ($css as $css_key => $css_data) {
    if (strpos($css_key, 'ecl/styles/europa.css') !== FALSE) {
      $css[$css_key]['group'] = 300;
      $css[$css_key]['weight'] = 100;
    }
  }
}

/**
 * Implements hook_theme().
 *
 * Define custom theme callback so to remove div wrapper within the form.
 */
function YOUR_THEME_theme() {
  return array(
    'ecl_search_form_wrapper' => array(
      'render element'  => 'element',
    ),
  );
}

/**
 * Theme wrapper callback.
 */
function YOUR_THEME_ecl_search_form_wrapper($variables) {
  return $variables['element']['#children'];
}


/**
 * Implements theme_button().
 */
function YOUR_THEME_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  if (isset($element['#ecl-buttontype']) && ($key = array_search('btn-search', $element['#attributes']['class'])) !== FALSE) {
    unset($element['#attributes']['class'][$key]);
  }

  element_set_attributes($element, array('id', 'name', 'value'));
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  // Improved layer: Add ECL button classes.
  if (isset($element['#ecl-buttontype']) && $element['#ecl-buttontype'] == 'button') {
    $element['#attributes']['class'][] = 'ecl-button';
    $element['#attributes']['class'][] = 'ecl-button--form';
    $element['#attributes']['class'][] = 'ecl-search-form__button';
    $value = $element['#value'];
    unset($element['#attributes']['value']);
    return '<button' . drupal_attributes($element['#attributes']) . '>' . filter_xss_admin($value) . '</button>';
  }
  else {
    return '<input' . drupal_attributes($element['#attributes']) . ' />';
  }
}

/**
 * Theme function for the breadcrumb.
 *
 * @param Assoc $variables
 *   arguments
 *
 * @return string
 *   HTML for the themed breadcrumb.
 */
function YOUR_THEME_easy_breadcrumb($variables) {

  $breadcrumb = $variables['breadcrumb'];
  $segments_quantity = $variables['segments_quantity'];

  $breadcrumb_items = [];
  $link_options = [
    'attributes' => [
      'class' => [
        'ecl-breadcrumbs__link',
      ],
    ],
    'html' => TRUE
  ];

  if ($segments_quantity > 0) {

    for ($i = 0, $s = $segments_quantity - 1; $i < $segments_quantity; ++$i) {
      $it = $breadcrumb[$i];
      $content = decode_entities($it['content']);
      if (isset($it['url'])) {
        $breadcrumb_item = [
          'data' => l($content, $it['url'], $link_options),
          'class' => [
            'ecl-breadcrumbs__segment',
          ],
        ];
      } else {
        $breadcrumb_item = [
          'data' => filter_xss($content),
          'class' => [
            'ecl-breadcrumbs__segment',
          ],
        ];
      }
      if ($i == $segments_quantity) {
        $breadcrumb_item['class'][] = 'ecl-breadcrumbs__segment--last';
      }

      $breadcrumb_items[] = $breadcrumb_item;
    }
  }

  $items = [
    'items' => $breadcrumb_items,
    'type' => 'ol',
    'attributes' => [
      'class' => [
        'ecl-breadcrumbs__segments-wrapper',
      ],
    ],
  ];

  return theme('item_list', $items);

}

/**
 * Implements theme_textfield().
 */
function YOUR_THEME_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array(
    'id',
    'name',
    'value',
    'size',
    'maxlength',
  ));
  _form_set_class($element, array(
    'form-text',
  ));
  $extra = '';

  // Improved layer: Unset class .form-control from Bootstrap.
  if (isset($element['#attributes']['class'])) {
    if (in_array('ecl-search-form__textfield', $element['#attributes']['class'])) {
      foreach ($element['#attributes']['class'] as $key => $value) {
        if ($value == 'form-control') {
          unset($element['#attributes']['class'][$key]);
        }
      }
    }
  }
  if ($element['#autocomplete_path'] && !empty($element['#autocomplete_input'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';
    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#autocomplete_input']['#id'];
    $attributes['value'] = $element['#autocomplete_input']['#url_value'];
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }

  // Improved layer: Wrap search form textfield with label.
  if (isset($element['#attributes']['class']) && in_array('ecl-search-form__textfield', $element['#attributes']['class'])) {
    $output = '<label class="ecl-search-form__textfield-wrapper"><span class="ecl-u-sr-only">';
    $output .= t('Search this website');
    $output .= '</span>';
    $output .= '<input' . drupal_attributes($element['#attributes']) . ' />';
    $output .= '</label>';
  }
  else {
    $output = '<input' . drupal_attributes($element['#attributes']) . ' />';
  }
  return $output . $extra;
}

/**
 * Implements theme_links__context().
 */
function YOUR_THEME_links__ecl_menus($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    $ecl_classes = _YOUR_THEME_ecl_menu_link_classes($attributes);

    foreach ($links as $link) {
      $class = $ecl_classes['li_class'];
      $link['attributes']['class'] = $ecl_classes['a_class'];
      $link['html'] = TRUE;

      // Add first, last and active classes to the list of links to help out
      // themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
        if ($attributes['id'] == 'ecl-site-switcher-header') {
          $class[] = 'ecl-site-switcher__option--is-selected';
        }
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
        && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for
        // adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}


/**
 * Implements theme_form().
 *
 * Remove form div wrapper.
 */
function YOUR_THEME_form($variables) {
  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }
  return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>';
}



/**
 * @param array $attributes
 *    Menu attributes.
 *
 * return array
 *    Menu link options.
 */
function _YOUR_THEME_ecl_menu_link_classes($attributes = array()) {
  if (isset($attributes['id'])) {
    $classes = [
      'li_class',
      'a_class',
    ];
    switch ($attributes['id']) {
      case 'user-menu-links':
        $classes = [
          'li_class' => [
            'ecl-navigation-list__item',
          ],
          'a_class' => [
            'ecl-navigation-list__link',
            'ecl-link',
          ],
        ];
        break;

      case 'ecl-site-switcher-header':
        $classes = [
          'li_class' => [
            'ecl-site-switcher__option',
          ],
          'a_class' => [
            'ecl-site-switcher__link',
            'ecl-link',
          ],
        ];
        break;

      case 'ecl-site-switcher-footer':
      case 'menu-ecl-follow-us':
      case 'menu-follow-us':
      case 'menu-ecl-contact':
      case 'menu-nexteuropa-service-links':
      case 'menu-nexteuropa-inst-links':
      case 'menu-nexteuropa-social-media':
        $classes = [
          'li_class' => [
            'ecl-footer__menu-item',
          ],
          'a_class' => [
            'ecl-link',
            'ecl-footer__link',
          ],
        ];
        break;

    }
    return $classes;
  }
}

/**
 * Generate HTML for language selector.
 *
 * @return string
 *    HTML.
 */
function _YOUR_THEME_language_selector() {
  $content = language_selector_site_block_content();
  // Initialize variables.
  $code = '<span class="ecl-lang-select-sites__code">' .
    '<span class="ecl-icon ecl-icon--language ecl-lang-select-sites__icon"></span>' .
    '<span class="ecl-lang-select-sites__code-text">' . render($content['code']) . '</span>' .
    '</span>';
  $label = '<span class="ecl-lang-select-sites__label">' . render($content['label']) . '</span>';
  $options = array(
    'html' => TRUE,
    'attributes' => array(
      'class' => array('ecl-lang-select-sites__link'),
    ),
    'query' => array(drupal_get_destination()),
  );

  // Add content to block.
  return l($label . $code, 'language-selector/site-language', $options);
}