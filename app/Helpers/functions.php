<?php
/* 
 *     FILENAME

 *     Notes goes here...

 *     Authors:
 *     Tihomir Kamenov <tihomir.kamenov@1stonlinesolutions.com>

 *     Revision date 7/24/2015 
 */
use App\User;

function getAdmins()
{
    $admins = User::where('is_admin', 1)->get();
    return $admins;
}
