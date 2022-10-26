<?php

namespace Bfe\Permission\Test;

class Role extends \Bfe\Permission\Models\Role
{
    protected $primaryKey = 'role_test_id';

    protected $visible = [
      'role_test_id',
      'name',
    ];
}
