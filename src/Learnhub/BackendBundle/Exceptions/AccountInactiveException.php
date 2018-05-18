<?php
namespace BackendBundle\Exceptions;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

class AccountInactiveException extends AccountStatusException{
    public function getMessageKey()
    {
        return 'Account still innactive. Did you check you inbox?';
    }
}