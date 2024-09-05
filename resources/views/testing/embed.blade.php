@extends('layouts.app')
@section('title', 'Media Embed')

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
    <div class="section mt-2 mb-1">
        <div class="card">
            <div class="card-body">
                <iframe width="100%" height="200" src="https://www.youtube.com/embed/lxviLXXvs3A?si=0ti_5Mo4_0pTO4PP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="border-radius: 5px;"></iframe>
            </div>
        </div>
    </div>

    <div class="section mt-2 mb-1">
        <div class="card">
            <div class="card-body">
                <figure style="margin: 0;">
                    <audio controls src="{{ asset('assets/mp3/untungnya.mp3') }}" style="width:100%;"></audio>
                </figure>
            </div>
        </div>
    </div>

    <div class="section mt-2 mb-1">
        <div class="card">
            <div class="card-body">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.4552249304584!2d107.80724567559948!3d-6.463868793527753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6939fa2e7c7a89%3A0x1d6fdda45e5770d3!2sTOP%20PUTRA%20RESIDENCE!5e0!3m2!1sen!2sid!4v1725523444678!5m2!1sen!2sid" width="100%" height="200" style="border-radius: 5px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection