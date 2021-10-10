<?php

return [
    // role based or permission based
    'admin_permission_type' => 'permission',
    'common' => [
        'comment_types' => array(
          'officer_to_officer',
          'lab_to_lab',
          'user_to_user',
          'officer_to_lab',
          'officer_to_user',
          'lab_to_officer',
          'user_to_officer',
          'system_to_user'
        ),
        'default_comment_type' => 'officer_to_officer',

        'levels' => array(
          'low',
          'hight',
          'important',
          'critical'
        ),
        'default_level' => 'low'
    ],
    'status' => array(
        'draft',
        'submitted',
        'resubmitted',
        'incomplete',
        'complete',
        'auto-cancelled',
        'accepted',
        'rejected',
        'approved',
        'license-approved',
        'under-assessment',
        'finalized',
        'trash',
        'withdrawn',
        'expired'
    ),
    'default_status' => 'draft',

    'application_type' => array(
      'amend',
      'new',
      'renew',
      'extension'
    ),
    'default_application_type' => 'new',

    'periods' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    'period_units' => ['Hour', 'Day', 'Week', 'Month', 'Year']
];
