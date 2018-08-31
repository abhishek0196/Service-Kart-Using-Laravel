<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('serviceprovider')->user();

    //dd($users);

    return view('serviceprovider.home');
})->name('home');

