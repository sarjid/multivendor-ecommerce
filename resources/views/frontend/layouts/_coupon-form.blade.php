<form action="{{ route('coupon.add') }}" id="coupon-form" method="POST">
    @csrf
    @if (session()->has('coupon'))
        <input type="text" class="form-control" required name="code" placeholder="Enter Your Coupon Code"  value="{{ session('coupon')['code'] }}" disabled>
        <small class="text-success">Coupon Apllied Success</small>
        <span> <a href="{{ route('coupon.remove', session('coupon')['code'] ) }}" class="">(remove coupon)</a></span> <br>
    @else
        <input type="text" class="form-control" required name="code" placeholder="Enter Your Coupon Code">
        <button type="submit" class="coupon-btn btn btn-primary mt-2">Apply Coupon</button>
    @endif
</form>
