<script src="./View/js/carrito.js"></script>
<div class="container">
  <div class="juego">
    <div class="juegoImg">
      <img src="<?=$datos->getImg()?>" />
      <?php
      switch ($datos->getIdPlataforma()){ // Dependiendo del idPlataforma del juego, se muestra un icono u otro.
        case 1:
          ?>
          <div class="plataforma"><i class="fa-brands fa-playstation"></i></div>
          <?php
          break;
        case 2:
          ?>
          <div class="plataforma"><i class="fa-brands fa-xbox"></i></div>
          <?php
          break;
        case 3:
          ?>
          <div class="plataforma"><i class="fa-solid fa-desktop"></i></div>
          <?php
          break;
        case 4:
          ?>
          <div class="plataforma"><img class="nintendoIcon" src="img/icons/nintendo.svg"></div>
          <?php
          break;
      }
      ?>
    </div>
    <div class="infoJuego">
      <h1><?=$datos->getNombre()?></h1>
      <p><?=$datos->getDescripcion()?></p>
      <div>
        <h2><?=$datos->getPrecio()?>€</h2>
        <span>
          <i class="fa-solid fa-plus" id="addToLista"></i>
          <?php
          if(isset($_SESSION['idCliente'])){
            if($datos->isInLista('Favoritos')){
              ?>
              <a href="index.php?action=removeJuegoFromLista&idJuego=<?=$datos->getIdVideojuego()?>"><i class="fa-solid fa-heart"></i></a>
              <?php
            } else {
              ?>
              <a href="index.php?action=addJuegoToLista&idJuego=<?=$datos->getIdVideojuego()?>"><i class="fa-regular fa-heart"></i></a>
              <?php
            }
          } else {
            ?>
            <a href="index.php?action=addJuegoToLista&idJuego=<?=$datos->getIdVideojuego()?>"><i class="fa-regular fa-heart"></i></a>
            <?php
          }
          ?>
        </span>
      </div>
      <button onclick="addToCart('<?=$datos->getIdVideojuego()?>')">Añadir al carrito</button>
    </div>
  </div>
  <div class="reviews">
    <?php
    if($datos->getReviews()){
      for($i = 0; $i < count($datos->getReviews()); $i++){
        ?>
        <div class="review">
          <div class="nota">
            <?php
            switch ($datos->getReviews()[$i]->getNota()){ // Dependiendo de la nota del juego, se muestran unos iconos u otros.
              case 0:
                ?>
                <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                <?php
                break;
              case 1:
                ?>
                <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                <?php
                break;
              case 2:
                ?>
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                <?php
                break;
              case 3:
                ?>
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                <?php
                break;
              case 4:
                ?>
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                <?php
                break;
              case 5:
                ?>
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <?php
                break;
            }
            ?>
          </div>
          <img src="<?=$datos->getReviews()[$i]->getCliente()->getPicture()?>" />
          <h3><?=$datos->getReviews()[$i]->getCliente()->getUsuario()?></h3>
          <p><?=$datos->getReviews()[$i]->getOpinion()?></p>
        </div>
        <?php
      }
    } else {
      echo "<p>Aún no hay reseñas de este juego.</p>";
    }
    ?>
  </div>
</div>
<?php
if(isset($_SESSION['idCliente'])){
?>
<div class="addToLista" id="divToAdd">
<?php
for($i = 0; $i < count($cliente->getListas()); $i++){
  ?>
  <div class="lista">
    <a href="index.php?action=addJuegoToLista&idJuego=<?=$datos->getIdVideojuego()?>&idLista=<?=$cliente->getListas()[$i]->getIdLista()?>">
      <p><?=$cliente->getListas()[$i]->getNombre()?></p>
    </a>
  </div>
  <?php
} 
?>
</div>
<?php
}
?>
<script>

  document.getElementById('addToLista').addEventListener('click', function(ev){
    coordenadas = document.getElementById('addToLista').getBoundingClientRect();

    document.getElementById('divToAdd').style.display = 'block';
    document.getElementById('divToAdd').style.top = coordenadas.top + "px";
    document.getElementById('divToAdd').style.left = coordenadas.left + "px";

    document.getElementById('divToAdd').addEventListener('mouseleave', function(ev){
    document.getElementById('divToAdd').style.display = 'none';
    });

  });


</script>