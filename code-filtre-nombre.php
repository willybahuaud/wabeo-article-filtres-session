<?php 

add_action( 'init', 'switch_session' );
function switch_session() {
    // J'initialize la session
    if( ! session_id() )
        session_start();

    // Si le switcher à été utilisé, on change la valeur
    if( isset( $_POST[ 'post-count' ] ) ) {
        $_SESSION[ 'post-count' ] = ( in_array( $_POST['post-count'], array(10,25,50,100,-1 ) ) ? $_POST['post-count'] : 10;
    }
    
    if( ! isset( $_SESSION[ 'post-count' ] ) )
        $_SESSION[ 'post-count' ] = 10;

}


// L'overide de la requête
add_action( 'pre_get_posts', 'switch_output_count' );
function switch_output_count( $q ) {
    // Si on est en front et qu'il s'agit de la requête principale de la page d'archive
    if( ! is_admin() 
      && $q->is_main_query() 
      && is_post_type_archive('cpt') ) {

        // tri par prix
        if( isset( $_SESSION['post-count'] ) 
          && in_array( $_SESSION['post-count'], array(10,25,50,100,-1 ) ) {
            $q->set( 'posts_per_page', $_SESSION['post-count'] );
        }
    }

    // On retourne la requête
    return $q;
}

// Le code du switcher
function switcher_session() {
    $current_count = $_SESSION[ 'post-count' ];
    ?>
    <form method="post" class="switcher">
        <p><label for="post-count">Résultats par page :</label>
        <select id="post-count" name="post-count" onchange="this.form.submit()">
            <option value="10" <?php selected( $current_count, 10 ); ?>>10</option>
            <option value="25" <?php selected( $current_count, 25 ); ?>>25</option>
            <option value="50" <?php selected( $current_count, 50 ); ?>>50</option>
            <option value="100" <?php selected( $current_count, 100 ); ?>>100</option>
            <option value="-1" <?php selected( $current_count, -1 ); ?>>Tous</option>
        </select></p>
    </form>
    <?php
}
