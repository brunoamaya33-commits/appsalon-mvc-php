<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    
    public static function index(Router $router) {

        // 1. Iniciar sesión de forma segura
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Proteger la página (esto es lo más importante)
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            header('Location: /login');
            exit();
        }

        // 3. Renderizar la vista
        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'] ?? 'Usuario',
            'id'     => $_SESSION['id']
        ]);
    }
}