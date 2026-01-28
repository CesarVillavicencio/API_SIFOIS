<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FituEsSeeder extends Seeder
{
    protected string $usuarioSistema = 'CVILLAVICENCIO';

    public function run()
    {
        $estructura = [

            'PROMOCIÓN Y PUBLICIDAD NACIONAL' => [

                'RELACIONES PÚBLICAS Y MEDIOS' => [
                    'CAMPAÑA BAJA CALIFORNIA NORTE',
                    'CAMPAÑA BAJA CALIFORNIA SUR',
                ],

                'DISEÑO DE MATERIALES Y DESARROLLO DE CONTENIDO' => [
                ],

                'CAMPAÑAS CON OTAS Y MEDIOS DIGITALES' => [
                ],

                'FERIAS Y PRESENCIAS' => [
                    'CAMPAÑA BAJA CALIFORNIA SUR',
                    'TIANGUIS TURÍSTICO DE MÉXICO',
                    'PRESENCIAS DE BCS EN CIUDAD DE MÉXICO',
                    'PRESENCIAS DE BCS EN MONTERREY',
                    'PRESENCIAS DE BCS EN GUADALAJARA',
                    'CARAVANA DEL BAJÍO',
                    'ARLAG',
                    'LOS CABOS VIP SUMMIT',
                ],

                'Promoción Grupos, Incentivos y Convenciones'=>[],

                'EVENTOS Y FESTIVALES DEPORTIVOS CULTURALES GASTRONÓMICOS Y TURÍSTICOS' => [

                    'EVENTOS DEPORTIVOS' => [
                        'IRONMAN LOS CABOS',
                        'TOUR DE FRANCE LA PAZ',
                        'NORRA MEXICAN 1000 RALLY',
                        'MAR A MAR (LOS BARRILES, EL CORO, SAN DIONISIO, RANCHO LA RUEDA, TODOS SANTOS)',
                        'TORNEO SURF LOS CERRITOS',
                        'FOIL EXPEDITION BAJA CALIFORNIA SUR',
                        'TRIATLÓN LA PAZ',
                    ],

                    'EVENTOS GASTRONÓMICOS' => [
                        'LA PAZIÓN POR EL SABOR, LA PAZ',
                        'FESTIVAL DE LA ALMEJA, LORETO',
                        'FESTIVAL MAQUECHO, SAN ANTONIO, LA PAZ',
                    ],

                    'FESTIVALES' => [
                        'FESTIVAL DE CINE LA PAZ',
                        'FESTIVAL DE CINE DE LA TOBA',
                        'OCEAN FILM FEST, LA VENTANA',
                        'FESTIVAL DE LA BALLENA GRIS, GUERRERO NEGRO',
                        'FESTIVALES WELLNESS BCS (TODOS SANTOS Y LORETO)',
                    ],

                    'PUEBLOS MÁGICOS' => [
                        'TIANGUIS NACIONAL DE PUEBLOS MÁGICOS (TODOS SANTOS, LORETO Y SANTA ROSALÍA)',
                    ],

                    'EVENTO CULTURAL TURÍSTICO' => [
                        'EXPO RURAL, LA PAZ',
                    ],

                ],
               
            ],
            'PROMOCION Y PUBLICIDAD INTERNACIONAL' =>[
                'Relaciones_Públicas_y_Medios_Estados_Unidos' => [
                    'Campaña RP y Medios',
                    'Campaña con industria (Trade)'
                ],
                'Relaciones Públicas y Medio Canadá' =>[],
                'Diseño de Materiales y Desarrollo de Contenidos'  =>[],
                'Desarrollo Mercado Europa y Japón'  =>[],
                'Campaña con OTA´s y Medios Digitales'  =>[],
                'Constant Contact (e-mail marketing)'  =>[],
                'Trade_Shows'  =>[
                    'FITUR',
                    'Travel and Adventure Show Chicago',
                    'Travel and Adventure Show LA',
                    'Travel and Adventure Show Dallas',
                    'Travel and Adventure Show Calgary',
                    'The Outdoor Adventure Show New York',
                    'Routes América',
                    'Bart Hall Shows',
                    'Scuba Show',
                    'Pacific Coast Sportfishing',
                    'Adevture Travel Trade Association',
                    'The Outdoor Adventure Show Vancouver y Calgary',
                    'Seminarios WestJet',
                    'Dema Show',
                    'Power Solutions',
                    'Travel Market Place',
                ],

            ],

            'MATERIALES_PROMOCIONALES' => [
                'Materiales Promocionales y Colaterales',
            ],

            'PROGRAMAS_ESPECIALES' => [

                'Patrocinios_Institucionales' => [
                    'Apoyo portal de Transparencia',
                    'Atenciones y Cortesías',
                    'Directorio Visit Los Cabos',
                    'Fams',
                ],

                'Relaciones_Comerciales' => [
                    'Reuniones y visitas de trabajo en el Estado',
                    'Reuniones y visitas de trabajo en el País',
                    'Reuniones y visitas de trabajo en el Extranjero',
                ],

                'Estudios_Diagnósticos_o_Evaluaciones' => [
                    'Encuestas de salida',
                    'Observatorios Turísticos',
                    'Medición de la percepción de turismo en La Paz',
                ],

                'Envíos Nacionales e Intenacionales',
                'Eventos no Programados',
                'Webcams',

                'Desarrollo_de_Producto' => [
                    'Capacitación hoteles Loreto, Comondú y Mulegé',
                    'Colaboración pesca con Futuro',
                ],
            ],

            'SUELDOS_Y_PRESTACIONES' => [

                'Sueldos' => [
                    'Coordinador de Transparencia, Documentación y Archivos',
                    'Coordinador Administrativo',
                    'Coordinador Tour & Travel',
                    'Coordinador General Administrativo',
                    'Coordinador Jurídico',
                    'Coordinador Loreto',
                    'Coordinador Comondú',
                    'Coordinador Mulegé',
                    'Director Comercial',
                    'Director General',
                    'Coordinador Tour & Travel Zona Centro/Norte',
                    'Coordinador Digital',
                    'Coordinador Contable',
                    'Contraprestación fin de año',
                    'Prima Vacacional',
                ],

                'Impuestos_Federales_y_Estatales' => [
                    'Impuestos sobre Nómina',
                ],

                'Cuotas_Patronales_y_Obrero' => [
                    'Patronales y Obrero',
                ],
            ],

            'SERVICIOS_PROFESIONALES' => [
                'Honorarios Fiduciarios',
                'Auditoría Contable',
                'Asesoría Jurídica',
                'Asesoría Contable',
            ],

            'GASTOS_ADMINISTRATIVOS' => [
                'Seguros y Fianzas',
                'Combustibles y Lubricantes',
                'Reparación y Mantenimiento de Automóviles',
                'Placas y tenencias',
                'Papelería y Material de Oficina',
                'Mobiliario, Equipo de oficina y de Cómputo',
                'Software y Office',
                'Comunicación y redes',
                'Teléfono',
                'Uniformes',
                'Renta de Bodega',
                'Mantenimiento de Bodega',
                'Mantenimiento de Oficina',
                'Servicio de limpieza',
                'Atención a visitantes',
                'Diversos',
                'Luz',
                'Renta de Oficina FITUES',
                'Capacitación para personal',
            ],

            'EGRESOS INFRAESTRUCTURA TURÍSTICA' => [

                'Infraestructura_Turística' => [
                    'AirB&B 2026',
                    'AirB&B 2025',
                    'AirB&B 2024',
                    'AirB&B 2023',
                    'AirB&B 2021 y 2022',
                ],
            ],

            'COMPROMETIDO' => [

                'Comprometido_2023' => [
                    'Espectaculares, lonas, anuncios, letras',
                ],

                'Comprometido_2024' => [
                    'Diseño de Materiales y Desarrollo de Contenido (Nacional)',
                    'Plataformas Digitales y Redes Sociales (Nacional)',
                    'Campaña vuelos Regionales',
                    'Relaciones Públicas y Medios Estados Unidos',
                    'Diseño de Materiales y Desarrollo de Contenido (Internacional)',
                    'Campañas con OTA´s y Agencias (Internacional)',
                    'Apoyo a nuevos vuelos (Internacional)',
                    'Espectaculares, lonas, anuncios, letras',
                    'Estudios, Diagnósticos o Evaluaciones',
                    'Desarrollo de Producto',
                    'Desarrollo de Infraestructura Turística',
                ],

                'Comprometido_2025' => [
                    'Relaciones Públicas y Medios (Nacional)',
                    'Eventos y Festivales deportivos, culturales, gastronómicos y turísticos',
                    'Diseño de Materiales y Desarrollo de Contenido (Nacional)',
                    'Plataformas Digitales y Redes Sociales (Nacional)',
                    'Campañas con OTA´s y Agencias (Nacional)',
                    'Relaciones públicas y Medios Estados Unidos',
                    'Relaciones públicas y Medios Canadá',
                    'Diseño de Materiales y Desarrollo de Contenido (Internacional)',
                    'Desarrollo de Mercado Europa',
                    'Campañas con OTA´s y Agencias (Internacional)',
                    'Trade Shows',
                    'Desarrollo Nueva Ruta',
                    'Materiales y Colaterales',
                    'Estudios, Diagnósticos o Evaluaciones',
                    'Espectaculares, lonas, anuncios, letras',
                    'Desarrollo de Producto',
                    'Reparación y Mantenimiento de oficina',
                    'Adquisición de vehículo',
                ],
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
            ->where('padre_id', $padreId)
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
        return mb_strtoupper(trim($nombre), 'UTF-8');
    }
}
