@extends('panel.layout.main')
@section('title', 'اسلات های کاراکتری')

@section('content')
<div class="container">
    <h3><p>تعداد اسلات‌های کاراکتری شما: {{ $amount }}</p></h3>

    @if ($amount == 0)
        <div class="alert alert-warning">
            ابتدا وارد سرور بازی شوید تا کاراکتر اولیه شما ساخته شود.
        </div>
    @else
        <form action="{{ route('buy.slots') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="slots" class="form-label">تعداد اسلات‌های درخواستی:</label>
                <input type="number" name="slots" id="slots" class="form-control" min="1" max="{{ 5 - $amount }}" required>
            </div>
            <button type="submit" class="btn btn-primary">خرید اسلات</button>
        </form>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
