@extends('layouts.owner')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/leaflet.css ') }}">

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="mb-3">Edit Apartment / Boarding House Information</h3>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="bhouse_name" value="{{ $bhouse->bhouse_name }}" name="bhouse_name" placeholder="Enter">
                    <label for="bhouse_name">Name of the Bhouse/Apartment</label>
                    <span class="text-danger" id="error-bhouse_name"></span>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Description" id="bhouse_desc" name="bhouse_desc"style="height: 100px">{{ $bhouse->bhouse_desc }}</textarea>
                    <label for="bhouse_desc">Description</label>
                    <span class="text-danger" id="error-bhouse_desc"></span>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="House Rules" id="bhouse_rule" name="bhouse_rule" style="height: 100px">{{ $bhouse->bhouse_rule }}</textarea>
                    <label for="bhouse_rule">House Rules</label>
                    <span class="text-danger" id="error-bhouse_rule"></span>

                </div>
            </div>
        </div>
        <h2>Boarding House Image</h2>

        <div class="text-center">
            <img src="{{ asset('storage/bhouses/' . $bhouse->bhouse_img)  }}" class="rounded" alt="..." width="250px" height="250px">
        </div>

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="bhouse_img" class="form-label">Upload photo of your boarding house/apartment</label>
                    <input class="form-control" type="file" id="bhouse_img" name="bhouse_img">
                    <span class="text-danger" id="error-upload"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="loc_description" name="loc_description" value="{{ $bhouse->loc_descrption }}" placeholder="Location">
                    <label for="loc_description">Location Description</label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div id="mapid"></div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="loc_x" value="{{ $bhouse->loc_x }}" name="loc_x" placeholder="Location" readonly>
                    <label for="loc_x">Longitude</label>
                    <span class="text-danger" id="error-loc_x"></span>

                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="loc_y" name="loc_y" value="{{ $bhouse->loc_y }}" placeholder="Location" readonly>
                    <label for="loc_y">Latitude</label>
                    <span class="text-danger" id="error-loc_y"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" style="padding:5px 30px;" id="bhInfo">Save</button>
            </div>
        </div>

    </div> <!--container-->


<script src="{{ asset('/js/leaflet.js') }}"></script>
    {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" /> --}}
    <script>


        //init variable
        var bhouse_name = document.getElementById('bhouse_name');
        var bhouse_desc = document.getElementById('bhouse_desc');
        var bhouse_img = document.getElementById('bhouse_img');
        var bhouse_rule = document.getElementById('bhouse_rule');
        var loc_description = document.getElementById('loc_description');
        var loc_x = document.getElementById('loc_x');
        var loc_y = document.getElementById('loc_y');
        var button = document.getElementById('bhInfo');


        //initiate map
        var mymap = L.map('mapid').setView([loc_x.value,loc_y.value], 17);



        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXRpZW5uZXdheW5lIiwiYSI6ImNrcno0N29seTE2bG0yd2szOXl5OXZ0ZWsifQ.xlNi77GcJmddd9UZTz1Hpw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: ''
        }).addTo(mymap);


        var theMarker = {};

        //this will show the Location
        theMarker = L.marker([loc_x.value,loc_y.value]).addTo(mymap);

        mymap.on('click', function(e) {
            lat = e.latlng.lat;
            lon = e.latlng.lng;


            if(theMarker != undefined){
                mymap.removeLayer(theMarker);
            }

            document.getElementById('loc_x').value = e.latlng.lat;
            document.getElementById('loc_y').value = e.latlng.lng;


            theMarker = L.marker([lat,lon]).addTo(mymap);

        });

        //add marker map
        // var marker = L.marker([8.067297619942783, 123.75230669975281]).addTo(mymap);
        // marker.bindPopup("<b>PARCOTILLO APARTMENT</b><br>").openPopup();

        //data here

        function clearDataForms(){
            document.getElementById('error-bhouse_name').innerText = "";
            document.getElementById('error-bhouse_desc').innerText = "";
            document.getElementById('error-bhouse_rule').innerText = "";
            document.getElementById('error-upload').innerText = "";
            document.getElementById('error-loc_x').innerText = "";
            document.getElementById('error-loc_y').innerText = "";
        }



        button.addEventListener('click', function(){

            clearDataForms();

            var formData = new FormData();

            formData.append('bhouse_name', bhouse_name.value);
            formData.append('bhouse_desc', bhouse_desc.value);
            formData.append('bhouse_img', bhouse_img.files[0]);
            formData.append('bhouse_rule', bhouse_rule.value);
            formData.append('loc_description', loc_description.value);
            formData.append('loc_x', loc_x.value);
            formData.append('loc_y', loc_y.value);


            axios.post('/dashboard-bhouse-update/{{$bhouse->bhouse_id}}', formData).then(res=>{

                if(res.data.status === 'updated'){
                    alert('Successfully saved.');
                    window.location = "/dashboard"
                }
            });
        });
    </script>
@endsection
