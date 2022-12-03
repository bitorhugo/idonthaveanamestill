<div class="container-fluid">
<div class="row align-items-center py-3 px-xl-5">
    <div class="col-lg-3 d-none d-lg-block">

    </div>
    <div class="col-lg-6 col-6 text-left">
        <form action="{{route('search.index')}}">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search for products">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                        <button type="button" class="fa fa-search"></button>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
