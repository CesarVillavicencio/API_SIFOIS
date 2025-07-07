<?php

namespace Database\Factories;

use App\Models\Partida;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartidaFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partida::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $nombre = $this->faker->randomElement(['SUELDOS_Y_PRESTACIONES', 'PROMOCIÓN_Y_PUBLICIDAD_NACIONAL', 'GASTOS_ADMINISTRATIVOS']);
        return [
           
            'nombre' => $nombre,
            'padre_id' => $this->addPadreId($nombre),
        ];
    }

    public function addPadreId($data){
        dd($data);
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