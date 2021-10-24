<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Ramsey\Uuid\Uuid;
use App\Model\File;

class FileUploader
{
    protected $disk;

    public function __construct($disk=null)
    {
        $this->disk = $disk?? active_file_driver();
    }

    public function uploadSingle($file, $file_directory, $encrypt = true)
    {
        $fileContent = $file->get();
        $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_extension = $file->extension();
        $content_type = $file->getMimeType();

        // Encrypt the Content
        if ($encrypt) $fileContent = encrypt($fileContent);

        $file_directory =  date('Y-m-d') . '/' . $file_directory;
        $file_name = time() . '_' . $original_name;
        $full_file_name = $file_directory . '/' . $file_name . '.' . $file_extension;
        Storage::disk($this->disk)->put($full_file_name, $fileContent);

        return File::create([
            'id' => Uuid::uuid4()->toString(),
            'original_name' => $original_name,
            'file_name' => $file_name,
            'file_extension' => $file_extension,
            'file_directory' => $file_directory,
            'disk' => $this->disk,
            'content_type' => $content_type,
            'is_encrypted' => $encrypt? 1: 0,
        ])->id;
    }

    public function uploadMultiple($files, $directory, $encrypt= true)
    {
        $fileArr = array();
        foreach ((array)$files as $key => $file) {
            $fileArr[$key] = $this->uploadSingle($file, $directory, $encrypt);
        }
        return $fileArr;
    }

    /*public function deleteSingle()
    {
        Storage::delete( $this->getFullName() );
        return;
    }

    public function showFile(File $file)
    {
        return Response::make($this->decryptFile(), 200, [
          'Content-Type'        => $this->content_type,
          'Content-Disposition' => 'inline;'
        ]);
    }

    public function download($fileName)
    {
        return response()->streamDownload(function () {
            echo $this->decryptFile();
        }, $fileName . '.' . $this->file_extension);
    }

    private function getFullName()
    {
        return $this->file_directory . '/' . $this->file_name . '.' . $this->file_extension;
    }

    public function decryptFile()
    {
        $fileName = $this->getFullName();
        $Content = Storage::disk($this->disk)->get($fileName);
        return decrypt($Content);
    }*/

}