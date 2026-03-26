@extends('layouts.master')
@section('content')
   <!-- NAVBAR -->
<nav class="navbar bg-white shadow-sm py-3 mb-4">
  <div class="container d-flex justify-content-between align-items-center">
     <a href="{{ route('home') }}" class="text-decoration-none text-orange fw-bold">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <h4 class="fw-800 mb-0">My Classes</h4>
  </div>
</nav>

<!-- CONTENT -->
<div class="container pb-5">

  <h3 class="fw-800 mb-4">
    List of <span style="color:#ff6a00">Centers</span>
  </h3>

 
                <div class="row g-4">

@foreach($zones as $zone)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="zone-card bg-white p-3 shadow-sm text-center"
             data-id="{{ $zone->id }}"
             style="cursor:pointer;">
        <img src="{{ asset($zone->thumbnail??'frontend/images/logo.png') }}" class="course-thumb mb-3">

            <h6 class="fw-bold">{{ $zone->title }}</h6>
        </div>
    </div>
@endforeach

</div>
<!-- Centers Modal -->
<div class="modal fade" id="centersModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Centers List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3" id="centersContainer">
            <!-- Centers will load here -->
        </div>
      </div>

    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    $(document).on('click', '.zone-card', function(){

        let zoneId = $(this).data('id');

        if(zoneId != ''){
            $.ajax({
                url: '/centers/' + zoneId,
                type: 'GET',
                success: function(response){

                    let html = '';

                    if(response.centers.length > 0){
                        response.centers.forEach(function(center){

                            let image = center.thumbnail 
                                ? center.thumbnail 
                                : '/frontend/images/logo.png';

                           html += `
    <div class="col-md-4">
        <div class="course-card bg-white p-3 shadow-sm h-100">

            <img src="${image}" class="course-thumb mb-2">

            <h6 class="fw-bold">${center.title}</h6>

            <div class="course-desc">

                <div class="short-desc">
                    ${truncateText(center.description, 100)}
                </div>

                <div class="full-desc d-none">
                    ${center.description}
                </div>

                <a href="javascript:void(0)" 
                   class="toggle-btn text-primary">
                   Read More
                </a>

            </div>

            <a href="/offline/mocktest/volume/${center.id}" 
               class="btn btn-orange w-100 mt-2">
                Continue
            </a>

        </div>
    </div>
`;
                        });
                    } else {
                        html = '<p class="text-center">No Centers Found</p>';
                    }

                    $('#centersContainer').html(html);
                    $('#centersModal').modal('show');
                }
            });
        }

    });

});

</script>
<script>
function truncateText(text, limit) {
    let div = document.createElement("div");
    div.innerHTML = text; // remove HTML tags
    let cleanText = div.textContent || div.innerText || "";

    if (cleanText.length > limit) {
        return cleanText.substring(0, limit) + "...";
    }
    return cleanText;
}
</script>

@endsection    