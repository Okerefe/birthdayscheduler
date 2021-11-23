<?php

/**
 * @file
 * Contains Import For PatchWork.
 *
 * For tests to function well, Patchwork needs to
 * be imported before Drupal Core is bootstrapped
 * So as to enable functions mocked with Brain Monkey (which uses patchwork)
 * work properly.
 */

// Import PatchWork from Vendor Folder.
require_once __DIR__ . '/../../../../../vendor/antecedent/patchwork/Patchwork.php';
