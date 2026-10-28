<?php
//Valor
$numero1 = '';
$numero2 = '';
$operacion = 'sumar';
$resultado = '';
$error = '';

//datos al calcular
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero1 = trim($_POST['numero1'] ?? '');
    $numero2 = trim($_POST['numero2'] ?? '');
    $operacion = $_POST['operacion'] ?? 'sumar';

    //validar
    if ($numero1 === '' || $numero2 === '') {
        $error = 'Ingresa los dos números';
    } elseif (!is_numeric($numero1) || !is_numeric($numero2)) {
        $error = 'Ingresa números válidos';
    } else {
        // parseo
        $a = (float) $numero1;
        $b = (float) $numero2;

        //Seleccion operacion
        switch ($operacion) {
            case 'sumar':
                $valor = $a + $b;
                break;
            case 'restar':
                $valor = $a - $b;
                break;
            case 'multiplicar':
                $valor = $a * $b;
                break;
            case 'dividir':
                if ($b == 0) {
                    $error = 'No se puede dividir entre cero.';
                } else {
                    $valor = $a / $b;
                }
                break;
            default:
                $error = 'Selecciona una operación válida.';
        }

        //resultado si no hay errores
        if ($error === '') {
            $resultado = (string) round($valor, 4);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es-EC">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Calculadora básica creada con PHP para operaciones matemáticas.">
    <title>Calculadora</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header class="titulo-sitio">
        <h1>MI PÁGINA PERSONAL</h1>
    </header>

    <main class="pagina-calculadora">
        <section class="contenedor">
            <div class="introduccion-calculadora">
                <h2>Calculadora</h2>
                <p>Ingresa dos números y escoge una operación</p>
            </div>
            <div class="tarjeta calculadora">

                <form action="calculadora.php" method="post">
                    <div class="campo">
                        <label for="numero1">Primer número</label>
                        <input id="numero1" type="number" name="numero1" step="any" required
                               placeholder="Ejemplo: 12"
                               value="<?= htmlspecialchars($numero1, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="campo">
                        <label for="numero2">Segundo número</label>
                        <input id="numero2" type="number" name="numero2" step="any" required
                               placeholder="Ejemplo: 4"
                               value="<?= htmlspecialchars($numero2, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="campo">
                        <label for="operacion">Operación matemática</label>
                        <select id="operacion" name="operacion">
                            <option value="sumar" <?= $operacion === 'sumar' ? 'selected' : '' ?>>Sumar (+)</option>
                            <option value="restar" <?= $operacion === 'restar' ? 'selected' : '' ?>>Restar (−)</option>
                            <option value="multiplicar" <?= $operacion === 'multiplicar' ? 'selected' : '' ?>>Multiplicar (×)</option>
                            <option value="dividir" <?= $operacion === 'dividir' ? 'selected' : '' ?>>Dividir (÷)</option>
                        </select>
                    </div>

                    <button class="boton boton-completo" type="submit">Calcular</button>
                </form>

                <?php if ($error !== ''): ?>
                    <div class="mensaje mensaje-error" role="alert">
                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php elseif ($resultado !== ''): ?>
                    <div class="mensaje mensaje-resultado" role="status">
                        <span>Resultado de la operación</span>
                        <strong><?= htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') ?></strong>
                    </div>
                <?php endif; ?>

                <a class="volver" href="index.html">Volver a la página anterior</a>
            </div>
        </section>
    </main>

    <footer class="pie-pagina">
        <div class="contenedor">
        </div>
    </footer>
</body>
</html>
