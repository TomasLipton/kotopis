<?php

use App\Models\Footprint;
use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:user', function () {
    User::class::factory()->count(1)->create();
    $this->comment('done');
})->purpose('Display an inspiring quote');

Artisan::command('mig', function () {

    $files = Storage::disk('s3')->allFiles();
//    usort($files, function ($a, $b) {
//        return Storage::disk('s3')->lastModified($a) - Storage::disk('s3')->lastModified($b);
//    });

    foreach ($files as $file) {
        $fp = Footprint::create([
            'user_id' => 1,
        ]);

        $fp->created_at = Storage::disk('s3')->lastModified($file);
        $fp->save();

        Media::create([
            'path' => $file,
            'footprint_id' => $fp->id,
        ]);
    }

    $this->comment('done');
})->purpose('Display an inspiring quote');
