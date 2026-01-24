<?php

namespace App\Services;

use App\Models\Anexo;
use App\Models\OrdemServico;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AnexoService {
    public function edit($novoAgendamento, $id) {
        $agendamento = OrdemServico::findOrFail($id);
        $agendamento->update($novoAgendamento);
        dd($novoAgendamento);
        return $agendamento;
    }

    public function getAll($idOS) {
        $anexos = Anexo::all()->where('id_os', '=', $idOS);
        $anexosArray = [];

        foreach ($anexos as $anexo) {
            $anexo->url = asset(Storage::url($anexo->path));
            array_push($anexosArray, $anexo);
        }

        return $anexosArray;
    }

    public function store(UploadedFile $image, int $idOS, string $filename = 'anexo_os') {
        $anexo = new Anexo();

        $extension = $image->getClientOriginalExtension();
        $finalName = $filename . '.' . $extension;

        $path = $image->storeAs(
            'anexos/' . $idOS,
            $finalName,
            'public'
        );

        $anexo->path = $path;
        $anexo->id_os = $idOS;
        $anexo->save();
    }

    public function destroy($id) {
        $anexo = Anexo::findOrFail($id);

        Storage::disk('public')->delete($anexo->path);

        return $anexo->delete();
    }

    public function base64ToUploadedFile($base64, $filename = 'file.png') {
        $fileData = preg_replace('/^data:.*;base64,/', '', $base64);
        $fileData = base64_decode($fileData);

        // Cria arquivo temporário
        $tmpFilePath = sys_get_temp_dir() . '/' . $filename;
        file_put_contents($tmpFilePath, $fileData);

        // Cria UploadedFile
        return new UploadedFile(
            $tmpFilePath,
            $filename,
            mime_content_type($tmpFilePath),
            null,
            true // $test mode - evita mover arquivo real
        );
    }
}
