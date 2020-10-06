<?php

namespace Drupal\bic_transactions\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBuilderInterface;
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
    $build = [];
    $build['#theme'] = 'renew_membership_block';
     $build['renew_membership_block']['#markup'] = 'Implement RenewMembershipBlock.';

    return $build;
  }

}
