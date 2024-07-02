<?php

$columns = array(
	array( 'db' => '`c`.`id`', 'dt' => 0, 'field' => 'id' ),
	array( 'db' => '`c`.`login`', 'dt' => 1 'field' => 'login' ),
	array( 'db' => '`c`.`password`', 'dt' => 2, 'field' => 'password' ),
	array( 'db' => '`c`.`name`', 'dt' => 3, 'field' => 'client_name', 'as' => 'client_name' ),
	array( 'db' => '`cn`.`name`', 'dt' => 4, 'field' => 'currency_name', 'as' => 'currency_name' )
	
	array( 'db' => '`c`.`id_client`', 'dt' => 5,
	'formatter' => function( $d, $row ) {
	return '<a href="EDIT_URL"><span class="label label-inverse"><i class="fa fa-edit"></i> Edit</span></a>
	<span class="label label-danger pointer"><i class="fa fa-trash-o"></i> Delete</span>
	';
	}, 'field' => 'id_client' )
);
 
$joinQuery = "FROM `{$table}` AS `c` LEFT JOIN `currency_names` AS `cn` ON (`cn`.`id` = `c`.`id_currency`)";

$Where = "`c`.`id_client`=".$CLIENT_ID; // OR For a Normal query condition could be $Where = "`id_client`=".$CLIENT_ID;
$Ssp = new Libs_SSP();
echo json_encode(
$Ssp::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where)
);

$groupBy = '`c`.`id_client`'; // for multiple COLUMN '`c`.`id_client`,`c`.`other_param`'
echo json_encode(
$Ssp::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where, $groupBy)
);

$having = '`c`.`id_client` >= 100'; // same as the extra where
echo json_encode( SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where, $groupBy,$having) );


$Ssp = new Libs_SSP();
echo json_encode(
$Ssp::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery )
);