<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2>Showcase</h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach($showcase as $card)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="" src="{{url('/images/defaultImageCard.jpg')}}" alt='image'>
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$card->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$card->price - ($card->price * $card->discount_amount)}}</h6><h6 class="text-muted ml-2"><del>{{$card->price}}</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{route('search.show', ['search' => $card->card_id])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"
                           onclick="event.preventDefault();
                                document.getElementById('add-to-cart-form{{$card->card_id}}').submit();">
                            <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
            <form id="add-to-cart-form{{$card->card_id}}"
                  action="{{ route('cart.store') }}"
                  method="POST" class="d-none">
                @csrf
                <input type="hidden" value="{{ $card->card_id }}" name="id">
                <input type="hidden" value="{{ $card->name }}" name="name">
                <input type="hidden" value="{{ $card->price }}" name="price">
                <input type="hidden" value="{{ $card->quantity }}" name="stock">
                <input type="hidden" value="{{ $card->discount_amount }}" name="discount">
                <input type="hidden" value="1" name="quantity">
            </form>
        @endforeach
    </div>
</div>

