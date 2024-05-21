<!DOCTYPE html>
<html lang="en">

<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <style>
       body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .field {
            border: none;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #6b08ff;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 18px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        button[type="submit"] {
            padding: 15px 30px;
            background-color: #6b08ff;
            color: #ffffff;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 30px;
        }

        button[type="submit"]:hover {
            background-color: #290e50;
        }

        .error-message {
            color: #ff0000;
            margin-top: 15px;
        }
    </style>

</head>

<body>
    <?php
    if (!empty($_GET["data"])) {
        $data = unserialize(urldecode($_GET['data']));
    }
    ?>

    <form action="./handleSubmit.php" method="POST">
        <h1>Information de base</h1>
        <fieldset class='field' >

            <?php
            if (!empty($_GET["errors"])) {
                echo '<ul style="list-style-type: none; padding: 5px 10px; background-color: #ffebee; border-radius: 10px;">';

                $errors = unserialize(urldecode($_GET['errors']));
                foreach ($errors as $error) {
                    echo "<li style='color: #ff0000;'>$error</li>";
                }
                echo '</ul>';
            }
            ?>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo !empty($data["nom"]) ? $data["nom"] : ""; ?>" />

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo !empty($data["prenom"]) ? $data["prenom"] : ""; ?>" />

            <label>Genre:</label>
            <div style="display: flex; gap: 10px;">
                <input type="radio" id="male" name="genre" value="male" <?php echo !empty($data["genre"]) && $data["genre"] === "male" ? "checked" : ""; ?> />
                <label for="male">Male</label>
                <input type="radio" id="female" name="genre" value="female" <?php echo !empty($data["genre"]) && $data["genre"] === "female" ? "checked" : ""; ?> />
                <label for="female">Female</label>
            </div>


            <label for="date-naissance">Date de naissance: (dd-mm-yyyy)</label><br />
            <input type="text" id="date-naissance" name="date-naissance" pattern="\d{2}-\d{2}-\d{4}" value="<?php echo !empty($data["date-naissance"]) ? $data["date-naissance"] : ""; ?>" />


            <label for="code-postal">Code postal:</label>
            <input type="number" id="code-postal" name="code-postal" value="<?php echo !empty($data["code-postal"]) ? $data["code-postal"] : ""; ?>" />

            <label for="ville">Ville:</label>
            <input type="text" id="ville" name="ville" value="<?php echo !empty($data["ville"]) ? $data["ville"] : ""; ?>" />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo !empty($data["email"]) ? $data["email"] : ""; ?>" />

            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone" value="<?php echo !empty($data["telephone"]) ? $data["telephone"] : ""; ?>" />
        </fieldset>

        <button type="submit">Submit</button>
    </form>
</body>

</html>
