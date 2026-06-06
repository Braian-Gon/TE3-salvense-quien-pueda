<?php
namespace HTTP\Models;
use Config\DataBase;
use Firebase\JWT\JWT;

Class Persona
{
    #region Atributos
    public $ci;
    public $id;
    public  $nombre;
    public  $passwd;
    private $rol;
    private  $estado;
    private static $tabla = 'Persona';
    #endregion
    # El constructor recibe un array de argumentos y una instancia de la base de datos. Asigna los valores a las propiedades de la clase.
    public function __construct( $args = [], protected DataBase $db = new DataBase())
    {
        $this->ci = $args['ci'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->passwd = $args['passwd'] ?? null;
        $this->rol = $args['rol'] ?? null;
        $this->estado = $args['estado'] ?? 'Activo';
        $this->id = $args['id'] ?? null;
    }

    public function login()
    {   
        # Validar la entrada de datos
        $this->validarLogin();
        #Busca el usuario
        $usuario = $this->obtenerUsuario();
        # Si no encuentra el usuario o la contraseña no coincide, retorna un error de autenticación. 
        if (!$usuario || !password_verify($this->passwd, $usuario->passwd)) {
            request(401, 'Credenciales inválidas');
        }
        else {
            # Genera un JWT Token con los datos del usuario
            $token = $this->Token($usuario);
            # Envia el token al cliente a través de una cookie segura y con HttpOnly habilitado, con una duración de 6 horas.
            setcookie('session_cookie', $token, time() + 21600, httponly: true, secure: true);
            # Retorna el rol del usuario en la respuesta para que el cliente pueda manejar la interfaz según el rol.
            request(200, $usuario->rol);
        }

    }

    private function validarLogin(){
        if (!$this->ci){
           request(400, 'El correo no puede estar vacio');
           exit;
        }
        if (!$this->passwd){
            request(400, 'La contraseña no puede estar vacia');
            exit;
        }
    }

    private function obtenerUsuario(){
  
        $sql = "SELECT * FROM " . self::$tabla . " WHERE estado = 'Activo' AND ci = :ci";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->execute([':ci' => $this->ci]);
        return $stmt->fetch();
    }
    public function getPersonas()
    {
        $sql = "SELECT * FROM Persona;";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->execute();
        request(200, json_encode($stmt->fetchAll()));
    }

    private function Token($usuario){
        # Recibe el objeto usuario y genera un token JWT con su id, rol y una fecha de expiración de 6 horas. 
        # El token se firma con una clave secreta definida en las variables de entorno.
         $payload = [
            'id' => $usuario->id,
            'rol' => $usuario->rol,
            'exp' => time() + 21600,
        ];
        $encode = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
        return $encode;
    }
    public function savePersona()
    {
        if(!$this->id)
        {
            $this->hashearContraseña();
            $sql = "INSERT INTO " . self::$tabla . " (ci, nombre, passwd, rol) VALUES (:ci, :nombre, :passwd, :rol)";
            $stmt = $this->db->connection->prepare($sql);
            $stmt->execute([':ci' => $this->ci, ':nombre' => $this->nombre, ':passwd' => $this->passwd, ':rol' => $this->rol]);
            request(201, 'Usuario creado exitosamente');
        }
        else
        {
            $sql = "UPDATE " . self::$tabla . " SET ci = :ci, nombre = :nombre WHERE id = :id";
            $stmt = $this->db->connection->prepare($sql);
            $stmt->execute([
                ':ci' => $this->ci,
                ':nombre' => $this->nombre,
                ':id' => $this->id
            ]);
            request(200, 'Usuario actualizado exitosamente');
        }
        
    }
    private function hashearContraseña(){
        # Utiliza la función password_hash para hashear la contraseña con el algoritmo BCRYPT antes de guardarla en la base de datos.
        $this->passwd = password_hash($this->passwd, PASSWORD_BCRYPT);
    }
    public function updatePasswd()
    {
        $this->hashearContraseña();
        $sql = "UPDATE " . self::$tabla . " SET passwd = :passwd WHERE id = :id";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->execute([':passwd' => $this->passwd, ':id' => $this->id]);
        request(200, 'Contraseña actualizada exitosamente');
    }
    public function delete()
    {
        $sql = "UPDATE " . self::$tabla . " SET estado = 'Desactivado' WHERE id = :id";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->execute([':id' => $this->id]);
        request(200, 'Usuario eliminado exitosamente');
    }
}