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
   * User storage.
   *
   * @var \Drupal\user\UserStorageInterface
   */
  protected $userStorage;

    /**
   * The transaction service.
   *
   * @var \Drupal\transaction\TransactionServiceInterface
   */
  protected $transactionService;

    /**
   * Create a user renewal block.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   The current user object.
   * @param \Drupal\user\UserStorageInterface $user_storage
   *   The current user object.
   * @param \Drupal\transaction\TransactionServiceInterface $transaction_service
   *   The current user object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $current_user, UserStorageInterface $user_storage, TransactionServiceInterface $transaction_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
    $this->userStorage = $user_storage;
    $this->transactionService = $transaction_service;
  }

  

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
      '#return_value' => 'renewed_subscription',
      '#default_value' => NULL,
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
  public function validateForm(array $form, FormStateInterface $form_state) {
    $renewal = $form_state->getValue('renewal');
    if (isEmpty($renewal)) {
      $form_state->setErrorByName('renewal', $this->t('Please check the Renew-box before submitting your order.'));
    }

   }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array $form, FormStateInterface $form_state) {
    
  $account = $this->userStorage
      ->load($form_state
      ->get('uid'));  
    
    
/**
 $target_user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  if ($last_transaction = \Drupal::service('transaction')
    ->getLastExecutedTransaction($target_user, 'userpoints_default_points')) {
    $currentpoints = $last_transaction->get('field_userpoints_default_balance')->getString();
  }
**/
  
  
  
   $form_state
      ->setRedirect('user.page'); 
    
  }

}

