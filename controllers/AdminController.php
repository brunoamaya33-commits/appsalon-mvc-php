<?php 

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {

        isAdmin();
        
        // === Validación de fecha ===
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            header('Location: /404');
            exit;
        }

        list($year, $month, $day) = explode('-', $fecha);

        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            header('Location: /404');
            exit;
        }

        // === Consulta SQL (versión segura para tu ActiveRecord) ===
        $consulta = "SELECT citas.id, citas.hora, 
                            CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente,
                            usuarios.email, usuarios.telefono, 
                            servicios.nombre as servicio, servicios.precio  
                     FROM citas  
                     LEFT OUTER JOIN usuarios ON citas.usuarioId = usuarios.id  
                     LEFT OUTER JOIN citasServicios ON citasServicios.citaId = citas.id 
                     LEFT OUTER JOIN servicios ON servicios.id = citasServicios.servicioId 
                     WHERE citas.fecha = '{$fecha}' 
                     ORDER BY citas.hora ASC";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'] ?? '',
            'citas'  => $citas,
            'fecha'  => $fecha
        ]);
    }
}