<?php
require_once '../observador/Observador.php';
require_once '../estrategia/Context.php';
require_once '../estrategia/RetiroEstrategia.php';
require_once '../estrategia/DepositoEstrategia.php';
require_once '../cadenaResponsabilidad/Billete200Manejador.php';
require_once '../cadenaResponsabilidad/Billete100Manejador.php';
require_once '../cadenaResponsabilidad/Billete50Manejador.php';
require_once '../cadenaResponsabilidad/Billete20Manejador.php';
require_once '../cadenaResponsabilidad/Billete10Manejador.php';
require_once '../cadenaResponsabilidad/Cajero.php';
require_once '../cadenaResponsabilidad/DepositoYRetiro.php';


class ATM_Cliente implements Observador
{
    private Context $context;
    private RetiroEstrategia $retiroEstrategia;
    private DepositoEstrategia $depositoEstrategia;

    private Billete200Manejador $billete200;
    private Billete100Manejador $billete100;
    private Billete50Manejador $billete50;
    private Billete20Manejador $billete20;
    private Billete10Manejador $billete10;

    private Cajero $cajero;
    private DepositoYRetiro $depositoYRetiro;

    public function __construct()
    {
        $this->billete200 = new Billete200Manejador();
        $this->billete100 = new Billete100Manejador();
        $this->billete50 = new Billete50Manejador();
        $this->billete20 = new Billete20Manejador();
        $this->billete10 = new Billete10Manejador();

        $this->billete200->establecerSiguiente($this->billete100);
        $this->billete100->establecerSiguiente($this->billete50);
        $this->billete50->establecerSiguiente($this->billete20);
        $this->billete20->establecerSiguiente($this->billete10);

        $this->retiroEstrategia = new RetiroEstrategia();
        $this->depositoEstrategia = new DepositoEstrategia();

        $this->context = new Context($this->retiroEstrategia);
        $this->context->agregarObservador($this);

        $this->cajero = new Cajero(3, 5, 10, 20, 30);
        $this->depositoYRetiro = new DepositoYRetiro(1000, 300);
        $this->retiroEstrategia = new RetiroEstrategia();
        $this->depositoEstrategia = new DepositoEstrategia();
        $this->context = new Context($this->retiroEstrategia);
        $this->context->agregarObservador($this);        
    }

    public function procesar_transaccion() {
        $tipo_transaccion = $_POST['tipo_transaccion'];
        if ($tipo_transaccion === 'retiro') {
            $this->context->setEstrategia($this->retiroEstrategia);
        } else if ($tipo_transaccion === 'deposito') {
            $this->context->setEstrategia($this->depositoEstrategia);
        }    

        $saldo = (int)$_POST['saldo'];
        $cantidad = (int)$_POST['cantidad'];
        $this->depositoYRetiro = new DepositoYRetiro($saldo, $cantidad);
        $resultado = $this->context->realizarOperacion(
            $this->billete200,
            $this->depositoYRetiro,
            $this->cajero
        );
        $this->mostrarATM($resultado);
    }

    public function actualizarCajero(): string
    {
        return "
    <ul class='list-group'>
        <li class='list-group-item'>Billetes de 200:
            <span id='billetes_200'>{$this->cajero->getBilletes200()}</span>
        </li>
        <li class='list-group-item'>Billetes de 100:
            <span id='billetes_100'>{$this->cajero->getBilletes100()}</span>
        </li>
        <li class='list-group-item'>Billetes de 50:
            <span id='billetes_50'>{$this->cajero->getBilletes50()}</span>
        </li>
        <li class='list-group-item'>Billetes de 20:
            <span id='billetes_20'>{$this->cajero->getBilletes20()}</span>
        </li>
        <li class='list-group-item'>Billetes de 10:
            <span id='billetes_10'>{$this->cajero->getBilletes10()}</span>
        </li>
    </ul>
    <div class='mt-3'>
        <h5>Total en el Cajero: $<span id='total_cajero'>{$this->cajero->getTotalDisponible()}</span></h5>
    </div>";
    }

    public function actualizarSaldoCuenta(): string
    {
        return "<div class='mb-3'>
                    <label for='saldo' class='form-label'>Saldo</label>
                    <input type='text' id='saldo' name='saldo' class='form-control' value={$this->depositoYRetiro->getTotalCuenta()} required>
                </div>

                <div class='mb-3'>
                    <label for='cantidad' class='form-label'>Cantidad</label>
                    <input type='number' id='cantidad' name='cantidad' class='form-control' value={$this->depositoYRetiro->getCantidadOperacion()} required>
                </div>";
    }

    public function actualizar(): void {}

    public function imprimir($str): string
    {
        return "
    <textarea 
        name='descripcion' 
        id='descripcion' 
        rows='4' 
        class='form-control' 
        placeholder='Descripción de la transacción'
    >$str</textarea>";
    }

    public function mostrarATM($str=''): void
    {
        $cajeroATM = $this->actualizarCajero();
        $imprimir = $this->imprimir($str);
        $saldocuenta = $this->actualizarSaldoCuenta();
        include 'uiCajero.php';
    }

    
}

$controlador = new ATM_Cliente();
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if (method_exists($controlador, $action)) {
        $controlador->$action();
    } else {
        echo "Método no encontrado";
    }
}