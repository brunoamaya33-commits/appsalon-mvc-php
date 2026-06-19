<?php 

namespace Model;

class Servicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
       $this->id = $args['id'] ?? null;
       $this->nombre = $args['nombre'] ?? '';
       $this->precio = $args['precio'] ?? '';
    }

    /**
     * Retorna el precio formateado con puntos (formato español)
     * Ejemplo: 14000 → $14.000
     */
    public function getPrecioFormateado(): string
    {
        $precio = (int) $this->precio;
        return '$' . number_format($precio, 0, ',', '.');
    }

    /**
     * Retorna solo el número formateado (sin el signo $)
     */
    public function getPrecioNumero(): string
    {
        $precio = (int) $this->precio;
        return number_format($precio, 0, ',', '.');
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del servicio es obligatorio.';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El precio del servicio es obligatorio.';
        }
        if(!is_numeric($this->precio)) {
            self::$alertas['error'][] = 'El precio no es válido.';
        }

        return self::$alertas;
    }
}