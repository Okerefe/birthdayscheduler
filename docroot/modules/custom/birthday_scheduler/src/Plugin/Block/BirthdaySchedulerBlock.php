<?php

declare(strict_types=1);
// -*- coding: utf-8 -*-
/**
 * This file is part of the Birthday Scheduler Drupal Module.
 *
 * (c) DeRavenedWriter <okerefe@gmail.com> for  Softescu <https://softescu.com/>
 *
 * @file
 * Contains \Drupal\birthday_scheduler\Plugin\Block\BirthdaySchedulerBlock
 */
namespace Drupal\birthday_scheduler\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Handles generation of the Birthday_Scheduler Custom Block.
 *
 * @Block(
 *   id = "birthday_scheduler_block",
 *   admin_label = @Translation("Birthday Scheduler"),
 *   category = @Translation("Blocks")
 * )
 */
class BirthdaySchedulerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\birthday_scheduler\Form\BirthdaySchedulerForm');
  }

  /**
   * {@inheritdoc}
   */
  public function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'view birthdayform');
  }

}
