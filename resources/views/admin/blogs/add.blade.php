
       
       <!-- Begin page -->
       @include('admin.layouts.header')

        <div class="wrapper">

        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">All Notes</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Notes</a></li>
                                            <li class="breadcrumb-item active">{{$page}}</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{$page}}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        

                        <!-- final Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">{{$page}}</h4>
                                       

                                        <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">

        <!-- Category -->
        <div class="col-md-6">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" id="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Sub Category -->
        <div class="col-md-6">
            <label class="form-label">Sub Category</label>
            <select name="sub_category_id" class="form-control" id="sub_category_id">
                <option value="">Select Sub Category</option>
               
            </select>
            @error('sub_category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Title -->
        <div class="col-md-6">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title') }}" placeholder="Enter Title" id="title" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Slug -->
        <div class="col-md-6">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control"
                   value="{{ old('slug') }}" placeholder="Enter Slug" id="slug" required>
            @error('slug')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Thumbnail -->
        <div class="col-md-6">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control"
                   accept=".jpg,.jpeg,.png">
            @error('thumbnail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Meta Key -->
        <div class="col-md-6">
            <label class="form-label">Meta Key</label>
            <input type="text" name="meta_key" class="form-control"
                   value="{{ old('meta_key') }}" placeholder="Enter Meta Keywords">
            @error('meta_key')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Contents -->
        <div class="col-md-12">
            <label class="form-label">Contents</label>
            <textarea name="contents" class="form-control ckeditor"
                      rows="5">{{ old('contents') }}</textarea>
            @error('contents')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Add Note</button>
    </div>
</form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

             
                

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        
        <script>
            document.getElementById('title').addEventListener('input', function() {
                let title = this.value;
                let slug = title.toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                    .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens
                document.getElementById('slug').value = slug;
            });
        </script>
        <script>
            document.getElementById('category_id').addEventListener('change', function() {
                let categoryId = this.value;
                fetch(`/admin/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        let subCategorySelect = document.getElementById('sub_category_id');
                        subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';
                        data.forEach(sub => {
                            let option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.title;
                            subCategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            });
        </script>
        @include('admin.layouts.footer')

       