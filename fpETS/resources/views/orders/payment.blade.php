@extends('layouts.master')

@section('contents')
    <h1>Payment Options</h1>
    
    <form action="{{ route('payment.process', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="payment_method">Select Payment Method:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="cash_on_delivery">Cash on Delivery</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <div id="bank_transfer_details" style="display: none;">
            <h3>Bank Transfer Details:</h3>
            <p>Account Name: WareHouse.co</p>
            <p>Account Number: 53423492950</p>
            <p>Bank Name: Bank BCA</p>
            <p>Please complete the payment and upload the payment receipt in the next step.</p>
        </div>

        <button type="submit" class="btn btn-primary">Confirm Payment</button>
    </form>

    <script>
        const paymentMethodSelect = document.getElementById('payment_method');
        const bankTransferDetails = document.getElementById('bank_transfer_details');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'bank_transfer') {
                bankTransferDetails.style.display = 'block';
            } else {
                bankTransferDetails.style.display = 'none';
            }
        });
    </script>
@endsection
