<?php

add_action( 'init', 'switch_session' );
function switch_session() {
    // notre code ira ici
}

add_action( 'init', 'switch_session' );
function switch_session() {
    // J'initialize la session
    if( ! session_id() )
        session_start();

    // Si le switcher à été utilisé, on change la valeur
    if( isset( $_POST[ 'post-order' ] ) ) {
        $_SESSION[ 'post-order' ] = ( 'ASC' == $_POST['post-order'] ) ? 'ASC' : 'DESC';
    }
    
    if( isset( $_POST[ 'post-order-by' ] ) ) {
        $_SESSION[ 'post-order-by' ] = ( 'price' == $_POST['post-order-by'] ) ? 'price' : 'date';
    }

    // S'il n'y a pas d'ordre de défini, on en met un par défaut
    if( ! isset( $_SESSION[ 'post-order' ] ) )
        $_SESSION[ 'post-order' ] = 'ASC';

    if( ! isset( $_SESSION[ 'post-order-by' ] ) )
        $_SESSION[ 'post-order-by' ] = 'price';
        
}
