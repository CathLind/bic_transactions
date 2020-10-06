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
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\transaction\TransactionServiceInterface $transaction_service
   *   The transaction service.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, TransactionServiceInterface $transaction_service) {
    $this->entityTypeManager = $entity_type_manager;
    $this->transactionService = $transaction_service;
  }

  /**
   * {@inheritdoc}
   */
  public function getCurrentState($entity, $transaction_type) {
    if ($last_transaction = $this->transactionService->getLastExecutedTransaction($entity, $transaction_type)) {
      $settings = $last_transaction->getType()->getPluginSettings();
      return $last_transaction->get($settings['state'])->value;
    }

    return FALSE;
  }


  
  
  
  
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
