<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .error {
        color: red;
        font-size: .956rem;
    }

    .success {
        color: green;
        font: 1em sans-serif;
    }
</style>

<body>


    <!-- <form action="formhandler.php" method="post">
        <label for="firstname">firstname</label>
        <input name="firstname" type="text">
        <br>
        <label for="lastname">lastname</label>
        <input name="lastname" type="text">

        <button type='submit'>submit</button>
    </form> -->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="number" name="num01" placeholder="num1">
        <select name="operator">

            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>

        </select>
        <input type="number" name="num02" placeholder="num2">

        <input type="submit" value="calculate">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        $num2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);

        ///errror handling//
        $errors = false;
        if (empty($num1) || empty($num2) || empty($operator)) {
            echo "<p class='error'> fill in all fields!!</p>";
            $errors = true;

        }
        if (!is_numeric($num1) || !is_numeric($num2)) {
            echo "<p class='error'> please write only numbers!!</p>";
            $errors = true;

        }
        //caculate if no errpor
    
        if (!$errors) {
            $value = 0;
            switch ($operator) {
                case "add":
                    $value = $num1 + $num2;
                    break;

                case "subtract":
                    $value = $num1 - $num2;
                    break;

                case "multiply":
                    $value = $num1 * $num2;
                    break;
                case "divide":
                    $value = $num1 / $num2;
                    break;


                default:
                    echo "<p class='error'>ahh! sorry something went wrong</p>";


            }
            echo "<p class='success'> result=" . $value . "</p>";
        }



    }


    ?>
</body>

</html>