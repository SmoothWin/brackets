<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (!isset($_POST["btnInsert"])) {
    ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input type="text" name="name" value="New Product xyz" /><br />
            <input type="text" name="description" value="Description: with prepared statement" /><br />
            <input type="text" name="price" value="200" /><br />
            <input type="submit" name="btnInsert" value="Insert" /><br />
        </form>
    <?php
    } else {
        include '_dbConnection.php';
        $name           = isset($_POST["name"]) ? $_POST["name"] : null;
        $description    = isset($_POST["description"]) ? $_POST["description"] : null;
        $price          = isset($_POST["price"]) ? $_POST["price"] : null;
        try {
            $sql = "INSERT INTO items(name, description, price) VALUES (?, ?, ?)";
            $stmt = $connect->prepare($sql);

            $stmt->execute([$name, $description, $price]);

            $last_id = $connect->lastInsertId();
            echo "New record created successfully. Last inserted ID is: " . $last_id;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $connect = null;
    }
    ?>
</body>

</html>