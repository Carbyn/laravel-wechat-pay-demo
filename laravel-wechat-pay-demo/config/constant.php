<?php

// ORDER STATUS
defined('ORDER_STATUS_USERPAYING') or define('ORDER_STATUS_USERPAYING', 0); // 用户支付中
defined('ORDER_STATUS_REVOKED') or define('ORDER_STATUS_REVOKED', 1);       // 已撤销（刷卡支付）
defined('ORDER_STATUS_CLOSED') or define('ORDER_STATUS_CLOSED', 2);         // 已关闭
defined('ORDER_STATUS_NOTPAY') or define('ORDER_STATUS_NOTPAY', 3);         // 未支付
defined('ORDER_STATUS_REFUND') or define('ORDER_STATUS_REFUND', 4);         // 转入退款
defined('ORDER_STATUS_PAYERROR') or define('ORDER_STATUS_PAYERROR', 5);     // 支付失败
defined('ORDER_STATUS_SUCCESS') or define('ORDER_STATUS_SUCCESS', 6);       // 支付成功
