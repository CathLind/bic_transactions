<?php

namespace Drupal\bic_transactions\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'renew_membership_block';
     $build['renew_membership_block']['#markup'] = 'Implement RenewMembershipBlock.';

    return $build;
  }

}
