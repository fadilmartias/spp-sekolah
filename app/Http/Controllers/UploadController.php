<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function filepondProcess(Request $request)
    {
        // We don't know the name of the file input, so we need to grab
        // all the files from the request and grab the first file.
        /** @var UploadedFile[] $files */
        $files = $request->allFiles();

        if (empty($files)) {
            abort(422, __('message.no_file'));
        }

        if (count($files) > 1) {
            abort(422, __('message.only_1_file'));
        }

        // Now that we know there's only one key, we can grab it to get
        // the file from the request.
        $requestKey = array_key_first($files);

        // If we are allowing multiple files to be uploaded, the field in the
        // request will be an array with a single file rather than just a
        // single file (e.g. - `csv[]` rather than `csv`). So we need to
        // grab the first file from the array. Otherwise, we can assume
        // the uploaded file is for a single file input and we can
        // grab it directly from the request.
        $file = is_array($request->input($requestKey))
            ? $request->file($requestKey)[0]
            : $request->file($requestKey);

        // Store the file in a temporary location and return the location
        // for FilePond to use.
        return $file->store(
            path: 'tmp/filepond/' . now()->timestamp . '-' . Str::random(20)
        );
    }

    public function filepondRevert(Request $request) {
        $fileId = $request->getContent();
        // Menghapus file dari storage berdasarkan fileId yang diberikan
        Storage::delete($fileId);

        return response()->json([
            'status' => 1,
            'message' => __('message.success_delete', ['data' => 'File'])
        ]);
    }

    public function quillImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('quill/image');

            return response()->json([
                'url' => asset('uploads/' . $path)
            ]);
        }

        return response()->json([
            'error' => __('message.not_found', ['data' => 'Image'])
        ], 400);
    }
}
