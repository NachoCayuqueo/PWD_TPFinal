<?php
include_once "../../controllers/validaciones.php";
include_once './structures/funciones.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Deposito";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="title text-center">Panel Deposito</h1>
    </div>
    <div class="main-container">
        <div class="container mt-3 mb-3">
            <div class="card ">
                <div class="card-header text-center">
                    <h3 class="title">Nuevo Producto</h3>
                </div>
                <div>
                    <form class="form card-body card-title text" id="form-nuevo-producto" name="form-modif-producto" novalidate enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input id="nombre" name="nombre" class="form-control" type="text" required>
                                <span id="error-nombre" class="error" style="color: red; display: none;"></span>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                            <div class="col">
                                <label for="precio" class="form-label">Precio</label>
                                <input id="precio" name="precio" class="form-control" type="number" minlength="8" required>
                                <div class="invalid-feedback">Debe ingresar el precio</div>
                                <span id="error-precio" class="error" style="color: red; display: none;"></span>

                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col">
                                <label for="stock" class="form-label">Stock</label>
                                <input id="stock" name="stock" class="form-control" type="number" required>
                                <div class="invalid-feedback">Debe ingresar el stock</div>
                                <span id="error-stock" class="error" style="color: red; display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <label for="stock" class="form-label">Tipo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="accessories">
                                        <label class="form-check-label" for="tipo1">Accesorio</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="food">
                                        <label class="form-check-label" for="tipo2">Comida</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo3" value="toys">
                                        <label class="form-check-label" for="tipo2">Juguete</label>
                                    </div>
                                </div>
                                <div class="invalid-tipo">Seleccionar tipo</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col text-center">
                                <label for="stock" class="form-label">Es Popular</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esPopular" id="esPupular1" value="1">
                                        <label class="form-check-label" for="esPupular1">SI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esPopular" id="esPupular2" value="0">
                                        <label class="form-check-label" for="esPupular2">NO</label>
                                    </div>
                                    <div class="invalid-esPopular">Seleccionar opcion</div>
                                </div>

                            </div>
                            <div class="col text-center">
                                <label for="stock" class="form-label">Es Nuevo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esNuevo" id="esNuevo1" value="1">
                                        <label class="form-check-label" for="esNuevo1">SI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esNuevo" id="esNuevo2" value="0">
                                        <label class="form-check-label" for="esNuevo2">NO</label>
                                    </div>
                                    <div class="invalid-esNuevo">Seleccionar opcion</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input id="titulo" name="titulo" class="form-control" type="text" required>
                                <div class="invalid-feedback">Debe ingresar el titulo</div>
                                <span id="error-titulo" class="error" style="color: red; display: none;"></span>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <div> <label for="titulo" class="form-label">Acerca del producto</label></div>
                                    <textarea class="form-control" name="masInfo" id="masInfo" style="height: 100px" required></textarea>
                                    <div class="invalid-feedback">Debe ingresar informacion del producto</div>
                                    <span id="error-masInfo" class="error" style="color: red; display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col text-center border">
                                <h6>Imagen actual</h6>
                                <img src="../../../assets/images/products/sinImagen.png" alt="" width="300" height="300">
                                <input type="hidden" name="nombreImagen" id="nombreImagen">

                            </div>
                            <div class="col d-flex align-items-center">
                                <div>
                                    <h5>Seleccione Imagen</h5>
                                    <input class="form-control" type="file" id="miArchivo" name="miArchivo" required>
                                    <div class="invalid-feedback">Debe seleccionar una imagen del producto</div>
                                    <small id="miniaturaHelp" class="form-text text-muted">formatos permitidos: png, jpg y jpeg</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                            <button id='btn-send' class="btn btn-text btn-color me-md-2" type="submit">Crear Producto</button>
                            <button id='btn-clean' class="btn btn-text btn-danger" type="reset">Borrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $PUBLIC_JS ?>/deposit/validation.js"></script>
    <script src="<?php echo $PUBLIC_JS ?>/deposit/productAjax.js"></script>

</body>

</html>