<?php

namespace Database\Factories;

use App\Models\CartaInstruccion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CartaInstruccionFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartaInstruccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $fecha = $this->faker->dateTimeBetween('2020-01-01', '2025-06-12');

        return [
            'id_partida' => $this->faker->numberBetween(1, 8),
            'ci' => 1,
            'id_beneficiario' => $this->faker->numberBetween(1, 100),
            'id_municipio' => $this->faker->randomElement([17,18,19,20,21]),
            'estatus' =>  $this->faker->randomElement(['aprobado','modificado', 'comprometido', 'devengado', 'ejercido', 'pagado']),
            'tipo_cambio' => '20',
            // 'importe' => $this->faker->numberBetween($min = 500000.00, $max = 1000000.99),
            'importe' => $this->faker->randomFloat(2, 500000, 1000000),
            'concepto' => $this->faker->text(),
            'observaciones' => $this->faker->text(),
            'fecha' =>  $fecha

        ];
    }

    public function getCI($fecha){
        // $year2020 = 0;
        // $year2021 = 0;
        // $year2022 = 0;
        // $year2023 = 0;
        // $year2024 = 0;
        // $year2025 = 0;

        $año = Carbon::parse($fecha)->format('Y');
        ${"year" . $año} = 0;

        $cartas = CartaInstruccion::withTrashed()
        ->whereYear('fecha', $año)
        ->get();
        // dd(count($cartas));

        return $id = count($cartas) + 1;
    }
}


// $table->unsignedBigInteger('id_partida');
// $table->foreign('id_partida')->references('id')->on('partidas');
// $table->unsignedBigInteger('id_beneficiario');
// $table->foreign('id_beneficiario')->references('id')->on('beneficiarios');
// $table->string('tipo_cambio');
// $table->decimal('importe',9,2);
// $table->text('concepto');
// $table->text('observaciones');
// $table->date('fecha');
// $table->timestamps();