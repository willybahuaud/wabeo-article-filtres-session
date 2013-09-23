<?php

//on ajoute ce champ de formulaire
$genre = $_SESSION[ 'post-piscine' ];
$terms = get_terms( 'piscine-bien' );
if( ! is_wp_error( $terms ) {
?>
    <p><label for="post-piscine">Piscine</label>
    <input type="checkbox" value="1" id="post-piscine" name="post-piscine"></p>
<?php
}

//dans switch_session() on sauvegarde la valeur de post-genre,
//on sinon on en défini une par défaut
if( isset( $_POST[ 'post-genre' ] ) ) {
    $terms = get_terms( 'genre-bien' );
    $_SESSION[ 'post-genre' ] = ( in_array( $_POST[ 'post-genre' ], wp_list_pluck( $terms, 'slug' ) ) ) ? $_POST[ 'post-genre' ] : false;
}

if( ! isset( $_SESSION[ 'post-genre' ] ) )
    $_SESSION[ 'post-genre' ] = false;

//dans switch_output_order
//dans la condition
if( false !== $_SESSION[ 'post-genre' ] ) {
    $q->set( 'meta_query', array(
        'relation' => 'AND',
        array(
            'key' => 'genre-bien',
            'value'    => $_SESSION[ 'post-genre' ],
            'compare' => '='
            )
        ) );
}
