<?php

declare(strict_types=1);
// -*- coding: utf-8 -*-
/*
 * This file is part of the Birthday Scheduler Drupal Module.
 *
 * (c) DeRavenedWriter <okerefe@gmail.com> for  Softescu <https://softescu.com/>
 *
 */

namespace Drupal\birthday_scheduler\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Generates and Processes the Birthday form.
 *
 * The Class Handles Generation, Validation and Saving of the Birthday Form.
 */
class BirthdaySchedulerForm extends FormBase {

  /**
   * Variable contains table name for birthday_scheduler.
   *
   * @var string Contains Constant for Search str
   */
  const TABLE_NAME = 'birthday_schedules';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'birthday_scheduler_email_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['first_name'] = [
      '#title' => t('First Name'),
      '#type' => 'textfield',
      '#size' => 25,
      '#description' => t("First Name Of Individual"),
      '#required' => TRUE,
    ];
    $form['last_name'] = [
      '#title' => t('Last Name'),
      '#type' => 'textfield',
      '#size' => 25,
      '#description' => t("Last Name Of Individual"),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#title' => t('Email address'),
      '#type' => 'textfield',
      '#size' => 25,
      '#description' => t("Email Address for Updates"),
      '#required' => TRUE,
    ];
    $form['dob'] = [
      '#title' => t('Date Of Birth'),
      '#type' => 'date',
      '#size' => 10,
      '#description' => t("Individual's Date Of Birth"),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];
    return $form;
  }

  /**
   * A Getter method for the Drupal::service('email.validator')->isValid.
   *
   * Created To Make Code Testable.
   *
   * @param string $email
   *   Email value to undergo validation.
   *
   * @return bool
   *   returns true or false based on email validity.
   */
  public function emailValidator($email) : bool {
    return \Drupal::service('email.validator')->isValid($email);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $value = $form_state->getValue('email');
    if ($value == !$this->emailValidator($value)) {
      $form_state->setErrorByName('email', t('The email address %mail is not valid.', ['%mail' => $value]));
      return;
    }
  }

  /**
   * A Setter function for the Drupal::database()->insert().
   *
   * Created To Make Code Testable.
   *
   * @param array $arr
   *   An array of values that contains Birthday Info to be saved.
   *
   * @return mixed
   *   The last insert ID of the query, if one exists. If the query was given
   *   multiple sets of values to insert, the return value is undefined. If no
   *   fields are specified, this method will do nothing and return NULL. That
   *   That makes it safe to use in multi-insert loops.
   *
   * @throws \Exception
   *   Throws an exception if something goes wrong with the Insert Operation.
   */
  public function insertToBirthdaySchedulerTable(array $arr = []) {
    return \Drupal::database()->insert(self::TABLE_NAME)
      ->fields($arr)
      ->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    try {
      $this->insertToBirthdaySchedulerTable([
        'first_name' => $form_state->getValue('first_name'),
        'last_name' => $form_state->getValue('last_name'),
        'mail' => $form_state->getValue('email'),
        'dob' => $form_state->getValue('dob'),
        'created' => time(),
      ]);
      $this->notifyTransactionStatus($form_state->getValue('first_name'), TRUE);
    }
    catch (\Exception $e) {
      $this->notifyTransactionStatus($form_state->getValue('first_name'), FALSE);
    }
  }

  /**
   * A Setter method for the Drupal::messenger()->addMessage().
   *
   * Sends Status Report on Birthday saving transaction to User.
   * Created to make Code Testable.
   *
   * @param string $name
   *   Contains the First Name of the User that will receive the Notification.
   * @param bool $success
   *   Contains a True|False Value based on the Status of the DB Transaction.
   */
  public function notifyTransactionStatus(string $name, bool $success = TRUE) {
    if ($success) {
      \Drupal::messenger()->addMessage(
        t('Hello %name. Thank you for Using Our Scheduler, your birthday has been registered.', ['%name' => $name])
      );
    }
    else {
      \Drupal::messenger()->addMessage(
        t('Dear %name. There was an Error when trying to save your Birthday Details please try again later.', ['%name' => $name]), 'error'
      );
    }
  }

}
