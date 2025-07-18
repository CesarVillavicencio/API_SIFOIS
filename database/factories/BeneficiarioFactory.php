<?php

namespace Database\Factories;

use App\Models\Beneficiario;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeneficiarioFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Beneficiario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->lastname,
            'creado_por' => 'CVILLAVICENCIO'
        ];
    }

}