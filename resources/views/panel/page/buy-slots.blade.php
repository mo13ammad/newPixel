@extends('panel.layout.main')
@section('title', 'خرید اسلات کاراکتر')

@section('content')
<div class="container">
    <h1>خرید اسلات کاراکتر</h1>
    <p>تعداد اسلات‌های درخواستی: {{ $requestedSlots }}</p>
    <p>قیمت کل: {{ $totalPrice }} تومان</p>

    <form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
    <input type="hidden" name="requestedSlots" value="{{ $requestedSlots }}">
    <button type="submit" class="btn btn-primary">پرداخت</button>
</form>
</div>
@endsection
