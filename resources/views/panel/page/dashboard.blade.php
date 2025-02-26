@extends('panel.layout.main')
<head>
<style>
            .subscription-plans {
                display: flex;
                justify-content: space-around;
                padding: 20px;
            }
            .subscription-tier {
                width: 25%;
                padding: 20px;
                background: linear-gradient(-45deg, #ff8383, #ff6666, #ff8383);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
                border-radius: 10px;
                text-align: center;
                color: white;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: all 0.3s ease;
            }
            .subscription-tier h2 {
                margin-bottom: 20px;
                font-size: 24px;
                font-weight: bold;
            }
            .features-list {
                background: white;
                color: black;
                padding: 10px;
                border-radius: 5px;
                text-align: left;
            }
            .features-list li {
                list-style-type: none;
                position: relative;
                padding-left: 20px;
                margin-bottom: 10px;
            }
            .features-list li::before {
                content: "✔";
                color: green;
                position: absolute;
                left: 0;
            }
            .subscription-tier:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }
            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }
        </style>
    </head>
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card  flex-lg-column flex-md-row ">
                <div class="card-body card-body  text-center border-bottom profile-bx">
                    <div class="profile-image mb-4">
                        <img src="https://cdn.discordapp.com/avatars/@user('id')/@user('avatar').webp?size=128" class="rounded-circle" alt="">
                    </div>
                    <h4 class="fs-22 text-black mb-1">@user('username')</h4>
                    @if ( auth()->user()->getActiveTire()  )
                        <p class="fs-22 text-black mb-1">{{ auth()->user()->tire->name }}</p>
                    @endif
                </div>
                <div class="card-body  activity-card">
                    @if ( auth()->user()->getPercent() !== false )
                        <div class="progress  mb-3">
                            <div class="progress-bar progress-animated" style="width: {{ auth()->user()->getPercent() }}%;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#ff8383);" role="progressbar">
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                    برای ورود به سرور نیازمند داشتن اشتراک فعال هستید
                    </div>
                    @endif
                    @if ( auth()->user()->active_from != null )
                    <div class="d-flex mb-1 align-items-center">
                        <strong class="text-black">
                            <i class="fa fa-calendar ml-3"></i>
                            تاریخ شروع اشتراک:
                        </strong>
                    </div>
                    <div class=" d-flex mb-3 mr-4 align-items-center">
                        <span class="text-black" style="cursor: pointer" title="{{ auth()->user()->active_from->toJalali()->formatJalaliDatetime() }}">{{ auth()->user()->active_from->toJalali()->formatWord('l d S F') }}</span>
                    </div>
                    @endif
                    @if ( auth()->user()->expire_at != null and auth()->user()->active_from != null )
                        <div class="d-flex mb-1 align-items-center">
                            <strong class="text-black">
                                <i class="fa fa-hourglass-half ml-3"></i>
                                اعتبار تا:
                            </strong>
                        </div>
                        <div class="d-flex mb-3 mr-4 align-items-center">
                            <span class="text-black" style="cursor: pointer" title="{{ auth()->user()->expire_at->toJalali()->formatJalaliDatetime() }}">{{ auth()->user()->expireAtHumanFormat() }}</span>
                        </div>
                        @if( auth()->user()->getActiveTire() )
                                <a href="{{ route('getRoll') }}" class="btn btn-info">دریافت مجدد اشتراک در دیسکورد</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card  flex-lg-column flex-md-row ">
                <div class="table-responsive">
                    <table class="table display mb-4 table-responsive-xl card-table no-footer">
                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>مبلغ</th>
                                @if( auth()->user()->getActiveTire() )
                                    <th>تخفیف ارتقا اشتراک</th>
                                @endif
                                <th>مدت اعتبار</th>
                                <th>دریافت</th>
                            </tr>
                        </thead>
                        <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td>{{ $package->name }}</td>
                            <td>
                                @if( $package->price == 0 )
                                    رایگان !
                                @else
                                    {{ number_format($package->price) }} تومان
                                @endif
                            </td>
                            @if( auth()->user()->getActiveTire() )
                                @php
                                    $discount =auth()->user()->discountUpgrade() ;
                                    $discount = ( $discount > $package->price ) ? $package->price : $discount;
                                @endphp
                                <td>@if( $discount <= 0 or $package->price <= 0 or $package->id == auth()->user()->tire_id )
                                    --
                                @else
                                    {{ number_format($discount) }} تومان
                                @endif
                                </td>
                            @endif
                            <td>{{ $package->expire }} روز</td>
                            <td>
                                @if( auth()->user()->getActiveTire() )
                                    @if( $package->id == auth()->user()->tire_id )
                                        <button class="btn btn-danger disabled" disabled>اشتراک فعلی!</button>
                                    @else
                                        @if( $package->price <= 0 or $package->price - $discount <= 0 )
                                            <a href="{{ route('buy' , $package->id ) }}" class="btn btn-warning">رایگان ارتقا دهید !</a>
                                        @else
                                            <a href="{{ route('buy' , $package->id ) }}" class="btn btn-warning">ارتقا اشتراک</a>
                                        @endif
                                    @endif
                                @else
                                    @if( $package->price <= 0)
                                        <a href="{{ route('buy' , $package->id ) }}" class="btn btn-warning">رایگان !</a>
                                    @else
                                        <a href="{{ route('buy' , $package->id ) }}" class="btn btn-info">دریافت اشتراک</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-info w-100 text-center">
                                    در حال حاضر امکان خرید اشتراک وجود ندارد
                                </div>
                            </td>
                        </tr>
                    @endif
                        </tbody>
                    </table>
                </div>
                <p style="text-align: center;"><strong><span style="color: #ff0000;">توجه داشته باشید اشتراک Premium Access</span><span style="color: #ff0000;"> فقط جهت دسترسی به یک سری عناوین خاص استفاده میشود</span></strong></p>
                <div class="subscription-plans">
                    <div class="subscription-tier">
                        <h2>اشتراک برنز</h2>
                        <ul class="features-list">
                            <li>ویژگی 1</li>
                            <li>ویژگی 2</li>
                        </ul>
                    </div>
                    <div class="subscription-tier">
                        <h2>اشتراک سیلور</h2>
                        <ul class="features-list">
                            <li>ویژگی A</li>
                            <li>ویژگی B</li>
                        </ul>
                    </div>
                    <div class="subscription-tier">
                        <h2>اشتراک گلد</h2>
                        <ul class="features-list">
                            <li>ویژگی X</li>
                            <li>ویژگی Y</li>
                        </ul>
                    </div>
                    <div class="subscription-tier">
                        <h2>اشتراک پلاتین</h2>
                        <ul class="features-list">
                            <li>ویژگی P</li>
                            <li>ویژگی Q</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
