<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $userId = Auth::id() ?? 0;
        $userTemplates = Storage::files("templates/{$userId}");

        $userTemplatesFormatted = array_map(function ($file)
        {
            return
            [
                'name' => basename($file),
                'url'  => route('templates.download', ['filename' => basename($file), 'user' => 'user'])
            ];
        }, $userTemplates);

        $defaultPath = public_path('templates_default');
        $defaultTemplates = [];

        if (is_dir($defaultPath))
        {
            $files = scandir($defaultPath);

            foreach ($files as $file)
            {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['docx', 'xlsx']))
                {
                    $defaultTemplates[] =
                    [
                        'name' => $file,
                        'url'  => asset("templates_default/{$file}")
                    ];
                }
            }
        }

        return view('templates.list',
        [
            'templates' => array_merge($userTemplatesFormatted, $defaultTemplates)
        ]);
    }

    public function form()
    {
        return view('templates.form');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'template' => 'required|file|mimes:docx,xlsx|max:5120'
        ]);

        $userId = Auth::id() ?? 0;
        $file = $request->file('template');
        $filename = $file->getClientOriginalName();

        Storage::putFileAs("templates/{$userId}", $file, $filename);

        return redirect()->route('templates.list')->with('success', 'Template berhasil diupload.');
    }

    public function delete($filename)
    {
        $userId = Auth::id() ?? 0;
        $filePath = "templates/{$userId}/{$filename}";

        if (Storage::exists($filePath))
        {
            Storage::delete($filePath);
            return redirect()->route('templates.list')->with('success', 'Template berhasil dihapus.');
        }

        return redirect()->route('templates.list')->with('error', 'Template tidak ditemukan.');
    }

    public function download($filename)
    {
        $userId = Auth::id() ?? 0;
        $filePath = "templates/{$userId}/{$filename}";

        if (!Storage::exists($filePath))
        {
            abort(404);
        }

        return response()->download(Storage::path($filePath), $filename);
    }
}
