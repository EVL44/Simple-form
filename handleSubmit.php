<?php
require_once "./validation.php";

$data = array();
$errors = array();


$valReturned = validateData($_POST['nom'], "nom");
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $data['nom'] = cleanData($_POST['nom']);
}

// Validate and sanitize "prenom"
$valReturned = validateData($_POST['prenom'], "prenom");
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $data['prenom'] = cleanData($_POST['prenom']);
}

// Validate and verify date of birth
$valReturned = validateDateOfBirth($_POST['date-naissance']);
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $valReturned = verifAge($_POST['date-naissance']);
    if ($valReturned !== true) {
        $errors[] =  $valReturned;
    } else {
        $data['date-naissance'] = $_POST['date-naissance'];
    }
}

// Validate and sanitize "genre"
$valReturned = validateData($_POST['genre'], "genre");
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $data['genre'] = $_POST['genre'];
}

// Verify gender
$valReturned = verifGenre($_POST['genre']);
if ($valReturned !== true) {
    $errors[] =  $valReturned;
}

// Validate and sanitize "code postal"
$valReturned = verifNumber($_POST['code-postal'], "code postal");
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $data['code-postal'] = $_POST['code-postal'];
}

// Validate and sanitize "ville"
$valReturned = validateData($_POST['ville'], "ville");
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $data['ville'] = $_POST['ville'];
}

// Validate and sanitize "email"
$valReturned = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if ($valReturned === false) {
    $errors[] =  "Invalid email format";
} else {
    $data['email'] = $_POST['email'];
}

// Validate and sanitize "telephone"
$valReturned = validateTelephone($_POST['telephone']);
if ($valReturned !== true) {
    $errors[] =  $valReturned;
} else {
    $data['telephone'] = $_POST['telephone'];
}

// If there are errors, redirect back to the form with error messages
if (!empty($errors)) {
    header("Location: form.php?errors=" . urlencode(serialize($errors)) . "&data=" . urlencode(serialize($data)));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            color: #6b08ff
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .info-item {
            margin-left: 30px;
            margin-bottom: 10px;
        }

        .info-item label {
            font-weight: bold;
        }

        .info-item span {
            margin-left: 10px;
        }

        button[type="submit"] {
            padding: 8px 15px;
            background-color: #6b08ff;
            color: #ffffff;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            width: 100px;
            margin-top: 30px;
        }

        button[type="submit"]:hover {
            background-color: #290e50;
        }

        a {
            text-decoration: none;
            color: white;

        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (!empty($errors)) {
            echo '<div class="error">';
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo '</div>';
        }
        ?>
        <h2> User Information :</h2>
        <div class="info-item">
            <label for="nom">Nom:</label>
            <span><?php echo $data["nom"] ?></span>
        </div>

        <div class="info-item">
            <label for="prenom">Prénom:</label>
            <span><?php echo $data["prenom"] ?></span>
        </div>

        <div class="info-item">
            <label for="date-naissance">Date de naissance:</label>
            <span><?php echo $data["date-naissance"] ?></span>
        </div>

        <div class="info-item">
            <label for="genre">Genre:</label>
            <span><?php echo $data["genre"] ?></span>
        </div>

        <div class="info-item">
            <label for="code-postal">Code Postal:</label>
            <span><?php echo $data["code-postal"] ?></span>
        </div>

        <div class="info-item">
            <label for="ville">Ville:</label>
            <span><?php echo $data["ville"] ?></span>
        </div>

        <div class="info-item">
            <label for="email">Email:</label>
            <span><?php echo $data["email"] ?></span>
        </div>

        <div class="info-item">
            <label for="telephone">Téléphone:</label>
            <span><?php echo $data["telephone"] ?></span>
        </div>

        <button type="submit"><a href='form.php'>back</a></button>
    </div>
</body>

</html>
