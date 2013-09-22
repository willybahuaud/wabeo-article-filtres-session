<?php

//on ajoute ce champ de formulaire
$genre = $_SESSION[ 'post-genre' ];
$terms = get_terms( 'genre-bien' );
if( ! is_wp_error( $terms ) {
?>
    <p><label for="post-genre">Types de biens :</label>
    <select id="post-genre" name="post-genre" onchange="this.form.submit()">
        <option value="">Tous</option>
        <?php
        foreach( $terms as $term )
            echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( $term->slug, $genre, false ) . '>' . esc_html( $term->name ) . '</option>';
        ?>
    </select></p>
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
    $q->set( 'tax_query', array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'genre-bien',
            'field'    => 'slug',
            'terms'    => $_SESSION[ 'post-genre' ]
            )
        ) );
}
