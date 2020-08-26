<?php
return [
    'adminEmail' => 'support@theclubofcashback.com',
    'supportEmail' => 'service@theclubofcashback.com',
    'senderEmail' => 'noreply@theclubofcashback.com',
    'senderName' => 'CashBackClub',
    'user.passwordResetTokenExpire' => 3600,
    'admin.passwordResetTokenExpire' => 3600,
    'order.Expire' => 1,
    'order_prefix' => 'TF',
    'ip_api' => 'http://ip-api.com/json',
    'order_status' => [
        1 => 'Purphase & Submit order info',
        2 => 'Order Submitted & Wait for Check',
        3 => 'Order Checked & Wait for Cashback',
        4 => 'Refunded',
        6 => 'Give Up',
        7 => 'Deal Time Out'
    ],
];
