@extends('layouts.admin')
@push('styles')
    <style>
        #imagePreview {
            display: inline-block; /* Ensure the preview is inline with the form */
            margin-left: 20px; /* Optional, for some spacing between input and preview */
        }

        #previewImage {
            border: 2px solid #ddd; /* Optional, for border around the image */
            padding: 5px;
            cursor: pointer; /* Makes it clear that the image is clickable */
        }

        .upload-image {
            display: inline-block; /* Ensure the upload area and preview are aligned horizontally */
        }

    </style>
@endpush
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Slide</h3>
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
                        <a href="{{ route('admin.slides') }}">
                            <div class="text-tiny">Slides</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Slide</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.slide.update', [ 'id' => $slide->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset class="name">
                        <div class="body-title">Tagline <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Tagline" name="tagline" tabindex="0" value="{{ $slide->tagline }}" aria-required="true" required="">
                        @error('tagline')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title" name="title" tabindex="0" value="{{ $slide->title }}" aria-required="true" required="">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Subtitle <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Subtitle" name="subtitle" tabindex="0" value="{{ $slide->subtitle }}" aria-required="true" required="">
                        @error('subtitle')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Link <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Use https:// before the website" name="link" tabindex="0" value="{{ $slide->link }}" aria-required="true" required="">
                        @error('link')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <!-- Image Preview Section -->
                        <div id="imagePreview" style="display: block; margin-top: 15px; text-align: right;">
                            <img id="previewImage" src="{{ asset('uploads/slides/' . $slide->image ) }}" alt="Image Preview" style="max-width: 300px; height: auto; cursor: pointer;" onclick="triggerFileInput()"/>
                        </div>
                        <!-- Hidden File Input -->
                        <div class="upload-image flex-grow {{ $slide->image ? 'd-none' : '' }}">
                            <div class="item up-load" id="imageInput">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image">
                                </label>
                            </div>
                        </div>

                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Status</div>
                        <div class="select flex-grow">
                            <select name="status" required>
                                <option value="" disabled>Select</option>
                                <option value="1" {{ $slide->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $slide->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Update</button>
                    </div>
                </form>
            </div>
            <!-- /new-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
@push('scripts')
    <script>
        // Listen for changes in the file input
        document.getElementById('myFile').addEventListener('change', function(event) {
            // Get the selected file
            const file = event.target.files[0];

            // Check if a file is selected
            if (file) {
                const reader = new FileReader();

                // Set up the onload event to display the image
                reader.onload = function(e) {
                    // Get the image preview element and set its source
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = e.target.result;

                    // Show the preview section
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('imageInput').style.display = 'none';
                }

                // Read the file as a data URL
                reader.readAsDataURL(file);
            }
        });

        // Function to trigger the file input when the preview image is clicked
        function triggerFileInput() {
            document.getElementById('myFile').click();
        }
    </script>


@endpush
