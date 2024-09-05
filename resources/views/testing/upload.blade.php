@extends('layouts.app')
@section('title', 'Upload File')

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

                <form action="{{ route('testing.upload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file-upload" id="fileUpload1">
                        <input type="file" name="photo" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                        <label for="fileuploadInput">
                            <span>
                                <strong>
                                    <ion-icon name="arrow-up-circle-outline" role="img" class="md hydrated" aria-label="arrow up circle outline"></ion-icon>
                                    <i>Upload Photo</i>
                                </strong>
                            </span>
                        </label>

                    </div>
                    @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="form-group boxed mt-1">
                        <div class="input-wrapper">
                            <label class="label" for="text4b">Upload Document</label>
                            <input type="file" class="form-control" name="file" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx">
                        </div>

                        @error('file')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-1" id="btn-submit">Upload</button>
                </form>
            </div>
        </div>
    </div>

    @if ($testing)
    @if ($testing->photo || $testing->file)
    <div class="listview-title">Result</div>
    @endif
    <ul class="listview image-listview media inset mb-2">
        @if ($testing->photo)
        <li>
            <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#actionSheetInset">
                <div class="imageWrapper">
                    <img src="{{ Storage::url($testing->photo) }}" alt="Webview" class="imaged w64">
                </div>
                <div class="in">
                    <div>
                        {{ Str::after($testing->photo, 'testing/') }}
                        <div class="text-muted">{{ $testing->created_at }}</div>
                    </div>
                </div>
            </a>
        </li>

        <div class="modal fade action-sheet inset" id="actionSheetInset" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Action Sheet Title</h5>
                    </div>
                    <div class="modal-body">
                        <ul class="action-button-list">
                            <li>
                                <a href="{{ Storage::url($testing->photo) }}" class="btn btn-list">
                                    <span>
                                        <ion-icon name="cloud-download-outline"></ion-icon>
                                        Download
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="btn btn-list" data-bs-toggle="modal" data-bs-target="#modalPhoto" data-bs-dismiss="modal">
                                    <span>
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Delete File
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade dialogbox" id="modalPhoto" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('testing.upload.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="pt-3 text-center">
                            <img src="{{ Storage::url($testing->photo) }}" alt="Webview" class="imaged w48 rounded mb-1">
                        </div>
                        <div class="modal-body mt-2">
                            Are you sure you want to delete the photo file?
                            <input type="hidden" name="photo" value="{{ $testing->photo }}">
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                                <button type="submit" class="btn btn-text-danger">DELETE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        @if ($testing->file)
        <li>
            <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#actionSheetInset">
                <div class="imageWrapper">
                    <img src="https://thumbs.dreamstime.com/b/file-folder-icon-flat-style-illustration-vector-web-design-128273206.jpg" alt="Webview" class="imaged w64">
                </div>
                <div class="in">
                    <div>
                        {{ Str::after($testing->file, 'testing/') }}
                        <div class="text-muted">{{ $testing->created_at }}</div>
                    </div>
                </div>
            </a>
        </li>

        <div class="modal fade action-sheet inset" id="actionSheetInset" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Action Sheet Title</h5>
                    </div>
                    <div class="modal-body">
                        <ul class="action-button-list">
                            <li>
                                <a href="{{ Storage::url($testing->file) }}" class="btn btn-list">
                                    <span>
                                        <ion-icon name="cloud-download-outline"></ion-icon>
                                        Download
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="btn btn-list" data-bs-toggle="modal" data-bs-target="#modalFile" data-bs-dismiss="modal">
                                    <span>
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Delete File
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade dialogbox" id="modalFile" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('testing.upload.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="pt-3 text-center">
                            <img src="https://thumbs.dreamstime.com/b/file-folder-icon-flat-style-illustration-vector-web-design-128273206.jpg" alt="Webview" class="imaged w48 rounded mb-1">
                        </div>
                        <div class="modal-body mt-2">
                            Are you sure you want to delete the file?
                            <input type="hidden" name="file" value="{{ $testing->file }}">
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                                <button type="submit" class="btn btn-text-danger">DELETE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </ul>
    @endif
</div>
@endsection

@push('script')
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
@endpush