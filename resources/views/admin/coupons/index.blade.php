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

                                <a href="{{ route('add.coupon') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add Coupon
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Coupon Code</th>
                                                <th>Discount</th>
                                                <th>Minimum Price</th>
                                                <th>Class Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($coupons as $key => $coupon)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $coupon->name }}</td>

                                                    <td>
                                                        <span class="badge bg-info">
                                                            {{ $coupon->coupon_code }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        {{ $coupon->discount_type == 'percentage'
                                                            ? $coupon->value . '%'
                                                            : '₹' . $coupon->value }}
                                                    </td>

                                                    <td>₹ {{ $coupon->minimum_price ?? '-' }}</td>

                                                    <td>
   {{ $coupon->class_type}}
</td>

                                                    <td>
                                                        <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        {{ $coupon->created_at->format('d-m-Y') }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ url('admin/coupon/edit/'.$coupon->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>

                                                        <a href="{{ url('admin/coupon/delete/'.$coupon->id) }}"
                                                           onclick="return confirm('Delete this coupon?')">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>

                                                        <a href="{{ url('admin/coupon/toggle/'.$coupon->id) }}">
                                                            <i class="fa {{ $coupon->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $coupons->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
