<?php

namespace Drupal\bic_transactions\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\transaction\TransactionServiceInterface;
use Drupal\transaction\Plugin\Transaction\BalanceTransactor;
use Drupal\transaction\TransactionInterface;
use Drupal\transaction\TransactionTypeInterface;
use Drupal\user\Entity\Role;
use Drupal\user\RoleInterface;



/**
 * Provides a 'RenewMembershipBlock' block.
 *
 * @Block(
 *  id = "renew_membership_block",
 *  admin_label = @Translation("Renew membership block"),
 * )
 */
class RenewMembershipBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
 $target_user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  if ($last_transaction = \Drupal::service('transaction')
    ->getLastExecutedTransaction($target_user, 'userpoints_default_points')) {
    $currentpoints = $last_transaction->get('field_userpoints_default_balance')->getString();
  }
**/
  
  
  
  
  /**
   * {@inheritdoc}
   */
  public function build() {
 // Return the form @ Form/RenewMembershipBlockForm.php.
    return \Drupal::formBuilder()->getForm('Drupal\bic_transactions\Form\RenewMembershipBlockForm');
  }

  
    /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    return $form;
  }
  
 /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('renew_membership_block_settings', $form_state->getValue('renew_membership_block_settings'));
  }
  
  
}
