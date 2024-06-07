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
          @foreach ($sell as $sell)
              <tr>
                  <td>{{ $sell->customer_name }}</td>
                  <td>{{ $sell->contact_number }}</td>
                  <td>{{ $sell->address }}</td>
                  <td> <button class="edit-btn btn btn-outline-primary btn-sm" data-id="{{ $sell->id }}"> Edit </button></td>
              </tr>
          @endforeach
      </tbody>
  </table>
@endsection

    <div class="modal fade" id="CustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sell</h5>
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
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="date" required>
                                <div class="invalid-feedback"> Please, enter date !</div>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label"> Select Battries </label>
                                <select name="item_id" id="item" class="form-control">
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" data-price="{{ $item->selling_price }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"> Please, enter date !</div>
                            </div>
                            <div class="col-6">
                                <label for="price" class="form-label">  Price </label>
                                <input type="number" name="price" class="form-control" id="price" required>
                                <div class="invalid-feedback"> Please, enter date !</div>
                            </div>
                            <div class="col-6">
                                <label for="discount" class="form-label">  Discount </label>
                                <input type="number" name="discount" class="form-control" id="discount" >
                            </div>
                            <div class="col-6">
                                <label for="payment_type" class="form-label">  Payment Type </label>
                                <select name="payment_type" id="payment_type" class="form-control">
                                    <option value="">Select Payment Type</option>
                                    <option value="cash">Cash</option>
                                    <option value="check">Check</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>

                            <div class="col-6" id="account_number_field" style="display: none;">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" name="account_number" id="account_number" class="form-control" required>
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

        $('#item').change(function() {
            var selectedPrice = $(this).find(':selected').data('price');
            $('#price').val(selectedPrice);
        });

        $('#payment_type').change(function() {
            if ($(this).val() === 'online') {
                $('#account_number_field').show();
                $('#account_number').attr('required', true); // Make it required
            } else {
                $('#account_number_field').hide();
                $('#account_number').attr('required', false); // Remove required attribute
            }
        });

        $('.edit-btn').click(function(e) {

            e.preventDefault();
            var CustomerId = $(this).data('id');
            var baseUrl = "{{ url('/') }}";

            $.ajax({
                url: baseUrl +'/Customer/edit-customer',  // URL for the edit-customer route
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),  // Add CSRF token
                    id: CustomerId
                },
                success: function(response) {
                    $('#customer_name').val(response.name);
                    $('#contact_number').val(response.plates);
                    $('#address').val(response.ah);
                    $('#CustomerId').val(CustomerId);
                    $('#CustomerModal').modal('show');

                    // Change the form action to the update route
                    $('#SaveCustomerForm').attr('action', '/UpdateCustomer/' + CustomerId);
                },
                error: function(response) {
                    console.log(response);
                    alert('Error occurred while fetching data');
                }
            });
        });

        $('#SaveCustomerForm').submit(function(e) {
            e.preventDefault();
            var CustomerId = $('#vustomer.index').val();
            var formData = new FormData(this);
            $.ajax({
                url: '/UpdateCustomer/' + CustomerId,
                type: 'POST',  // Using POST to update customer data
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#CustomerModal').modal('hide');
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


