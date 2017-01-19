<?php

use Illuminate\Database\Seeder;

class DonorSeed extends Seeder
{
    protected $source = [
        'http://www.envylook.dk/' => ['nyheder', 'overdele', 'underdele', 'kjoler', 'sko', 'accessories', 'udsalg'],
        'http://online-mode.dk/' => [
            'nyheder',
            'plus-size/kjoler',
            'plus-size/overdele',
            'plus-size/underdele',
            'toj/kjoler/strikkjoler',
            'toj/kjoler/festkjoler',
            'toj/kjoler/aftenkjoler',
            'toj/kjoler/lange-kjoler',
            'toj/overdele/toppe',
            'toj/overdele/bluser',
            'toj/overdele/tunika',
            'toj/overdele/cardigans',
            'toj/overdele/jakker',
            'toj/underdele/leggins',
            'toj/underdele/jeans',
            'toj/underdele/nederdele',
            'toj/underdele/overalls',
            'toj/tilbehor/nylonstromper',
            'toj/tilbehor/badetoj',
            'toj/tilbehor/lingeri-undertoj',
            'sko-stovler/stovle/ankelstovler',
            'sko-stovler/stovle/stovler',
            'sko-stovler/hoje-sko/pumps',
            'sko-stovler/hoje-sko/stiletter',
            'sko-stovler/flade-sko/sandaler',
            'sko-stovler/flade-sko/sneakers',
            'accessories/acc-tilbehor/tasker',
            'accessories/acc-tilbehor/balter',
            'accessories/acc-tilbehor/torklader',
            'accessories/acc-tilbehor/huer-handsker',
            'accessories/acc-tilbehor/solbriller',
            'accessories/smykker/armband',
            'accessories/smykker/halskaeder',
            'udsalg'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->source as $site => $categories) {

            foreach ($categories as $category) {
                \App\Donor::create(['url' => $site . $category]);
            }
        }
    }
}
