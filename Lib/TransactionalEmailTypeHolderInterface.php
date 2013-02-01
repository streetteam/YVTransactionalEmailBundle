<?php

namespace YV\TransactionalEmailBundle\Lib;

interface TransactionalEmailTypeHolderInterface
{
    public function getChoices();
    
    public function getReadableTypes();
    
    public function getVariablesForType($type);
}
