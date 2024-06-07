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
      <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CustomerModal">
          <i class="bi bi-plus me-1"></i> Add
      </button>
  </h5>

  <!-- Table with stripped rows -->
  <table class="table datatable">
      <thead>
        <tr>
          <th>Full Name</th>
          <th>Contact Number </th>
          <th>Address</th>
          <th>Action</th>
          <!-- Add more headers as needed -->
        </tr>
      </thead>
      <tbody>
          @foreach ($CustomerData as $CustomerData)
              <tr>
                  <td>{{ $CustomerData->customer_name }}</td>
                  <td>{{ $CustomerData->contact_number }}</td>
                  <td>{{ $CustomerData->address }}</td>
                  <td> <button class="edit-btn btn btn-outline-primary btn-sm" data-id="{{ $CustomerData->id }}"> Edit </button></td>
              </tr>
          @endforeach
      </tbody>
  </table>
@endsection

<div class="modal fade" id="CustomerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form class="row g-3 needs-validation" action="{{ route('SaveCustomer') }}" method="post" novalidate="" id="SaveCustomerForm">
                        @csrf
                        <input type="hidden" id="CustomerId" name="id">
                        <div class="col-6">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" id="customer_name" required>
                            <div class="invalid-feedback">Please, enter Customer name!</div>
                        </div>
                        <div class="col-6">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="number" name="contact_number" class="form-control" id="contact_number" required>
                            <div class="invalid-feedback"> Please, enter contact number !</div>
                        </div>
                        <div class="col-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address"> </textarea>
                            <div class="invalid-feedback">Please, enter address!</div>
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
            var CustomerId = $(this).data('id');
            var baseUrl = "{{ url('/') }}";
        
            $.ajax({
                url: '{{ route("edit_customer")}}',  // URL for the edit-customer route
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),  // Add CSRF token
                    id: CustomerId
                },
                success: function(response) {
                    console.log(response);
                    
                    $('#customer_name').val(response.customer_name);
                    $('#contact_number').val(response.contact_number);
                    $('#address').val(response.address);
                    $('#CustomerId').val(CustomerId);
                    $('#CustomerModal').modal('show');
                    
                    // Change the form action to the update route
                    var baseUrl = "{{ route('UpdateCustomer',['id' => 'PLACEHOLDER']) }}";
                    var url = baseUrl.replace('PLACEHOLDER', CustomerId);

                    $('#SaveCustomerForm').attr('action', url);
                },
                error: function(response) {
                    console.log(response);
                    alert('Error occurred while fetching data');
                }
            });
        });

        // $('#SaveCustomerForm').submit(function(e) {
        //     e.preventDefault();
        //     var CustomerId = $('#CustomerId').val();
        //     var formData = new FormData(this);
        //     $.ajax({
        //         url: '/UpdateCustomer/' + CustomerId,
        //         type: 'POST',  // Using POST to update customer data
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response) {
        //             $('#CustomerModal').modal('hide');
        //             location.reload();
        //         },
        //         error: function(response) {
        //             console.log(response);
        //             alert('Error occurred while updating data');
        //         }
        //     });
        // });
    });
</script>


