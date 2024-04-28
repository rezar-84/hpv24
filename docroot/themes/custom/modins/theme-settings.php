<?php
use Drupal\Core\Extension\Extension;
use Drupal\Core\Extension\ExtensionDiscovery;

use Drupal\system\Controller\ThemeController;
use Drupal\Core\Theme\ThemeManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Implementation of hook_form_system_theme_settings_alter()
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 *
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function modins_form_system_theme_settings_alter(&$form, &$form_state) {
	$form['#attached']['library'][] = 'modins/modins-admin';  
	// Get the build info for the form
	$build_info = $form_state->getBuildInfo();
	// Get the theme name we are editing
	$theme = \Drupal::theme()->getActiveTheme()->getName();
	// Create Omega Settings Object

	$form['core'] = array(
		'#type' => 'vertical_tabs',
		'#attributes' => array('class' => array('entity-meta')),
		'#weight' => -899
	);

	$form['theme_settings']['#group'] = 'core';
	$form['logo']['#group'] = 'core';
	$form['favicon']['#group'] = 'core';

	$form['theme_settings']['#open'] = FALSE;
	$form['logo']['#open'] = FALSE;
	$form['favicon']['#open'] = FALSE;
	
	// Custom settings in Vertical Tabs container
	$form['options'] = array(
		'#type' => 'vertical_tabs',
		'#attributes' => array('class' => array('entity-meta')),
		'#weight' => -999,
		'#default_tab' => 'edit-variables',
		'#states' => array(
			'invisible' => array(
			 ':input[name="force_subtheme_creation"]' => array('checked' => TRUE),
			),
		),
	);

	/* ---------- Setting Logo -------------- */
	$form['custom_logo'] = array(
		'#type' => 'details',
		'#attributes' => array(),
		'#title' => t('Logo options'),
		'#weight' => -999,
		'#group' => 'options',
		'#open' => FALSE,
	);

	$form['custom_logo']['logo_width'] = array(
		'#type' => 'textfield',
		'#title' => t('Width logo'),
		'#default_value' => theme_get_setting('logo_width') ? theme_get_setting('logo_width'): '',
		'#group' => 'custom_logo',
		'#description' => 'Set width of logo, example: 150px'
	); 

	$form['custom_logo']['logo_padding_top'] = array(
		'#type' => 'textfield',
		'#title' => t('Padding top logo'),
		'#default_value' => theme_get_setting('logo_padding_top'),
		'#group' => 'custom_logo',
		'#description' => 'Set space top of logo, example: 15px'
	); 

	$form['custom_logo']['logo_padding_bottom'] = array(
		'#type' => 'textfield',
		'#title' => t('Padding bottom logo'),
		'#default_value' => theme_get_setting('logo_padding_bottom'),
		'#group' => 'custom_logo',
		'#description' => 'Set space bottom of logo, example: 15px'
	); 

	/* --------- Setting general ----------------*/
	$form['general'] = array(
		'#type' => 'details',
		'#attributes' => array(),
		'#title' => t('Gerenal options'),
		'#weight' => -999,
		'#group' => 'options',
		'#open' => FALSE,
	);

	$form['general']['sticky_menu'] =array(
		'#type' => 'select',
		'#title' => t('Enable Sticky Menu'),
		'#default_value' => theme_get_setting('sticky_menu'),
		'#group' => 'general',
		'#options' => array(
			'0'        => t('Disable'),
			'1'        => t('Enable')
		 ) 
	); 
	
	$form['general']['site_layout'] = array(
		'#type' => 'select',
		'#title' => t('Body Layout'),
		'#default_value' => theme_get_setting('site_layout'),
		'#options' => array(
			'wide' => t('Wide (default)'),
			'boxed' => t('Boxed'),
		),
	);

	$form['general']['preloader'] = array(
		'#type' => 'select',
		'#title' => t('Preloader'),
		'#default_value' => theme_get_setting('preloader'),
		'#group' => 'options',
		'#options' => array(
			'0' => t('Disable'),
			'1' => t('Enable')
		),
	);
	
	$form['general']['google_key'] = array(
		'#type' => 'textfield',
		'#title' => t('Google Key'),
		'#default_value' => theme_get_setting('google_key'),
		'#group' => 'general',
	);

	/*--------- Setting Header ------------ */
	$form['header'] = array(
		'#type' => 'details',
		'#attributes' => array(),
		'#title' => t('Header options'),
		'#weight' => -998,
		'#group' => 'options',
		'#open' => FALSE,
	);

	$form['header']['default_header'] = array(
		'#type' => 'select',
		'#title' => t('Default Header'),
		'#default_value' => theme_get_setting('default_header'),
		'#options' => array(
			'header' => t('Header I'),
			'header-2' => t('Header II'),
			'header-3' => t('header III')
		),
	);

	$form['header']['link_request'] = array(
		'#type' => 'textfield',
	    '#title'  => t(' Get a Quote '),
	    '#default_value' => theme_get_setting('link_request'),
	);

	$form['header']['header_info'] = array(
		'#type' => 'textarea',
		'#title' => t('Header Information'),
		'#default_value' => theme_get_setting('header_info'),
		'#attributes' => array('rows' => '12' )
	);

	// User CSS --------------------------------------
	$form['options']['css_customize'] = array(
		'#type' => 'details',
		'#attributes' => array(),
		'#title' => t('Customize css'),
		'#weight' => -996,
		'#group' => 'options',
		'#open' => TRUE,
	);
	$form['customize']['customize_css'] = array(
		'#type' => 'textarea',
		'#title' => t('Add your own CSS'),
		'#group' => 'css_customize',
		'#attributes' => array('class' => array('code_css') ),
		'#default_value' => theme_get_setting('customize_css'),
	);
		
	//Customize color ----------------------------------
	$form['options']['settings_customize'] = array(
		'#type' => 'details',
		'#attributes' => array(),
		'#title' => t('Settings Customize'),
		'#weight' => -997,
		'#group' => 'options',
		'#open' => TRUE,
	);
	
	$form['options']['settings_customize']['settings'] = array(
		'#type' => 'details',
		'#open' => TRUE,
		'#attributes' => array(),
		'#title' => t('Cutomize Setting'),
		'#weight' => -999,
	);

	$form['options']['settings_customize']['settings']['enable_customize'] = array(
		'#type' => 'select',
		'#title' => t('Enable Display Cpanel Customize'),
		'#default_value' => theme_get_setting('enable_customize'),
		'#group' => 'settings',
		'#options' => array(
			'0'        => t('Disable'),
			'1'        => t('Enable'),
		),
	);

	$form['actions']['submit']['#value'] = t('Save');
} 
