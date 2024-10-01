@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Upload your files</h5>
                </div>

                <div class="card-body p-3">
                     <!-- Title Input Field -->
                     <input class="form-control my-2" type="text" id="titleId" placeholder="Enter file title" required>
                     <!-- File Input Field -->
                    <input class="form-control my-2" type="file" name="" id="fileId">
                    <!-- button -->
                    <button onclick="onUpload()" class="btn btn-primary" id="uploadBtnId">Upload</button>
                    <h2 id="uploadPercentage"></h2>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection