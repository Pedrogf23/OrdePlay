<script src="./View/js/carrito.js"></script>
<div class="container">
  <div class="infoCarrito">
    <div class="carrito">
      <?php      

      $precioTotal = 0;

      if($_COOKIE['carrito'] != "[]") {
        $carrito = $_COOKIE['carrito'];

        // Decodificar el string JSON en un arreglo de PHP
        $arrayCarrito = json_decode($carrito, true);
        
        // Crear un arreglo asociativo para contar las repeticiones de cada idVideojuego
        $contador = array();
  
        // Recorrer el arreglo y realizar una acción para cada idVideojuego
        foreach ($arrayCarrito as $idVideojuego) {
          // Incrementar el contador para el idVideojuego actual
          if (isset($contador[$idVideojuego])) {
              $contador[$idVideojuego]++;
          } else {
              $contador[$idVideojuego] = 1;
          }

          $juego = $controlador->OrdePlay->getVideojuegoById($idVideojuego);
          $precioTotal += $juego->getPrecio();

        }
  
        // Mostrar los idVideojuegos y el recuento, mostrando solo uno cuando se repiten tres veces
        foreach ($contador as $idVideojuego => $cantidad) {
        
          $juego = $controlador->OrdePlay->getVideojuegoById($idVideojuego);
  
          ?>
          <div class="juego">
            <img src="<?=$juego->getImg()?>" />
            <div class="infoJuego">
              <p><?=$juego->getNombre()?></p>
              <?php
              switch ($juego->getIdPlataforma()){ // Dependiendo del idPlataforma del juego, se muestra un icono u otro.
                case 1:
                  ?>
                  <i class="fa-brands fa-playstation"></i>
                  <?php
                  break;
                case 2:
                  ?>
                  <i class="fa-brands fa-xbox"></i>
                  <?php
                  break;
                case 3:
                  ?>
                  <i class="fa-solid fa-desktop"></i>
                  <?php
                  break;
                case 4:
                  ?>
                  <img class="nintendoIcon" src="img/icons/nintendo.svg">
                  <?php
                  break;
              }
              ?>
              <div class="borrar">
                <i class="fa-solid fa-xmark" onclick="eliminarDelCarrito('<?=$juego->getIdVideojuego()?>')"></i>
                <p>|</p>
                <a href="index.php?action=addJuegoToDeseados&idJuego=<?=$juego->getIdVideojuego()?>">Añadir a deseados</a>
              </div>
            </div>
            <div class="precioCantidad">
              <p><?=$juego->getPrecio()?>€</p>
              <p><?=$cantidad?></p>
            </div>
          </div>
          <?php
        }
      } else {
        ?>
        <h2>No tienes juegos añadidos al carrito.</h2>
        <?php
      }
      ?>
    </div>
    <div class="comprar">
      <div><p>Precio total</p> <p><?=$precioTotal?>€</p></div>
      <a href="index.php?action=pagarCarrito">
        <button>Proceder con el pago</button>
      </a>
      <hr>
      <a href="index.php?action=web">Seguir comprando</a>
    </div>
  </div>
</div>