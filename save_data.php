<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formularz</title>
</head>
<body>
<?php
    $Imie = $_POST['imie'];
    $Nazwisko = $_POST['nazwisko'];
    $Data = $_POST['data'];
    $Email = $_POST['email'];
    $Telefon = $_POST['telefon'];
    $Woje = $_POST['woje'];
    $Plec = $_POST['plec'];
    $Gazetka = isset($_POST['gazetka']) ? 1 : 0;

    $mysqli = mysqli_connect('localhost', 'root', '', 'formlarz');

    if (!$mysqli) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

    $que = "INSERT INTO users VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $que);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $Imie, $Nazwisko, $Data, $Email, $Telefon, $Woje, $Plec, $Gazetka);

        $exe = mysqli_stmt_execute($stmt);

        if ($exe) {
            echo "Dodano dane do bazy";
        } else {
            echo "Błąd podczas dodawania danych: " . mysqli_error($mysqli);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd podczas przygotowywania zapytania: " . mysqli_error($mysqli);
    }
    mysqli_close($mysqli);
?>

</body>
</html>