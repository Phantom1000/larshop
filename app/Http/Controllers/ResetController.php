<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function __invoke()
    {
        Artisan::call('migrate:fresh --seed');
        $folders = collect(['categories', 'products']);
        $folders->each(function ($folder) {
            Storage::disk('public')->deleteDirectory($folder);
            Storage::disk('public')->makeDirectory($folder);
            $files = collect(Storage::disk('reset')->files($folder));
            $files->each(function ($file) {
                Storage::disk('public')->put($file, Storage::disk('reset')->get($file));
            });
        });
        session()->flash('success', 'Проект был сброшен в начальное состояние');
        return redirect()->route('index');
    }
}
