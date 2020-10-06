<?php

/**
 * @file
 * Contains bic_transactions\bic_transactions.views.inc..
 * Provide a custom views field data that isn't tied to any other module. */


/**
* Implements hook_views_data().
*/
function bic_transactions_views_data() {

    $data['views']['table']['group'] = t('Custom Global');
    $data['views']['table']['join'] = [
      // #global is a special flag which allows a table to appear all the time.
      '#global' => [],
    ];

    $data['views']['authenticate_group_member'] = [
        'title' => t('Authenticate group member'),
        'help' => t('PHP Script for authenticate group member'),
        'field' => [
            'id' => 'authenticate_group_member',
        ],
    ];
    $data['views']['extend_group_membership'] = [
        'title' => t('Extend group membership'),
        'help' => t('PHP script for extrending the membership for an active and existing member'),
        'field' => [
            'id' => 'extend_group_membership',
        ],
    ];
    $data['views']['renew_group_manager'] = [
        'title' => t('Renew group manager'),
        'help' => t('PHP script for renewing the membership for a expried group manager'),
        'field' => [
            'id' => 'renew_group_manager',
        ],
    ];
    return $data;
}
