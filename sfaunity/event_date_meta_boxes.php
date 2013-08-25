<?php 
$meta_box['post'] = array(
    'id' => 'expiration-date-meta-details',
    'title' => 'Expiration Date',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Month',
            'desc' => 'Enter the month in 2 digits (e.g. 08 for August)',
            'id' => 'expiration_date_month',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Day',
            'desc' => 'Enter the day in 2 digits (e.g. 16 for the 16th)',
            'id' => 'expiration_date_day',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Year',
            'desc' => 'Enter the year in 4 digits (e.g. 1987)',
            'id' => 'expiration_date_year',
            'type' => 'text',
            'default' => ''
        ),
    )
);
?>
