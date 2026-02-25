<!-- Begin page -->
@include('admin.layouts.header')

<div class="wrapper">
    @include('admin.layouts.topbar')
    @include('admin.layouts.sidebar')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- Page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">My Courses</li>
                                    <li class="breadcrumb-item">Edit Courses</li>
                                    <li class="breadcrumb-item active">{{ $page }}</li>
                                </ol>
                            </div>
                            <h4 class="page-title">{{ $page }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ $page }}</h4>

                                <form method="POST"
                                      action="{{ route('class.update', $class->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-2">
                                        <!-- Title -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="title"
                                                   value="{{ old('title', $class->title) }}"
                                                   required>
                                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <!-- Time -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Time</label>
                                            <input type="time"
                                                   class="form-control"
                                                   name="time"
                                                   value="{{ old('time', $class->time) }}"
                                                   required>
                                            @error('time') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <!-- Start Date -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Class Start Date</label>
                                            <input type="date"
                                                   class="form-control"
                                                   name="start_date"
                                                   value="{{ old('start_date', $class->start_date) }}"
                                                   required>
                                            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <!-- Batches -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Select Batches</label>
                                            <select class="form-control select2"
                                                    name="batches[]"
                                                    multiple
                                                    required>
                                                @php
    $selectedBatches = old(
        'batches',
        json_decode($class->batches, true) ?? []
    );
@endphp

@foreach($batches as $batch)
    <option value="{{ $batch->id }}"
        {{ in_array($batch->id, $selectedBatches) ? 'selected' : '' }}>
        {{ $batch->title }}
    </option>
@endforeach

                                            </select>
                                            @error('batches') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <!-- Meta Key -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Meta Key</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="meta_key"
                                                   value="{{ old('meta_key', $class->meta_key) }}"
                                                   required>
                                            @error('meta_key') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <!-- Description -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control ckeditor"
                                                      name="description">{{ old('description', $class->description) }}</textarea>
                                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <!-- Meta Description -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Meta Description</label>
                                            <textarea class="form-control ckeditor"
                                                      name="meta_description">{{ old('meta_description', $class->meta_description) }}</textarea>
                                            @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-control" name="is_active" required>
                                                <option value="1" {{ $class->is_active == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ $class->is_active == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
