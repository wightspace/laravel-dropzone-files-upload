<?php

namespace App\Http\Controllers;

use App\Document;
use App\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class DocumentController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:3',
            'department' => 'required|min:3',
            'phone' => 'required',
            'file_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors()
                ->withInput();
        }

        $data = [
            'fullname' => $request->input('fullname'),
            'department' => $request->input('department'),
            'phone' => $request->input('phone'),
        ];

        $document = Document::create($data);
        $files = $request->input('file_id');
        foreach ($files as $file) {
            $upload = Upload::find($file);
            $upload->document_id = $document->id;
            $upload->save();
        }
        return redirect('/success');
    }

    public function destroy($document_id)
    {
        $upload = Upload::where('document_id', $document_id);
        $uploadList = $upload->lists('id');

        if (count($uploadList) > 0) {
            $files = $upload->get();
            foreach ($files as $file) {
                Storage::delete($file->name);
            }
            Upload::destroy($uploadList);
        }
        $document = Document::find($document_id);
        $document->delete();
        return redirect('/home');
    }
}
