<?php

namespace Bfe\Permission\Test;

class RuntimeRole extends \Bfe\Permission\Models\Role
{
    protected $visible = [
      'id',
      'name',
    ];
}
