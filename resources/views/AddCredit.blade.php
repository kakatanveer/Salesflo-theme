@extends('layouts.layout')
@section('title', 'ShowItems')
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

<form class="row g-3 needs-validation" action="{{ route('StoreCredit') }}" method="post" novalidate="" >
    @csrf
    <input type="hidden" id="CustomerId" name="id">
    <div class="col-6">
        <label for="customer_name" class="form-label">Customer Name</label>
        <select name="customer_name" id="customer_name" class="form-control">
            <option value="0"> Select Customer </option>
        @foreach ($customer as $customer)
            <option value="{{$customer->id}}"> {{ $customer->customer_name }} </option>
        @endforeach
        </select>
        <div class="invalid-feedback">Please, enter Customer name!</div>
    </div>
    <div class="col-6" id="advance_payment_field" >
        <label for="advance_payment" class="form-label">Advance Payment</label>
        <input type="text" name="advance_payment" id="advance_payment" class="form-control">
    </div>
    <div class="col-12">
        <label for="items" class="form-label">Items</label>
        <table class="table" id="itemsTable">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount (%)</th>
                    <th>Discount Amount</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{-- {{ dd($items) }} --}}
                        <select name="item_id[]" class="form-control item-select item-select-wide" style="width: 250px">
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->selling_price }}" data-stock="{{ $item->stock_quantity }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="price[]" class="form-control item-price" readonly></td>
                    <td><input type="number" name="quantity[]" class="form-control item-quantity" value="1" min="1"></td>
                    <td><input type="number" name="item_discount[]" class="form-control item-discount" value="0" min="0"></td>
                    <td><input type="number" name="discount_amount[]" class="form-control discount-amount" value="0" min="0"></td>
                    <td><input type="number" name="total[]" class="form-control item-total" readonly></td>
                    <td><button type="button" class="btn btn-danger remove-row btn-sm">Remove</button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end">Total Amount:</th>
                    <th><input type="number" id="grandTotal" class="form-control" readonly></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-success btn-sm" id="addRow">Add Row</button>
    </div>

    <div class="col-12 d-flex justify-content-center align-items-center mt-5" id="div-save-button">
        <button type="submit" class="btn btn-outline-primary"  style="width:200px">Save</button>
    </div>
</form>
@endsection
<script src="{{ asset('assets/vendor/myjs.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        function updateTotal() {

            let grandTotal = 0;

            $('#itemsTable tbody tr').each(function() {
                var price = $(this).find('.item-select option:selected').data('price');
                var quantity = $(this).find('.item-quantity').val();
                var discountPercent = $(this).find('.item-discount').val();
                var discountAmount = $(this).find('.discount-amount').val();
                var availableStock = $(this).find('.item-select option:selected').data('stock');

                // alert(availableStock);

                var calculatedDiscountAmount = (price * quantity) * (discountPercent / 100);
                var total = (price * quantity) - discountAmount;

                if ($(document.activeElement).hasClass('item-discount')) {
                    $(this).find('.discount-amount').val(calculatedDiscountAmount.toFixed(2));
                    total = (price * quantity) - calculatedDiscountAmount;
                } else {
                    var discountPercentFromAmount = (discountAmount / (price * quantity)) * 100;
                    $(this).find('.item-discount').val(discountPercentFromAmount.toFixed(2));
                }

                if (quantity > availableStock) {
                    alert("Requested quantity exceeds available stock.");
                    $(this).find('.item-quantity').val(availableStock);
                    quantity = availableStock;
                    total = (price * quantity) - discountAmount;
                }

                $(this).find('.item-price').val(price);
                $(this).find('.item-total').val(total.toFixed(2));

                // Add this row's total to the grand total
                grandTotal += total;
            });

            var advancepayment = $('#advance_payment').val();


            if(advancepayment > grandTotal)
            {
                $('#advance_payment').val(0);
                alert('advance payment can not be greater than total amount.');
            }

            // Update the grand total in the footer
            $('#grandTotal').val(grandTotal.toFixed(2));
        }

        $('#addRow').click(function() {
            var newRow = $('#itemsTable tbody tr:first').clone();
            newRow.find('input').val('');
            newRow.find('.item-quantity').val(1);
            newRow.find('.item-discount').val(0);
            newRow.find('.discount-amount').val(0);
            $('#itemsTable tbody').append(newRow);
        });

        $('#itemsTable').on('change', '.item-select', function() {
            updateTotal();
        });

        $('#advance_payment').on('change', function() {
            updateTotal();
        });

        $('#itemsTable').on('input', '.item-quantity, .item-discount, .discount-amount',  function() {
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

        $('.edit-btn').click(function(e) {
            e.preventDefault();
            var CustomerId = $(this).data('id');
            var baseUrl = "{{ url('/') }}";

            $.ajax({
                url: baseUrl +'/Customer/edit-customer',
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: CustomerId
                },
                success: function(response) {
                    $('#customer_name').val(response.customer_name);
                    $('#contact_number').val(response.contact_number);
                    $('#address').val(response.address);
                    $('#CustomerId').val(CustomerId);
                    $('#CustomerModal').modal('show');

                    $('#SaveCustomerForm').attr('action', '{{ url("/UpdateCustomer") }}/' + CustomerId);
                },
                error: function(response) {
                    console.log(response);
                    alert('Error occurred while fetching data');
                }
            });
        });

        updateTotal(); // Initial call to update total for the first row
    });
</script>
<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>
