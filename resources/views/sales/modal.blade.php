{{-- <div class="modal fade" id="openModal{{ $sale->id }}" tabindex="-1"> --}}
  <div id="openModal{{$sale->id}}" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $sale->customer }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

      </div>
    </div>
  </div>