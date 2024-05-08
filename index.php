<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="number" name="num01" placeholder="Number 1">
        <select name="operator">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num02" placeholder="Number 2">
        <input type="submit" value="Calculate">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        $num2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        $errors = false;
        if (empty($num1) || empty($num2) || empty($operator)) {
            echo "<p class='error'>Please fill in all fields!</p>";
            $errors = true;
        } elseif (!is_numeric($num1) || !is_numeric($num2)) {
            echo "<p class='error'>Please enter only numbers!</p>";
            $errors = true;
        }

        if (!$errors) {
            $result = 0;
            switch ($operator) {
                case "add":
                    $result = $num1 + $num2;
                    break;
                case "subtract":
                    $result = $num1 - $num2;
                    break;
                case "multiply":
                    $result = $num1 * $num2;
                    break;
                case "divide":
                    if ($num2 == 0) {
                        echo "<p class='error'>Division by zero is not allowed!</p>";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                default:
                    echo "<p class='error'>An unexpected error occurred!</p>";
            }

            if (!$errors) {
                echo "<p class='success'>Result: $result</p>";
            }
        }
    }
    ?>
</body>

</html>