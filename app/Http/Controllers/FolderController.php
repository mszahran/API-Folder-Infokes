<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    // Ambil struktur folder secara rekursif
    public function getFolderTree()
    {
        $folders = Folder::whereNull('parent_id')->with('children')->get();
        return response()->json($folders);
    }

    // Ambil subfolder dan file di dalam folder tertentu
    public function getFolderContents($id)
    {
        $subfolders = Folder::where('parent_id', $id)->get();
        $files = File::where('folder_id', $id)->get();

        return response()->json([
            'subfolders' => $subfolders,
            'files' => $files,
        ]);
    }

    // Menampilkan breadcrumb
    public function getBreadcrumbPath($id)
    {
        $folder = Folder::with(['parent.parent.parent'])
        ->find($id);

        if (!$folder) {
            return response()->json(['error' => 'Folder not found'], 404);
        }

        return response()->json($folder);
    }

    // Buat folder baru
    public function createFolder(Request $request)
    {
        $folder = Folder::create($request->only(['name', 'parent_id']));
        return response()->json($folder);
    }

    // Buat file baru
    public function createFile(Request $request)
    {
        $file = File::create($request->only(['name', 'folder_id']));
        return response()->json($file);
    }
}
