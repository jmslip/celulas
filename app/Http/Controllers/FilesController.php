<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    
    public function anexaArquivo($request, $ministracao) {
        if ($request->hasFile('fministracao') && $request->file('fministracao')->isValid()) {
            // $path = $request->fministracao->path();
            $type = $request->fministracao->getMimeType();
            // $originalName = $request->fministracao->getClientOriginalName(); 
            $extension = $request->fministracao->extension();
            $size = $request->fministracao->getClientSize();
            // $fullyTemporaryFile = $path.'/'.$originalName;
            $newName = $ministracao->number.'.Ministracao-para-celulas';
            $fullyNewName = "{$newName}.{$extension}";
            $upload = $request->fministracao->storeAs('pdf', $fullyNewName);

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
}
