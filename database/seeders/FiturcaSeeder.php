<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FiturcaSeeder extends Seeder
{
    protected string $usuarioSistema = 'CVILLAVICENCIO';

    public function run()
    {
        $estructura = [
            'PROMOCION' => [
                'ROADSHOW_NACIONAL' => [
                    'SEGMENTO MEETINGS' => [
                        'CARAVANA DE TURISMO DE REUNIONES CDMX/CDMX' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'CARAVANA DE TURISMO DE REUNIONES MTY/MTY' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'CARAVANA DE TURISMO DE REUNIONES  GDL/GDL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                    ],
                    'SEGMENTO LEISURE' => [
                        'CARAVANAS MEXICO / BAJIO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'VARIOS MEXICO CDMX/ GDL/ MTY' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'CALL CENTER RCI' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                    ],
                ],
                'ROADSHOW_INTERNACIONAL' => [
                    'SEGMENTO MEETINGS' => [
                        'EVENTO DE PROMOCIÓN  / CALIFORNIA' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'EVENTO DE PROMOCIÓN / WESTCOAST' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'EVENTO DE PROMOCIÓN / DALLAS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'EVENTO DE PROMOCIÓN / EASTCOAST' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                    ],
                    'SEGMENTO LEISURE' => [
                        'ROADSHOW ESTADOS UNIDOS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'CALL CENTER RCI' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'ROADSHOW CANADA' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                        'ROADSHOW LATIONOAMERICA' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aerea',
                        ],
                    ],
                ],
                'FAM_TRIP_NACIONAL' => [
                    'FAM TRIPS LEISURE NACIONAL',
                    'FAM TRIPS MEETINGS NACIONAL',
                    'PROGRAMA DE FAM TRIPS GOLF NACIONAL',
                    'FAM TRIPS SEGMENTOS ESPECIALES NACIONAL',
                    'FAM TRIPS RELACIONES PÚBLICAS NACIONAL',
                ],
                'FAM_TRIP_INTERNACIONAL' => [
                    'PROGRAMA DE FAM TRIPS MEETINGS INTERNACIONAL',
                    'FAM TRIPS LEISURE INTERNACIONAL',
                    'PROGRAMA DE FAM TRIPS GOLF INTERNACIONAL',
                    'FAM TRIPS SEGMENTOS ESPECIALES INTERNACIONAL',
                    'FAM TRIPS RELACIONES PÚBLICAS INTERNACIONAL',
                ],
                'TRADE_SHOWS_NACIONAL' => [
                    'SEGMENTO MEETINGS' => [
                        'PCMA PROFESSIONAL EXCHANGE /LOS CABOS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'IBTM AMERICAS/CIUDAD DE MÉXICO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS GASTOS VIAJE NACIONAL MICE / VARIOS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'CONGRESO NACIONAL DE LA INDUSTRIA DE REUNIONES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'DESTINATION MEXICO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                    'SEGMENTO LEISURE' => [
                        'TIANGUIS TURÍSTICO DE MÉXICO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS MEXICO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'ATENCIÓN Y GASTOS DE VIAJE/VARIAS CIUDADES NACIONAL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                    'SEGMENTO ESPECIALES' => [
                        'PROGRAMA TRADESHOWS GOLF/VARIAS NACIONAL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS PROMOCIÓN LGBTQ + (PRIDE LOS CABOS)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTO PROMOCIÓN PARA TIEMPO COMPARTIDO (ASUDESTICO)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                ],
                'TRADE_SHOWS_INTERNACIONAL' => [
                    'SEGMENTO MEETINGS' => [
                        'PCMA PARTNERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'FORBES TRAVEL SUMMIT' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'SITE PARTNERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'PRESTIGE PARTNERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'AMERICAN EXPRESS PARTNERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'GLOBAL CYNERGIES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'CONNECT MEETINGS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'SMU SUCCESSFUL MEETINGS UNIVERSITY/NEW YORK' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'WORLD MEETINGS FORUM' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'GMITE/PHOENIX' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'HPN' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'AMC INSTITUTE' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'GLOBAL DESTINATION SUSTAINABILITY' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'CONFERENCE DIRECT ANNUAL PARTNER MEETING' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'IMEX FRANKFURT/FRANKFURT' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'HELMSBRISCOE ANNUAL BUSINESS CONFERENCE /LAS VEGAS, NV' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'INCENTIVE RESEARCH FOUNDATION' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'MPI PARTNERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'VIRTUAL TRADESHOWS MEETING' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'FIEXPO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'DESTINATION INTERNATIONAL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'DESTINATION  MEXICO' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'IMEX AMERICA /LAS VEGAS, NV' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'ICCA CONGRESS + MEMBERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'APOYO A POSTULACIONES/VARIAS CIUDADES INTERNACIONAL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'MARITZ PARTNERSHIP' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'NORTHSTAR  EVENTS/MEETINGS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS MICE PROMOCION' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                    'SEGMENTO LEISURE' => [
                        'FERIAS EUROPA (FITUR, WTM LONDRES, TOP RESA, ITB BERLIN)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'ROADSHOW SOCIOS COMERCIALES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'VIRTUOSO TRAVEL WEEK LOS CHAIRMAN\'S' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS CANADA (WESTJET/AIR CANADA)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'FERIAS LATAM (WTM LATAM, FIT, ANATO)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'ILTM EVENTOS (LATAM, PAC, CANNES, NOTH AMERICA)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'NORTHSTAR  GTM WEST / GTM / FUTURE LEADERS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS VIRTUOSO /DIVERSAS CUIDADES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS SIGNATURE /DIVERSAS CIUDADES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS LEISURE PROMOCIÓN VIRTUAL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'ATENCIÓN Y GASTOS DE VIAJE/VARIAS CIUDADES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'LE MIAMI' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS PROMOCION LEISURE EAS COAST (NY, IL, AAA, CCRA)' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'TRADESHOW  INTERNACIONAL EUROPA' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS ASIA (JATA/KOTFA/ARABIAN' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS AUSTRALIA' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTOS BRASIL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'EVENTO NORTHSTAR LUXURY' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                    'SEGMENTO ROMANCE' => [
                        'ENGAGED SUMMIT' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'WEDDING SALON /LOS ÁNGELES, CA' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'DWP CONGRESS' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                    'SEGMENTOS ESPECIALES' => [
                        'PROGRAMA TRADESHOWS GOLF/VARIAS INTERNACIONAL' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                        'PROGRAMA IGLTB / VARIAS CIUDADES' => [
                            'Costo por participación',
                            'Viáticos',
                            'Transp Terrestre ',
                            'Transp. Aéreo',
                        ],
                    ],
                ],
                'VIP_SUMMIT_INTERNACIONAL' => [
                    'LOS CABOS VIP SUMMIT  (MAYORISTAS) INTL',
                ],
                'RELACIONES_PÚBLICAS_NACIONAL' => [
                    'RELACIONES PÚBLICAS NACIONAL',
                    'ALIANZA GOPRO CONTENIDO',
                ],
                'RELACIONES_PÚBLICAS_INTERNL' => [
                    'RELACIONES PÚBLICAS INT USA ',
                    'RELACIONES PÚBLICAS INTERNACIONALES PARA CANADÁ',
                    'RELACIONES PUBLICAS ESPAÑA',
                    'RELACIONES PUBLICAS COLOMBIA Y PANAMÁ',
                    'RELACIONES PUBLICAS UK',
                    'RELACIONES PUBLICAS ALEMANIA',
                    'RELACIONES PUBLICAS Y REPRESENTACIÓN LATAM',
                    'INFLUENCERS ESTADOS UNIDOS',
                    'ESTRATEGIA DE INFLUENCERS TAGGER MEDIA',
                    'ATENCIONES Y CORTESIAS',
                ],
                'APOYO_A_NUEVOS_VUELOS_INTERNACIONAL' => [
                    'APOYO A NUEVOS VUELOS INTERNACIONAL ' => [
                        'APOYO A NUEVOS VUELOS INTERNACIONAL ',
                        'Apoyo Desarrollo Ruta Copa Airlines',
                        'Eventos',
                        'Viáticos',
                        'transporte aereo',
                    ],
                    'APOYO A NUEVOS VUELOS INAUGURALES' => [
                        'APOYO A NUEVOS VUELOS INAUGURALES',
                    ],
                ],
                'APOYO_A_NUEVOS_VUELOS_NACIONAL' => [
                    'APOYO A NUEVOS VUELOS NACIONAL',
                ],
                'MATERIAL_PROMOCIONAL__NACIONAL_E_INTERNAC.' => [
                    'MATERIALES  NACIONAL E INTERNAC',
                    'KIT PROMOCIONAL PARA MERCADO NACIONAL',
                ],
                'ENVIOS_Y_ALMACENAJE_MATERIAL_COLATERAL' => [
                    'ENVIOS Y ALMACENAJE MATERIAL COLATERAL',
                ],
                'SERVICIOS_DE_PROMOCIÓN_COMERCIAL' => [
                    'ASESORIA GLOBAL MEETING',
                    'ACCIONES PROMOCION CLUSTER REUNIONES',
                    'CAPACITACION MICE',
                    'BRANDING MICE',
                    'ESTUDIOS MICE',
                    'SERVICIOS DE DISEÑO INSTITUCIONAL',
                    'SERVICIOS DE TRADUCCIÓN INSTITUCIONAL',
                    'ASESORÍA QUEER DESTINATIONS',
                    'SERVICIO DE COORDINACIÓN Y LOGÍSTICA DE EVENTOS DE PROMOCIÓN ',
                    'SERVICIO STANDS',
                    'ASESORIA COOPERATIVOS ',
                ],
                'MEMBRESIAS_SISTEMAS_Y_PLATAFORMAS' => [
                    'PLATAFORMA CVENT',
                    'MEMBRESIA IAGTO',
                    'MEMBRESIA SMITH TRAVEL REPORT (STR)',
                    'LICENCIA CRM/CMS GESTOR DE MARKETING MASIVA',
                    'LICENCIA TOUR DIGITAL 360 ANUAL',
                    'MEMBRESÍA IGLTA',
                    'LOS CABOS SPECIALIST',
                    'PLATAFORMA ESPECIALISTA LOS CABOS ',
                    'ACTUALIZACIONES Y ADMON PAGINAS WEB,  SOFTWARES Y HERRAMIENTAS DIGITALES',
                    'LICENCIA 3D FLIGTH MAP SMARTFLYER',
                ],
                'ESTUDIOS_DE_INVESTIGACIÓN_DE_MERCADO' => [
                    'SISTEMA DE INTELIGENCIA DE AEROPUERTOS OAG',
                    'LICENCIA DE ACCESO A ESTUDIOS SKIFT',
                    'DESARROLLO PRODUCTOS TURÍSTICOS EXPERIENCIALES',
                    'ESTUDIOS INDUSTRIA DE REUNIONES',
                    'INTELIGENCIA DEL MERCADO TURISTICO',
                    'PATA DE PERRO',
                    'ANALISIS DATOS ESTADÍSTICOS (OBSERVATORIO ESTADÍSTICO)',
                    'ESTUDIO DE INVESTIGACIÓN DE ORIGEN DE MERCADOS',
                    'MONITOREO ROI PATROCINIOS',
                    'ESTUDIO ESTRATÉGICO DE LOS CABOS / PROYECTA',
                    'ESTUDIO DE ZONAS DE DESARROLLO Y DEMANDA TIEMPOS COMPARTIDOS',
                    'ESTUDIO PERCEPCION COMUNITARIA',
                    'ESTUDIO DE ESTADISTICAS DE HOSPEDAJE A TRAVÉS DE PLATAFORMAS ',
                    'ESTUDIO DE MERCADOS COMPETITIVOS',
                ],
                'CAPACITACIÓN_EDUCATIVA' => [
                    'CERTIFICACION CMP',
                    'CERTIFICACION DMC\'S',
                    'CAPACITACIÓN DE COPY CREATIVO Y REDACCIÓN PUBLICITARIA',
                    'TALLER DE TRABAJO CON AGENCIAS',
                    'CAPACITACIÓN DE RELACIONES PÚBLICAS',
                    'CAPACITACIÓN DESARROLLO DE PRODUCTO',
                    'MAESTRÍA ESPECIALIZADAS',
                ],
                'PROMOCIONES_CON_CUENTAS_COMERCIALES_INTERNACIONALES' => [
                    'ALIANZA MERIT TRAVEL BRANDS GOLF',
                    'ALIANZA NORTHEAST GOLF / HGL',
                    'ALIANZA LGBTQ',
                    'ALIANZA GENDRON GOLF',
                    'GOLF BREAKS UK',
                ],
                'PATROCINIOS_NACIONAL_E_INTERNACIONAl' => [
                    'PATROCINIOS NACIONAL E INTERNACIONAL',
                    'WORLD MEETINGS FORUM',
                    'GLOBAL MICE FORUM',
                    'EVENTOS PATROCINIOS MICE',
                    'FESTIVALES CULTURALES',
                    'TORNEO DE GOLF INFANTIL INTERNACIONAL FUTURE CHAMPIONS',
                    ' PGA TOUR WORLD WIDE TECNOLOGY CHAMPIOSHIP',
                ],
                'PATROCINIOS_INSTITUCIONALES' => [
                    ' M&I LUXE LOS CABOS',
                    'CONNECT INCENTIVES',
                    'BILLFISH',
                    'WORLD MEETINGS FORUM',
                    'LGBTQ+ TRAVEL SYMPOSIUM LOS CABOS ',
                    'LATIN AMERICAN CUPS FLAG FOOTBALL TOURNAMENT',
                ],
                'TORNEOS_DE_PESCA' => [
                    'PLAN DE PROMOCIÓN DE PESCA DEPORTIVA FONMAR',
                    'TORNEO DE PESCA "BILLFISH"',
                    'PLAN DE MEDIOS DE PESCA  FITURCA FONMAR ',
                    'LOS CABOS BIG GAME CHARTERBOAT CLASSIC',
                ],
                'APOYOS_INSTITUCIONALES' => [
                    'ATENCIONES Y CORTESÍAS ',
                    'ADMINISTRACIÓN Y MANTENIMIENTO DE PANTALLA APTO.',
                    'GASTOS DE PRESENTACIONES',
                ],
                'SUELDOS_Y_SALARIOS_PROMOCIÓN_COMERCIAL' => [
                    'DIRECTOR DE COMUNICACIÓN ESTRATÉGICA Y MEDIOS (SUELDOS Y SALARIOS)',
                    'DIRECTOR DE PROMOCIÓN Y DESARROLLO DE NEGOCIOS (SUELDOS Y SALARIOS)',
                    'GERENTE DE MERCADOTECNIA (SUELDOS Y SALARIOS)',
                    'GERENTE RELACIONES PÚBLICAS (SUELDOS Y SALARIOS)',
                    'GERENTE DE MEDIOS DIGITALES (SUELDOS Y SALARIOS)',
                    'GERENTE DE CONTENIDO DIGITAL (SUELDOS Y SALARIOS)',
                    'SUBDIRECCIÓN COMERCIAL (SUELDOS Y SALARIOS)',
                    'GERENTE DE PROMOCIÓN (SUELDOS Y SALARIOS)',
                    'GERENTE DE INDUSTRIA DE REUNIONES (SUELDOS Y SALARIOS)',
                    'GERENTE DE SEGMENTOS ESPECIALES (SUELDOS Y SALARIOS)',
                    'GERENTE DE MARCA Y CREATIVIDAD (SUELDOS Y SALARIOS)',
                    'GERENTE DE DESARROLLO DE PRODUCTO (SUELDOS Y SALARIOS)',
                    'REMUNERACION POR TERMINO DE RELACION LABORAL SYS',
                ],
                'IMPUESTOS__ESTATALES_PROMOCIÓN' => [
                    'IMPUESTOS  ESTATALES PROMOCIÓN COMERCIAL PROM',
                ],
                'CUOTAS_PATRONALES_IMSS_COMERCIAL' => [
                    'CUOTAS PATRONALES IMSS PROM',
                ],
                'RETIRO_2_COMERCIAL' => [
                    ' RETIRO 2%  PROM',
                ],
                'INFONAVIT_COMERCIAL' => [
                    'INFONAVIT PROM',
                ],
                'CESANTÍA_Y_VEJEZ_COMERCIAL' => [
                    'CESANTÍA Y VEJEZ PROM',
                ],
                'GASTOS_DE_LICITACIONES' => [
                    'GASTOS DE LICITACIONES',
                ],
                'DIVERSOS_COMERCIAL' => [
                    'DIVERSOS COMERCIAL',
                ],
                'DIVERSOS_RP_Y_COMUNICACIÓN_ESTRATEGICA' => [
                    'DIVERSOS RP Y COMUNICACIÓN ESTRATEGICA',
                ],
                'GASTOS_DE_VIAJE_MERCADOTECNIA' => [
                    'DIVERSOS DIGITAL',
                    'DIVERSOS BRAND',
                ],
                'PROGRAMAS_Y_SISTEMAS_INFORMÁTICOS' => [
                    'PROGRAMAS Y SISTEMAS INFORMÁTICOS',
                ],
            ],
            'PUBLICIDAD' => [
                'MEDIOS_NACIONAL' => [
                    'UNIMEDIOS',
                    'CABO NEWS TODAY',
                    'GUIA MICHELIN',
                ],
                'MEDIOS_INTERNACIONAL' => [
                    'MEDIOS INTERNACIONAL USA',
                    'MEDIOS INTERNACIONAL CANADA',
                    'MEDIOS INTERNACIONAL EUROPA',
                    'MEDIOS INTERNACIONAL LATAM',
                    'CAMPAÑAS COOPERATIVAS ESPAÑA',
                    'CAMPAÑAS INTERNACIONALES CON SOCIOS COMERCIALES ',
                    'FAMS SOCIOS COMERCIALES',
                ],
                'MARKETING_DIGITAL_INTERNACIONAL' => [
                    'MARKETING DIGITAL INTERNACIONAL',
                    'DESARROLLO DEL METAVERSO DE LOS CABOS',
                    'ESTUDIO DE IMPACT DIGITAL DEL DESTINO',
                    'PROGRAMA DE CONTENT MEETINGS (REDES Y CRM)',
                    'LEVANTAMIENTO 360',
                    'ACCIONES EMERGENTES MARKETING DIGITAL INTERNACIONAL',
                ],
                'MARKETING_DIGITAL_NACIONAL' => [
                    'MARKETING DIGITAL NACIONAL',
                    'ACCIONES EMERGENTES MARKETING DIGITAL NACIONAL',
                ],
                'CREATIVIDAD_Y_PRODUCCIÓN_NACIONAL' => [
                    'CREATIVIDAD Y PRODUCCIÓN NACIONAL',
                ],
                'CREATIVIDAD_Y_PRODUCCIÓN_INTERNACIONAL' => [
                    'CREATIVIDAD Y PRODUCCIÓN INTERNACIONAL',
                ],
                'MARKETING_INTEGRAL_PARA_CANADÁ' => [
                    'MARKETING INTEGRAL PARA CANADÁ',
                ],
                'MARKETING_INTEGRAL_ESPAÑA' => [
                    'MARKETING INTEGRAL ESPAÑA',
                ],
                'RECUPERAR_CONECTIVIDAD_AÉREA_DE_LOS_MERCADOS_PRIMARIOS_PRIMARIOS' => [
                    'RECUPERAR CONECTIVIDAD AÉREA DE LOS MERCADOS PRIMARIOS PRIMARIOS',
                ],
                'INVERSIÓN_EN_PROGRAMAS_DE_PROMOCIÓN__EN_VENTA_DIRECTA_AL_CONSUMIDOR__DIRECTA_AL_CONSUMIDOR' => [
                    'INVERSIÓN EN PROGRAMAS DE PROMOCIÓN  EN VENTA DIRECTA AL CONSUMIDOR  DIRECTA AL CONSUMIDOR',
                ],
                'CAMPAÑAS_DE_IMAGEN_DEL_DESTINO' => [
                    'CAMPAÑAS DE IMAGEN DEL DESTINO',
                ],
                'MERCADOS_EMERGENTES' => [
                    'REINO UNIDO (UK)',
                    'AUSTRALIA',
                    'BRASIL',
                    'ESPAÑA',
                    'FRANCIA',
                    'JAPON',
                    'ALEMANIA',
                ],
            ],
            'ADMINISTRACION' => [
                'IMPUESTOS_ESTATALES_ADMINISTRATIVOS' => [
                    'ISN',
                ],
                'SUELDOS_Y_SALARIOS_ADMINISTRATIVOS_BRUTOS' => [
                    'DIRECTOR GENERAL  (SUELDOS Y SALARIOS)',
                    'GERENTE DE ADMINISTRACIÓN Y FINANZAS (SUELDOS Y SALARIOS)',
                    'COORDINADOR DE CONTROL ADMINISTRATIVO   (SUELDOS Y SALARIOS)',
                    'GERENTE JURÍDICO (SUELDOS Y SALARIOS)',
                    'SECRETARIA TÉCNICA (SUELDOS Y SALARIOS)',
                    'AUXILIAR ADMINISTRATIVO (SUELDOS Y SALARIOS)',
                    'SERVICIO DE LIMPIEZA   (SUELDOS Y SALARIOS)',
                    'COORDINADOR DE CALIDAD Y TRANSPARENCIA (SUELDOS Y SALARIOS)',
                    'REMUNERACION POR TERMINO DE RELACION LABORAL',
                ],
                'CUOTAS_PATRONALES_IMSS' => [
                    'CUOTAS PATRONALES IMSS',
                ],
                'RETIRO_2_ADMON' => [
                    'RETIRO 2% ADMON',
                ],
                'INFONAVIT' => [
                    'INFONAVIT',
                ],
                'CESANTÍA_Y_VEJEZ' => [
                    'CESANTÍA Y VEJEZ',
                ],
                'HONORARIOS_A_PROFESIONISTAS' => [
                    'HONORARIOS A ABOGADOS',
                    'HONORARIOS A CONTADORES',
                    'HONORARIOS A FIDUCIARIO',
                    'HONORARIOS A AUDITORIA',
                ],
                'ASESORIA_INTEGRAL' => [
                    'ASESORIA INTEGRAL',
                ],
                'GASTOS_LEGALES' => [
                    'GASTOS LEGALES',
                ],
                'CAPACITACIÓN_ADMINISTRATIVA' => [
                    'CAPACITACIÓN ADMINISTRATIVA',
                ],
                'ESTUDIOS ESPECIALIZADOS' => [
                    'ESTUDIOS ESPECIALIZADOS',
                ],
                'ARRENDAMIENTO_DE_OFICINA' => [
                    'ARRENDAMIENTO DE OFICINA',
                ],
                'MANTENIMIENTO' => [
                    'MANTENIMIENTOS DE MOB Y EQUIPO',
                    ' SERVICIOS DE VIGILANCIA',
                    'MANTENIMIENTO DE EQUIPO DE TRANSPORTE',
                    'MANTENIMIENTO AIRES ACONDICIONADOS',
                    ' MANTENIMIENTO DE INMUEBLES',
                    'SUMINISTRO DE LIMPIEZA',
                    'MANTENIMIENTO DE EQUIPO DE CÓMPUTO',
                    'SERVICIOS DE LAVANDERÍA, LIMPIEZA, HIGIENE Y FUMIGACIÓN',
                ],
                'TELEFONOS' => [
                    'TELEFONOS',
                ],
                'FLETES_Y_MENSAJERIA' => [
                    'FLETES Y MENSAJERIA',
                ],
                'SERVICIO_DE_TRANSPORTACÍON_LOCAL' => [
                    'TRANSPORTACÍON LOCAL',
                ],
                'ATENCIONES_A_VISITANTES' => [
                    'ATENCIONES A VISITANTES',
                ],
                'GASTOS_DE_VIAJE' => [
                    'GASTOS DE VIAJE',
                ],
                'ENERGIA_ELECTRICA' => [
                    'ENERGIA ELECTRICA',
                ],
                'GASOLINA' => [
                    'GASOLINA',
                ],
                'PAPELERIA_Y_UTILES' => [
                    'PAPELERIA Y UTILES',
                ],
                'ENSERES_MENORES' => [
                    'ENSERES MENORES',
                ],
                'PROGRAMAS_Y_ASESORIAS' => [
                    'PROGRAMAS Y ASESORIAS',
                ],
                'UNIFORMES' => [
                    'UNIFORMES',
                ],
                'COMISIONES_BANCARIAS' => [
                    'COMISIONES BANCARIAS',
                ],
                'OBLIGACIONES_VEHICULARES' => [
                    'OBLIGACIONES VEHICULARES',
                ],
                'SEGUROS_Y_FIANZAS' => [
                    'SEGUROS Y FIANZAS',
                ],
                'EQUIPO_DE_TRANSPORTE_MOBILIARIO' => [
                    'EQUIPO DE CÓMPUTO',
                    'RENOVACION DE PARQUE VEHICULAR',
                    'CAMARA DE VIDEO',
                    'MUEBLES COCINA',
                    'CAFETERAS',
                    'EQUIPO DE SONIDO',
                    'TELEVISIONES',
                    'MUEBLES PARA TELEVISION',
                    'DISPENSADOR DE AGUA',
                ],
                'MEJORAS_INMUEBLES_ARRENDADOS' => [
                    'REMODELACIÓN OFICINA',
                ],
                'MAQUINARIA_OTROS_EQUIPOS_Y_HERRAMIENTAS' => [
                    'SISTEMAS DE AIRE ACONDICIONADO',
                ],
                'DIVERSOS_ADMINISTRATIVOS' => [],
            ],
            'INFRAESTRUCTURA TURISTICA' => [
                'INFRAESTRUCTURA TURISTICA 21, 22\'',
                'INFRAESTRUCTURA TURISTICA 23\'',
                'INFRAESTRUCTURA TURISTICA 24\'',
                'INFRAESTRUCTURA TURISTICA 25\'',
                'INFRAESTRUCTURA TURISTICA 26\'',
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