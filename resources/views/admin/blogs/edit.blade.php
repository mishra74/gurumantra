@include('admin.layouts.header')

<div class="wrapper">

@include('admin.layouts.topbar')
@include('admin.layouts.sidebar')

<div class="content-page">
<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

<h4 class="header-title">{{ $page }}</h4>

<form method="POST" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

<div class="row g-3">

    <!-- Category -->
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" id="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Sub Category -->
    <div class="col-md-6">
        <label class="form-label">Sub Category</label>
        <select name="sub_category_id" class="form-control" id="sub_category_id" required>
            <option value="">Select Sub Category</option>
            @foreach($subcategories as $sub)
                <option value="{{ $sub->id }}"
                    {{ old('sub_category_id', $blog->sub_category_id) == $sub->id ? 'selected' : '' }}>
                    {{ $sub->title }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Title -->
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input type="text"
               name="title"
               class="form-control"
               value="{{ old('title', $blog->title) }}"
               id="title"
               required>
    </div>

    <!-- Slug -->
    <div class="col-md-6">
        <label class="form-label">Slug</label>
        <input type="text"
               name="slug"
               class="form-control"
               value="{{ old('slug', $blog->slug) }}"
               id="slug"
               required>
    </div>

    <!-- Thumbnail -->
    <div class="col-md-6">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">

        @if($blog->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($blog->thumbnail) }}" width="80" class="rounded">
            </div>
        @endif
    </div>

    <!-- Meta Key -->
    <div class="col-md-6">
        <label class="form-label">Meta Key</label>
        <input type="text"
               name="mata_key"
               class="form-control"
               value="{{ old('mata_key', $blog->mata_key) }}">
    </div>

    <!-- Status -->
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status', $blog->status) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $blog->status) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <!-- Contents -->
    <div class="col-md-12">
        <label class="form-label">Contents</label>
        <textarea name="contents" class="form-control ckeditor" rows="5">
            {{ old('contents', $blog->contents) }}
        </textarea>
    </div>

</div>

<div class="mt-3">
    <button type="submit" class="btn btn-success">Update Blog</button>
</div>

</form>

</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<!-- Auto Slug -->
<script>
document.getElementById('title').addEventListener('input', function() {
    let title = this.value;
    let slug = title.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
});
</script>

@include('admin.layouts.footer')