<?php 

// models/UserModel.php
class UserModel {
    public function getUserByUsername($username) {
        // Aquí iría tu código para obtener un usuario de la base de datos
        // basado en el nombre de usuario
    }

    public function createUser($username, $password) {
        // Aquí iría tu código para insertar un nuevo usuario en la base de datos
        // Asegúrate de hashear la contraseña antes de almacenarla
    }
}
