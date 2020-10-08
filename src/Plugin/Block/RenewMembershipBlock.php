<?php

namespace Drupal\bic_transactions\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\ContentEntityInterface;




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
