<?php
	/**
	 * Clase para administrar las funcionalidades de las deudas
	*/
	class Deudas_Controller{
		/**
		 * Propiedades
		*/
		private $table_name;

		/**
		 * Inicialziación de los datos
		*/
		function __construct(){
			$this->table_name = 'deudas';
		}

		/**
		 * Funccion para insertar un dato a la tabla
		 * Devuelve: true || false
		*/
		public function insert($Deudas_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("INSERT INTO " . $this->table_name . " (numero_factura, total_deuda, valor_cuotas, numero_cuotas, ultima_fecha_pago, dia_pago, numero_cuotas_pendientes, total_pendiente, numero_cuotas_pagadas, total_pagado, porcentaje_mora, valor_mora, numero_cuotas_mora, total_mora, total_deuda_mora,  fecha_registro, id_usuario, dui) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

			$query->execute(array(
				$Deudas_Model->get_numero_factura(),
				$Deudas_Model->get_total_deuda(),
				$Deudas_Model->get_valor_cuotas(),
				$Deudas_Model->get_numero_cuotas(),
				$Deudas_Model->get_ultima_fecha_pago(),
				$Deudas_Model->get_dia_pago(),
				$Deudas_Model->get_numero_cuotas_pendientes(),
				$Deudas_Model->get_total_pendiente(),
				$Deudas_Model->get_numero_cuotas_pagadas(),
				$Deudas_Model->get_total_pagado(),
				$Deudas_Model->get_porcentaje_mora(),
				$Deudas_Model->get_valor_mora(),
				$Deudas_Model->get_numero_cuotas_mora(),
				$Deudas_Model->get_total_mora(),
				$Deudas_Model->get_total_deuda_mora(),
				$Deudas_Model->get_fecha_registro(),
				$Deudas_Model->get_id_usuario(),
				$Deudas_Model->get_dui(),
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
		}

		/**
		 * Funcion para actualizar los datos de la tabla
		 * Devuelve: true || false
		*/
		public function update($Deudas_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("UPDATE " . $this->table_name . " SET
				numero_factura = ?,
				total_deuda = ?,
				valor_cuotas = ?,
				numero_cuotas = ?,
				ultima_fecha_pago = ?,
				dia_pago = ?,
				numero_cuotas_pendientes = ?,
				total_pendiente = ?,
				numero_cuotas_pagadas = ?,
				total_pagado = ?,
				porcentaje_mora = ?,
				valor_mora = ?,
				numero_cuotas_mora = ?,
				total_mora = ?,
				total_deuda_mora = ?,
				fecha_registro = ?,
				id_usuario = ?,
				dui = ?
				WHERE id_deuda = ?");

			$query->execute(array(				
				$Deudas_Model->get_numero_factura(),
				$Deudas_Model->get_total_deuda(),
				$Deudas_Model->get_valor_cuotas(),
				$Deudas_Model->get_numero_cuotas(),
				$Deudas_Model->get_ultima_fecha_pago(),
				$Deudas_Model->get_dia_pago(),
				$Deudas_Model->get_numero_cuotas_pendientes(),
				$Deudas_Model->get_total_pendiente(),
				$Deudas_Model->get_numero_cuotas_pagadas(),
				$Deudas_Model->get_total_pagado(),
				$Deudas_Model->get_porcentaje_mora(),
				$Deudas_Model->get_valor_mora(),
				$Deudas_Model->get_numero_cuotas_mora(),
				$Deudas_Model->get_total_mora(),
				$Deudas_Model->get_total_deuda_mora(),
				$Deudas_Model->get_fecha_registro(),
				$Deudas_Model->get_id_usuario(),
				$Deudas_Model->get_dui(),
				$Deudas_Model->get_id_deuda(),
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
		}

		/**
		 * Funcion para eliminar un registro de la tabla
		*/
		public function delete($Deudas_Model){
			$val = false;

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_deuda = ?");

			$query->execute(array(
				$Deudas_Model->get_id_deuda()
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
		}

		/**
		 * Funcion para recuperar los datos de una tabla
		 * Devuelve: array en caso de que hayan datos, y devuelve null en caso de que no hayan registros
		*/
		public function select_all(){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name);

			$query->execute();

			foreach($query as $data){
				$deuda['id_deuda'] = $data['id_deuda'];
				$deuda['numero_factura'] = $data['numero_factura'];
				$deuda['total_deuda'] = $data['total_deuda'];
				$deuda['valor_cuotas'] = $data['valor_cuotas'];
				$deuda['numero_cuotas'] = $data['numero_cuotas'];
				$deuda['ultima_fecha_pago'] = $data['ultima_fecha_pago'];
				$deuda['dia_pago'] = $data['dia_pago'];
				$deuda['numero_cuotas_pendientes'] = $data['numero_cuotas_pendientes'];
				$deuda['total_pendiente'] = $data['total_pendiente'];
				$deuda['numero_cuotas_pagadas'] = $data['numero_cuotas_pagadas'];
				$deuda['total_pagado'] = $data['total_pagado'];
				$deuda['porcentaje_mora'] = $data['porcentaje_mora'];
				$deuda['valor_mora'] = $data['valor_mora'];
				$deuda['numero_cuotas_mora'] = $data['numero_cuotas_mora'];
				$deuda['total_mora'] = $data['total_mora'];
				$deuda['total_deuda_mora'] = $data['total_deuda_mora'];
				$deuda['fecha_registro'] = $data['fecha_registro'];
				$deuda['id_usuario'] = $data['id_usuario'];
				$deuda['dui'] = $data['dui'];

				$array[] = $deuda;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}

		/**
         * Funcion para recuperar un valor a través de su id
         * Devuelve: Modelo con sus datos en caso de que haya encontrado una coincidencia, null en caso de que no haya encontrado ninguna coincidencia
        */
        public function select_by_id($id){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_deuda = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Deuda = new Deudas_Model();

                $Deuda->set_id_deuda($data['id_deuda']);
                $Deuda->set_numero_factura($data['numero_factura']);
                $Deuda->set_total_deuda($data['total_deuda']);
                $Deuda->set_valor_cuotas($data['valor_cuotas']);
                $Deuda->set_numero_cuotas($data['numero_cuotas']);
                $Deuda->set_ultima_fecha_pago($data['ultima_fecha_pago']);
                $Deuda->set_dia_pago($data['dia_pago']);
                $Deuda->set_numero_cuotas_pendientes($data['numero_cuotas_pendientes']);
                $Deuda->set_total_pendiente($data['total_pendiente']);
                $Deuda->set_numero_cuotas_pagadas($data['numero_cuotas_pagadas']);
                $Deuda->set_total_pagado($data['total_pagado']);
                $Deuda->set_porcentaje_mora($data['porcentaje_mora']);
                $Deuda->set_valor_mora($data['valor_mora']);
                $Deuda->set_numero_cuotas_mora($data['numero_cuotas_mora']);
                $Deuda->set_total_mora($data['total_mora']);
                $Deuda->set_total_deuda_mora($data['total_deuda_mora']);
                $Deuda->set_fecha_registro($data['fecha_registro']);
                $Deuda->set_id_usuario($data['id_usuario']);
                $Deuda->set_dui($data['dui']);
            }

            $cn = null;

            if(isset($Deuda)){
                return $Deuda;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_by_dui($dui){
			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE dui = ?");

			$query->execute(array(
				$dui
			));

			foreach($query as $data){
				$deuda['id_deuda'] = $data['id_deuda'];
				$deuda['numero_factura'] = $data['numero_factura'];
				$deuda['total_deuda'] = $data['total_deuda'];
				$deuda['valor_cuotas'] = $data['valor_cuotas'];
				$deuda['numero_cuotas'] = $data['numero_cuotas'];
				$deuda['ultima_fecha_pago'] = $data['ultima_fecha_pago'];
				$deuda['dia_pago'] = $data['dia_pago'];
				$deuda['numero_cuotas_pendientes'] = $data['numero_cuotas_pendientes'];
				$deuda['total_pendiente'] = $data['total_pendiente'];
				$deuda['numero_cuotas_pagadas'] = $data['numero_cuotas_pagadas'];
				$deuda['total_pagado'] = $data['total_pagado'];
				$deuda['porcentaje_mora'] = $data['porcentaje_mora'];
				$deuda['valor_mora'] = $data['valor_mora'];
				$deuda['numero_cuotas_mora'] = $data['numero_cuotas_mora'];
				$deuda['total_mora'] = $data['total_mora'];
				$deuda['total_deuda_mora'] = $data['total_deuda_mora'];
				$deuda['fecha_registro'] = $data['fecha_registro'];
				$deuda['id_usuario'] = $data['id_usuario'];
				$deuda['dui'] = $data['dui'];

				$array[] = $deuda;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}

		/**
		 * select
		*/
		public function count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario){
			if(!empty($fecha_final)){
				$fecha_final = $fecha_final . ' 23:59:59';
			}else{
				$fecha_final = $fecha_inicio . ' 23:59:59';
			}
			$fecha_inicio = $fecha_inicio . ' 00:00:00';

			$conexion = new Conexion();
			$cn = $conexion->connect();
			
			if($id_cartera > 0){
				if($id_usuario > 0){
					// fecha - cartera - usuario
					$query = $cn->prepare("SELECT COUNT(*) AS TOTAL FROM " . $this->table_name . " AS D 
					INNER JOIN clientes AS C 
					ON D.dui = C.dui 
					WHERE C.id_cartera = ? AND D.fecha_registro BETWEEN ? AND ? AND D.id_usuario = ?");

					$query->execute(array(
						$id_cartera,
						$fecha_inicio,
						$fecha_final,
						$id_usuario
					));
				}else{
					// fecha - cartera
					$query = $cn->prepare("SELECT COUNT(*) AS TOTAL FROM " . $this->table_name . " AS D 
					INNER JOIN clientes AS C 
					ON D.dui = C.dui 
					WHERE C.id_cartera = ? AND D.fecha_registro BETWEEN ? AND ?");

					$query->execute(array(
						$id_cartera,
						$fecha_inicio,
						$fecha_final
					));
				}
			}else{
				if($id_usuario > 0){
					// fecha - id_usuario
					$query = $cn->prepare("SELECT COUNT(*) AS TOTAL FROM " . $this->table_name . " WHERE fecha_registro BETWEEN ? AND ? AND id_usuario = ?");

					$query->execute(array(
						$fecha_inicio,
						$fecha_final,
						$id_usuario
					));
				}else{
					// fecha
					$query = $cn->prepare("SELECT COUNT(*) AS TOTAL FROM " . $this->table_name . " WHERE fecha_registro BETWEEN ? AND ?");

					$query->execute(array(
						$fecha_inicio,
						$fecha_final
					));
				}
			}

			$total = 0;

			foreach($query as $data){
				$total = $data['TOTAL'];
			}

			$cn = null;

			return $total;
		}

		public function select_all_by_id_usuario_fecha_registro_id_cartera($id_usuario, $fecha_inicio, $fecha_final, $id_cartera){
			if(!empty($fecha_final)){
                $fecha_final = $fecha_final . ' 23:59:59';
            }else{
                $fecha_final = $fecha_inicio . ' 23:59:59';
            }
            $fecha_inicio = $fecha_inicio . ' 00:00:00';

			$conexion = new Conexion();
			$cn = $conexion->connect();

			$query = $cn->prepare("SELECT * FROM " . $this->table_name . " AS D 
			INNER JOIN clientes AS C 
			ON D.dui = C.dui 
			WHERE D.id_usuario = ? AND D.fecha_registro BETWEEN ? AND ? AND C.id_cartera = ?");

			$query->execute(array(
				$id_usuario,
				$fecha_inicio,
				$fecha_final,
				$id_cartera
			));

			foreach($query as $data){
				$deuda['id_deuda'] = $data['id_deuda'];
				$deuda['numero_factura'] = $data['numero_factura'];
				$deuda['total_deuda'] = $data['total_deuda'];
				$deuda['valor_cuotas'] = $data['valor_cuotas'];
				$deuda['numero_cuotas'] = $data['numero_cuotas'];
				$deuda['ultima_fecha_pago'] = $data['ultima_fecha_pago'];
				$deuda['dia_pago'] = $data['dia_pago'];
				$deuda['numero_cuotas_pendientes'] = $data['numero_cuotas_pendientes'];
				$deuda['total_pendiente'] = $data['total_pendiente'];
				$deuda['numero_cuotas_pagadas'] = $data['numero_cuotas_pagadas'];
				$deuda['total_pagado'] = $data['total_pagado'];
				$deuda['porcentaje_mora'] = $data['porcentaje_mora'];
				$deuda['valor_mora'] = $data['valor_mora'];
				$deuda['numero_cuotas_mora'] = $data['numero_cuotas_mora'];
				$deuda['total_mora'] = $data['total_mora'];
				$deuda['total_deuda_mora'] = $data['total_deuda_mora'];
				$deuda['fecha_registro'] = $data['fecha_registro'];
				$deuda['id_usuario'] = $data['id_usuario'];
				$deuda['dui'] = $data['dui'];

				$array[] = $deuda;
			}

			$cn = null;

			if(isset($array)){
				return $array;
			}

			return null;
		}
	}
?>