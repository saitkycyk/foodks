<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{

    public $cityNames = ["Prishtina","Prizren","Ferizaj","Pejë","GJakovë","Gjilan","Mitrovicë","Podujeva","Vushtrri","Suharekë","Rahovec","Drenas","Lipjan","Malishevë","Kamenicë","Viti","Deçan","Istog","Klinë","Skenderaj","Dragash","Fushë Kosovë" ,"Kaçanikë","Mitrovica Veriore","Shtime","Obiliq","Leposaviq","Graçanicë","Han i Elezit","Zveçan","Shtërpcë","Novobërdë","Zubin Potok","Junik","Mamusha","Ranillug","Kllokoti","Parteshi"];


    public function run()
    {
        foreach ($this->cityNames as $cityName) {
            $this->cityCreator($cityName);
        }
    }

    public function cityCreator($cityName)
    {        
        City::create([
            'name' => $cityName,
            'created_at' => now()
        ]);
    }
}