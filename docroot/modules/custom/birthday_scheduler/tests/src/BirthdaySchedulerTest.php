<?php

declare(strict_types=1);
// -*- coding: utf-8 -*-
/*
 * This file is part of the Birthday Scheduler Drupal Module.
 *
 * (c) DeRavenedWriter <okerefe@gmail.com> for  Softescu <https://softescu.com/>
 *
 */

namespace Drupal\Tests\birthday_scheduler;

use Drupal\Tests\UnitTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;

/**
 * @author  DeRavenedWriter <deravenedwriter@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-2.0.txt
 */
class BirthdaySchedulerTest extends UnitTestCase {
  use MockeryPHPUnitIntegration;

  /**
   *
   */
  protected function setUp(): void {
    parent::setUp();
    Monkey\setUp();
  }

  /**
   *
   */
  protected function tearDown(): void {
    Monkey\tearDown();
    parent::tearDown();
  }

  /**
   * @test */
  public function preventTestWarning() {
    $this->assertSame('idontwantwarnings', 'idontwantwarnings');
  }

}
