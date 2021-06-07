@if (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() >0)
@foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
    <tr>
        <th scope="row">
            <i class="icofont-close"></i>
        </th>
        <td>
            <img src="{{ $item->model->photo }}" alt="Product">
        </td>
        <td>
            <a href="{{ route('product.detail',$item->model->slug) }}">{{ $item->name }}</a>
        </td>
        <td>${{ $item->price }}</td>
        <td>
            <div class="quantity">
                <input type="number" class="qty-text" id="qty2" step="1" min="1" disabled max="99" name="quantity" value="1">
            </div>
        </td>
        <td><a href="javascript::void(0)" data-id="{{ $item->rowId }}" class="btn btn-primary btn-sm move-to-cart" id="move_to_cart_{{ $item->rowId }}">Move to Cart</a></td>
    </tr>
@endforeach
@else
<td colspan="6" class="text-center">No Product Found</td>
@endif
