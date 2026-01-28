<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FitupazSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $user = 'CVILLAVICENCIO';

        $estructura = [

            'ADMINISTRACION' => [
                'COORDINACIÓN DE ADMINISTRACIÓN',
                'JEFATURA DE DEPARTAMENTO DE CONTABILIDAD',
                'AUXILIAR DE CONTABILIDAD',
                'RCV (RETIRO, CESANTÍA EN EDAD AVANZADA Y VEJEZ)',
                'IMSS',
                'INFONAVIT',
                'ISN (IMPUESTO SOBRE NÓMINA)',
                'VALES DE DESPENSA',
                'PRIMA VACACIONAL',
                'AGUINALDO',
                'RENTA DE OFICINAS FITUPAZ',
                'RENTA DE BODEGA',
                'ADECUACIONES Y EQUIPAMIENTO NUEVAS OFICINAS FITUPAZ',
                'MOBILIARIO Y EQUIPO DE OFICINA',
                'MANTENIMIENTO DE EQUIPO DE OFICINA',
                'ENERGIA ELECTRICA',
                'TELEFONOS',
                'ASESORÍA JURÍDICA',
                'DESPACHO CONTABLE',
                'GASTOS PARA LICITACIÓN',
                'SEGURO DE GASTOS MÉDICOS',
                'COMBUSTIBLES Y LUBRICANTES',
                'FLETES Y MENSAJERÍAS',
                'REPARACIÓN Y MANTENIMIENTO DE AUTOMÓVIL',
                'IMPREVISTOS',
                'SERVICIO DE LIMPIEZA',
                'SEGUROS Y FIANZAS',
                'FIDUCIARIO',
                'COMISIONES BANCARIAS POR OPERACIONES EN MONEDA EXTRANJERA',
                'CONTABILIDAD GUBERNAMENTAL',
                'LICENCIAS SOFTWARE Y OFFICE',
                'UNIFORMES',
                'PAPELERIA Y ARTICULOS',
                'PLACAS Y REVISTA',
                'CAPACITACIÓN PARA EL PERSONAL DE FITUPAZ',
                'AUDITORIA FITUPAZ',
                'VIÁTICOS NACIONALES',
                'VIÁTICOS INTERNACIONALES',
            ],

            'MERCADOTECNIA Y PROMOCIÓN' => [
                'GERENCIA DE MERCADOTECNIA Y PROMOCIÓN',
                'CAMPAÑA EN MEDIOS NACIONALES E INTERNACIONALES',
                'DISEÑO Y PRODUCCIÓN DE MATERIALES PROMOCIONALES',
                'LEVANTAMIENTO ESTADÍSTICO LA PAZ',
                'CAMPAÑA CONCIENTIZACIÓN HACIA EL TURISMO',
            ],

            'COMERCIALIZACIÓN Y EVENTOS' => [
                'GERENCIA DE COMERCIALIZACIÓN Y EVENTOS',
                'Triatlón La Paz',
                'Campaña de Eventos Promocionales',
                'PASAJES AÉREOS',
            ],

            'DESARROLLO DIGITAL' => [
                'GERENCIA DE DESARROLLO DIGITAL',
                'Gestión Estratégica y Contenido Digital para Redes Sociales',
                'Sitio Web La Paz',
                'Mantenimiento Sitio Web',
                'Desarrollo de contenido',
            ],

            'RELACIONES PÚBLICAS' => [
                'GERENCIA DE RELACIONES PÚBLICAS',
                'Campaña Imagen y Promoción La Paz Estados Unidos de América',
                'Campaña Imagen y Promoción La Paz Canadá y mercados emergentes',
                'Campaña Imagen y Promoción La Paz Europa Mercados Emergentes',
                'Campaña Nacional de Imagen y Promoción La Paz',
            ],

            'SEGMENTOS ESPECIALES' => [
                'GERENCIA DE SEGMENTOS ESPECIALES',
                'Turismo Rural',
                'La Paz Incluyente',
            ],

            'TURISMO DE REUNIONES' => [
                'Turismo de Reuniones',
            ],

            'PROGRAMA INSTITUCIONAL FITUPAZ' => [
                'DIRECCIÓN GENERAL',
                'ENLACE ADMINISTRATIVO DIRECCIÓN GENERAL',
                'Apoyo a Vuelos Nacionales e Internacionales',
            ],

            'TRANSPARENCIA ACCESO A LA INFORMACION' => [
                'JEFATURA DE DEPARTAMENTO JURÍDICO Y TRANSPARENCIA',
                'AUXILIAR JURÍDICO Y DE TRANSPARENCIA',
            ],

            'DESARROLLO DE INFRAESTRUCTURA TURISTICA' => [
                'INFRAESTRUCTURA TURÍSTICA AIRBNB',
            ],

            'Compromisos 2024 para pagar en 2026' => [
                'PASAJES AÉREOS',
            ],

            'Compromisos 2025 para pagar en 2026' => [
                'RCV (RETIRO, CESANTÍA EN EDAD AVANZADA Y VEJEZ)',
                'IMSS',
                'INFONAVIT',
                'ISN (IMPUESTO SOBRE NÓMINA)',
                'ASESORÍA JURÍDICA',
                'CAMPAÑA EN MEDIOS NACIONALES E INTERNACIONALES',
                'LEVANTAMIENTO ESTADÍSTICO LA PAZ',
                'CAMPAÑA CONCIENTIZACIÓN HACIA EL TURISMO',
                'CAMPAÑA DE EVENTOS PROMOCIONALES',
                'CAMPAÑA IMAGEN Y PROMOCIÓN LA PAZ ESTADOS UNIDOS DE AMÉRICA',
                'CAMPAÑA IMAGEN Y PROMOCIÓN LA PAZ CANADÁ',
                'CAMPAÑA NACIONAL DE IMAGEN Y PROMOCIÓN LA PAZ',
                'ESTRATEGIA DIGITAL Y REDES SOCIALES',
                'SITIO WEB LA PAZ',
            ],
        ];

        foreach ($estructura as $partidaNombre => $subpartidas) {

            $partidaNombre = $this->limpiarNombre($partidaNombre);

            // PARTIDA PADRE
            $partida = DB::table('partidas')
                ->where('nombre', $partidaNombre)
                ->whereNull('padre_id')
                ->first();

            if (!$partida) {
                $partidaId = DB::table('partidas')->insertGetId([
                    'nombre' => $partidaNombre,
                    'padre_id' => null,
                    'creado_por' => $user,
                    'actualizado_por' => $user,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                $partidaId = $partida->id;
            }

            // SUBPARTIDAS
            foreach ($subpartidas as $nombre) {
                $nombre = $this->limpiarNombre($nombre);
                $existe = DB::table('partidas')
                    ->where('nombre', $nombre)
                    ->where('padre_id', $partidaId)
                    ->exists();

                if (!$existe) {
                    DB::table('partidas')->insert([
                        'nombre' => $nombre,
                        'padre_id' => $partidaId,
                        'creado_por' => $user,
                        'actualizado_por' => $user,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
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
