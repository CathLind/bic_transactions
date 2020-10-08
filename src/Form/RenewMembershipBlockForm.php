<?php

namespace Drupal\bic_transactions\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\transaction\TransactionServiceInterface;
use Drupal\transaction\Plugin\Transaction\BalanceTransactor;
use Drupal\transaction\TransactionInterface;
use Drupal\transaction\TransactionTypeInterface;
use Drupal\user\Entity\Role;
use Drupal\user\RoleInterface;

/**
 * RenewMembershipBlock form
 */
class RenewMembershipBlockForm extends FormBase {
  
  /**
   * Drupal\Core\Session\AccountProxyInterface definition.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

    /**
   * The transaction service.
   *
   * @var \Drupal\transaction\TransactionServiceInterface
   */
  protected $transactionService;

  
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->currentUser = $container->get('current_user');
    return $instance;
  }


  
  
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
      '#description' => $this->t('When checking the box and clicking the button, 100 credits will be deducted from your account and your subscription will be renewed for 6 month. By checking the box you accept our terms of service.'),
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
      $form_state->setErrorByName('renewal', $this->t('Please check the Renew-box before submitting your order.'));
    }

   }

  /**
   * {@inheritdoc}
   */
  public function submitForm(FormStateInterface $form_state) {
    
    
    
    
/**
 $target_user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  if ($last_transaction = \Drupal::service('transaction')
    ->getLastExecutedTransaction($target_user, 'userpoints_default_points')) {
    $currentpoints = $last_transaction->get('field_userpoints_default_balance')->getString();
  }
**/
  
  
  
    
    
  }

}

