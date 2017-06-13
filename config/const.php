<?php

return array(
    // メンバー状態
    'STATE_NONE'    => 0,
    'STATE_REQUEST' => 1,
    'STATE_REFUSE'  => 2,
    'STATE_JOIN'    => 3,
    
    // 収支種別
    'TYPE_INCOME'   => 0,
    'TYPE_SPENDING' => 1,
    
    // 収支カテゴリ
    'CATEGORY_MEMBER_INCOME'    => 0,   // 会費
    'CATEGORY_EXTRA_INCOME'     => 1,   // 臨時収入
    'CATEGORY_SUPPLIES_EXPENSE' => 2,   // 消耗品費
    'CATEGORY_USAGE_FEE'        => 3,   // 利用費
    'CATEGORY_ENTRY_FEE'        => 4,   // 参加費
    
    // 収支カテゴリ名
    'CATEGORY_NAME'=>array(
        "会費",             // 0
        "臨時収入",         // 1
        "消耗品費",         // 2
        "利用費",           // 3
        "イベント参加費",   // 4
    ),
);
