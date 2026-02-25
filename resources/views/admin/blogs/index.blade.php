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

                                <!-- Add Button -->
                                <a href="{{ route('add.blog') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th width="140">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($blogs as $key => $note)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <!-- Thumbnail -->
                                                    <td>
                                                        @if($note->thumbnail)
                                                            <img src="{{ asset($note->thumbnail) }}"
                                                                 width="60"
                                                                 height="60"
                                                                 class="rounded">
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    <!-- Title -->
                                                    <td>{{ $note->title }}</td>

                                                    <!-- Category -->
                                                    <td>{{ $note->category->title ?? '-' }}</td>

                                                    <!-- Sub Category -->
                                                    <td>{{ $note->subCategory->title ?? '-' }}</td>

                                                    <!-- Status -->
                                                    <td>
                                                        <span class="badge {{ $note->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $note->status == 1 ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>

                                                    <!-- Created -->
                                                    <td>{{ $note->created_at->format('d M Y') }}</td>

                                                    <!-- Action -->
                                                    <td>
                                                        <a href="{{ route('blog.edit', $note->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>

                                                        <a href="{{ route('blog.delete', $note->id) }}"
                                                           onclick="return confirm('Are you sure you want to delete this note?')">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>

                                                        <i class="fa fa-eye text-primary"
                                                           style="cursor:pointer"
                                                           data-content="{!! htmlspecialchars($note->contents, ENT_QUOTES, 'UTF-8') !!}"
                                                           onclick="previewContent(this)">
                                                        </i>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        No Notes Found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Content Preview Modal -->
<div class="modal fade" id="contentModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Content Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="previewContentArea"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

<script>
function previewContent(el) {
    let content = el.getAttribute('data-content');
    document.getElementById('previewContentArea').innerHTML = content;

    let modal = new bootstrap.Modal(document.getElementById('contentModal'));
    modal.show();
}
</script>

@include('admin.layouts.footer')