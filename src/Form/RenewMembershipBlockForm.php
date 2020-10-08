<?php

namespace Drupal\bic_transactions\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * RenewMembershipBlock form
 */
class RenewMembershipBlockForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'renew_membership_block_form';
  }
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    // Checkbox for renewal of subscription
    $form['renewal'] = [
      '#type' => 'checkbox',
      '#title' => $this
    ->t('Renew your subscription'),
      '#description' => $this->t('When checking the box and clicking the button, 100 credits will be deducted from your account and your subscription will be renewed for 6 month.'),
    ];

    // Submit.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Renew subscription'),
    ];

    return $form;
  }

  
    /**
   * {@inheritdoc}
   */
  public function validateForm(FormStateInterface $form_state) {
    $renewal = $form_state->getValue('renewal');
    if (isEmpty($renewal)) {
      $form_state->setErrorByName('renewal', $this->t('Please check the box before submitting your order.'));
    }

   }

  /**
   * {@inheritdoc}
   */
  public function submitForm(FormStateInterface $form_state) {
    
  }

}

