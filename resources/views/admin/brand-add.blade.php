@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand Information</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands') }}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Brand</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand name" name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required>
                    </fieldset>
                    @error('name')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Brand Description <span class="tf-color-1">*</span></div>
                        <textarea class="flex-grow" placeholder="Brand description" name="description" rows="4" aria-required="true">{{ old('description') }}</textarea>
                    </fieldset>
                    @error('description')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug" tabindex="0" value="{{ old('slug') }}" aria-required="true">
                    </fieldset>
                    @error('slug')
                    <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset>
                        <div class="body-title">Upload Brand Image <span class="tf-color-1">*</span></div>
                        <div class="upload-container">
                            <div class="upload-preview" id="imagePreview">
                                <img id="previewImage" src="" alt="No Image Selected" style="display: none;">
                                <div class="no-preview cursor-pointer" id="noPreviewText">
                                    No image selected</div>
                            </div>
                            <div class="upload-controls">
                                <label for="imageUpload" class="upload-button">
                                    <i class="icon-upload-cloud"></i> Select Image
                                </label>
                                <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;">
                                <div id="fileInfo" style="margin-top: 10px; display: none;">
                                    <strong>File:</strong> <span id="fileName"></span>
                                    <a id="filePreviewLink" href="#" target="_blank" style="margin-left: 10px; color: #007bff; text-decoration: none;">Preview</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .upload-container {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-top: 10px;
        }

        .upload-preview {
            width: 200px;
            height: 200px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .upload-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-controls {
            flex-grow: 1;
        }

        .upload-button {
            background-color: #007bff;
            font-size: 14px;
            color: #fff;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }

        .upload-button:hover {
            background-color: #0056b3;
        }

        .no-preview {
            color: #999;
            font-size: 16px;
            padding: 80px 20px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById("imageUpload");
            const fileNameSpan = document.getElementById("fileName");
            const filePreviewLink = document.getElementById("filePreviewLink");
            const fileInfo = document.getElementById("fileInfo");
            const imagePreview = document.getElementById("imagePreview");
            const previewImage = document.getElementById("previewImage");
            const noPreviewText = document.getElementById("noPreviewText");

            // Make "No image selected" area clickable to open file input dialog
            noPreviewText.addEventListener("click", function () {
                fileInput.click();
            });

            fileInput.addEventListener("change", function () {
                const file = fileInput.files[0];
                if (file) {
                    // Display file name
                    fileNameSpan.textContent = file.name;
                    fileInfo.style.display = "block";
                    fileInfo.style.fontSize = "16px";

                    // Create a link to preview the file
                    const fileURL = URL.createObjectURL(file);
                    filePreviewLink.href = fileURL;

                    // Show the image preview
                    previewImage.src = fileURL;
                    previewImage.style.display = "block";
                    noPreviewText.style.display = "none";
                } else {
                    fileInfo.style.display = "none";
                    previewImage.style.display = "none";
                    noPreviewText.style.display = "block";
                }
            });
        });
    </script>
@endpush
