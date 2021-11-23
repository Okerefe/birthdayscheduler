<?php

declare(strict_types=1);
// -*- coding: utf-8 -*-
/*
 * This file is part of the Birthday Scheduler Drupal Module.
 *
 * (c) DeRavenedWriter <okerefe@gmail.com> for  Softescu <https://softescu.com/>
 *
 */

namespace Drupal\Tests\birthday_scheduler\Unit\Controller;

use Drupal\birthday_scheduler\Controller\ReportController;
use Drupal\Tests\birthday_scheduler\BirthdaySchedulerTest;


/**
 * @author  DeRavenedWriter <deravenedwriter@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-2.0.txt
 */
final class ReportControllerTest extends BirthdaySchedulerTest {

  /**
   * @test
   */
  public function report_function_returns_expected_data() {

    $report = $this->getMockBuilder(ReportController::class)
      ->onlyMethods(['birthdaysFromDB'])
      ->getMock();

    // Actual value that will be returned is a List of Birthday Objects
    // Here we just return a variable for simplicity
    // and to test that data is passed rightly.
    $report->expects($this->once())
      ->method('birthdaysFromDB')
      ->with(['id', 'first_name', 'last_name', 'dob', 'mail', 'created'])
      ->willReturn(["All is Good"]);



    $response = $report->report();
    $this->assertArrayHasKey('#theme', $response);
    $this->assertArrayHasKey('#birthdays', $response);
    $this->assertArrayHasKey('#cache', $response);

    $this->assertSame('birthday_schedules', $response['#theme']);
    $this->assertSame(["All is Good"], $response['#birthdays']);
    $this->assertSame(0, $response['#cache']['max-age']);

  }

}
