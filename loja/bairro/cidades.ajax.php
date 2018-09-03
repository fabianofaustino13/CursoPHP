<?php
require_once(__DIR__ . "/../classes/modelo/Estado.class.php");
require_once(__DIR__ . "/../classes/dao/EstadoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Cidade.class.php");
require_once(__DIR__ . "/../classes/dao/CidadeDAO.class.php");

header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );

$cidade = new Cidade();
$cidadeDao = new CidadeDAO();
$cidades = $cidadeDao->findCidadeEstado($_GET['q']);



// $cod_estados = mysql_real_escape_string( $_GET['cod_estados'] );

// $cidades = array();

// $sql = "SELECT cod_cidades, nome
//     FROM cidades
//     WHERE estados_cod_estados=$cod_estados
//     ORDER BY nome";
// $res = mysql_query( $sql );
// while ( $row = mysql_fetch_assoc( $res ) ) {
//   $cidades[] = array(
//     'cod_cidades'  => $row['cod_cidades'],
//     'nome'      => $row['nome'],
//   );
// }

echo( json_encode( $cidades ) );
