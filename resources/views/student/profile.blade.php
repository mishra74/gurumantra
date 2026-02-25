@include('student.layouts.header')
@include('student.layouts.sidebar')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="card text-center">
                        <div class="card-body">

                            

                            <h4 class="mb-0 mt-2">{{ $profile->name }}</h4>
                            <p class="text-muted">{{ $profile->email }}</p>

                            <div class="text-start mt-3">

                                <p class="text-muted mb-2 font-13">
                                    <strong>Registration Date :</strong>
                                    <span class="ms-2">
                                        {{ $profile->created_at->format('d M Y') }}
                                    </span>
                                </p>

                                <p class="text-muted mb-2 font-13">
                                    <strong>Mobile :</strong>
                                    <span class="ms-2">
                                        {{ $profile->phone ?? 'Not Provided' }}
                                    </span>
                                </p>

                                <p class="text-muted mb-2 font-13">
                                    <strong>Available Coins :</strong>
                                    <span class="ms-2 badge bg-success">
                                        {{ $profile->coins ?? 0 }}
                                    </span>
                                </p>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Profile Edit Section -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title mb-3">Update Profile</h4>

                            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                   value="{{ $profile->name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                   value="{{ $profile->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{ $profile->phone }}">
                                </div>

                               

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        Update Profile
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@include('student.layouts.footer')
