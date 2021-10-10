<?php
/* 
namespace App\Model\Task;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = [];
}
 */

namespace App\Model\Task;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Model\GeneralSetup\Document;

class Attachment extends Model
{
    protected $guarded = [];

    protected $disk = "drug";

    public static function boot() {
        parent::boot();
        static::deleting(function($attachment) {
        	Storage::disk("drug")->delete($attachment->file_path);
        });
    }

    /* public function document()
    {
        return $this->hasOne(Document::class, 'file_code', 'file_field');
    } */

    public function attachable()
    {
        return $this->morphTo();
    }

    public function certificateType()
    {
        return $this->hasOne(CertificateType::class, 'id', 'certificate_type_id');
    }

    
    public function showFile()
    {
        $Content = $this->decryptFile();

        return Response::make($Content, 200, [
          'Content-Type'        => $this->content_type,
          'Content-Disposition' => 'inline;'
        ]);
    }

    public function downloadFile($fileName)
    {
        return response()->streamDownload(function () {
            echo $this->decryptFile();
        }, $fileName.'.'.$this->file_extension);
    }
    
    public function showManufFile()
    {
        $Content = $this->decryptFile();

        return Response::make($Content, 200, [
          'Content-Type'        => $this->content_type,
          'Content-Disposition' => 'inline;'
        ]);
    }

    public function extractFileInfo($path, $file, $directory, $inputName = null, $encrypt = 1)
    {
        $fileContent = $file->get();
        $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_extension = $file->extension();
        $content_type = $file->getMimeType();

        // Encrypt the Content
        if ($encrypt) {
            $fileContent = encrypt($fileContent);
        }

        // $file_name = time() . '_' . $original_name;
        $file_name = \Str::random(40). time() .'-'. $original_name;
        $full_file_name = $path.'/'.$directory.'/'.$file_name.'.'.$file_extension;
        Storage::disk($this->disk)->put($full_file_name, $fileContent);

        return [
            'file_driver' => $this->disk,
        	'file_field' => $inputName?? 'NA',
        	'file_path' => $path . '/' . $directory . '/' . $file_name . '.' . $file_extension,
        	'original_name' => $file_name,
            'file_name' => $file_name,
            'file_extension' => $file_extension,
            'file_directory' => $path.'/'.$directory,
            'content_type' => $content_type,
            'is_encrypted' => $encrypt,
        ];
    }

   /* public function deleteSingleFile()
    {
        try {
            $full_name = $this->getFullFileName();
            Storage::disk( $this->disk )->delete($full_name);
        } catch (Throwable $e) {
            
        }
        return;
    }*/

    public function decryptFile()
    {
        $full_file_name = $this->getFullFileName();
        $Content = Storage::disk( $this->disk )->get($full_file_name);
        return decrypt($Content);
    }

    public function getFullFileName()
    {
        return $this->file_directory.'/'.$this->file_name.'.'.$this->file_extension;
    }

    /*public function deleteOldFiles( $fileFields )
    {
    	foreach ($this->whereIn('file_field', $fileFields)->get() as $key => $attachment) {
    		Storage::disk( $this->disk )->delete( $attachment->file_path );
    		$attachment->delete();
    	}
    }*/

}
