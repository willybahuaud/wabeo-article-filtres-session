<?php
function switcher_session() {
  ?>
  <form method="post" class="switcher">
      <!-- ici nous allons mettre les options -->
  </form>
  <?php
}

//la fonction du formulaire et ses selects...
function switcher_session() {
  ?>
  <form method="post" class="switcher">
      <p><label for="post-order-by">Trier selon :</label>
        <select id="post-order-by" name="post-order-by" onchange="this.form.submit()">
            <option value="date">la date</option>
            <option value="price">le prix</option>
        </select></p>

        <p><label for="post-order">Ordre de tri :</label>
        <select id="post-order" name="post-order" onchange="this.form.submit()">
            <option value="DESC">Décroissant</option>
            <option value="ASC">Croissant</option>
        </select></p>
  </form>
  <?php
}


//le switcher complet
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
