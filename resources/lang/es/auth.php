<?php

return [

    /*
   |--------------------------------------------------------------------------
   | API header
   |--------------------------------------------------------------------------
   |
   | Headers validation
   |
   */
    'api_no_compat'       => 'La versión de la APP no es correcta. Te has de actualizar a la Versión :version',
    'compilation_invalid' => 'La versión de la APP no es correcta. Te has de actualizar a la Versión :version',
    'auth_invalid'        => 'Falta el tipo de autorización',
    'headers_incomplete'  => 'Las cabeceras de la petición están incompletas',
    'headers_error'       => 'Hay un problema en las cabeceras de la petición',


    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'       => 'Estas credenciales no coinciden con nuestros registros.',
    'throttle'     => 'Demasiados intentos de acceso. Por favor intente nuevamente en :seconds segundos.',

    /*
	 |--------------------------------------------------------------------------
	 | User
	 |--------------------------------------------------------------------------
	 |
	 */
    "verification" => array(
        "error"    => "No se ha podido activar el usuario",
        "correcto" => "Usuario activado correctamente",
    ),
    "login"        => array(
        "disabled"       => "El usuario está deshabilitado.",
        "baja"           => "Ese usuario ha sido dado de baja en el sistema",
        "noUser"         => "Solo los usuarios estándar pueden loguearse.",
        "invalidCred"    => "credenciales de usuario inválidas.",
        "invalidUser"    => "El usuario no es válido.",
        "userNoExist"    => "No existe ningún usuario con ese correo.",
        "noToken"        => "No se puede generar el token de usuario.",
        "invalidEmail"   => "El email es inválido.",
        "blocked"        => "El usuario se encuentra bloqueado. Revise el correo para reactivarlo",
        "deadPassword"   => "La contraseña ha caducado. Revise el correo para introducir una nueva",
        "wrongConfig"    => "Tu usuario está mal configurado.",
        'signIn'         => "Acceso a tu cuenta",
        'loginBtn'       => "Acceder",
        'forgotPassword' => "¿Olvidaste tu contraseña?",
        'remember'       => 'Recordar',
    ),
    "reset"        => [
        'send_reminder' => 'Reestablecer contraseña',
        'back_login'    => 'Iniciar sesión',
    ],
    "role"         => [
        "forbidden" => "No tiene privilegios para realizar esta acción.",
    ],


];
