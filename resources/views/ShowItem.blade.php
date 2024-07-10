@extends('layouts.layout')
@section('title','ShowItems')
@section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if (session('success'))
      <div class="alert alert-success d-flex justify-content-center align-items-center">
          {{ session('success') }}
      </div>
  @endif

  @if ($errors->any())
      <div class="alert alert-danger d-flex justify-content-center align-items-center">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <h5 class="card-title">
      <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ItemModal">
          <i class="bi bi-plus me-1"></i> Add
      </button>
  </h5>

  <!-- Table with stripped rows -->
  <table class="table datatable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Plates</th>
          <th>A-H</th>
          <th>Limit</th>
          <th>Quantity</th>
          <th>Buying Price</th>
          <th>Selling Price</th>
          <th>Action</th>
          <!-- Add more headers as needed -->
        </tr>
      </thead>
      <tbody>
          @foreach ($items as $item)
              <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->plates }}</td>
                  <td>{{ $item->ah }}</td>
                  <td>{{ $item->limit }}</td>
                  <td>{{ $item->stock_quantity }}</td>
                  <td>{{ $item->buying_price }}</td>
                  <td>{{ $item->selling_price }}</td>
                  <td> <button class="edit-btn btn btn-outline-primary btn-sm" data-id="{{ $item->id }}"> Edit </button></td>
                  <!-- <td><a href="{{ route('edit-item', $item->id) }}" data-bs-toggle="modal" data-bs-target="#EditItemModal">Edit</a></td> -->
                  <!-- Add more columns as needed -->
              </tr>
          @endforeach
      </tbody>
  </table>
  <!-- End Table with stripped rows -->
<!-- Modal -->
@endsection

<div class="modal fade" id="ItemModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form class="row g-3 needs-validation" action="{{ route('SaveItem') }}" method="post" novalidate="" id="SaveItemForm">
                        @csrf
                        <input type="hidden" id="itemId" name="id">
                        <div class="col-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <div class="invalid-feedback">Please, enter Item name!</div>
                        </div>
                        <div class="col-6">
                            <label for="plates" class="form-label">Plates</label>
                            <input type="number" name="plates" class="form-control" id="plates" required>
                            <div class="invalid-feedback">Please, enter Item Plates!</div>
                        </div>
                        <div class="col-6">
                            <label for="ah" class="form-label">A-H</label>
                            <input type="number" name="ah" class="form-control" id="ah" required>
                            <div class="invalid-feedback">Please, enter A-H!</div>
                        </div>
                        <div class="col-6">
                            <label for="limit" class="form-label">Limit</label>
                            <input type="number" name="limit" class="form-control" id="limit" required>
                            <div class="invalid-feedback">Please, enter Limit!</div>
                        </div>
                        <div class="col-6">
                            <label for="buying_price" class="form-label">Buying Price</label>
                            <input type="number" name="buying_price" class="form-control" id="buying_price" required>
                            <div class="invalid-feedback">Please, enter Buying Price!</div>
                        </div>
                        <div class="col-6">
                            <label for="selling_price" class="form-label">Selling Price</label>
                            <input type="number" name="selling_price" class="form-control" id="selling_price" required>
                            <div class="invalid-feedback">Please, enter Selling Price!</div>
                        </div>
                        <div class="col-6">
                            <label for="stock_quantity" class="form-label"> Quantity </label>
                            <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" required>
                            <div class="invalid-feedback">Please, enter stock_quantity!</div>
                        </div>
                        <div class="col-12" id="div-save-button">
                          <button type="submit" class="btn btn-primary" id="SaveItemButton" style="width:200px">Save</button>
                          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.edit-btn').click(function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var baseUrl = "{{ url('/') }}";
            console.log(baseUrl ,"<><>");
            $.ajax({
                url: baseUrl+'/items/' + itemId + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#name').val(response.name);
                    $('#plates').val(response.plates);
                    $('#ah').val(response.ah);
                    $('#limit').val(response.limit);
                    $('#buying_price').val(response.buying_price);
                    $('#selling_price').val(response.selling_price);
                    $('#itemId').val(itemId);
                    $('#ItemModal').modal('show');

                    // Change the form action to the update route
                    $('#SaveItemForm').attr('action', baseUrl+'/UpdateItems/' + itemId);
                    // $('#SaveItemForm').attr('method', 'POST');
                },
                error: function(response) {
                    console.log(response);
                    alert('Error occurred while fetching data');
                }
            });
        });

        $('#editForm').submit(function(e) {
            e.preventDefault();
            var itemId = $('#itemId').val();
            var formData = new FormData(this);
            $.ajax({
                url: '/items/' + itemId,
                type: 'PUT',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#EditItemModal').modal('hide');
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                    alert('Error occurred while updating data');
                }
            });
        });
    });
</script>

