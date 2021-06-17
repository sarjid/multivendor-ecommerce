<table class="table mb-3">
    <tbody>
        <tr>
            <td>Sub Total</td>
            <td>
                ${{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal() }}
            </td>
        </tr>

    @if (\Illuminate\Support\Facades\Session::has('coupon'))
        <tr>
            <td>Discount</td>
            <td>
                ${{ \Illuminate\Support\Facades\Session::get('coupon')['value'] }}
            </td>
        </tr>
    @endif
        {{-- <tr>
            <td>VAT (10%)</td>
            <td>$5.60</td>
        </tr> --}}
        <tr>
            <td>Total</td>
            <td>
            @if (session()->has('coupon'))
                @php
                  $subtotal =  str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal());

                  $sessionSubtotal =  str_replace(',','',session()->get('coupon')['value']);
                @endphp

                ${{ number_format(round($subtotal-$sessionSubtotal),2) }}

            @else
                ${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}
            @endif
            </td>
        </tr>
    </tbody>
</table>
