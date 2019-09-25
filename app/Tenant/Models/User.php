<?php

namespace App\Tenant\Models;

use App\Shared\Models\User as Shared;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class User extends Shared
{
    use UsesTenantConnection;
}
