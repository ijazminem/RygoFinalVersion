<?php
    class Contactos_Controller{
        private $table_name = '';

        function __construct(){
            $this->table_name = 'contactos';
        }

        public function insert($Contactos_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("INSERT INTO " . $this->table_name . " (nombre_completo, direccion, telefono, parentezco, trabajo, direccion_trabajo, telefono_trabajo, tipo_contacto, fecha_registro, id_usuario, dui) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

			$query->execute(array(
				$Contactos_Model->get_nombre_completo(),
                $Contactos_Model->get_direccion(),
                $Contactos_Model->get_telefono(),
                $Contactos_Model->get_parentezco(),
                $Contactos_Model->get_trabajo(),
                $Contactos_Model->get_direccion_trabajo(),
                $Contactos_Model->get_telefono_trabajo(),
                $Contactos_Model->get_tipo_contacto(),
                $Contactos_Model->get_fecha_registro(),
                $Contactos_Model->get_id_usuario(),
                $Contactos_Model->get_dui(),
			));

			if($query->rowCount() > 0){
                $val = true;
            }

			$cn = null;

			return $val;
        }

        public function update($Contactos_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("UPDATE " . $this->table_name . " SET
                nombre_completo = ?,
                direccion = ?,
                telefono = ?,
                parentezco = ?,
                trabajo = ?,
                direccion_trabajo = ?,
                telefono_trabajo = ?,
                tipo_contacto = ?,
                fecha_registro = ?,
                id_usuario = ?,
                dui = ?
                WHERE id_contacto = ?");

            $query->execute(array(
                $Contactos_Model->get_nombre_completo(),
                $Contactos_Model->get_direccion(),
                $Contactos_Model->get_telefono(),
                $Contactos_Model->get_parentezco(),
                $Contactos_Model->get_trabajo(),
                $Contactos_Model->get_direccion_trabajo(),
                $Contactos_Model->get_telefono_trabajo(),
                $Contactos_Model->get_tipo_contacto(),
                $Contactos_Model->get_fecha_registro(),
                $Contactos_Model->get_id_usuario(),
                $Contactos_Model->get_dui(),
                $Contactos_Model->get_id_contacto(),
            ));

            if($query->rowCount() > 0){
                $val = true;
            }

            $cn = null;

            return $val;
        }
        
        public function delete($Contactos_Model){
            $val = false;

            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("DELETE FROM " . $this->table_name . " WHERE id_contacto = ?");

            $query->execute(array(
                $Contactos_Model->get_id_contacto()
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
                $contactos['id_contacto'] = $data['id_contacto'];
                $contactos['nombre_completo'] = $data['nombre_completo'];
                $contactos['direccion'] = $data['direccion'];
                $contactos['telefono'] = $data['telefono'];
                $contactos['parentezco'] = $data['parentezco'];
                $contactos['trabajo'] = $data['trabajo'];
                $contactos['direccion_trabajo'] = $data['direccion_trabajo'];
                $contactos['telefono_trabajo'] = $data['telefono_trabajo'];
                $contactos['tipo_contacto'] = $data['tipo_contacto'];
                $contactos['fecha_registro'] = $data['fecha_registro'];
                $contactos['id_usuario'] = $data['id_usuario'];
                $contactos['dui'] = $data['dui'];

                $array[] = $contactos;
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

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_contacto = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $Contacto = new Contactos_Model();

                $Contacto->set_id_contacto($data['id_contacto']);
                $Contacto->set_nombre_completo($data['nombre_completo']);
                $Contacto->set_direccion($data['direccion']);
                $Contacto->set_telefono($data['telefono']);
                $Contacto->set_parentezco($data['parentezco']);
                $Contacto->set_trabajo($data['trabajo']);
                $Contacto->set_direccion_trabajo($data['direccion_trabajo']);
                $Contacto->set_telefono_trabajo($data['telefono_trabajo']);
                $Contacto->set_tipo_contacto($data['tipo_contacto']);
                $Contacto->set_fecha_registro($data['fecha_registro']);
                $Contacto->set_id_usuario($data['id_usuario']);
                $Contacto->set_dui($data['dui']);
            }

            $cn = null;

            if(isset($Contacto)){
                return $Contacto;
            }

            return null;
        }

        /**
         * 
        */
        public function select_all_id_cartera($id){
            $conexion = new Conexion();
            $cn = $conexion->connect();

            $query = $cn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_cartera = ?");

            $query->execute(array(
                $id
            ));

            foreach($query as $data){
                $contactos['id_contacto'] = $data['id_contacto'];
                $contactos['nombre_completo'] = $data['nombre_completo'];
                $contactos['direccion'] = $data['direccion'];
                $contactos['telefono'] = $data['telefono'];
                $contactos['parentezco'] = $data['parentezco'];
                $contactos['trabajo'] = $data['trabajo'];
                $contactos['direccion_trabajo'] = $data['direccion_trabajo'];
                $contactos['telefono_trabajo'] = $data['telefono_trabajo'];
                $contactos['tipo_contacto'] = $data['tipo_contacto'];
                $contactos['fecha_registro'] = $data['fecha_registro'];
                $contactos['id_usuario'] = $data['id_usuario'];
                $contactos['dui'] = $data['dui'];

                $array[] = $contactos;
            }

            $cn = null;

            if(isset($array)){
                return $array;
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
                $contactos['id_contacto'] = $data['id_contacto'];
                $contactos['nombre_completo'] = $data['nombre_completo'];
                $contactos['direccion'] = $data['direccion'];
                $contactos['telefono'] = $data['telefono'];
                $contactos['parentezco'] = $data['parentezco'];
                $contactos['trabajo'] = $data['trabajo'];
                $contactos['direccion_trabajo'] = $data['direccion_trabajo'];
                $contactos['telefono_trabajo'] = $data['telefono_trabajo'];
                $contactos['tipo_contacto'] = $data['tipo_contacto'];
                $contactos['fecha_registro'] = $data['fecha_registro'];
                $contactos['id_usuario'] = $data['id_usuario'];
                $contactos['dui'] = $data['dui'];

                $array[] = $contactos;
            }

            $cn = null;

            if(isset($array)){
                return $array;
            }

            return null;
        }
    }
?>