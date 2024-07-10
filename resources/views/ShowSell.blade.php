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
    <button type="button" class="btn btn-outline-primary btn-sm" >
        {{-- <i class="bi bi-plus me-1"></i> Add Sell--}}
         <a href="{{ route('AddSell') }}"> Add Sell </a>
    </button>
</h5>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Contact Number </th>
        <th>Payment Type</th>
        {{-- <th>Action</th> --}}
      </tr>
    </thead>
    <tbody>
        @foreach ($sell as $sell)
            <tr>
                <td>{{ $sell->customer_name }}</td>
                <td>{{ $sell->contact_number }}</td>
                <td>{{ $sell->payment_type }}</td>
                {{-- <td> <button class="edit-btn btn btn-outline-primary btn-sm" data-id="{{ $sell->id }}"> Edit </button></td> --}}
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
                        <div class="col-12">
                            <label for="items" class="form-label">Items</label>
                            <table class="table" id="itemsTable">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="item_id[]" class="form-control item-select">
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}" data-price="{{ $item->selling_price }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="price[]" class="form-control item-price" readonly></td>
                                        <td><input type="number" name="quantity[]" class="form-control item-quantity" value="1" min="1"></td>
                                        <td><input type="number" name="total[]" class="form-control item-total" readonly></td>
                                        <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="addRow">Add Row</button>
                        </div>
                        <div class="col-6">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="number" name="discount" class="form-control" id="discount">
                        </div>
                        <div class="col-6">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select name="payment_type" id="payment_type" class="form-control">
                                <option value="">Select Payment Type</option>
                                <option value="cash">Cash</option>
                                <option value="check">Check</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                        <div class="col-6" id="account_number_field" style="display: none;">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" name="account_number" id="account_number" class="form-control">
                        </div>
                        <div class="col-12" id="div-save-button">
                            <button type="submit" class="btn btn-primary" id="SaveItemButton" style="width:200px">Save</button>
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


        function updateTotal() {
            $('#itemsTable tbody tr').each(function() {
                var price = $(this).find('.item-select option:selected').data('price');
                var quantity = $(this).find('.item-quantity').val();
                var total = price * quantity;
                $(this).find('.item-price').val(price);
                $(this).find('.item-total').val(total);
            });
        }

        $('#addRow').click(function() {
            var newRow = $('#itemsTable tbody tr:first').clone();
            newRow.find('input').val('');
            newRow.find('.item-quantity').val(1);
            $('#itemsTable tbody').append(newRow);
        });

        $('#itemsTable').on('change', '.item-select', function() {
            updateTotal();
        });

        $('#itemsTable').on('input', '.item-quantity', function() {
            updateTotal();
        });


        $('#itemsTable').on('click', '.remove-row', function() {
            if ($('#itemsTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('You must have at least one item.');
            }
            updateTotal();
        });


        $('#payment_type').change(function() {
            if ($(this).val() === 'online') {
                $('#account_number_field').show();
                $('#account_number').attr('required', true);
            } else {
                $('#account_number_field').hide();
                $('#account_number').attr('required', false);
            }
        });
        // $('#item').change(function() {
        //     var selectedPrice = $(this).find(':selected').data('price');
        //     $('#price').val(selectedPrice);
        // });

        // $('#payment_type').change(function() {
        //     if ($(this).val() === 'online') {
        //         $('#account_number_field').show();
        //         $('#account_number').attr('required', true); // Make it required
        //     } else {
        //         $('#account_number_field').hide();
        //         $('#account_number').attr('required', false); // Remove required attribute
        //     }
        // });

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


