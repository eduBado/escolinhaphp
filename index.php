<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";
$nameErr = $emailErr = $genderErr = $websiteErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
        $comment = wordwrap($comment, 40);
    }


    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}



/* ENVIO DE EMAIL */
$para = 'edubado08@gmail.com';
$assunto = 'E-mail através de formulário';
$mensagem = "De: $name <$email> \r\n";
$mensagem .= "Website: $website \r\n";
$mensagem .= "Genero: $gender \r\n";
$mensagem .= "Comentários \r\n\n $comment";
$headers = "From: $name <$email>" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
if (strlen($nameErr) == 0 && strlen($emailErr) == 0 && strlen($websiteErr) == 0) {
    mail($para, $assunto, $mensagem, $headers);
    $statusMail = true;
} else {
    $statusMail = false;
}

//*** Fim da função de envio de e-mail
//Limpeza dos dados de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .err{
                outline: 1px dashed red;
                background-color: lightcoral;
            }
        </style>
    </head>
    <body>
        <h1>Manuseio de Formulário com PHP</h1>
        <p>Referências</p>
        <ul>
            <li><a href="http://www.w3schools.com/">W3Schools</a></li>
            <li><a href="http://www.w3schools.com/php/">Manual do PHP</a></li>
        </ul>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

            Name: <input type="text" name="name" class="<?= strlen($nameErr) != 0 ? "err" : ""; ?>" value="<?= $name; ?>">
            <span class="error">* <?php echo $nameErr; ?></span>
            <br><br>
            E-mail:
            <input type="text" name="email" class="<?= strlen($emailErr) != 0 ? "err" : ""; ?>" value="<?= $email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>
            Website:
            <input type="text" name="website" value="<?= $website; ?>" >
            <span class="error"><?php echo $websiteErr; ?></span>
            <br><br>
            Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
            <br><br>
            Gender:
            <input type="radio" name="gender" value="female" class="<?= strlen($genderErr) != 0 ? "err" : ""; ?>" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>>Female
            <input type="radio" name="gender" value="male" class="<?= strlen($genderErr) != 0 ? "err" : ""; ?>" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>>Male
            <span class="error">* <?php echo $genderErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit"> 

        </form>
        <?php
        if (isset($statusMail) && $statusMail) {
            echo "<h1> E-mail enviado </h1>";
        } else {
            echo "<h1 class='err'>E-mail nao enviado!</h1>";
        }
        ?>
    </body>
</html>
