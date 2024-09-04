<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserType: string {
    use EnumToArray;

    case Polititian = 'polititian';
    case General = 'general';
}
