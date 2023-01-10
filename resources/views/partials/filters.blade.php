<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-data__tool" style="align-content:flex-end">
                    
                    <form id="sort-form" action="{{route('search.index')}}" method="GET" class="">
                        <label>Sort</label>
                        <select name="sort" id="sort" form="sort-form" style="background:#f8fafc">
                            <option value="none">Best Match</option>
                            <option value="age-asc">Age (ascending)</option>
                            <option value="age-desc">Age (descending)</option>
                            <option value="price-asc">Price (ascending)</option>
                            <option value="price-desc">Price (descending)</option>
                            <option value="discount-asc">Discount (ascending)</option>
                            <option value="discount-desc">Discount (descending)</option>
                        </select>
                        <input type="hidden" name="category" id="category" value="{{$category}}">
                        <input type="hidden" name="q" id="q" value="{{$q}}">
                        <input type="submit" value="=>">
                    </form>
                    
                </div>
            </div>                
        </div>
    </div>

    </form>
</section>

