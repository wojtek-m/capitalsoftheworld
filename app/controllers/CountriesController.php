<?php

class CountriesController extends BaseController {
        
    /*
    |--------------------------------------------------
    | Display a list of countries on a given continent
    |--------------------------------------------------
    */
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

            // if given continent recognised, query database, else return 404 error
            if (!$code = $country_names[strtolower($continent)]) {
                return App::abort(404);
            } else {
                $countries = Country::where('continent', '=', $code)->orderBy('countryName')->get();
            }
            
            // if successful render a view
            if($countries->count()) {

                return View::make('countries.countries', array('countries' => $countries))
                    ->with('continent', $continent)
                    ->with('title', $continent . ' | ')
                    ->with('description', 'A list of countries in ' . $continent);

            } else {
                // if failed return 404
                return App::abort(404);
            }     
    }

    /*
    |--------------------------------------------------
    | Display a profile page of a given country
    |--------------------------------------------------
    */
    public function country($country) {
    
        // check if given country exist
        $country = Country::where('countryName', '=', $country)->get();

        // if successful render a view
        if($country->count()) {

            // Flickr images
            $flickering = App::make('flickering');
            $flickering->handshake('ade52786b574ca2ddbf8b58a0ce7299b', '25654303463a1f1e');
            $search_query = $country[0]->countryName;

            $results = Flickering::callMethod('photos.search', array(
                                                                    'text' => $search_query,
                                                                    'tags' => $search_query, 
                                                                    'extras' => 'url_m',
                                                                    'orientation' => 'landscape', 
                                                                    'sort' => 'relevance'
                                                                    ));
            $photos = $results->getResults('photo');
            $photo_size = sizeof($photos);

            // In case there is less than 10 images returned from Flickr
            if ($photo_size > 10) {
                $photo_index = 10;
            } else {
                $photo_index = $photo_size;
            }

            // Add Flickr photos information to the session
            Session::put('photos', $photos);
            Session::put('photo_index', $photo_index);

            // Render view
            return View::make('countries.country', array(
                                        'country' => $country,
                                        'title' => $country[0]->countryName . ' | ', // Title for the page
                                        'description' => 'Some basic information, map and photograps depicting ' . $country[0]->countryName,
                                        'photos' => Session::get('photos'),
                                        'photo_index' => Session::get('photo_index')
                                        ))->with('country', $country);
                
        // if given country does not exist in the database return 404
        } else {
            return App::abort(404);
        }             
    }
}
