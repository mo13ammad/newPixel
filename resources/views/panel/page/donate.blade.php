@extends('panel.layout.main')
@section('title' , 'حمایت مالی')
@section('content')
    <div class="card  flex-lg-column flex-md-row ">
        <div class="card-body">
            <p class="alert alert-info">شما با حمایت سرور در سرور دیسکورد رول اختصاصی خود را دریافت خواهید کرد.</p>

            <form action="{{ route('payDonate') }}" method="POST" class="display mb-4 card-table no-footer">
                @csrf
                <div class="form-group">
                    <label for="input-name" class="control-label ">مبلغ مد نظر را وارد کنید.</label>
                    <input class="form-control" name="price" value="{{ old('price') }}" placeholder="حداقل مبلغ قابل پرداخت: {{ env('MIN_DONATION') }}">
                </div>
                <input type="submit" value="پرداخت" class="btn btn-info">
            </form>
        </div>
    </div>
@endsection
