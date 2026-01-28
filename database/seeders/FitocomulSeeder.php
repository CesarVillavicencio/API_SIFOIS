<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class fitocomulSeeder extends Seeder
{
    protected string $usuarioSistema = 'CVILLAVICENCIO';

    public function run()
    {
        $estructura = [

            'PROMOCION_NACIONAL' => [

                'PRESENCIAS_BCS' => [
                    'Tianguis Turistico',
                    'ATMEX',
                ],

                'APOYOS_Y_PATROCINIOS' => [
                    'Apoyo a Fams Trips en Comondú',
                    'Apoyo a Fams Trips en Mulegé',
                ],

                'MATERIAL_DE_PROMOCION' => [

                    'Comondú' => [
                        'Material de promocion Comondú',
                        'Redes Sociales en medios Comondú',
                        'Mapas Letreros lonas calendarios Comondú',
                    ],

                    'Mulegé' => [
                        'Material de promocion de Mulegé',
                        'Redes Sociales en medios Mulegé',
                        'Mapas Letreros lonas calendarios Mulegé',
                    ],
                ],
            ],

            'PROMOCION_INTERNACIONAL' => [
                'Presencias de BCS en USA',
                'Presencias de BCS en Canada',
                'Reuniones y visitas de trabajo en el Extranjero',
            ],

            'PROGRAMAS_ESPECIALES' => [
                'Expo Mulegé',
                'Festival de la Ballena Guerrero Negro',
                'Eventos no programados',
                'Reuniones y visitas de trabajo en el Estado',
                'Reuniones y visitas de trabajo en el País',
                'Mantenimiento a Infraestructura Turistica',
                'Modulo de Informacion Turistica',
                'Eventos turisticos y deportivos',
                'Festival de la Ballena Gris en Pto. San Carlos',
                'Festival de la Ballena Gris en Pto. Lopez Mateos',
                'Festival de la talega Cd. Constitucion',
                'Fistas Patronales La Purisima y San Pedro',
                'Festival de Cine de La Toba',
                'Apoyo a programa del Fideicomiso FITUCOMUL y Ayuntamiento de Mulegé de señaletica',
                'Exposición Fotografica Raices de Sal Guerrero Negro',
                'Fistas de fundación de Santa Rosalia',
                'Festival del Ostion en Guerrero Negro',
                'Festival de Cine en Santa Rosalia',
                'Pinturas Rupestres Orquesta Filarmonica de B.C.S.',
                'Aniversario de la Iglesia de Santa Barbara Sta. Rosalia',
            ],

            'GASTOS_ADMINISTRATIVOS' => [
                'Honorarios Contables',
                'Contabilidad Gubernamental',
                'Servicios administrativos',
                'Licencia de sistema de contabilidad SAACG.NET',
                'Honorarios Fiduciario',
                'Auditoria Financiera',
                'Fletes y acarreos',
                'Papeleria y articulos de escritorio',
                'Combustible y lubricantes',
                'Software Licencias y Office 360',
                'Telefonía',
                'Equipo de computo',
            ],

            'INFRAESTRUCTURA_TURÍSTICA' => [
                'INFRAESTRUCTURA TURÍSTICA 2026',
                'INFRAESTRUCTURA TURÍSTICA 2025',
                'INFRAESTRUCTURA TURÍSTICA 2024',
                'INFRAESTRUCTURA TURÍSTICA 2023',
                'INFRAESTRUCTURA TURÍSTICA 2021 - 2022',
            ],
        ];

        foreach ($estructura as $nombre => $hijos) {
            $padreId = $this->obtenerOCrearPartida($nombre, null);
            $this->insertarHijos($hijos, $padreId);
        }
    }

    private function obtenerOCrearPartida($nombre, $padreId)
    {
        $nombreLimpio = $this->limpiarNombre($nombre);

        $existente = DB::table('partidas')
            ->where('nombre', $nombreLimpio)
            ->first();

        if ($existente) {
            return $existente->id;
        }

        return DB::table('partidas')->insertGetId([
            'nombre'            => $nombreLimpio,
            'padre_id'          => $padreId,
            'creado_por'        => $this->usuarioSistema,
            'actualizado_por'   => $this->usuarioSistema,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
    }

    private function insertarHijos(array $hijos, $padreId)
    {
        foreach ($hijos as $key => $value) {

            if (is_array($value)) {
                $nuevoPadreId = $this->obtenerOCrearPartida($key, $padreId);
                $this->insertarHijos($value, $nuevoPadreId);
            } else {
                $this->obtenerOCrearPartida($value, $padreId);
            }
        }
    }

    private function limpiarNombre($nombre)
    {
        $nombre = str_replace('_', ' ', $nombre);

        // Forzar UTF-8 correcto
        $nombre = mb_convert_encoding($nombre, 'UTF-8', 'UTF-8');

        // Convertir a mayúsculas respetando acentos
        return mb_strtoupper($nombre, 'UTF-8');
    }
}
