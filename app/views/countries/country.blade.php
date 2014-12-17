@extends('layout.main')

@section('content')

    <div class="row-fluid">
        <div class="col-md-12 col-lg-10 well bs-component">
            <div class="container margin-bottom-25">
                
                <div class="margin-bottom-25 col-xs-12">
                    <div class="md-col-12"><h1>{{ $country[0]->countryName }}</h1></div>
                    <div class="col-md-7">
                        {{ str_replace('@en', '', $country[0]->comment) }}
                    </div>
                    <div class="col-md-3">
                        <img class="flag" src="{{ $country[0]->flag }}?width=200" alt="{{ $country[0]->countryName }} flag">
                    </div>  
                </div>
            </div>
            
            <div role="tabpanel" class="margin-left-25">
                <!-- Tab navigation buttons -->
                <ul class="nav nav-tabs margin-bottom-25" role="tablist">
                    <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Basic Information & Map</a></li>
                    <li role="presentation"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                    <li role="presentation"><a href="#flag" aria-controls="flag" role="tab" data-toggle="tab">Flag</a></li>
                    <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a></li>
                </ul>

                <!-- Tab data panels -->
                <div class="tab-content">
                    <!-- Info & Map Box -->
                    <div role="tabpanel" class="tab-pane active padding-20" id="info">
                        <div class="row">
                            <div class="col-xs-12 col-md-4 margin-left-25">
                                <p>The capital of {{ $country[0]->countryName }} is <strong>{{ $country[0]->capital }}</strong>.</p>
                                <p>Continent: <strong>{{ $country[0]->continentName }}</strong></p>
                                <p>Population: <strong>{{ number_format($country[0]->population) }}</strong></p>
                                <p>Area: <strong>{{ number_format($country[0]->areaInSqKm) }} km<sup>2</sup></strong></p>
                                <p>Country code: <strong>{{ $country[0]->countryCode }}</strong></p>
                                <p>Currency code: <strong>{{ $country[0]->currencyCode }}</strong></p>
                            </div>

                            <div class="col-xs-12 col-md-4 margin-left-25">
                                <p><a href="http://en.wikipedia.org/wiki/List_of_countries_by_GDP_%28PPP%29">GDP</a> PPP per Capita: <strong>${{ number_format($country[0]->gdpPerCapita) }}</strong></p>
                                <p>GDP PPP world rank: <strong>{{ $country[0]->gdpPppPerCapitaRank }}</strong></p>
                                <p><a href="http://en.wikipedia.org/wiki/Human_Development_Index">HDI</a> world rank ({{ $country[0]->hdiYear }}): <strong>{{ $country[0]->hdiRank }}</strong></p>
                            </div>
                            <div class="col-xs-12 margin-left-25">
                                <h5 class="margin-bottom-25">Your can learn more about {{ $country[0]->countryName }} from {{ HTML::link($country[0]->homepage, 'Wikipedia') }}.</a></h5>
                                <h4>A map of {{ $country[0]->countryName }}</h4>
                                <div>
                                    <iframe
                                          width="700"
                                          height="450"
                                          frameborder="0" style="border:0"
                                          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAHojkOAAGKk3v9KeHvK2BP4JR-liCt4Pw&q={{ $country[0]->countryName }}">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        $('#info a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')
                        })
                    </script>

                    <!-- Long Description -->
                    <div role="tabpanel" class="tab-pane margin-left-25" id="description"><p>{{ str_replace('@en', '', $country[0]->description) }}</p></div>

                    <script>
                        $('#description a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')
                        })
                    </script>

                    <!-- Flag -->
                    <div role="tabpanel" class="tab-pane margin-left-25" id="flag">
                        <img class="flag" src="{{ $country[0]->flag }}?width=600" alt="{{ $country[0]->countryName }} flag" />
                        <p><small>Flag image source: <a href="{{ $country[0]->flag }}">Wikimedia</a></small></p>
                    
                    </div>

                    <script>
                        $('#flag a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')
                        })
                    </script>

                    <!-- Flickr photo slides -->
                    <div role="tabpanel" class="tab-pane" id="photos">
                        <div class="photo margin-bottom-25">     
                            <div id="PhotoSlider" maxheight="500">
                                <ul class="rslides">
                                    @for ($i = 0; $i < $photo_index; $i++)
                                        <li><img {{ 'src="' . $photos[$i]['url_m'] . '"' }} {{ 'alt="' . $photos[$i]['title'] . '"' }}></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <p><small>The presented photographs come from <a href="http://www.flickr.com">Flickr</a></small></p>  
                    </div>

                    <script>
                        $('#photos a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')
                        })
                    </script>

                </div>

                
            </div>
            


        </div>
    </div>

<script>
    $(function() {
        $(".rslides").responsiveSlides({
            maxwidth: "800",
            //prevText: "Previous",
            //nextText: "Next",
            //nav: true,
        });
    });
</script>

@stop