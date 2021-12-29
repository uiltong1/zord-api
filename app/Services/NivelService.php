<?php

namespace App\Services;

use App\Http\Interfaces\NivelInterface;
use App\Models\Nivel;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class NivelService implements NivelInterface
{

    function index($params)
    {

        $order = $params->order ?? 'asc';
        $field = $params->field ?? 'created_at';
        $niveis = Nivel::orderby($field, $order)->with(['desenvolvedores']);

        if (isset($params->search)) {
            $niveis->where('nm_nivel', 'like', "%{$params->search}%");
        }


        if ($params->limit == -1) {
            return $niveis->get();
        } else {
            return $niveis->paginate(10);
        }
    }

    function store($nivel)
    {
        return Nivel::create($nivel->all());
    }

    function show($id)
    {
        return Nivel::findOrFail($id);
    }

    function update($params, $id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->update($params->all());
        return $nivel;
    }

    function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        if (count($nivel->desenvolvedores) > 0)
            throw new Exception("O Nível não pode ser excluído, pois possui desenvolvedores cadastrados.", Response::HTTP_NOT_IMPLEMENTED);
        return $nivel->delete();
    }
}
