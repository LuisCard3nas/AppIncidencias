<?php

namespace App\Models;

// Este modelo es un alias del nuevo modelo modular
// Se mantiene para compatibilidad hacia atrás
use App\Modules\Incidents\Models\Application as ApplicationModel;

class Application extends ApplicationModel
{
    // Este modelo ahora extiende del modelo modular
    // Todas las funcionalidades están en App\Modules\Incidents\Models\Application
}
