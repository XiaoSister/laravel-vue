<?php

Route::any('{all}', function () {
    return view('layouts.app');
})->where(['all' => '.*']);
