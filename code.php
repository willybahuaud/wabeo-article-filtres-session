<?php 

add_action( 'init', 'switch_session' );
function switch_session() {
    // J'initialize la session
    if( ! session_id() )
        session_start();

    // Si le switcher à été utilisé, on change la valeur
    if( isset( $_POST[ 'post-order' ] ) ) {
        $_SESSION[ 'post-order' ] = ( 'ASC' == $_POST['post-order'] ) ? 'ASC' : 'DESC' );
    }

    if( isset( $_POST[ 'post-order-by' ] ) ) {
        $_SESSION[ 'post-order-by' ] = ( 'price' == $_POST['post-order-by'] ) ? 'price' : 'date' );
    }

    // S'il n'y a pas d'ordre de défini, on en met un par défaut
    if( ! isset( $_SESSION[ 'post-order' ] ) )
        $_SESSION[ 'post-order' ] = 'ASC';

    if( ! isset( $_SESSION[ 'post-order-by' ] ) )
        $_SESSION[ 'post-order-by' ] = 'price';

}


// L'overide de la requête
add_action( 'pre_get_posts', 'switch_output_order' );
function switch_output_order( $q ) {
    // Si on est en front et qu'il s'agit de la requête principale de la page d'archive
    if( ! is_admin() && $q->is_main_query() && is_post_type_archive( 'cpt' ) ) {

        // tri par prix
        if( 'price' == $_SESSION[ 'post-order-by' ] ) {
            $q->set( 'meta_value_num', '_price' );
        }
        /* 
        * Par défaut, WordPress tri par date, donc il n'y a pas besoin d'effectuer'
        * un autre overide pour le tri par date ;-)
        *
        * Sauf si, par exemple, vous voulez trier selon une date 
        * autre que la publication de l'article...
        */

        // Tri croissant ou décroissant
        $q->set( 'order', $_SESSION[ 'post-order' ] );
    }

    // On retourne la requête
    return $q;
}

// Le code du switcher
function switcher_session() {
    $current_order = $_SESSION[ 'post-order' ];
    $current_order_by = $_SESSION[ 'post-order-by' ];
    ?>
    <form method="post" class="switcher">
        <p><label for="post-order-by">Trier selon :</label>
        <select id="post-order-by" name="post-order-by" onchange="this.form.submit()">
            <option value="date" <?php selected( $current_order_by, 'date' ); ?>>la date</option>
            <option value="price" <?php selected( $current_order_by, 'price' ); ?>>le prix</option>
        </select></p>

        <p><label for="post-order">Ordre de tri :</label>
        <select id="post-order" name="post-order" onchange="this.form.submit()">
            <option value="DESC" <?php selected( $current_order, 'DESC' ); ?>>Décroissant</option>
            <option value="ASC" <?php selected( $current_order, 'ASC' ); ?>>Croissant</option>
        </select></p>
    </form>
    <?php
}
