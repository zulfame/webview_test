@extends('layouts.app')
@section('title', 'Webcam')

@section('content')
<div class="appHeader bg-primary">
    <div class="left">
        <a href="/" class="headerButton goBack text-white">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        @yield('title')
    </div>
    <div class="right"></div>
</div>

<div id="appCapsule">
    <div class="section mt-2 mb-2">
        <form action="{{ route('testing.webcam.post') }}" method="POST" id="formfoto" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="photo" value="" id="photos" required>
                    <div class="webcam-capture"></div>

                    @if ($testing)
                    @if ($testing->camera)
                    <a href="#" class="item btn btn-success btn-block mt-1" data-bs-toggle="modal" data-bs-target="#DialogImage">
                        Show Result
                    </a>

                    <div class="modal fade dialogbox" id="DialogImage" data-bs-backdrop="static" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <img src="{{ Storage::url($testing->camera) }}" alt="image" class="img-fluid">
                                <div class="modal-footer">
                                    <div class="btn-inline">
                                        <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                                        <a href="#" class="btn btn-text-primary" data-bs-dismiss="modal">DONE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <div>
                        <input type="text" id="lokasi" style="display: none;" />
                        <div id="map"></div>
                    </div>

                    <div class="form-group boxed">
                        <input type="text" class="form-control" name="latitude" id="latitude" readonly>
                        <input type="text" class="form-control mt-1" name="longitude" id="longitude" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-1" id="btn-submit">Take Photo</button>
                </div>
            </div>
        </form>


    </div>
</div>

</div>
@endsection

@push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 5px;

    }

    #map {
        height: 200px;
    }
</style>
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('btn-submit');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            submitButton.textContent = 'Processing';
        });
    });
</script>

<script>
    Webcam.set({
        height: 480,
        width: 480,
        image_format: 'jpeg',
        jpeg_quality: 80
    });

    Webcam.attach('.webcam-capture');

    $('#btn-submit').click(function(e) {
        e.preventDefault();

        Webcam.snap(function(uri) {
            $('#photos').val(uri)
            $('#formfoto')[0].submit();
        });
    })
</script>

<script>
    var latitudeInput = document.getElementById('latitude');
    var longitudeInput = document.getElementById('longitude');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        alert('Geolocation is not supported by this browser.');
    }

    function successCallback(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        latitudeInput.value = latitude;
        longitudeInput.value = longitude;

        var map = L.map('map').setView([latitude, longitude], 18);

        L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Your Location')
            .openPopup();

        var circle = L.circle([latitude, longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 20
            }).addTo(map)
            .bindPopup('Kantor Location');
    }

    function errorCallback(error) {
        console.error(error);
        alert('Error getting location: ' + error.message);
    }

    $('#btn-submit').click(function(e) {
        e.preventDefault();

        Webcam.snap(function(uri) {
            $('#photos').val(uri)
            $('#formfoto')[0].submit();
        });
    })
</script>
@endpush