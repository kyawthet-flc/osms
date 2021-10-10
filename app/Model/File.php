<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class File extends Model
{    
    protected $guarded = [];

    public $incrementing = false;

    public $disk = 'osms';

    public function deleteSingle()
    {
        Storage::delete( $this->getFullName() );
        return;
    }

    public function showFile()
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

    public function uploadMultiple($files, $directory)
    {
        $fileArr = array();
        foreach ((array)$files as $key => $file) {
            $fileArr[$key] = self::uploadSingle($file, $directory);
        }
        return $fileArr;
    }

    public function decryptFile()
    {
        $fileName = $this->getFullName();
        $content = Storage::disk($this->disk)->get($fileName);
        if( $this->is_encrypted == 1) {
        	return decrypt($content);
        }
         return $content;
    }
}