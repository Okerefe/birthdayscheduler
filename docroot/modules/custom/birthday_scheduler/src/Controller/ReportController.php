<?php

declare(strict_types=1);
// -*- coding: utf-8 -*-
/*
 * This file is part of the Birthday Scheduler Drupal Module.
 *
 * (c) DeRavenedWriter <okerefe@gmail.com> for  Softescu <https://softescu.com/>
 *
 * @file
 * Contains \Drupal\birthday_scheduler\Controller\ReportController.
 */

namespace Drupal\birthday_scheduler\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

/**
 * Controller for RSVP List Report.
 *
 * This Class Generates the Report of Birthday Schedules.
 */
class ReportController extends ControllerBase {

  /**
   * Variable contains table name for birthday_scheduler.
   *
   * @var string Contains Constant for Search str
   */
  const TABLE_NAME = 'birthday_schedules';

  /**
   * A Getter method for: Drupal::getConnection()->select(TABLE_NAME, 'alias')
   *
   * Created To Make Code Testable.
   *
   * @param array $columns
   *   Contains the Columns of the table that are needed.
   *
   * @return object[]
   *   Returns an array of Birthday Objects.
   */
  public function birthdaysFromDB(array $columns) : array {
    return Database::getConnection()->select(self::TABLE_NAME, 's')
      ->fields('s', $columns)
      ->execute()->fetchAll(\PDO::FETCH_OBJ);
  }

  /**
   * Creates the page Containing Birthday Schedules.
   *
   * @return array
   *   Render array for report output.
   */
  public function report() {
    $birthdays = $this->birthdaysFromDB(
      ['id', 'first_name', 'last_name', 'dob', 'mail', 'created']
    );

    $content = [
      '#theme' => 'birthday_schedules',
      '#birthdays' => $birthdays,
    ];
    $content['#cache']['max-age'] = 0;
    return $content;
  }

}
