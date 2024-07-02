<?php 

    $table = 'new_meta_samples';

    $primaryKey = 'CMIS_ID';
    include_once '../ext_links.php';
    //
    $columns = array(
        array( 'db' => '`t1`.`CMIS_ID`', 'dt' => 0,
        'formatter' => function( $d, $row ) {
            return '<a href="dashboard/mg_sample.php?msample='.$d.'" target="_blank">'.$d.'</a>';
        }, 'field' => 'CMIS_ID' ),
        array( 'db' => '`t1`.`sample_name`', 'dt' => 1, 'field' => 'sample_name' ),
        array( 'db' => '`t1`.`Biosample_ID`', 'dt' => 2,
        'formatter' => function( $d, $row ) {
                        # Calling a global variable
                        global $links;
                        foreach ($links as $key => $value) {
                            if (str_contains($d, $key)) {
                                return '<a href="'.$value.$d.'" target="_blank">'.$d.'</a>';
                            }
                        }
        }, 'field' => 'Biosample_ID' ),
        array( 'db' => '`t2`.`study_id`', 'dt' => 3, 'field' => 'study_id' ),
        array( 'db' => '`t3`.`source_name`', 'dt' => 4, 'field' => 'source_name' ),
        array( 'db' => '`t4`.`state_name`', 'dt' => 5, 'field' => 'state_name' ),
        array( 'db' => '`t5`.`env_name`', 'dt' => 6, 'field' => 'env_name' ),
        array( 'db' => '`t1`.`Location`', 'dt' => 7, 'field' => 'Location' )
    );

    $joinQuery = "FROM `{$table}` AS `t1` JOIN `new_meta_studies` AS `t2` ON (`t1`.`CMIM_ID` = `t2`.`CMIM_ID`) JOIN `source` AS `t3` ON (`t1`.`Source_ID` = `t3`.`Source_ID`) JOIN `states` AS `t4` ON (`t1`.`state_id` = `t4`.`state_id`) JOIN `environments` AS `t5` ON (`t1`.`env_id` = `t5`.`env_id`) ";

    $where = "`t1`.`Sequence_stratergy`= 'wgs'";

    require_once( '../db_details.php' );

    require( '../../ssp.classExtended.php' );

    echo json_encode(
        SSP::simple( $_POST, $db_details, $table, $primaryKey, $columns, $joinQuery, $where )
    );
