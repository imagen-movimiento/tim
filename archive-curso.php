<?php
/*
Template Name: cursos
*/


$query = new WP_Query('order=ASC&post_type=curso');

$cursos = array();
$cursos['futuros'] = array();
$cursos['pasados'] = array();

while ($query->have_posts()) : $query->the_post(); 


	$titulo			=	get_the_title();
	$img			=	makeImg( timThumb( featImg($post->ID), 200, 200 ) );
	$link			=	get_permalink($post->ID);
	$extracto		=	get_the_excerpt();
	$imparte		=	get('imparte');
	$horario		=	get('horario');
    $fecha_inicio 	=	date_i18n( 'd \d\e F \d\e\l Y', strtotime( get('fecha_de_inicio') ) );
    $fecha_final 	=	date_i18n( 'd \d\e F \d\e\l Y', strtotime( get('fecha_de_final') ) );
	$dias_semana	=	get('dias_de_la_semana');


    $dia_counter=0;
    $num_dias = count($dias_semana);
    $dias = null;

    foreach($dias_semana as $dia){
        if( $dia_counter == $num_dias - 1 )
            $dias .= ' y ';
        else if( $dia_counter > 0 && $num_dias > 2 )
            $dias .= ', ';
        $dias .= $dia;
        $dia_counter += 1;
    }


    $fechas = $dias != '' ? $dias.' del ' : 'Del ';

    $fechas .= '<strong>'.$fecha_inicio.'</strong> al <strong>'.$fecha_final.'</strong>';

    $curso = makeDiv( "", "span2 img", $img );
    
    $texto = makeDiv( "", "titulo", '<h4>'.$titulo.'</h4>' );
    $texto .= makeDiv( "", "imparte", "Imparte: " . '<b>'.$imparte.'</b>' );
    $texto .= makeDiv( "", "fechas", $fechas );
    $texto .= makeDiv( "", "horario", $horario );
    $texto .= makeDiv( "", "extracto", $extracto . '<b>ver más -></b>' );

    $curso .= makeDiv( "", "span10 texto", $texto );

    $curso = makeDiv("", "elemento_lista row-fluid", $curso );

    if ( strtotime(date('d F Y')) < strtotime( get('fecha_de_final') ) )
    	array_push( $cursos['futuros'], $curso );
    else
    	array_push( $cursos['pasados'], $curso );

    

endwhile;

if( count( $cursos['futuros'] ) > 0 ) {
	echo '<h2>Cursos Futuros:</h2>';
	foreach ( $cursos['futuros'] as $curso ) {
		echo $curso;
	}
}

if( count( $cursos['pasados'] ) > 0 ) {
	echo '<h2>Cursos Pasados:</h2>';
	foreach ( $cursos['pasados'] as $curso ) {
		echo $curso;
	}
}

?>