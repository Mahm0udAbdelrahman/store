<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="https://coffective.com/wp-content/uploads/2018/06/default-featured-image.png.jpg" alt="#">
        @if($product->sale_percent)
        <span class="sale-tag">-{{ $product->sale_percent }}%</span>
        @endif
        <div class="button">
            <form method="post" action="{{ route('cart.store') }}">
                @csrf
                <button type="submit"  class="btn"><i class="lni lni-cart"></i> Add to
                    Cart</button>
                </form>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name ?? '' }}</span>
        <h4 class="title">
            <a href="{{ route('front_product.show' , $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><span>5.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>${{ $product->price }}</span>
            @if($product->compare_price)
            <span class="discount-price">${{ $product->compare_price }}</span>
            @endif

        </div>
    </div>
</div>
<!-- End Single Product -->
