<?php

use Illuminate\Support\Facades\Route;

Route::post('{resource}/upload/{field}', 'UploadController@store');

Route::delete('{resource}/attachments/{field}/{draftId}', 'UploadController@destroyPending');
