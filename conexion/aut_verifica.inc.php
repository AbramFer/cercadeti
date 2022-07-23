<?php 
// Motor autentificaci� usuarios.

// Cargar datos conexion y otras variables.
require ("conexion/aut_config.inc.php");
// chequear p�ina que lo llama para devolver errores a dicha p�ina.

$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;

// chequear si se llama directo al script.
if ($_SERVER['HTTP_REFERER'] == ""){
    session_name($usuarios_sesion);
    session_start();
    session_unset();
    session_destroy();
    die(header ("Location:  index.php?error_login=7"));
    //die ("Error cod.:1 - Acceso incorrecto!");
    exit;
}


// Chequeamos si se est�autentificandose un usuario por medio del formulario
if (isset($_POST['user']) && isset($_POST['pass'])) {

    // Conexi� base de datos.
    // si no se puede conectar a la BD salimos del scrip con error 0 y
    // redireccionamos a la pagina de error.
    $db_conexion = mysqli_connect("$sql_host", "$sql_usuario", "$sql_pass", "$sql_db") or die(header ("Location:  $redir?error_login=0"));

    // realizamos la consulta a la BD para chequear datos del Usuario.
    $usuario_consulta = mysqli_query($db_conexion, "SELECT * FROM $sql_tabla WHERE usuario='".strtoupper($_POST['user'])."'") or die(header ("Location:  $redir?error_login=1"));

    // miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)
    if (mysqli_num_rows($usuario_consulta) != 0) {

        // eliminamos barras invertidas y dobles en sencillas
        $login = stripslashes(strtoupper($_POST['user']));
        // encriptamos el password en formato md5 irreversible.
        $password = md5($_POST['pass']);

        // almacenamos datos del Usuario en un array para empezar a chequear.
        $usuario_datos=mysqli_fetch_array($usuario_consulta);

        // liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
        //agregada por mi
        mysqli_free_result($usuario_consulta);

        // cerramos la Base de dtos.
        mysqli_close($db_conexion);

        // si el password no es correcto ..
        // salimos del script con error 3 y redireccinamos hacia la p�ina de error
        if ($password != $usuario_datos['pass']) {
            Header ("Location: $redir?error_login=3");
            exit;
        }

        // Paranoia: destruimos las variables login y password usadas
        unset($login);
        unset($password);

        // En este punto, el usuario ya esta validado.
        // Grabamos los datos del usuario en una sesion.

        // le damos un mobre a la sesion.
        session_name($usuarios_sesion);
        // incia sessiones
        session_start();

        // Paranoia: decimos al navegador que no "cachee" esta p�ina.
        session_cache_limiter('nocache,private');

        // Asignamos variables de sesi� con datos del Usuario para el uso en el
        // resto de p�inas autentificadas.

        $_SESSION['sesion_id_usuario'] = $usuario_datos['id_usuario'];
        $_SESSION['sesion_nombre'] = $usuario_datos['nombre'];
        $_SESSION['sesion_usuario'] = $usuario_datos['usuario'];
        $_SESSION['sesion_pass'] = $usuario_datos['pass'];
        $_SESSION['sesion_nivel'] = $usuario_datos['nivel_usuario'];
        $_SESSION['sesion_rango'] = $usuario_datos['rango_numeros'];
       


        // Hacemos una llamada a si mismo (scritp) para que queden disponibles
        // las variables de session en el array asociado $HTTP_...
        $pag=$_SERVER['PHP_SELF'];
        Header ("Location: $pag?");
        exit;

    } else {
        // si no esta el nombre de usuario en la BD o el password ..
        // se devuelve a pagina q lo llamo con error
        Header ("Location: $redir?error_login=2");
        exit;
    }
} else {

    // -------- Chequear sesi� existe -------

    // usamos la sesion de nombre definido.
    session_name($usuarios_sesion);
    // Iniciamos el uso de sesiones
    session_start();

    // Chequeamos si estan creadas las variables de sesi� de identificaci� del usuario,
    // El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
    // con el navegador.

    if (!isset($_SESSION['sesion_usuario']) && !isset($_SESSION['sesion_pass'])){
        // Borramos la sesion creada por el inicio de session anterior
        session_destroy();
        die(header ("Location:  index.php?error_login=7"));
        //die ("Error cod.: 2 - Acceso incorrecto!");
        exit;
    }
}
?>
