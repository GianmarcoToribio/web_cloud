<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Win Fibra Optica</title>
    <link rel="stylesheet" href="css\styleindex.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
</head>
<body>
    <div id="loginModal" class="modal fade" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="close" data-bs-dismiss="modal">&times;</div>
                <div class="row g-0">
                    <div class="col-md-6 modal-left" >
                    </div>
                    <div class="col-md-6 modal-right">
                        <div class="d-flex justify-content-end">
                        </div>
                        <h2>INICIAR SESIÓN</h2>
                        <form id="loginForm" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="correologin" id="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="contralogin" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-warning" id="Entrarlog">ENTRAR</button>

                        <!-- Aquí se mostrará el mensaje de error si ocurre -->
                        <div id="error-msg" style="color: red; margin-top: 10px;"></div>
                        </form>

                        <!-- Incluye jQuery para manejar AJAX -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                        $("#loginForm").submit(function(event) {
                            event.preventDefault(); // Evita el envío del formulario normal
                            
                            $.ajax({
                                url: 'php/login_usuario_be.php', // Ruta del archivo PHP que procesa el login
                                type: 'POST',
                                data: $(this).serialize(), // Enviar los datos del formulario
                                success: function(response) {
                                    if (response === 'success_cliente') {
                                        window.location.href = 'Menu_Cliente.php'; // Redirigir a la página de cliente
                                    } else if (response === 'success_moderador') {
                                        window.location.href = 'Menu_moderador.php'; // Redirigir a la página de moderador
                                    } else {
                                        $('#error-msg').text(response); // Mostrar mensaje de error en el div
                                    }
                                    // Borrar solo el campo de contraseña después de procesar el envío
                                    $('#password').val(''); // Esto borra solo el campo de contraseña
                                }
                            });
                        });

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header>
        <div class="container"> 
            <div class="logowin"><img src="images\win.png"alt="" width="140px" ></div>
            <ul class="botones">
                <div class="btnwsp" >
                    <button type="button" class="btn btn-success">
                         <img src="images\whatsapp-icon.png" alt="wsp" class="icon-wsp">
                        ESCRIBENOS
                    </button>
                </div>
                <div class="btncontact">
                    <button type="button" class="btn btn-success">
                        <img src="images\telefono-icon.png" alt="wsp" class="icon-wsp">
                        CONTÁCTENOS</button>
                </div>
                <button type="button" class="btn btn-warning" id="loginbtn">INICIAR SESIÓN</button>
            </ul>
        </div>
    </header>
    <div>
        <img src="images\fondo2.1.png" alt="wsp" class="imagen1" width="80px">
    </div>

    <div class="planes">
        
        
        <div class="column1">
            <div class="banner">Oferta del mes</div>
            <div class="titulo-planes">
                <p>Internet</p>
                <p>100% Fibra Óptica</p>
                </div>
            <p>200 mbps</p>
            <p>400 mbps x 6 meses</p> <br>
            <p>S/99 x 6 meses</p>
            <div style="margin-top: 200px;"></div>
            <button type="button" class="btn btn-secondary" >¡Quiero este plan!</button><br>
            <button class="accordion">Más información</button>

        </div>
        <div class="column2">
            <div class="banner">Oferta del mes</div>
            <div class="titulo-planes">
                <p>Internet</p>
                <p>100% Fibra Óptica</p>
            </div>
            <p>400 mbps</p>
            <p>800 mbps x 6 meses</p> <br>
            <p>S/99 x 6 meses</p>
            <p class="precio-reg">Precio regular: S/129</p> <br>
            <p>A solicitud:</p>
            <img src="images\wifimesh.png" alt="wsp" class="imgmesh" width="100px"><br>
            <button type="button" class="btn btn-secondary">¡Quiero este plan!</button><br>
            <button class="accordion">Más información</button>

        </div>
        <div class="column3">
            <div class="banner">Oferta del mes</div>
            <div class="titulo-planes">
                <p>Internet</p>
                <p>100% Fibra Óptica</p>
            </div>
            <p>600 mbps</p><br><br><br>
            <p>S/109 x 6 meses</p>
            <p class="precio-reg">Precio regular: S/139</p> <br>
            <p>A solicitud:</p>
            <img src="images\wifimesh.png" alt="wsp" class="imgmesh" width="100px"><br>
            <button type="button" class="btn btn-secondary">¡Quiero este plan!</button><br>
            <button class="accordion">Más información</button>

        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>