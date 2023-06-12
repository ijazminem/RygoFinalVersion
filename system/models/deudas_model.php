<?php
	/**
	 * Clase para administrar las Deudas
	*/
	class Deudas_Model{
		/**
		 * Propiedades
		*/
		private $id_deuda;
		private $numero_factura;
		private $total_deuda;
		private $valor_cuotas;
		private $numero_cuotas;
		private $ultima_fecha_pago;
		private $dia_pago;
		private $numero_cuotas_pendientes;
		private $total_pendiente;
		private $numero_cuotas_pagadas;
		private $total_pagado;
		private $porcentaje_mora;
		private $valor_mora;
		private $numero_cuotas_mora;
		private $total_mora;
		private $total_deuda_mora;
		private $fecha_registro;
		private $id_usuario;
		private $dui;

		/**
		 * Inicialización de valores
		*/
		function __construct(){
			$this->id_deuda = 0;
			$this->numero_factura = '';
			$this->total_deuda = 0.0;
			$this->valor_cuotas = 0.0;
			$this->numero_cuotas = 0;
			$this->ultima_fecha_pago = null;
			$this->dia_pago = 0;
			$this->numero_cuotas_pendientes = 0;
			$this->total_pendiente = 0.0;
			$this->numero_cuotas_pagadas = 0;
			$this->total_pagado = 0.0;
			$this->porcentaje_mora = 0.0;
			$this->valor_mora = 0.0;
			$this->numero_cuotas_mora = 0;
			$this->total_mora = 0.0;
			$this->total_deuda_mora = 0.0;
			$this->fecha_registro = '';
			$this->id_usuario = 0;
			$this->dui = '';
		}

		/**
		 * Gestión de datos
		*/
		/**
		 * id_deuda
		*/
		public function get_id_deuda(){
			return $this->id_deuda;
		}

		public function set_id_deuda($id_deuda){
			$this->id_deuda = $id_deuda;
		}

		/**
		 * numero_factura
		*/
		public function get_numero_factura(){
			return $this->numero_factura;
		}

		public function set_numero_factura($numero_factura){
			$this->numero_factura = $numero_factura;
		}

		/**
		 * total_deuda
		*/
		public function get_total_deuda(){
			return $this->total_deuda;
		}

		public function set_total_deuda($total_deuda){
			$this->total_deuda = $total_deuda;
		}

		/**
		 * valor_cuotas
		*/
		public function get_valor_cuotas(){
			return $this->valor_cuotas;
		}

		public function set_valor_cuotas($valor_cuotas){
			$this->valor_cuotas = $valor_cuotas;
		}

		/**
		 * numero_cuotas
		*/
		public function get_numero_cuotas(){
			return $this->numero_cuotas;
		}

		public function set_numero_cuotas($numero_cuotas){
			$this->numero_cuotas = $numero_cuotas;
		}

		/**
		 * ultima_fecha_pago
		*/
		public function get_ultima_fecha_pago(){
			return $this->ultima_fecha_pago;
		}

		public function set_ultima_fecha_pago($ultima_fecha_pago){
			$this->ultima_fecha_pago = $ultima_fecha_pago;
		}

		/**
		 * dia_pago
		*/
		public function get_dia_pago(){
			return $this->dia_pago;
		}

		public function set_dia_pago($dia_pago){
			$this->dia_pago = $dia_pago;
		}

		/**
		 * numero_cuotas_pendientes
		*/
		public function get_numero_cuotas_pendientes(){
			return $this->numero_cuotas_pendientes;
		}

		public function set_numero_cuotas_pendientes($numero_cuotas_pendientes){
			$this->numero_cuotas_pendientes = $numero_cuotas_pendientes;
		}

		/**
		 * total_pendiente
		*/
		public function get_total_pendiente(){
			return $this->total_pendiente;
		}

		public function set_total_pendiente($total_pendiente){
			$this->total_pendiente = $total_pendiente;
		}

		/**
		 * numero_cuotas_pagadas
		*/
		public function get_numero_cuotas_pagadas(){
			return $this->numero_cuotas_pagadas;
		}

		public function set_numero_cuotas_pagadas($numero_cuotas_pagadas){
			$this->numero_cuotas_pagadas = $numero_cuotas_pagadas;
		}

		/**
		 * total_pagado
		*/
		public function get_total_pagado(){
			return $this->total_pagado;
		}

		public function set_total_pagado($total_pagado){
			$this->total_pagado = $total_pagado;
		}

		/**
		 * porcentaje_mora
		*/
		public function get_porcentaje_mora(){
			return $this->porcentaje_mora;
		}

		public function set_porcentaje_mora($porcentaje_mora){
			$this->porcentaje_mora = $porcentaje_mora;
		}

		/**
		 * valor_mora
		*/
		public function get_valor_mora(){
			return $this->valor_mora;
		}

		public function set_valor_mora($valor_mora){
			$this->valor_mora = $valor_mora;
		}

		/**
		 * numero_cuotas_mora
		*/
		public function get_numero_cuotas_mora(){
			return $this->numero_cuotas_mora;
		}

		public function set_numero_cuotas_mora($numero_cuotas_mora){
			$this->numero_cuotas_mora = $numero_cuotas_mora;
		}

		/**
		 * total_mora
		*/
		public function get_total_mora(){
			return $this->total_mora;
		}

		public function set_total_mora($total_mora){
			$this->total_mora = $total_mora;
		}

		/**
		 * total_deuda_mora
		*/
		public function get_total_deuda_mora(){
			return $this->total_deuda_mora;
		}

		public function set_total_deuda_mora($total_deuda_mora){
			$this->total_deuda_mora = $total_deuda_mora;
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
		 * id_usuario
		*/
		public function get_id_usuario(){
			return $this->id_usuario;
		}

		public function set_id_usuario($id){
			$this->id_usuario = $id;
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