<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    
    public function anexaArquivo($request, $ministracao) {
        if ($request->hasFile('fministracao') && $request->file('fministracao')->isValid()) {
            $type = $request->fministracao->getMimeType();
            $extension = $request->fministracao->extension();
            $size = $request->fministracao->getClientSize();
            $newName = $ministracao->number.'.Ministracao-para-celulas';
            $fullyNewName = "{$newName}.{$extension}";
            $upload = $request->fministracao->storeAs('download/'.$extension, $fullyNewName);

            if ($upload) {
                $file = new Files();
    
                $file->name = $fullyNewName;
                $file->path = $upload;
                $file->type = $type;
                $file->size = $size;
                $file->ministracao()->associate($ministracao); 
                $file->save();
            } else {
                echo json_encode('Erro ao anexar o arquivo');
            }

        }      
    }

    public function downloadFile($tipo, $file) {
        $tipo = explode('.', $file);
        $tipo = array_pop($tipo);
        $arquivoLocal = 'download/'.$tipo.'/'.$file;
        return (Storage::download($arquivoLocal, $file));
    }

    public function apagaArquivo($idMinistracao) {
        if (!is_null($idMinistracao)) {
            $file = Files::where('ministrations_id', $idMinistracao)->firstOrFail();


            if (!empty($file)) {
                try {
                    Storage::delete($file->getAttribute('path'));
                    $file->delete();
                } catch(Throwable $tr) {
                    return false;
                }
            }
        }
    }
}
