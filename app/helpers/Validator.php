<?php
namespace App\Helpers;

/**
 * Clase Validator
 *
 * avlida datos de entrada.
 */
class Validator {

    /**
     * Validar formato de correo electrónico
     *
     * @param string $email Correo a validar
     * @return bool true si el correo es válido, false si no
     */
    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
