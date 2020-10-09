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
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $current_user, UserStorageInterface $user_storage, TransactionServiceInterface $transaction_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
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
    
     $target_user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  if ($last_transaction = \Drupal::service('transaction')
    ->getLastExecutedTransaction($target_user, 'userpoints_default_points')) {
    $currentpoints = $last_transaction->get('field_userpoints_default_balance')->getString();
  }

  if ($currentpoints < 100){
    $missingpoints = (100 - $currentpoints);
    $form_state->setErrorByName('renewal', $this->t('Sorry, you do not have enough credits on your account to renew your subscription. Your account has ' $missingpoints 'credits. Please visit the store and buy the necessary credits.' ));
  }

   }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array $form, FormStateInterface $form_state) {
    
  /** Deduct the credits from the user account.  */
    
  $target_user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  \Drupal\transaction\Entity\Transaction::create([
    'type' => 'userpoints_default_points',
    'target_entity' => $target_user,
    'field_userpoints_default_amount' => -100,
    'field_userpoints_default_reason' => '6 month Subscription for Group Manager',
  ])->execute();

  
  
  
   $form_state
      ->setRedirect('user.page'); 
    
  }

}

