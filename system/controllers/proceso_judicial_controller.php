<?php
    class Proceso_Judicial_Controller{
        private $table_name = '';

        function __construct(){
            $this->table_name = 'proceso_judicial';
        }

        public function insert($Proceso_Judicial_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("INSERT INTO " . $this->table_name . " (descripcion, fecha_registro, id_usuario, dui) VALUES (?, ?, ?, ?)");

            $query->execute(array(
                $Proceso_Judicial_Model->get_descripcion(),
                $Proceso_Judicial_Model->get_fecha_registro(),
                $Proceso_Judicial_Model->get_id_usuario(),
                $Proceso_Judicial_Model->get_dui()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }

        public function update($Proceso_Judicial_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("UPDATE " . $this->table_name . " SET
                descripcion = ?,
                fecha_registro = ?,
                id_usuario = ?,
                dui = ?
                WHERE id_proceso = ?");

            $query->execute(array(
                $Proceso_Judicial_Model->get_descripcion(),
                $Proceso_Judicial_Model->get_fecha_registro(),
                $Proceso_Judicial_Model->get_id_usuario(),
                $Proceso_Judicial_Model->get_dui(),
                $Proceso_Judicial_Model->get_id_proceso()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }

        public function delete($Proceso_Judicial_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_proceso = ?");

            $query->execute(array(
                $Proceso_Judicial_Model->get_id_proceso()
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }

        public function select_all(){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name);

            $query->execute();

            foreach($query as $data){
                $proceso_judicial['id_proceso'] = $data['id_proceso'];
                $proceso_judicial['descripcion'] = $data['descripcion'];
                $proceso_judicial['fecha_registro'] = $data['fecha_registro'];
                $proceso_judicial['id_usuario'] = $data['id_usuario'];
                $proceso_judicial['dui'] = $data['dui'];

                $array[] = $proceso_judicial;
            }

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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_proceso = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Proceso = new Proceso_Judicial_Model();

                $Proceso->set_id_proceso($data['id_proceso']);
                $Proceso->set_descripcion($data['descripcion']);
                $Proceso->set_fecha_registro($data['fecha_registro']);
                $Proceso->set_id_usuario($data['id_usuario']);
                $Proceso->set_dui($data['dui']);
            }

            $cn = null;

            if(isset($Proceso)){
                return $Proceso;
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
				$proceso['id_proceso'] = $data['id_proceso'];
				$proceso['descripcion'] = $data ['descripcion'];
                $proceso['fecha_registro'] = $data['fecha_registro'];
                $proceso['id_usuario'] = $data['id_usuario'];
				$proceso['dui'] = $data['dui'];

				$array[] = $proceso;
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
                    $query = $cn->prepare("SELECT COUNT(*) AS TOTAL FROM " . $this->table_name . " AS PJ 
                    INNER JOIN clientes AS C 
                    ON PJ.dui = C.dui 
                    WHERE C.id_cartera = ? AND PJ.fecha_registro BETWEEN ? AND ? AND PJ.id_usuario = ?");

                    $query->execute(array(
                        $id_cartera,
                        $fecha_inicio,
                        $fecha_final,
                        $id_usuario
                    ));
                }else{
                    // fecha - cartera
                    $query = $cn->prepare("SELECT COUNT(*) AS TOTAL FROM " . $this->table_name . " AS PJ 
                    INNER JOIN clientes AS C 
                    ON PJ.dui = C.dui 
                    WHERE C.id_cartera = ? AND PJ.fecha_registro BETWEEN ? AND ?");

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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " AS PJ 
            INNER JOIN clientes AS C 
            ON PJ.dui = C.dui 
            WHERE PJ.id_usuario = ? AND PJ.fecha_registro BETWEEN ? AND ? AND C.id_cartera = ?");

            $query->execute(array(
                $id_usuario,
                $fecha_inicio,
                $fecha_final,
                $id_cartera
            ));

            foreach($query as $data){
                $proceso['id_proceso'] = $data['id_proceso'];
                $proceso['descripcion'] = $data ['descripcion'];
                $proceso['fecha_registro'] = $data['fecha_registro'];
                $proceso['id_usuario'] = $data['id_usuario'];
                $proceso['dui'] = $data['dui'];

                $array[] = $proceso;
            }

            $cn = null;

            if(isset($array)){
                return $array;
            }

            return null;
        }
    }
?>