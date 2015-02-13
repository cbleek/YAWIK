<?php

namespace Auth\Form\Hydrator;

use Core\Entity\Hydrator\EntityHydrator;

class UserPasswordFieldsetHydrator extends EntityHydrator
{
    public function extract ($object)
    {
        $data = array(
            'password' => 'cross',
            'password2' => 'cross'
            );
        return $data;
    }
}
