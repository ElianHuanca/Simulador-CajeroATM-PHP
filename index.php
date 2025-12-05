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
                        <form action="procesar_transaccion.php" method="post">
                            <div>
                                <select name="tipo_transaccion" id="tipo_transaccion" class="form-select" required>
                                    <option value="" disabled selected>Seleccione el tipo de transacción</option>
                                    <option value="deposito">Depósito</option>
                                    <option value="retiro">Retiro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="saldo" class="form-label">Saldo</label>
                                <input type="text" id="saldo" name="saldo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" rows="4" class="form-control" placeholder="Descripción de la transacción"></textarea>
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
                        <ul class="list-group">
                            <li class="list-group-item">Billetes de 100: <span id="billetes_100">3</span></li>
                            <li class="list-group-item">Billetes de 100: <span id="billetes_100">5</span></li>
                            <li class="list-group-item">Billetes de 50: <span id="billetes_50">10</span></li>
                            <li class="list-group-item">Billetes de 20: <span id="billetes_20">20</span></li>
                            <li class="list-group-item">Billetes de 10: <span id="billetes_10">30</span></li>
                        </ul>
                        <!-- Total -->
                        <div class="mt-3">
                            <h5>Total en el Cajero: $<span id="total_cajero">0</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>