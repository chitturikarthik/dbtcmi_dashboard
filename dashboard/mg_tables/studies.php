<?php 

    $table = 'new_meta_studies';

    $primaryKey = 'CMIM_ID';

    include_once '../ext_links.php';
    //
    $columns = array(
        array( 'db' => '`t1`.`CMIM_ID`', 'dt' => 0,
        'formatter' => function( $d ) {
            return '<a href="dashboard/mg_study.php?cmimid='.$d.'" target="_blank">'.$d.'</a>';
        }, 'field' => 'CMIM_ID' ),
        array( 'db' => '`t1`.`study_id`', 'dt' => 1,
        'formatter' => function( $d ) {
            # Calling a global variable
            global $links;
            foreach ($links as $key => $value) {
                if (str_contains($d, $key)) {
                    return '<a href="'.$value.$d.'" target="_blank">'.$d.'</a>';
                }
            }
        }, 'field' => 'study_id' ),
        array( 'db' => '`t1`.`Study_Name`', 'dt' => 2, 'field' => 'Study_Name' ),
        array( 'db' => '`t2`.`main_environment`', 'dt' => 3, 'field' => 'main_environment' ),
        array( 'db' => '`t1`.`Sequence_region`', 'dt' => 4, 'field' => 'Sequence_region' ),
        array( 'db' => '`t1`.`Sample_size`', 'dt' => 5, 'field' => 'Sample_size' ),
        array( 'db' => '`t3`.`state_name`', 'dt' => 6, 'field' => 'state_name' ),
        array( 'db' => '`t1`.`Deposited_at`', 'dt' => 7, 'field' => 'Deposited_at' )
    );

    $joinQuery = "FROM `{$table}` AS `t1` JOIN `main_environments` AS `t2` ON (`t1`.`menv_id` = `t2`.`menv_id`) JOIN `states` AS `t3` ON (`t1`.`state_id` = `t3`.`state_id`) ";


   require_once( '../db_details.php' );

   require( '../../ssp.classExtended.php' );

    echo json_encode(
        SSP::simple( $_POST, $db_details, $table, $primaryKey, $columns, $joinQuery )
    );