<?php

//on ajoute ce champ de formulaire
$piscine = $_SESSION[ 'post-piscine' ];
?>
    <p><label for="post-piscine">Piscine</label>
    <input type="hidden" value="0" name="post-piscine">
    <input type="checkbox" value="1" id="post-piscine" name="post-piscine" <?php checked( true, $piscine ); ?>></p>
<?php


//dans switch_session() on sauvegarde la valeur de post-piscine,
//on sinon on en défini une par défaut
if( isset( $_POST[ 'post-piscine' ] ) ) {
    $_SESSION[ 'post-piscine' ] = ( 1 == $_POST[ 'post-piscine' ] ) ? true : false;
}

if( ! isset( $_SESSION[ 'post-piscine' ] ) )
    $_SESSION[ 'post-piscine' ] = false;

//dans switch_output_order
//dans la condition
if( false !== $_SESSION[ 'post-piscine' ] ) {
    $q->set( 'meta_query', array(
        'relation' => 'AND',
        array(
            'key' => '_equipement',
            'value'    => 'piscine',
            'compare' => '='
            )
        ) );
}
