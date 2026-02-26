@include('admin.layouts.header')

<div class="wrapper">

@include('admin.layouts.topbar')
@include('admin.layouts.sidebar')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">My Courses</li>
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
                                  action="{{ route('courses.update', $edit->id) }}"
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
                                               value="{{ old('title', $edit->title) }}"
                                               required>
                                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
 <!-- Thumbnail -->
    <div class="col-md-6">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">

        @if($edit->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($edit->thumbnail) }}" width="80" class="rounded">
            </div>
        @endif
    </div>
                                    <!-- Meta Key -->
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Meta Key</label>
                                        <input type="text"
                                               class="form-control"
                                               name="meta_key"
                                               value="{{ old('meta_key', $edit->meta_key) }}"
                                               required>
                                        @error('meta_key') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                </div>

                                <div class="row g-2">

                                    <!-- Description -->
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control ckeditor"
                                                  name="description">{{ old('description', $edit->description) }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Meta Description</label>
                                        <textarea class="form-control ckeditor"
                                                  name="meta_description">{{ old('meta_description', $edit->meta_description) }}</textarea>
                                        @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <!-- Is Active -->
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Is Active</label>
                                        <select class="form-control" name="is_active" required>
                                            <option value="1" {{ $edit->is_active == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $edit->is_active == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a href="{{ route('all.courses') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

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
