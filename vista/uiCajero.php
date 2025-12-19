<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cajero ATM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
    <h1 class="text-center my-4">Bienvenido al Cajero ATM</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="ATM_Cliente.php?action=procesar_transaccion" method="post">
                            <div class="mb-3">
                                <label class="form-label">Tipo de transacción</label>

                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="tipo_transaccion"
                                        id="deposito"
                                        value="deposito"
                                        required>
                                    <label class="form-check-label" for="deposito">
                                        Depósito
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="tipo_transaccion"
                                        id="retiro"
                                        value="retiro">
                                    <label class="form-check-label" for="retiro">
                                        Retiro
                                    </label>
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="text-center mt-3">
                                <img
                                    id="imagenOperacion"
                                    src=""
                                    alt="Operación"
                                    class="img-fluid d-none"
                                    style="max-height: 220px;">
                            </div>

                            <?= $saldocuenta ?>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <?= $imprimir ?>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Realizar Operacion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Cantidad de billetes -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Cantidad de Billetes</h5>
                        <?= $cajeroATM ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        const imagen = document.getElementById('imagenOperacion');

        document.querySelectorAll('input[name="tipo_transaccion"]').forEach(radio => {
            radio.addEventListener('change', function() {
                console.log('hubo un cambio de estrategia');
                if (this.value === 'retiro') {
                    console.log('retiro');
                    imagen.src = '../assets/retirarDinero.jpg';
                } else if (this.value === 'deposito') {
                    console.log('deposito');
                    imagen.src = '../assets/depositarDinero.jpg';
                }

                imagen.classList.remove('d-none');
            });
        });
        
    </script>

</body>

</html>