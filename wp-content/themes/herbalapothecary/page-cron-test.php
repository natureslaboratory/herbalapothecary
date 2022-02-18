<?php

/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

get_header();

ha_cron_exec_new();

set_capsule_stock();

// ha_update_stock();

get_footer();
