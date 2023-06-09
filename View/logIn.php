<div class="container">
  <div class="form">
    <h2>Iniciar Sesión</h2>
    <form action="https://ordeplay.cifpceuta.com/index.php?action=doLogIn" method="post" id="miFormulario">
      <div class="campo">
        <input type="text" name="email" required id="email">
        <label>Email</label>
      </div>
      <div class="campo" id="lastCampo">
        <input type="password" name="passwd" required id="passwd">
        <label>Contraseña</label>
        <i class="fa-regular fa-eye" id="eyeIcon"></i>
      </div>
      <div class="loginButton">
        <button id="enviar">Iniciar Sesión</button>
        <br/>
        <br/>
        <a href="index.php?action=crearUser">Crear cuenta</a>
      </div>
    </form>
  </div>
</div>
<script>

  // Mostrar placeholders al tener el foco y quitarlo al perderlo.
  document.getElementById('email').addEventListener('focus', function(){
    document.getElementById('email').setAttribute('placeholder', 'example@notmail.es');
  });

  document.getElementById('email').addEventListener('blur', function(){
    document.getElementById('email').removeAttribute('placeholder');
  });

  document.getElementById('passwd').addEventListener('focus', function(){
    document.getElementById('passwd').setAttribute('placeholder', 'P@ssw0rd!2023');
  });

  document.getElementById('passwd').addEventListener('blur', function(){
    document.getElementById('passwd').removeAttribute('placeholder');
  });

  // Mostrar valor de las cookies en los inputs
  var valorCookie1 = document.cookie
    .split(";")
    .map(cookie => cookie.trim())
    .find(cookie => cookie.startsWith("email="));

  if (valorCookie1) {
    var valor = valorCookie1.split("=")[1];
    document.getElementById("email").value = valor;
  }

  var valorCookie2 = document.cookie
    .split(";")
    .map(cookie => cookie.trim())
    .find(cookie => cookie.startsWith("passwd="));

  if (valorCookie2) {
    var valor = valorCookie2.split("=")[1];
    document.getElementById("passwd").value = valor;
  }

  // Validación y envío de datos del formulario con respuesta del servidor.
  var miFormulario = document.getElementById('miFormulario');
  miFormulario.addEventListener('submit', function(ev) {
    ev.preventDefault();

    var datos = new FormData(miFormulario);

    // Envío de los datos al servidor
    fetch(miFormulario.getAttribute('action'), {
      method: miFormulario.getAttribute('method'),
      body: datos
    })
    .then(function(respuesta) {
    return respuesta.json();
    })
    // Trabajo con la respuesta que da el servidor.
    .then(function(datos) {
      if(datos.exito){
        // Se guardan las cookies de inicio de sesión.
        let hoy = new Date();
        let caducidadMs = hoy.getTime() + 1000 * 60 * 60 * 24 * 7;
        let caducidad = new Date (caducidadMs);
        document.cookie = `email = ${document.getElementById('email').value}; expires = ${caducidad.toUTCString()}`;
        document.cookie = `passwd = ${document.getElementById('passwd').value}; expires = ${caducidad.toUTCString()}`;
        // Se dirige a la pantalla de inicio
        window.location.href = "https://ordeplay.cifpceuta.com";
      } else {
        if(!document.getElementById('mensaje')){
          let msg = document.createElement('p');
          msg.innerText = datos.mensaje;
          msg.id = 'mensaje';
          document.getElementById('lastCampo').appendChild(msg);
        } else {
          document.getElementById('mensaje').innerText = datos.mensaje;
        }
      }
    })
    .catch(function(error) {
      console.log(error);
    });
  });

  // Ver contraseña
  document.getElementById('eyeIcon').addEventListener("click", function() {
      if (document.getElementById('passwd').type === 'password') {
        document.getElementById('passwd').type = 'text';
        document.getElementById('eyeIcon').classList.remove('fa-regular');
        document.getElementById('eyeIcon').classList.add('fa-solid');
    } else {
      document.getElementById('passwd').type = 'password';
        document.getElementById('eyeIcon').classList.remove('fa-solid');
        document.getElementById('eyeIcon').classList.add('fa-regular');
    }
  })

</script>
