<?php
include_once '../../../config/configuration.php';
include_once './structures/funciones.php';

$datos = data_submitted();

// viewStructure($datos);

$nombreImagen = $datos['nombreImagen'];
$nombre = $datos['nombre'];
$precio = $datos['precio'];
$tipo = $datos['tipo'];

$idProducto = $datos['idProducto'];
$descripcion = $datos['descripcionCompleta'];
$descripcion_formateada = str_replace('<br/>', '.', $descripcion);
$stock = $datos['stock'];
$nombreCompleto = $datos['nombreCompleto'];
$esNuevo = $datos['esNuevo'];
$esPopular = $datos['esPopular'];

$existenRoles = false;
if (!empty($listaRoles)) {
    $existenRoles = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Panel Admin";
    include_once "../structures/head.php";
    ?>
</head>

<body>
    <?php
    include_once '../structures/navbar.php';
    ?>
    <div class="mt-3">
        <h1 class="text-center">Panel Encargado De Deposito</h1>
    </div>
    <div class="main-container">
        <div class="container mt-3 mb-3">
            <div class="card ">
                <div class="card-header text-center">
                    <h3 class="title">Modificar Producto</h3>
                </div>
                <div>
                    <form class="form card-body card-title" id="form-modificar-producto" name="form-modif-producto" novalidate enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input id="nombre" name="nombre" class="form-control" type="text" value="<?php echo $nombre ?>" required>
                                <div class="invalid-feedback">Debe ingresar el nombre</div>
                            </div>
                            <div class="col">
                                <label for="precio" class="form-label">Precio</label>
                                <input id="precio" name="precio" class="form-control" type="number" value="<?php echo $precio ?>" minlength="8" required>
                                <div class="invalid-feedback">Debe ingresar un precio</div>
                                <span id="error-precio" class="error" style="color: red; display: none;"></span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="stock" class="form-label">Stock a ingresar</label>
                                <input id="stock" name="stock" class="form-control" value="" type="number" required>
                                <span> Stock actual: <?php echo $stock  ?></span>
                                <div class="invalid-feedback">Ingrese el stock</div>
                                <span id="error-stock" class="error" style="color: red; display: none;"></span>
                            </div>
                            <div class="col text-center">
                                <label for="stock" class="form-label">Tipo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="accessories" <?php if ($tipo === 'accessories') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="tipo1">Accesorio</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="food" <?php if ($tipo === 'food') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="tipo2">Comida</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo3" value="toys" <?php if ($tipo === 'toys') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="tipo2">Juguete</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col text-center">
                                <label for="stock" class="form-label">Es Popular</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esPopular" id="esPupular1" value="1" <?php if ($esPopular === '1') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="esPupular1">SI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esPopular" id="esPupular2" value="0" <?php if ($esPopular === '0') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                        <label class="form-check-label" for="esPupular2">NO</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col text-center">
                                <label for="stock" class="form-label">Es Nuevo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esNuevo" id="esNuevo1" value="1" <?php if ($esNuevo === '1') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="esNuevo1">SI</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="esNuevo" id="esNuevo2" value="0" <?php if ($esNuevo === '0') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                        <label class="form-check-label" for="esNuevo2">NO</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col">
                                <label for="idProducto" class="form-label">Id</label>
                                <input id="idProducto" name="idProducto" class="form-control" type="text" value="<?php echo $idProducto ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input id="titulo" name="titulo" class="form-control" value="<?php echo $nombreCompleto ?>" type="text" required>
                                <div class="invalid-feedback">Ingrese el titulo</div>
                                <span id="error-titulo" class="error" style="color: red; display: none;"></span>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <textarea class="form-control" name="masInfo" id="masInfo" style="height: 100px" required><?php echo $descripcion_formateada ?></textarea>
                                    <label for="floatingTextarea2">Mas Info (separar oraciones con punto)</label>
                                    <div class="invalid-feedback">Ingrese la informacion</div>
                                    <span id="error-masInfo" class="error" style="color: red; display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col text-center border">
                                <h6>Imagen actual</h6>
                                <img src="../../../assets/images/products/<?php echo $tipo ?>/<?php echo $nombreImagen ?>" alt="" width="300" height="300">
                                <input type="hidden" name="nombreImagen" id="nombreImagen" value="<?php echo $nombreImagen ?>">

                            </div>
                            <div class="col d-flex align-items-center">
                                <div>
                                    <h5>Seleccione Imagen</h5>
                                    <input class="form-control" type="file" id="miArchivo" name="miArchivo">
                                    <small id="miniaturaHelp" class="form-text text-muted">formatos permitidos: png, jpg y jpeg</small>
                                    <div class="invalid-feedback">Ingrese el nombre</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                            <button id='btn-send' class="btn btn-text btn-primary me-md-2" type="submit">Modificar</button>
                            <button id='btn-clean' class="btn btn-text btn-primary" type="reset">Borrar</button>
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