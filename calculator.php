<?php
$number1 = "";
$number2 = "";
$operation = "+";
$result = null;
$error = "";
$requestData = !empty($_POST) ? $_POST : $_GET;

if (!empty($requestData)) {
    $number1 = $requestData["number1"] ?? "";
    $number2 = $requestData["number2"] ?? "";
    $operation = $requestData["operation"] ?? "+";

    if ($number1 === "" || $number2 === "") {
        $error = "Заполнить оба поля";
    } elseif (!is_numeric($number1) || !is_numeric($number2)) {
        $error = "Вводить корректные числа";
    } else {
        $num1 = floatval($number1);
        $num2 = floatval($number2);
        switch ($operation) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 === 0.0) {
                    $error = "Ошибка: деление на ноль";
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = "Неизвестная операция";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="container">
        <h1>Калькулятор</h1>
        
        <form method="POST" action="calculator.php">
            <div class="form-group">
                <label for="number1">Первое число:</label>
                <input 
                    type="number" 
                    id="number1" 
                    name="number1" 
                    value="<?= htmlspecialchars($number1) ?>"
                    step="any"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="number2">Второе число:</label>
                <input 
                    type="number" 
                    id="number2" 
                    name="number2" 
                    value="<?= htmlspecialchars($number2) ?>"
                    step="any"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="operation">Операция:</label>
                <select id="operation" name="operation">
                    <option value="+" <?= $operation === '+' ? 'selected' : '' ?>>+ (Сложение)</option>
                    <option value="-" <?= $operation === '-' ? 'selected' : '' ?>>- (Вычитание)</option>
                    <option value="*" <?= $operation === '*' ? 'selected' : '' ?>>× (Умножение)</option>
                    <option value="/" <?= $operation === '/' ? 'selected' : '' ?>>÷ (Деление)</option>
                </select>
            </div>
            
            <button type="submit">Посчитать</button>
        </form>
        
        <?php if ($error) : ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif ($result !== null) : ?>
            <div class="result">
                <div class="result-label">Результат:</div>
                <div class="result-value">
                    <?= htmlspecialchars($number1) ?> 
                    <?= htmlspecialchars($operation) ?> 
                    <?= htmlspecialchars($number2) ?> 
                    = 
                    <?= number_format($result, 2, '.', ' ') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
