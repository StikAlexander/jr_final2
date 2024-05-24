<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DirectoryListController extends Controller
{
    public function index()
    {
        $directorioRaiz = public_path();
        $directorios = File::directories($directorioRaiz);

        foreach ($directorios as $directorio) {
            echo basename($directorio). "\n";
        }

        return response()->json(['message' => 'Directorios listados']);
    }
}
