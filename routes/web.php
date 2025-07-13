<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Booking App - INSTANT UPDATES! ⚡️ Time: ' . date('H:i:s') . ' - Hot reload working! 🔥';
});
