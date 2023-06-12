<?php
    /**
     * Clase para administrar los archivos
    */
    class Clientes_Model{
        /**
         * Propiedades
        */
        private $dui;
        private $id_cliente;
        private $nombre_completo;
        private $telefono;
        private $sexo;
        private $profesion;
        private $fecha_nacimiento;
        private $direccion;
        private $direccion_trabajo;
        private $telefono_trabajo;
        private $sueldo;
        private $estado;
        private $fecha_registro;
        private $id_cartera;

        /**
         * Inicialización de los valores
        */

        function __construct(){
            $this->dui = '';
            $this->id_cliente = 0;
            $this->nombre_completo = '';
            $this->telefono = 0;
            $this->sexo = '';
            $this->profesion = '';
            $this->fecha_nacimiento = null;
            $this->direccion = '';
            $this->direccion_trabajo = '';
            $this->telefono_trabajo = '';
            $this->sueldo = 0.00;
            $this->estado = '';
            $this->fecha_registro = '';
            $this->id_cartera = 0;
        }

        /**
         * Getters y Setters
        */
        /**
         * dui
        */
        public function get_dui(){
            return $this->dui;
        }

        public function set_dui($dui){
            $this->dui = $dui;
        }

        /**
         * id_cliente
        */
        public function get_id_cliente(){
            return $this->id_cliente;
        }

        public function set_id_cliente($id_cliente){
            $this->id_cliente = $id_cliente;
        }

        /**
         * nombre_completo
        */
        public function get_nombre_completo(){
            return $this->nombre_completo;
        }

        public function set_nombre_completo($nombre){
            $this->nombre_completo = $nombre;
        }

        /**
         * telefono
        */
        public function get_telefono(){
            return $this->telefono;
        }

        public function set_telefono($telefono){
            $this->telefono = $telefono;
        }

        /**
         * sexo
        */
        public function get_sexo(){
            return $this->sexo;
        }

        public function set_sexo($sexo){
            $this->sexo = $sexo;
        }

        /**
         * profesion
        */
        public function get_profesion(){
            return $this->profesion;
        }

        public function set_profesion($profesion){
            $this->profesion = $profesion;
        }

        /**
         * fecha_nacimiento
        */
        public function get_fecha_nacimiento(){
            return $this->fecha_nacimiento;
        }

        public function set_fecha_nacimiento($fecha_nacimiento){
            $this->fecha_nacimiento = $fecha_nacimiento;
        }

        /**
         * direccion
        */
        public function get_direccion(){
            return $this->direccion;
        }

        public function set_direccion($direccion){
            $this->direccion = $direccion;
        }

        /**
         * direccion_trabajo
        */
        public function get_direccion_trabajo(){
            return $this->direccion_trabajo;
        }

        public function set_direccion_trabajo($direccion_trabajo){
            $this->direccion_trabajo = $direccion_trabajo;
        }

        /**
         * telefono_trabajo
        */
        public function get_telefono_trabajo(){
            return $this->telefono_trabajo;
        }

        public function set_telefono_trabajo($telefono_trabajo){
            $this->telefono_trabajo = $telefono_trabajo;
        }

        /**
         * sueldo
        */
        public function get_sueldo(){
            return $this->sueldo;
        }

        public function set_sueldo($sueldo){
            $this->sueldo = $sueldo;
        }

        /**
         * estado
        */
        public function get_estado(){
            return $this->estado;
        }

        public function set_estado($estado){
            $this->estado = $estado;
        }

        /**
         * fecha_registro
        */
        public function get_fecha_registro(){
            return $this->fecha_registro;
        }

        public function set_fecha_registro($fecha){
            $this->fecha_registro = $fecha;
        }

        /**
         * id_cartera
        */
        public function get_id_cartera(){
            return $this->id_cartera;
        }

        public function set_id_cartera($id_cartera){
            $this->id_cartera = $id_cartera;
        }
    }
?>