@extends('layouts.app')
@section('title', 'CONTACT')

@section('content')
<div class="appHeader bg-primary">
    <div class="left"></div>
    <div class="pageTitle">
        @yield('title')
    </div>
    <div class="right"></div>
</div>

<div id="appCapsule">
    <div class="section">
        <div class="splash-page mt-5 mb-5">
            <div class="mb-3">
                <img src="assets/img/sample/qr.png" alt="QR Code" class="imaged square w140">
            </div>
            <h2 class="mb-2">Scan QR Code</h2>
            <p>
                Scan or upload this QR code using WhatsApp camera to add me to WhatsApp
            </p>
        </div>
    </div>

    <div class="section inset mt-2">
        <div class="accordion" id="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#poin01">
                        What do i get?
                    </button>
                </h2>
                <div id="poin01" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        You will get the complete file in the form of APK and AAB.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#poin02">
                        How many times revision?
                    </button>
                </h2>
                <div id="poin02" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        If there are still discrepancies regarding the assets provided, improvements can still be made.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#poin03">
                        How much does it cost?
                    </button>
                </h2>
                <div id="poin03" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        You can get it at a price of IDR 50K, Prices are subject to change at any time.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#poin04">
                        How can i buy this?
                    </button>
                </h2>
                <div id="poin04" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        You can contact me by scanning the QR code above.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection