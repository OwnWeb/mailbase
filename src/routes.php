<?php

declare(strict_types=1);

use Tkeer\Mailbase\MailController;

Route::group(['as' => 'mailbase::', 'prefix' => 'mailbase', 'middleware' => config('mailbase.middleware')], function () {
    Route::get('/', MailController::class . '@index')->name('index');
    Route::post('/clear', MailController::class . '@clear')->name('clear');
    Route::get('/{mailbase}/attachments/{index}', MailController::class . '@attachment')->name('attachment');
    Route::get('/{mailbase}/attachments/{index}/download', MailController::class . '@downloadAttachment')->name('attachment.download');
    Route::get('/{mailbase}', MailController::class . '@show')->name('show');
});
