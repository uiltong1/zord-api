<?php

namespace Tests\Feature;

use App\Models\Nivel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class NivelTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $baseUrl;
    private $nivel;

    public function setUp(): void
    {
        parent::setUp();
        $this->nivel = Nivel::factory()->create();
        $this->baseUrl = 'api/niveis';
    }

    /**
     * @test
     */
    public function listarTodosOsNiveis()
    {
        $this->get($this->baseUrl)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function consultarNivelPeloCodigo()
    {
        $this->get($this->baseUrl . '/' . $this->nivel->co_nivel)
            ->assertJsonStructure(['co_nivel', 'nm_nivel'])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     *  @test
     */
    public function cadastrarNivel()
    {
        $this->postJson($this->baseUrl, [
            'nm_nivel' => 'Sênior Tester'
        ])->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['co_nivel', 'nm_nivel']);
    }

    /**
     *  @test
     */
    public function atualizarNivel()
    {
        $this->put($this->baseUrl . '/' . $this->nivel->co_nivel, [
            'nm_nivel' => 'Sênior Superior'
        ])->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['co_nivel', 'nm_nivel']);
    }
    /**
     *  @test
     */
    public function excluirNivel()
    {
        $this->delete($this->baseUrl . '/' . $this->nivel->co_nivel)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
