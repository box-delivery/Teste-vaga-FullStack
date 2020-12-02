<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;
}
