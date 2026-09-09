<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Verificación de correo
    |--------------------------------------------------------------------------
    | Cuando está en false, las cuentas nuevas quedan verificadas al crearse,
    | no se envía el correo de verificación y el registro entra directo al
    | panel. Ponlo en true (NCIE_EMAIL_VERIFICATION=true en .env) para volver a
    | exigir la verificación.
    */
    'email_verification' => (bool) env('NCIE_EMAIL_VERIFICATION', false),

];
