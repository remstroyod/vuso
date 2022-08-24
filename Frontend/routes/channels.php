<?php

use Illuminate\Support\Facades\Broadcast;
use Backend\Modules\EDocuments\Models\EdocumentUser;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('order-status-{contract_id}', function ($user) {
    //return (int) $contract->id === (int) EdocumentUser::find($id)->id;
    return $user;
});