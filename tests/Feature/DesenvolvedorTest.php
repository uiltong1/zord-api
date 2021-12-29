<?php

namespace Tests\Feature;

use App\Models\Desenvolvedor;
use App\Models\Nivel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DesenvolvedorTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $baseUrl;
    private $desenvolvedor;
    public function setUp(): void
    {
        parent::setUp();
        $this->desenvolvedor = Desenvolvedor::factory()->create();
        $this->nivel = Nivel::factory()->create();
        $this->baseUrl = 'api/desenvolvedores';
    }

    /**
     * @test
     */
    public function listarTodosOsDesenvolvedores()
    {
        $this->get($this->baseUrl)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function consultarDesenvolvedorPeloCodigo()
    {
        $this->get($this->baseUrl . '/' . $this->desenvolvedor->co_desenvolvedor)
            ->assertJsonStructure([
                'co_desenvolvedor',
                'nm_desenvolvedor',
                'ds_sexo',
                'dt_nascimento',
                'nu_idade',
                'ds_hobby',
                'co_nivel'
            ])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     *  @test
     */
    public function cadastrarDesenvolvedor()
    {
        $this->postJson($this->baseUrl, [
            'nm_desenvolvedor' => 'Caio Junqueira',
            'ds_sexo' => 'Masculino',
            'dt_nascimento' => '2000-08-10',
            'nu_idade' => 21,
            'ds_hobby' => 'Desenvolver sites',
            'co_nivel' => $this->nivel->co_nivel
        ])->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'co_desenvolvedor',
                'nm_desenvolvedor',
                'ds_sexo',
                'dt_nascimento',
                'nu_idade',
                'ds_hobby',
                'co_nivel'
            ]);
    }

    /**
     *  @test
     */
    public function atualizarDesenvolvedor()
    {
        $this->put($this->baseUrl . '/' . $this->desenvolvedor->co_desenvolvedor, [
            'nm_desenvolvedor' => 'Mário Kart Silveira',
            'ds_sexo' => 'Masculino',
            'dt_nascimento' => '2005-01-01',
            'nu_idade' => 16,
            'ds_hobby' => 'Jogar Vídeo game',
            'co_nivel' => $this->nivel->co_nivel
        ])->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'co_desenvolvedor',
                'nm_desenvolvedor',
                'ds_sexo',
                'dt_nascimento',
                'nu_idade',
                'ds_hobby',
                'co_nivel'
            ]);
    }

    /**
     *  @test
     */
    public function excluirDesenvolvedor()
    {
        $this->delete($this->baseUrl . '/' . $this->desenvolvedor->co_desenvolvedor)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
