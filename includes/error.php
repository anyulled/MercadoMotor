<?php

/**
 * Clase manejadora de eventos de error en la aplicacion
 *
 * @author anyul
 */
class error {

    public $error = array();
    public $mail = false;

    public function __construct() {
        error_reporting(0);
        set_error_handler(userErrorHandler);
    }

// user defined error handling function
    public function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars) {
// timestamp for the error entry
        $dt = date("Y-m-d H:i:s (T)");

// define an assoc array of error string
// in reality the only entries we should
// consider are E_WARNING, E_NOTICE, E_USER_ERROR,
// E_USER_WARNING and E_USER_NOTICE
        $errortype = array(
            E_ERROR => 'Error',
            E_WARNING => 'Warning',
            E_PARSE => 'Parsing Error',
            E_NOTICE => 'Notice',
            E_CORE_ERROR => 'Core Error',
            E_CORE_WARNING => 'Core Warning',
            E_COMPILE_ERROR => 'Compile Error',
            E_COMPILE_WARNING => 'Compile Warning',
            E_USER_ERROR => 'User Error',
            E_USER_WARNING => 'User Warning',
            E_USER_NOTICE => 'User Notice',
            E_STRICT => 'Runtime Notice',
            E_RECOVERABLE_ERROR => 'Catchable Fatal Error'
        );
// set of errors for which a var trace will be saved
        $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

        $err = "<div>\n";
        $err .= "\t<p>" . $dt . "</p>\n";
        $err .= "\t<em>" . $errno . "</em>\n";
        $err .= "\t<b>" . $errortype[$errno] . "</b>\n";
        $err .= "\t<span>" . $errmsg . "</span>\n";
        $err .= "\t<p>" . $filename . "</p>\n";
        $err .= "\t<span>" . $linenum . "</span>\n";

        if (in_array($errno, $user_errors)) {
            $err .= "\t<p>" . wddx_serialize_value($vars, "Variables") . "</p>\n";
        }
        $err .= "</div>\n\n";

        array_push($this->error, $err);


// for testing
// echo $err;
// save to the error log, and e-mail me if there is a critical user error
        if ($this->mail) {
            error_log($err, 1, "anyulled@gmail.com");
            if ($errno == E_USER_ERROR) {
                mail("anyulled@gmail.com", "Error mercadomotor.com", $err);
            }
        }
    }
}

?>
