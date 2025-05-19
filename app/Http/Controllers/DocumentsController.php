<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function generate(Request $request)
    {
        $request->validate(
        [
            'template_name' => 'required|string',
            'data'          => 'required|array'
        ]);

        $userId = Auth::id();
        $templatePathUser = "templates/{$userId}/{$request->template_name}";
        $templatePathDefault = public_path("templates_default/{$request->template_name}");

        if (Storage::exists($templatePathUser))
        {
            $templateFile = Storage::path($templatePathUser);
        }
        else if (file_exists($templatePathDefault))
        {
            $templateFile = $templatePathDefault;
        }
        else
        {
            return response()->json(['error' => 'Template not found.'], 404);
        }

        $extension = pathinfo($request->template_name, PATHINFO_EXTENSION);
        $templateFile = Storage::path($templatePath);

        $filename = 'dokcik_' . Str::random(8) . '.' . $extension;
        $outputPath = "documents/{$userId}/{$filename}";
        $outputFullPath = Storage::path($outputPath);

        Storage::makeDirectory("documents/{$userId}");

        if ($extension === 'docx')
        {
            $processor = new TemplateProcessor($templateFile);

            foreach ($request->data as $key => $value)
            {
                $processor->setValue($key, $value);
            }

            $processor->saveAs($outputFullPath);
        }
        elseif ($extension === 'xlsx')
        {
            $arrayData = Excel::toArray(null, $templateFile)[0];

            foreach ($arrayData as $rowIndex => $row)
            {
                foreach ($row as $colIndex => $cell)
                {
                    foreach ($request->data as $key => $value)
                    {
                        if (is_string($cell) && strpos($cell, '{{' . $key . '}}') !== false)
                        {
                            $arrayData[$rowIndex][$colIndex] = str_replace('{{' . $key . '}}', $value, $cell);
                        }
                    }
                }
            }

            Excel::store(new \Maatwebsite\Excel\Collections\SheetCollection([
                'Sheet1' => collect($arrayData)
            ]), $outputPath);
        }
        else
        {
            return response()->json(['error' => 'Unsupported file format.'], 400);
        }

        return response()->json([
            'message'       => 'Document generated successfully.',
            'file'          => $filename,
            'download_url'  => route('documents.download', ['filename' => $filename])
        ]);
    }

    public function download($filename)
    {
        $userId = Auth::id() ?? 0;
        $filePath = "documents/{$userId}/{$filename}";

        if (!Storage::exists($filePath))
        {
            return response()->json(['error' => 'Document not found.'], 404);
        }

        return response()->download(Storage::path($filePath), $filename);
    }

    public function list()
    {
        $userId = Auth::id() ?? 0;
        $files = Storage::files("documents/{$userId}");

        $documents = [];

        foreach ($files as $file)
        {
            $documents[] = [
                'filename' => basename($file),
                'url'      => route('documents.download', ['filename' => basename($file)])
            ];
        }

        return response()->json([
            'documents' => $documents
        ]);
    }
}
