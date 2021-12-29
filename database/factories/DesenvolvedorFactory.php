<?php

namespace Database\Factories;

use App\Models\Desenvolvedor;
use App\Models\Nivel;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesenvolvedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Desenvolvedor::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElements(['male', 'female'])[0];

        return [
            'nm_desenvolvedor' => $this->faker->name($gender),
            'ds_sexo' => $gender,
            'dt_nascimento' => '2002-08-10',
            'nu_idade' => 19,
            'ds_hobby' => $this->faker->text(80),
            'co_nivel' => Nivel::factory(),
        ];
    }
}
