<?php

namespace App\Http\Controllers;

use App\Document;
use App\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $files[] = $request->file('file');
        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->toDateString() . '_' . sha1(microtime()) . '.' . $extension;
            $file->move(storage_path('app'), $filename);
            $ori_name = $file->getClientOriginalName();
            $link = Storage::url($filename);
            $data = [
                'name' => $filename,
                'original_name' => $ori_name,
                'extension' => $extension,
                'path' => $link,
                'url' => $link,
                'size' => Storage::size($filename),
            ];

            $upload = Upload::create($data);

            $sendItBack[] = [
                'id' => $upload->id,
                'filename' => $upload->original_name,
            ];
        }
        return response()->json(['success', $sendItBack]);
    }


    public function remove(Request $request)
    {
        $file_id = $request->input('id');
        $upload = Upload::find($file_id);
        if (Storage::delete($upload->name)) {
            return response()->json($upload->id);
        } else {
            return response()->json('error');
        }

    }

    public function showFile($document_id)
    {
        $files = Upload::where('document_id', $document_id)->get();
        $document = Document::find($document_id);
        return view('showfile', ['files' => $files, 'document' => $document]);
    }

    public function download($file_id)
    {
        $file = Upload::find($file_id);
        return response()->download(storage_path('app/' . $file->name));
    }

    public function open($file_id)
    {
        $file = Upload::find($file_id);
        return response()->file(storage_path('app/' . $file->name));
    }

    public function destroy($file_id)
    {
        $file = Upload::find($file_id);
        if ($file->delete()) {
            Storage::delete($file->name);
        }
        return redirect('/show-file-' . $file->document_id);
    }
}
