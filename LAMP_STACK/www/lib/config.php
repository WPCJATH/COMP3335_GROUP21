<?php

/**
 * A file to hold some constant configs.
 *
 * @return array
 *  The config defined here.
 */
function get_config(): array
{
    return [
        'session_key' => 'socjrhstcmtkshfeitnxhaweocgsiurk',
        'life_time' => 20 * 60,
        'read_raw_post' => false,

        'mysql_info' => [
            'host' => 'localhost',
            'database' => 'hotel',
            'computer_user' => 'computer',
            'computer_pass' => '12345678',
        ],

    ];
}
