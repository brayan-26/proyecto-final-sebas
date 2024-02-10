<?php
// Conexión a la base de datos (debes tener tus propias credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sebas";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
    if (isset($_POST["correo"]) && isset($_POST["contrasena"])) {
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

    // Validación de contraseña
    if (strlen($contrasena) < 8 || !preg_match("/^[A-Z]/", $contrasena) || !preg_match("/[0-9]/", $contrasena)) {
        echo "la contraseña no corresponde con el usuario";
    } else {
        echo "Los datos del formulario son incorrectos.";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Verificar la conexión
        if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

        // Consulta para verificar la existencia del usuario
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
        $result = $conn->query($sql);

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($result->num_rows > 0) {
            // Inicio de sesión exitoso
            // Redirigir a la página principal
            header("Location:../views/principal.html");
        } else {
            // Inicio de sesión fallido
            // Puedes redirigir a una página de error o mostrar un mensaje
            echo "usuario no encontrado.";
        }

        // Cerrar la conexión
        $conn->close();
    }
}
