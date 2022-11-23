<?php
return [
    'status' => [
        '' => 'Select Status',
        1 => 'Active',
        0 => 'Inactive'
    ],

    'municipality' => [
        'types' => [
            1 => 'महानगरपालिका',
            2 => 'उपमहानगरपालिका',
            3 => 'नगरपालिका',
            4 => 'गाउँपालिका'
        ]
    ],
    'backups' => [
        '' => 'Never',
        '1' => "Daily",
        '7' => 'Weekly',
        '30' => 'Monthly'
    ],
    'interval' => [
        '0' => 'Select',
        '1' => 'Day',
        '7' => 'Week',
        '30' => 'Month',
        '90' => '3 Months',
        '180' => '6 Months',
        '365' => 'Yearly'
    ],
];
