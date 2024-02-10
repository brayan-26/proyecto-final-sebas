<?php
$conexion = new mysqli("localhost", "root", "", "sebas");


if ($conexion->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Verificar la conexión
    $correoExistenteQuery = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $correoExistenteResult = $conexion->query($correoExistenteQuery);
    
    if ($correoExistenteResult->num_rows > 0) {
        // El correo ya está registrado
        echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; border: 1px solid #808080; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; font-family: \"Times New Roman\", Times, serif; font-size: 20px !important;'>";
        echo "<p style='margin-bottom: 20px;'>El correo electrónico $email ya está registrado. Por favor, elija otro correo.</p>";
        echo "<a href='../views/register.html' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Volver</a>";
        echo "</div>";
    } else 
        if (empty($nombre) || empty($correo) || empty($telefono) || empty($cedula) || empty($contrasena)) {
            // Campos vacíos
            echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; border: 1px solid #808080; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; font-family: \"Times New Roman\", Times, serif; font-size: 20px !important;'>";
            echo "<p style='margin-bottom: 20px;'>Ingrese todos los datos</p>";
            echo "<a href='../views/register.html' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Volver</a>";
            echo "</div>";
        } else 
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                // Correo no válido
                echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; border: 1px solid #808080; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; font-family: \"Times New Roman\", Times, serif; font-size: 20px !important;'>";
                echo "<p style='margin-bottom: 20px;'>La dirección de correo $correo NO es válida</p>";
                echo "<a href='../views/register.html' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Volver</a>";
                echo "</div>";
            } else 
                $uppercase = preg_match('@[A-Z]@', $contrasena);
                $numbers = preg_match('@[0-9]{2,}@', $contrasena);

                if (!$uppercase || !$numbers || ($password)) { 
                    // Contraseña no cumple con los requisitos
                    echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; border: 1px solid #808080; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; font-family: \"Times New Roman\", Times, serif; font-size: 20px !important;'>";
                    echo "<p style='margin-bottom: 20px;'>La contraseña debe contener al menos una mayúscula y dos números.</p>";
                    echo "<a href='../views/register.html' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Volver</a>";
                    echo "</div>";
                } else {

    $sql = "INSERT INTO usuarios (nombre, telefono, cedula, correo, contrasena) VALUES ('$nombre', '$telefono', '$cedula', '$correo', '$contrasena')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso";
        header("Location: ../views/loguin.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

$conexion->close();

?>