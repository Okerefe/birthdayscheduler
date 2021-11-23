<?php

declare(strict_types=1);
// -*- coding: utf-8 -*-
/*
 * This file is part of the Birthday Scheduler Drupal Module.
 *
 * (c) DeRavenedWriter <okerefe@gmail.com> for  Softescu <https://softescu.com/>
 *
 */

namespace Drupal\Tests\birthday_scheduler\Unit\Form;

use Drupal\birthday_scheduler\Form\BirthdaySchedulerForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Tests\birthday_scheduler\BirthdaySchedulerTest;
use Brain\Monkey\Functions;

/**
 * @author  DeRavenedWriter <deravenedwriter@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-2.0.txt
 */
final class BirthdaySchedulerFormTest extends BirthdaySchedulerTest {

  /**
   * @test
   */
  public function correct_form_id_is_returned() {
    $this->assertSame('birthday_scheduler_email_form', (new BirthdaySchedulerForm)->getFormId());
  }

  /**
   * @test
   */
  public function build_form_returns_array() {
    $request = $this->getMockBuilder(BirthdaySchedulerForm::class)
      ->getMock();

    $form_state = $this->getMockBuilder(FormStateInterface::class)->getMock();

    $response = (new BirthdaySchedulerForm)->buildForm([], $form_state);

    $this->assertArrayHasKey('first_name', $response);
    $this->assertArrayHasKey('last_name', $response);
    $this->assertArrayHasKey('email', $response);
    $this->assertArrayHasKey('dob', $response);
    $this->assertArrayHasKey('submit', $response);
  }

  /**
   * @test
   */
  public function email_validation_fails_for_wrong_email_format() {

    $form_state = $this->getMockBuilder(FormStateInterface::class)
      ->onlyMethods(['getValue', 'setErrorByName'])
      ->getMockForAbstractClass();

    $form = $this->getMockBuilder(BirthdaySchedulerForm::class)
      ->onlyMethods(['emailValidator'])
      ->getMock();

    $form_state->expects($this->once())
      ->method('getValue')
      ->with('email')
      ->willReturn('wrongformat');

    $form_state->expects($this->once())
      ->method('setErrorByName')
      ->with('email', 'The email address wrongformat is not valid.')
      ->willReturn('wrongformat');

    $form->expects($this->once())
      ->method('emailValidator')
      ->with('wrongformat')
      ->willReturn(FALSE);

    Functions\expect('t')
      ->once()
      ->with('The email address %mail is not valid.', ['%mail' => 'wrongformat'])
      ->andReturn('The email address wrongformat is not valid.');

    $arr = [];
    $form->validateForm($arr, $form_state);

  }

  /**
   * @test
   */
  public function email_validation_succeeds_for_correct_email_format() {

    $form_state = $this->getMockBuilder(FormStateInterface::class)
      ->onlyMethods(['getValue'])
      ->getMockForAbstractClass();

    $form = $this->getMockBuilder(BirthdaySchedulerForm::class)
      ->onlyMethods(['emailValidator'])
      ->getMock();

    $form_state->expects($this->once())
      ->method('getValue')
      ->with('email')
      ->willReturn('correct@email.com');

    $form->expects($this->once())
      ->method('emailValidator')
      ->with('correct@email.com')
      ->willReturn(TRUE);

    $arr = [];
    $form->validateForm($arr, $form_state);

  }

  /**
   * @test
   */
  public function submit_form_inserts_to_db() {

    $form_state = $this->getMockBuilder(FormStateInterface::class)
      ->onlyMethods(['getValue'])
      ->getMockForAbstractClass();

    $form = $this->getMockBuilder(BirthdaySchedulerForm::class)
      ->onlyMethods(['insertToBirthdaySchedulerTable', 'notifyTransactionStatus'])
      ->getMock();

    $form_state->expects($this->exactly(5))
      ->method('getValue')
      ->withConsecutive(
        ['first_name'],
        ['last_name'],
        ['email'],
        ['dob'],
        ['first_name']
      )
      ->willReturnOnConsecutiveCalls('john','doe','doe@john.com','1999/12/10','john');

    $form->expects($this->once())
      ->method('insertToBirthdaySchedulerTable')
      ->with(['first_name' => 'john','last_name' => 'doe','mail' => 'doe@john.com','dob' => '1999/12/10', 'created' => time()]);

    $form->expects($this->once())
      ->method('notifyTransactionStatus')
      ->with('john');

    $arr = []; //array is passed in reference so we must declare array first.
    $form->submitForm($arr, $form_state);

  }

  /**
   * @test
   */
  public function submit_form_handles_exception_properly() {
    $form_state = $this->getMockBuilder(FormStateInterface::class)
      ->onlyMethods(['getValue'])
      ->getMockForAbstractClass();

    $form = $this->getMockBuilder(BirthdaySchedulerForm::class)
      ->onlyMethods(['insertToBirthdaySchedulerTable', 'notifyTransactionStatus'])
      ->getMock();

    $form_state->expects($this->exactly(5))
      ->method('getValue')
      ->withConsecutive(
        ['first_name'],
        ['last_name'],
        ['email'],
        ['dob'],
        ['first_name']
      )
      ->willReturnOnConsecutiveCalls('john','doe','doe@john.com','1999/12/10','john');

    $form->expects($this->once())
      ->method('insertToBirthdaySchedulerTable')
      ->willThrowException(new \Exception("There was an error in DB Transaction"));

    $form->expects($this->once())
      ->method('notifyTransactionStatus')
      ->with('john', FALSE);

    $arr = []; //array is passed in reference so we must declare array first.
    $form->submitForm($arr, $form_state);

  }

}
