<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('provinces')->insert([
        //     [
        //         'id' =>1,
        //         'name' => 'Maputo Cidade',
        //     ],
        //     [
        //         'id' =>2,
        //         'name' => 'Maputo Província',
        //     ],
        //     [
        //         'id' =>3,
        //         'name' => 'Inhambane',
        //     ],
        //     [
        //         'id' =>4,
        //         'name' => 'Gaza',
        //     ],
        //     [
        //         'id' =>5,
        //         'name' => 'Sofala',
        //     ],
        //     [
        //         'id' =>6,
        //         'name' => 'Manica',
        //     ],
        //     [
        //         'id' =>7,
        //         'name' => 'Tete',
        //     ],
        //     [
        //         'id' =>8,
        //         'name' => 'Zambézia',
        //     ],
        //     [
        //         'id' =>9,
        //         'name' => 'Nampula',
        //     ],
        //     [
        //         'id' =>10,
        //         'name' => 'Cabo Delgado',
        //     ],
        //     [
        //         'id' =>11,
        //         'name' => 'Niassa',
        //     ],
        //    ]);

        //    DB::table('roles')->insert([
        //     [
        //         'id' =>1,
        //         'name' => 'admin',
        //     ],
        //     [
        //         'id' =>2,
        //         'name' => 'manager',
        //     ],
        //     [
        //         'id' =>3,
        //         'name' => 'associate',
        //     ],
            
        //    ]);

        //    DB::table('event_types')->insert([
        //     [
        //         'id' =>1,
        //         'name' => 'Privado',
        //     ],
        //     [
        //         'id' =>2,
        //         'name' => 'Público',
        //     ],
        //    ]);

        //    DB::table('payment_frequencies')->insert([
        //     [
        //         'id' =>1,
        //         'name' => 'Trimestral',
        //         'months' => 3
        //     ],
        //     [
        //         'id' =>2,
        //         'name' => 'Semestral',
        //         'months' => 6
        //     ],
        //     [
        //         'id' =>3,
        //         'name' => 'Anual',
        //         'months' => 12
        //     ],
        //    ]);


           //SERVICOS ECONOMICOS

        //    DB::table('service_economic_activities')->insert([
        //     [
        //         'id' =>1,
        //         'name' => 'G - Comércio por grosso e a retalho: reparação de veículos automóveis e motociclos',
        //     ],
        //     [
        //         'id' =>2,
        //         'name' => 'J - Actividades de informação e de comunicação',
        //     ],
        //     [
        //         'id' =>3,
        //         'name' => 'M - Actividades de consultoria, científicas, técnicas e similares',
        //     ],
        //     [
        //         'id' =>4,
        //         'name' => 'N - Actividades administrativas e dos serviços de apoio',
        //     ],
        //     [
        //         'id' =>5,
        //         'name' => 'Q - Actividades de saúde humana e acção social',
        //     ],
        //     [
        //         'id' =>6,
        //         'name' => 'S - Outras actividades de serviços',
        //     ],
        //     [
        //         'id' =>7,
        //         'name' => 'E - Captação, tratamento e distribuição de água: saneamento gestão de resíduos e despoluição',
        //     ],
        //    ]);


        //    //DIVISÃO ECONOMICA

        //    DB::table('division_economic_activities')->insert([
        //     [
        //         'id' =>1,
        //         'service_economic_activity_id'=>1,
        //         'name' => '45 - Comércio por grosso e a retalho: manutenção e reparação de veículos automóveis e motociclos',
        //     ],
        //     [
        //         'id' =>2,
        //         'service_economic_activity_id'=>1,
        //         'name' => '46 - Comércio por grosso (inclui agentes), excepto de veículos automóveis e motociclos',
        //     ],
        //     [
        //         'id' =>3,
        //         'service_economic_activity_id'=>1,
        //         'name' => '47 - Comércio a retalho, excepto de veículos automóveis e motociclos',
        //     ],

        //     // FIM 1

        //     [
        //         'id' =>4,
        //         'service_economic_activity_id'=>2,
        //         'name' => '58 - Actividades de edição',
        //     ],
        //     [
        //         'id' =>5,
        //         'service_economic_activity_id'=>2,
        //         'name' => '62 - Consultoria e programação informática e actividades relacionadas',
        //     ],
        //     [
        //         'id' =>6,
        //         'service_economic_activity_id'=>2,
        //         'name' => '63 - Actividades dos serviços de informação',
        //     ],

        //     // FIM 2

        //     [
        //         'id' =>7,
        //         'service_economic_activity_id'=>3,
        //         'name' => '69 - Actividades jurídicas e de contabilidade',
        //     ],
        //     [
        //         'id' =>8,
        //         'service_economic_activity_id'=>3,
        //         'name' => '70 - Actividades das sedes sociais e de consultoria para a gestão',
        //     ],

        //     [
        //         'id' =>9,
        //         'service_economic_activity_id'=>3,
        //         'name' => '71 - Actividades de arquitectura, de engenharia e técnicas afins, actividades de ensaios e de análises técnicas',
        //     ],
        //     [
        //         'id' =>10,
        //         'service_economic_activity_id'=>3,
        //         'name' => '73 - Publicidade, estudos de mercado e sondagens de opinião',
        //     ],
        //     [
        //         'id' =>11,
        //         'service_economic_activity_id'=>3,
        //         'name' => '74 - Outras actividades de consultoria, científicas, técnicas e similares',
        //     ],

        //     //FIM 3

        //     [
        //         'id' =>12,
        //         'service_economic_activity_id'=>4,
        //         'name' => '77 - Actividades de aluguer',
        //     ],
        //     [
        //         'id' =>13,
        //         'service_economic_activity_id'=>4,
        //         'name' => '78 - Actividades de emprego',
        //     ],

        //     [
        //         'id' =>14,
        //         'service_economic_activity_id'=>4,
        //         'name' => '81 - Actividades relacionadas com edifícios, plantação e manutenção de jardins',
        //     ],
        //     [
        //         'id' =>15,
        //         'service_economic_activity_id'=>4,
        //         'name' => '82 - Actividades de serviços administrativos e de apoio prestados às empresas',
        //     ],

        //     //FIM 4

        //     [
        //         'id' =>16,
        //         'service_economic_activity_id'=>5,
        //         'name' => '88 - Actividades de acção social sem alojamento',
        //     ],

        //     //FIM 5

    

        //     [
        //         'id' =>17,
        //         'service_economic_activity_id'=>6,
        //         'name' => '95 - Reparação de computadores e de bens de uso pessoal e doméstico',
        //     ],
        //     [
        //         'id' =>18,
        //         'service_economic_activity_id'=>6,
        //         'name' => '96 - Outras actividades de serviços pessoais',
        //     ],

        //     //FIM 7

        //     [
        //         'id' =>19,
        //         'service_economic_activity_id'=>7,
        //         'name' => '36 - Captação, tratamento e distribuição de água',
        //     ],
        //     [
        //         'id' =>20,
        //         'service_economic_activity_id'=>7,
        //         'name' => '37 - Recolha, drenagem e tratamento de águas residuais',
        //     ],

        //     //FIM 8
            



        //     //GRUPO ECONOMICO

           
        //    ]);

        //    DB::table('group_economic_activities')->insert([
        //     [
        //         'id' =>1,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>1,
        //         'name' => '451 - Comércio de veículos automóveis',
        //     ],
        //     [
        //         'id' =>2,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>1,
        //         'name' => '453 - Comércio de peças e acessórios para veículos automóveis',
        //     ],
        //     [
        //         'id' =>3,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>1,
        //         'name' => '454 - Comércio, manutenção e reparação de motociclos, de suas peças e acessórios',
        //     ],

        //     //FIM 1 1

        //     [
        //         'id' =>4,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '461 - Agentes do comércio por grosso',
        //     ],
        //     [
        //         'id' =>5,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '462 - Comércio por grosso de produtos agrícolas brutos e animais vivos',
        //     ],
        //     [
        //         'id' =>6,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '463 - Comércio por grosso de produtos alimentares, bebidas e tabaco',
        //     ],
        //     [
        //         'id' =>7,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '464 - Comércio por Grosso de Bens de Consumo (Excepto Alimentares, Bebidas e Tabaco)',
        //     ],
        //     [
        //         'id' =>8,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '465 - Comércio por grosso de máquinas, equipamentos e suas partes',
        //     ],
        //     [
        //         'id' =>9,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '466 - Outro comércio por grosso especializado',
        //     ],
        //     [
        //         'id' =>10,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>2,
        //         'name' => '469 - Comércio por grosso não especializado',
        //     ],
           
        //     //FIM 1 2

        //     [
        //         'id' =>11,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '471 - Comércio a retalho em estabelecimentos não especializados',
        //     ],
        //     [
        //         'id' =>12,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '472 - Comércio a retalho de produtos alimentares, bebidas e tabaco em estabelecimentos especializados',
        //     ],
        //     [
        //         'id' =>13,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '474 - Comércio a retalho de equipamento das tecnologias da informação e comunicação (tic/ict), em estabelecimentos especializados',
        //     ],
        //     [
        //         'id' =>14,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '475 - Comércio a retalho de outro equipamento para uso doméstico em estabelecimentos especializados',
        //     ],
        //     [
        //         'id' =>15,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '476 - Comércio a retalho de bens culturais e recreativos em estabelecimentos especializados',
        //     ],
        //     [
        //         'id' =>16,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '477 - Comércio a retalho de outros produtos em estabelecimentos especializados',
        //     ],
        //     [
        //         'id' =>17,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>3,
        //         'name' => '479 - Comércio a retalho não efectuado em estabelecimentos, bancas, feiras ou unidades móveis de venda',
        //     ],

        //     //FIM 1 3

        //     [
        //         'id' =>18,
        //         'service_economic_activity_id'=>2,
        //         'division_economic_activity_id'=>4,
        //         'name' => '581 - Edição de livros, jornais e de outras publicações',
        //     ],
        //     [
        //         'id' =>19,
        //         'service_economic_activity_id'=>2,
        //         'division_economic_activity_id'=>4,
        //         'name' => '582 - Edição de programas informáticos',
        //     ],

        //     //FIM 2 4

        //     [
        //         'id' =>20,
        //         'service_economic_activity_id'=>2,
        //         'division_economic_activity_id'=>5,
        //         'name' => '620 - Consultoria e programação informática e actividades relacionadas',
        //     ],

        //      //FIM 2 5

        //      [
        //         'id' =>21,
        //         'service_economic_activity_id'=>2,
        //         'division_economic_activity_id'=>6,
        //         'name' => '639 - Outras actividades dos serviços de informação',
        //     ],

        //     //FIM 2 6

        //     [
        //         'id' =>22,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>7,
        //         'name' => '691 - Actividades jurídicas',
        //     ],
        //     [
        //         'id' =>23,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>7,
        //         'name' => '692 - Actividades de contabilidade e auditoria, consultoria fiscal',
        //     ],

        //      //FIM 3 7

        //      [
        //         'id' =>24,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>8,
        //         'name' => '702 - Actividades de consultoria para os negócios e a gestão',
        //     ],

        //     //FIM 3 8
        //     [
        //         'id' =>25,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>9,
        //         'name' => '711 - Actividade de arquitectura, de engenharia e ténicas afins',
        //     ],

        //     [
        //         'id' =>26,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>9,
        //         'name' => '712 - Actividades de ensaios e análises técnicas',
        //     ],

        //     //FIM 3 9

        //     [
        //         'id' =>27,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>10,
        //         'name' => '731 - Publicidade',
        //     ],

        //     [
        //         'id' =>28,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>10,
        //         'name' => '732 - Estudos de mercado e sondagens de opinião',
        //     ],

        //     //FIM 3 10

           

        //     [
        //         'id' =>29,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>11,
        //         'name' => '741 - Actividades de design',
        //     ],

        //     [
        //         'id' =>30,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>11,
        //         'name' => '742 - Actividades fotográficas',
        //     ],

        //     [
        //         'id' =>31,
        //         'service_economic_activity_id'=>3,
        //         'division_economic_activity_id'=>11,
        //         'name' => '749 - Outras actividades de consultoria, científicas, técnicas e similares, n.e.',
        //     ],

        //      //FIM 3 11
           
        //      [
        //         'id' =>32,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>12,
        //         'name' => '771 - Aluguer de veículos automóveis',
        //     ],

        //     [
        //         'id' =>33,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>12,
        //         'name' => '772 - Aluguer de bens de uso pessoal e doméstico',
        //     ],

        //     [
        //         'id' =>34,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>12,
        //         'name' => '773 - Aluguer de outras máquinas e equipamentos (sem operador)',
        //     ],

        //     //FIM 4 12

        //     [
        //         'id' =>35,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>13,
        //         'name' => '781 - Actividades das empresas de selecção e colocação de pessoal',
        //     ],

        //     [
        //         'id' =>36,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>13,
        //         'name' => '783 - Outros fornecimento de recursos humanos',
        //     ],

            

        //     //FIM 4 13

        //     [
        //         'id' =>37,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>14,
        //         'name' => '811 - Actividades combinadas de apoio à gestão de edifícios',
        //     ],

        //     [
        //         'id' =>38,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>14,
        //         'name' => '812 - Actividades de Limpeza',
        //     ],

        //     [
        //         'id' =>39,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>14,
        //         'name' => '813 - Actividades de plantação e manutenção de jardins',
        //     ],

            

        //     //FIM 4 14
        //     [
        //         'id' =>40,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>15,
        //         'name' => '821 - Actividades de serviços administrativos e de apoio',
        //     ],

        //     [
        //         'id' =>41,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>15,
        //         'name' => '822 - Actividades dos centros de chamadas',
        //     ],

        //     [
        //         'id' =>42,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>15,
        //         'name' => '823 - Organização de feiras, congressos e outros eventos similares',
        //     ],
        //     [
        //         'id' =>43,
        //         'service_economic_activity_id'=>4,
        //         'division_economic_activity_id'=>15,
        //         'name' => '829 - Actividades de serviços de apoio prestados às empresas, n.E.',
        //     ],

        //     //FIM 5 15

        //     [
        //         'id' =>44,
        //         'service_economic_activity_id'=>5,
        //         'division_economic_activity_id'=>16,
        //         'name' => '881 - Acção social para pessoas idosas e com deficiência, sem alojamento',
        //     ],

        //     [
        //         'id' =>45,
        //         'service_economic_activity_id'=>5,
        //         'division_economic_activity_id'=>16,
        //         'name' => '889 - Outras actividades de acção social, sem alojamento',
        //     ],

           

        //     //FIM 5 16

        //     [
        //         'id' =>46,
        //         'service_economic_activity_id'=>6,
        //         'division_economic_activity_id'=>17,
        //         'name' => '951 - Reparação de computadores e equipamento de comunicação',
        //     ],

        //     //FIM 6 17

        //     [
        //         'id' =>47,
        //         'service_economic_activity_id'=>6,
        //         'division_economic_activity_id'=>18,
        //         'name' => '960 - Outras actividades de serviços pessoais',
        //     ],

        //     //FIM 6 18
           

            

        //     [
        //         'id' =>48,
        //         'service_economic_activity_id'=>7,
        //         'division_economic_activity_id'=>19,
        //         'name' => '360 - Captação, tratamento e distribuição de água',
        //     ],
        //     //FIM 7 19

        //     [
        //         'id' =>49,
        //         'service_economic_activity_id'=>7,
        //         'division_economic_activity_id'=>20,
        //         'name' => '370 - Recolha, drenagem e tratamento de águas residuais',
        //     ],
        //     //FIM 7 20

            


        //    ]);









        //    //FIM TABBELA GRUPO ECONOMICO


           DB::table('class_economic_activities')->insert([
            [
                'id' =>1,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>1,
                'group_economic_activity_id'=>1,
                'name' => '4510 - Comércio de veículos automóveis',
            ],
            [
                'id' =>2,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>1,
                'group_economic_activity_id'=>2,
                'name' => '4530 - Comércio de peças e acessórios para veículos automóveis',
            ],
            [
                'id' =>3,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>1,
                'group_economic_activity_id'=>3,
                'name' => '4540 - Comércio, manutenção e reparação de motociclos, de suas peças e acessórios',
            ],
            [
                'id' =>4,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>4,
                'name' => '4610 - Agentes do comércio por grosso',
            ],
            [
                'id' =>5,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>5,
                'name' => '4620 - Comércio por grosso de produtos agrícolas brutos e animais vivos',
            ],
            [
                'id' =>6,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>6,
                'name' => '4630 - Comércio por grosso de produtos alimentares, bebidas e tabaco',
            ],
            [
                'id' =>7,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>6,
                'name' => '4641 - Comércio por grosso de têxteis, vestuário e calçado',
            ],
            [
                'id' =>8,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>7,
                'name' => '4649 - Comércio por grosso de outros bens de consumo (excepto alimentares, bebidas e tabaco)',
            ],
            [
                'id' =>9,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>8,
                'name' => '4651 - Comércio por grosso de computadores, equipamentos periféricos e programas informáticos',
            ],
            [
                'id' =>10,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>8,
                'name' => '4652 - Comércio por grosso de outros componentes e equipamentos electrónicos, de telecomunicações e suas partes',
            ],
            [
                'id' =>11,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>8,
                'name' => '4653 - Comércio por grosso de máquinas e equipamentos agrícolas',
            ],
            [
                'id' =>12,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>8,
                'name' => '4659 - Comércio por grosso de outras máquinas e equipamentos',
            ],
            [
                'id' =>13,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=> 9,
                'name' => '4661 - Comércio por grosso de combustíveis sólidos, líquidos, gasosos e produtos derivados',
            ],
            [
                'id' =>15,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>9,
                'name' => '4662 - Comércio por grosso de minérios e de metais
                ',
            ],
            [
                'id' =>16,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>9,
                'name' => '4663 - Comércio por grosso de madeira, de materiais de construção, ferragens, equipamento sanitário, equipamento e acessórios para canalizações e climatização',
            ],
            [
                'id' =>17,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>2,
                'group_economic_activity_id'=>9,
                'name' => '4669 - Comércio por grosso de desperdícios, sucatas e outros produtos, n.e.',
            ],
            [
                'id' =>18,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>10,
                'name' => '4690 - Comércio por grosso não especializado',
            ],
            [
                'id' =>19,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>11,
                'name' => '4711 - Comércio a retalho em estabelecimentos não especializados, com predominância de produtos alimentares, bebidas ou tabaco',
            ],
            [
                'id' =>20,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>11,
                'name' => '4719 - Comércio a retalho em estabelecimentos não especializados sem predominância de produtos alimentares, bebidas ou tabaco',
            ],
            [
                'id' =>21,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>12,
                'name' => '4723 - Comércio a retalho de tabaco, em estabelecimentos especializados',
            ],
            [
                'id' =>22,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>13,
                'name' => '4741 - Comércio a retalho de computadores, equipamentos periféricos, programas informáticos e de equipamento de telecomunicações, em estabelecimentos especializados',
            ],
            [
                'id' =>23,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>13,
                'name' => '4742 - Comércio a retalho do equipamento audiovisual em estabelecimentos especializados',
            ],
            [
                'id' =>24,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>14,
                'name' => '4751 - Comércio a retalho de têxteis em estabelecimentos especializados',
            ],
            [
                'id' =>25,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>14,
                'name' => '4753 - Comércio a retalho de carpetes, tapetes, cortinados e de outros revestimentos para paredes 4753 e pavimentos em estabelecimentos especializados',
            ],
            [
                'id' =>26,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>15,
                'name' => '4763 - Comércio a retalho de artigos de desporto, de campismo e lazer, em estabelecimentos 4763 especializados',
            ],
            [
                'id' =>27,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>15,
                'name' => '4764 - Comércio a retalho de jogos e brinquedos em estabelecimentos especializados',
            ],
            [
                'id' =>28,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>16,
                'name' => '4773 - Outro comércio a retalho de produtos novos em estabelecimentos especializados',
            ],
            [
                'id' =>29,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>16,
                'name' => '4774 - Comércio a retalho de artigos em segunda mão em estabelecimentos especializados',
            ],
            [
                'id' =>30,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>17,
                'name' => '4791 - Comércio a retalho por correspondência ou por Internet',
            ],
            [
                'id' =>31,
                'service_economic_activity_id'=>1,
                'division_economic_activity_id'=>3,
                'group_economic_activity_id'=>17,
                'name' => '4799 - Comércio a retalho por outros métodos, não efectuado em estabelecimentos, em bancas,feiras ou unidades móveis de venda',
            ],

            [
                'id' =>32,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>4,
                'group_economic_activity_id'=>18,
                'name' => '5811 - Edição de livros, brochuras, partituras e outras publicações',
            ],

            [
                'id' =>33,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>4,
                'group_economic_activity_id'=>18,
                'name' => '5812 - Edição de listas destinadas a consulta',
            ],
            [
                'id' =>34,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>4,
                'group_economic_activity_id'=>18,
                'name' => '5813 - Edição de jornais, de revistas e de outras publicações periódicas',
            ],
            [
                'id' =>35,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>4,
                'group_economic_activity_id'=>18,
                'name' => '5819 - Outras actividades de edição',
            ],
            [
                'id' =>36,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>4,
                'group_economic_activity_id'=>19,
                'name' => '5820 - Edição de programas informáticos',
            ],

            [
                'id' =>37,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>5,
                'group_economic_activity_id'=>20,
                'name' => '6201 - Actividades de programação informática',
            ],
           
            [
                'id' =>38,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>5,
                'group_economic_activity_id'=>20,
                'name' => '6202 - Actividades de consultoria em informática, gestão e exploração de equipamento informático',
            ],

            [
                'id' =>39,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>6,
                'group_economic_activity_id'=>21,
                'name' => '6391 - Actividades de agências de notícias',
            ],
            [
                'id' =>40,
                'service_economic_activity_id'=>2,
                'division_economic_activity_id'=>6,
                'group_economic_activity_id'=>21,
                'name' => '6399 - Outras actividades de serviços de informação, n.e.',
            ],
            [
                'id' =>41,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>7,
                'group_economic_activity_id'=>22,
                'name' => '6910 - Actividades jurídicas',
            ],
            [
                'id' =>42,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>7,
                'group_economic_activity_id'=>23,
                'name' => '6920 - Actividades de contabilidade e auditoria, consultoria fiscal',
            ],
            [
                'id' =>43,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>8,
                'group_economic_activity_id'=>24,
                'name' => '7020 - Actividades de consultória para os negócios e a gestão',
            ],
            [
                'id' =>44,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>9,
                'group_economic_activity_id'=>25,
                'name' => '7110 - Actividade de arquitectura, de engenharia e ténicas afins',
            ],
            [
                'id' =>45,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>9,
                'group_economic_activity_id'=>26,
                'name' => '7120 - Actividades de ensaios e análises técnicas',
            ],
            [
                'id' =>46,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>10,
                'group_economic_activity_id'=>27,
                'name' => '7310 - Publicidade',
            ],
            [
                'id' =>47,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>10,
                'group_economic_activity_id'=>28,
                'name' => '7320 - Estudos de mercado e sondagens de opinião',
            ],
            [
                'id' =>48,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>11,
                'group_economic_activity_id'=>29,
                'name' => '7410 - Actividades de design',
            ],
            [
                'id' =>49,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>11,
                'group_economic_activity_id'=>30,
                'name' => '7420 - Actividades fotográficas',
            ],
            [
                'id' =>50,
                'service_economic_activity_id'=>3,
                'division_economic_activity_id'=>11,
                'group_economic_activity_id'=>31,
                'name' => '7490 - Outras actividades de consultoria, científicas, técnicas e similares, n.e.',
            ],

            [
                'id' =>51,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>12,
                'group_economic_activity_id'=>32,
                'name' => '7710 - Aluguer de veículos automóveis',
            ],
            [
                'id' =>52,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>12,
                'group_economic_activity_id'=>33,
                'name' => '7721 - Aluguer de bens recreativos e desportivos',
            ],
            [
                'id' =>53,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>12,
                'group_economic_activity_id'=>33,
                'name' => '7722 - Aluguer de videocassetes e discos',
            ],
            [
                'id' =>54,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>12,
                'group_economic_activity_id'=>33,
                'name' => '7729 - Aluguer de outros bens de uso pessoal e doméstico',
            ],
            [
                'id' =>55,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>12,
                'group_economic_activity_id'=>34,
                'name' => '7730 - Aluguer de outras máquinas e equipamentos (sem operador)',
            ],
            [
                'id' =>56,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>13,
                'group_economic_activity_id'=>35,
                'name' => '7810 - Actividades das empresas de selecção e colocação de pessoal',
            ],
            [
                'id' =>57,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>13,
                'group_economic_activity_id'=>36,
                'name' => '7830 - Outros fornecimento de recursos humanos',
            ],
            [
                'id' =>58,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>14,
                'group_economic_activity_id'=>37,
                'name' => '8110 - Actividades combinadas de apoio à gestão de edifícios',
            ],
            [
                'id' =>59,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>14,
                'group_economic_activity_id'=>38,
                'name' => '8121 - Actividades de limpeza geral em edifícios',
            ],
            [
                'id' =>60,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>14,
                'group_economic_activity_id'=>38,
                'name' => '8129 - Outras actividades de limpeza em edifícios e em equipamentos industriais',
            ],
            [
                'id' =>61,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>14,
                'group_economic_activity_id'=>39,
                'name' => '8130 - Actividades de plantação e manutenção de jardins',
            ],
            [
                'id' =>62,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>40,
                'name' => '8211 - Actividades combinadas de serviços administrativos',
            ],
            [
                'id' =>63,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>40,
                'name' => '8219 - Execução de fotocópias, preparação de documentos e outras actividades especializadas de apoio administrativo',
            ],
            [
                'id' =>64,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>41,
                'name' => '8220 - Actividades dos centros de chamadas',
            ],
            [
                'id' =>65,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>42,
                'name' => '8230 - Organização de feiras, congressos e outros eventos similares',
            ],
            [
                'id' =>66,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>43,
                'name' => '8291 - Actividades de cobrança e avaliação de crédito',
            ],
            [
                'id' =>67,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>43,
                'name' => '8292 - Actividades de embalagem',
            ],
            [
                'id' =>68,
                'service_economic_activity_id'=>4,
                'division_economic_activity_id'=>15,
                'group_economic_activity_id'=>43,
                'name' => '8299 - Outras actividades de serviços de apoio aos negócios, n.e.',
            ],
            [
                'id' =>69,
                'service_economic_activity_id'=>5,
                'division_economic_activity_id'=>16,
                'group_economic_activity_id'=>44,
                'name' => '8810 - Acção social para pessoas idosas e com deficiência, sem alojamento',
            ],
            [
                'id' =>70,
                'service_economic_activity_id'=>5,
                'division_economic_activity_id'=>16,
                'group_economic_activity_id'=>45,
                'name' => '8890 - Outras actividades de acção social, sem alojamento',
            ],
            [
                'id' =>71,
                'service_economic_activity_id'=>6,
                'division_economic_activity_id'=>17,
                'group_economic_activity_id'=>46,
                'name' => '9511 - Reparação de computadores e equipamento periférico',
            ],
            [
                'id' =>72,
                'service_economic_activity_id'=>6,
                'division_economic_activity_id'=>17,
                'group_economic_activity_id'=>46,
                'name' => '9512 - Reparação de equipamento de comunicação',
            ],
            [
                'id' =>73,
                'service_economic_activity_id'=>6,
                'division_economic_activity_id'=>18,
                'group_economic_activity_id'=>47,
                'name' => '9601 - Lavagem e Limpeza a seco de têxteis e peles',
            ],
            [
                'id' =>74,
                'service_economic_activity_id'=>6,
                'division_economic_activity_id'=>18,
                'group_economic_activity_id'=>47,
                'name' => '9609 - Outras actividades de serviços pessoais n.e',
            ],
            [
                'id' =>75,
                'service_economic_activity_id'=>7,
                'division_economic_activity_id'=>19,
                'group_economic_activity_id'=>48,
                'name' => '3600 - Captação, tratamento e distribuição de água',
            ],
            [
                'id' =>76,
                'service_economic_activity_id'=>7,
                'division_economic_activity_id'=>20,
                'group_economic_activity_id'=>49,
                'name' => '3700 - Recolha, drenagem e tratamento de águas residuais',
            ],
           
           ]);













        //    //FIM TABELA CLASS ECONOMICO

        //    DB::table('sub_class_economic_activities')->insert([
        //     [
        //         'id' =>1,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>1,
        //         'group_economic_activity_id'=>1,
        //         'class_economic_activity_id'=>1,
        //         'name' => 'Trimestral',
        //     ],
           
        
        //    ]);

        //    DB::table('economic_activities')->insert([
        //     [
        //         'id' =>1,
        //         'service_economic_activity_id'=>1,
        //         'division_economic_activity_id'=>1,
        //         'group_economic_activity_id'=>1,
        //         'class_economic_activity_id'=>1,
        //         'sub_class_economic_activity_id'=>1,
        //         'name' => 'Trimestral',
        //     ],
           
        
        //    ]);
    }
}
