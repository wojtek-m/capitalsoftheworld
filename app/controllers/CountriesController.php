<?php

class CountriesController extends BaseController {
        

        // TEST display of a list of countries in a continent

        public function countries_list() {
                $european_countries = Country::where('continent', '=', 'EU')->get();

                //var_dump($european_countries);

                return View::make('quizz.quizz', 
                    array(
                        'countries' => $european_countries,
                        'continent' => 'Europe'
                    )
                );
        }

        
        public function continent($continent) {
                
                // translate user friendly continent names to consistent codes
                $country_names = array(
                        'africa'            => 'AF',
                        'antarctica'        => 'AN',
                        'asia'              => 'AS',
                        'europe'            => 'EU',
                        'north-america'     => 'NA',
                        'northamerica'      => 'NA',
                        'america'           => 'NA',
                        'oceania'           => 'OC',
                        'south-america'     => 'SA',
                        'southamerica'      => 'SA',
                );

                // use the code to search the database
                // !!!!!!!!!! BUGGGY !!!!!!! need to escape the Undefined index: error or reimplement with stripping and strtolower 
                // for both user input and the continent name in the database

                if (!$code = $country_names[strtolower($continent)]) {
                    return App::abort(404);
                } else {
                    $countries = Country::where('continent', '=', $code)->get();
                }
                
                //$countries = Country::where(strtolower(str_replace(' ', '', ('continentName'))), '=', strtolower(str_replace('-', '', $continent)))->get();
                //$test1 = strtolower(str_replace(' ', '', ('')));
                //$test2 = strtolower(str_replace('-', '', ('south-America')));
                //var_dump($test1);
                //var_dump($test2);
                //var_dump($countries);

                // if successful render a view
                if($countries->count()) {

                    return View::make('countries.countries', array('countries' => $countries))
                        ->with('continent', $continent);
                } else {
                    // if failed return 404
                    return App::abort(404);
                }

                
        }

}
