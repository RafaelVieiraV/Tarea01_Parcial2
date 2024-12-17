<?php
define('MAX', 1000000); // Constante máxima para la opción 2

// Función para calcular la serie de Fibonacci
function fibonacci($n) {
    $a = 1; $b = 1;
    echo "Serie Fibonacci: 1 1";
    for ($i = 3; $i <= $n; $i++) {
        $c = $a + $b;
        echo " $c";
        $a = $b; $b = $c;
    }
}

// Función para verificar si un número cumple la condición del cubo de sus dígitos
function cuboDigitos($max) {
    $resultados = [];
    for ($i = 1; $i <= $max; $i++) {
        $sum = array_sum(array_map(function($d) {
            return pow($d, 3);
        }, str_split($i)));
        if ($sum == $i) $resultados[] = $i;
    }
    return $resultados;
}

// Función para realizar operaciones con fraccionarios
function calcularFraccion($a, $b, $c, $d) {
    if ($b <= 0 || $d <= 0) return "Error: El denominador debe ser positivo.";
    return $a + ($b * $c) - $d;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $option = $_POST['option'] ?? '';
    switch ($option) {
        case '1': // Opción 1: Fibonacci
            $num = intval($_POST['num'] ?? 0);
            if ($num < 1 || $num > 50) {
                echo "Número fuera de rango (1-50).";
            } else {
                fibonacci($num);
            }
            break;
        case '2': // Opción 2: Cubo de dígitos
            $numeros = cuboDigitos(MAX);
            echo "Números que cumplen la condición: " . implode(", ", $numeros);
            break;
        case '3': // Opción 3: Fraccionarios
            $a = intval($_POST['a'] ?? 0);
            $b = intval($_POST['b'] ?? 0);
            $c = intval($_POST['c'] ?? 0);
            $d = intval($_POST['d'] ?? 0);
            $resultado = calcularFraccion($a, $b, $c, $d);
            echo "Resultado: $resultado";
            break;
        default:
            echo "Seleccione una opción válida.";
    }
    echo "<br><a href='menu2.php'>Volver</a>";
} else {
?>
<form method="POST">
    <label>Opción:</label>
    <select name="option" id="option" required onchange="mostrarCampos()">
        <option value="">Selecciona...</option>
        <option value="1">Fibonacci</option>
        <option value="2">Cubo de Dígitos</option>
        <option value="3">Fraccionarios</option>
    </select>
    <br><br>

    <!-- Campo para la Opción 1 -->
    <div id="campoFibonacci" style="display:none;">
        <label>Número (1-50):</label>
        <input type="number" name="num" min="1" max="50">
    </div>

    <!-- Campos para la Opción 3 -->
    <div id="campoFraccionarios" style="display:none;">
        <label>A:</label><input type="number" name="a">
        <label>B:</label><input type="number" name="b">
        <label>C:</label><input type="number" name="c">
        <label>D:</label><input type="number" name="d">
    </div>

    <br>
    <button type="submit">Calcular</button>
</form>

<!-- Botón adicional para ir a la página principal -->
<form action="../index.html" method="get" style="margin-top: 10px;">
    <button type="submit">Ir a la página principal</button>
</form>


<script>
function mostrarCampos() {
    var opcion = document.getElementById('option').value;
    document.getElementById('campoFibonacci').style.display = (opcion === '1') ? 'block' : 'none';
    document.getElementById('campoFraccionarios').style.display = (opcion === '3') ? 'block' : 'none';
}
</script>
<?php
}
?>
