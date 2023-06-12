<?php
	class Contactos_Model{
		private $id_contacto;
		private $nombre_completo;
		private $direccion;
		private $telefono;
		private $parentezco;
		private $trabajo;
		private $direccion_trabajo;
		private $telefono_trabajo;
		private $tipo_contacto;
		private $fecha_registro;
		private $id_usuario;
		private $dui;

		function __construct(){
			$this->id_contacto = 0;
			$this->nombre_completo = '';
			$this->direccion = '';
			$this->telefono = '';
			$this->parentezco = '';
			$this->trabajo = '';
			$this->direccion_trabajo = '';
			$this->telefono_trabajo = '';
			$this->tipo_contacto = '';
			$this->fecha_registro = '';
			$this->id_usuario = 0;
			$this->dui = '';
		}

		/**
		 * id_contacto
		*/
		public function get_id_contacto(){
			return $this->id_contacto;
		}

		public function set_id_contacto($id){
			$this->id_contacto = $id;
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
		 * direccion
		*/
		public function get_direccion(){
			return $this->direccion;
		}

		public function set_direccion($direccion){
			$this->direccion = $direccion;
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
		 * parentezco
		*/
		public function get_parentezco(){
			return $this->parentezco;
		}

		public function set_parentezco($parentezco){
			$this->parentezco = $parentezco;
		}

		/**
		 * trabajo
		*/
		public function get_trabajo(){
			return $this->trabajo;
		}

		public function set_trabajo($trabajo){
			$this->trabajo = $trabajo;
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
		 * tipo_contacto
		*/
		public function get_tipo_contacto(){
			return $this->tipo_contacto;
		}

		public function set_tipo_contacto($tipo_contacto){
			$this->tipo_contacto = $tipo_contacto;
		}

		/**
		 * fecha_registro
		*/
		public function get_fecha_registro(){
			return $this->fecha_registro;
		}

		public function set_fecha_registro($fecha_registro){
			$this->fecha_registro = $fecha_registro;
		}

		/**
		 * id_usuario
		*/
		public function get_id_usuario(){
			return $this->id_usuario;
		}

		public function set_id_usuario($id_usuario){
			$this->id_usuario = $id_usuario;
		}

		/**
		 * dui
		*/
		public function get_dui(){
			return $this->dui;
		}

		public function set_dui($dui){
			$this->dui = $dui;
		}
	}
?>