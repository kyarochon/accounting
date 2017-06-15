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
    'CATEGORY_ENTRY_INCOME'     => 1,   // 参加費
    'CATEGORY_EXTRA_INCOME'     => 2,   // 臨時収入
    'CATEGORY_SUPPLIES_EXPENSE' => 3,   // 消耗品費
    'CATEGORY_USAGE_FEE'        => 4,   // 利用費
    'CATEGORY_ENTRY_FEE'        => 5,   // 参加費
    
    'INCOME_CATEGORIES'     => array(0, 1, 2),
    'SPENDING_CATEGORIES'   => array(3, 4, 5),

    // 収支カテゴリ名
    'CATEGORY_NAME'=>array(
        "入会費",           // 0
        "参加費",           // 1
        "臨時収入",         // 2
        "消耗品費",         // 3
        "利用費",           // 4
        "イベント参加費",   // 5
    ),
);
