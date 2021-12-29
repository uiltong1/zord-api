<?php

namespace App\Services;

use App\Http\Interfaces\DesenvolvedorInterface;
use App\Models\Desenvolvedor;
use App\Models\Nivel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;

class DesenvolvedorService implements DesenvolvedorInterface
{

    function index($params)
    {
        $order = $params->order ?? 'asc';
        $field = $params->field ?? 'created_at';
        $desenvolvedores = Desenvolvedor::orderby($field, $order)->with(['nivel']);

        if (isset($params->search) && isset($params->fieldSearch)) {

            if ($params->fieldSearch == 'nm_nivel') {
                $desenvolvedores->whereHas('nivel', function ($query) use ($params) {
                    $query->where('niveis.nm_nivel', 'like', "%{$params->search}%");
                });
            } else if ($params->fieldSearch == 'dt_nascimento') {
                $date = Carbon::createFromDate($params->search)->format('Y-m-d');
                $desenvolvedores->where($params->fieldSearch, 'like', "%{$date}%");
            } else {
                $desenvolvedores->where($params->fieldSearch, 'like', "%{$params->search}%");
            }

        } else if (isset($params->search)) {
            $desenvolvedores->Where('nm_desenvolvedor', 'like', "%{$params->search}%");
            $desenvolvedores->orWhere('ds_sexo', 'like', "%{$params->search}%");
            $desenvolvedores->orWhere('dt_nascimento', 'like', "%{$params->search}%");
            $desenvolvedores->orWhere('nu_idade', 'like', "%{$params->search}%");
            $desenvolvedores->orWhere('ds_hobby', 'like', "%{$params->search}%");
        }


        return $desenvolvedores->paginate(10);
    }

    function store($desenvolvedor)
    {
        if (!Nivel::find($desenvolvedor->co_nivel))
            throw new Exception("O nível informado não foi encontrado.", Response::HTTP_BAD_REQUEST);
        $this->verificaDataNascimentoIdade($desenvolvedor->dt_nascimento, $desenvolvedor->nu_idade);
        return Desenvolvedor::create($desenvolvedor->all());
    }

    function show($id)
    {
        return Desenvolvedor::where('co_desenvolvedor', $id)->with('nivel')->firstOrFail();
    }

    function update($params, $id)
    {
        if (!Nivel::find($params->co_nivel))
            throw new Exception("O nível informado não foi encontrado.", Response::HTTP_BAD_REQUEST);
        $this->verificaDataNascimentoIdade($params->dt_nascimento, $params->nu_idade);
        $desenvolvedor = Desenvolvedor::where('co_desenvolvedor', $id)->with('nivel')->firstOrFail();
        $desenvolvedor->update($params->all());
        return $desenvolvedor;
    }

    function destroy($id)
    {
        $desenvolvedor = Desenvolvedor::findOrFail($id);
        return $desenvolvedor->delete();
    }

    private function verificaDataNascimentoIdade($dataNascimento, $idade)
    {
        $dataNascimentoFormat = Carbon::createFromDate($dataNascimento);
        $now = Carbon::now();
        $idadeCalculada = $dataNascimentoFormat->diffInYears($now);
        if ($idade != $idadeCalculada)
            throw new Exception("Idade não coincide com a data de nascimento.", Response::HTTP_BAD_REQUEST);
    }
}
