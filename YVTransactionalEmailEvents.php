<?php

namespace YV\TransactionalEmailBundle;

final class YVTransactionalEmailEvents
{    
    const TRANSACTIONAL_EMAIL_CREATE_INITIALIZE = 'yv_transactional_email.create.initialize';
    
    const TRANSACTIONAL_EMAIL_CREATE_SUCCESS = 'yv_transactional_email.create.success';
    
    const TRANSACTIONAL_EMAIL_CREATE_COMPLETED = 'yv_transactional_email.create.completed'; 

    const TRANSACTIONAL_EMAIL_UPDATE_INITIALIZE = 'yv_transactional_email.update.initialize';
    
    const TRANSACTIONAL_EMAIL_UPDATE_SUCCESS = 'yv_transactional_email.update.success';
    
    const TRANSACTIONAL_EMAIL_UPDATE_COMPLETED = 'yv_transactional_email.update.completed';     
}
