<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FituLoreSeeder extends Seeder
{
    protected string $usuarioSistema = 'CVILLAVICENCIO';

    public function run()
    {
        $estructura = [

            'PROMOCION_INTERNACIONAL' => [

                'PROMOCIÓN_SOCIOS_COMERCIALES' => [
                    'Alaska Airlines',
                    'Westjet, Calgary-Lto',
                    'Volaris',
                    'American Airlines',
                    'Nuevos Vuelos',
                ],

                'FERIAS_Y_TRADESHOWS_INTERNACIONALES' => [
                    'Travel & Adventure Dallas',
                    'Travel & Adventure',
                    'TTG Expo Rimini',
                    'FITUR España',
                    'American Outdoor Association',
                ],
            ],

            'PROMOCION_NACIONAL' => [

                'MATERIALES_Y_MEDIOS_PROMOCIONALES' => [
                    'Estrategia Digital y Redes Sociales / Promoción Impresa y electrónica',
                    'Mantenimiento Sitio Web',
                    'Sitio Web Loreto / Redes Sociales / Mantenimiento',
                ],

                'EVENTOS_LOCALES_Y_ATENCIÓN_A_VISITANTES' => [
                    'Festival de Wellness',
                    'Promoción del Triatlón 2025',
                    'Art Walk Centro Histórico de Loreto',
                    'Atención a visitantes',
                    'Campeonato OFF Road Baja Sur',
                    'Festival de la almeja chocolata 2025',
                    'Festivales Gastronómicos de primavera y otoño',
                    'Noche de la Conquista',
                ],

                'FERIAS_Y_EVENTOS_NACIONALES' => [
                    'Tianguis Turístico de México',
                    'Presencias Loreto',
                    'Los Cabos, VIP Summit',
                    'Pueblos Mágicos',
                    'ATMEX Adventure Travel Mexico',
                ],
            ],

            'PROGRAMAS_ESPECIALES' => [

                'REUNIONES_DE_TRABAJO_NACIONALES_Y_EN_EL_ESTADO' => [
                    'Reuniones y visitas de trabajo Nacionales y en el Estado',
                ],
            ],

            'GASTOS_ADMINISTRATIVOS' => [
                'Honorarios Contables',
                'Impuestos y Derechos',
                'Contabilidad Gubernamental / Apoyo a Plataforma de Transparencia',
                'Honorarios Fiduciario',
                'Auxiliar Administración',
                'RCV (Sistema de Ahorro para el Retiro)',
                'Aguinaldo',
                'IMSS',
                'Prima Vacacional',
                'INFONAVIT',
                'Papelería y artículos de escritorio',
                'Teléfono',
                'Luz',
                'Imprevistos / Caja Chica revolvente',
                'Limpieza',
                'Mantenimiento de Equipo de Oficina / Adquisición de Equipo de Oficina',
                'Mensajería',
            ],

            'TOTAL EGRESOS PROMOCION' => [],

            'INFRAESTRUCTURA_TURÍSTICA' => [
                'Infraestructura Turística 2026',
                'Infraestructura Turística 2025 (Ajustar al cierre)',
                'Infraestructura Turística 2024',
                'Infraestructura Turística 2021 - 2022 - 2023',
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
            'nombre'          => $nombreLimpio,
            'padre_id'        => $padreId,
            'creado_por'      => $this->usuarioSistema,
            'actualizado_por' => $this->usuarioSistema,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
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
        $nombre = mb_convert_encoding($nombre, 'UTF-8', 'UTF-8');
        return mb_strtoupper($nombre, 'UTF-8');
    }
}
