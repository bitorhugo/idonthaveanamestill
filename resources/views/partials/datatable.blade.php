<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Add route name prefix to identify data table -->

                
                <!-- <h3 class="title-5 m-b-35"> {{  current(explode('.', Route::currentRouteName())) }} data table</h3> -->
                
                
                <div class="table-data__tool">
                    <div class="table-data__tool-left">

                        <div class="row">
                            <div class="col">
                                <select name="select" id="select" class="form-control-sm form-control">
                                    <option value="priceUp">Price ↥</option>
                                    <option value="priceDown">Price ↧</option>
                                    <option value="3">Option #3</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="select" id="select" class="form-control-sm form-control">
                                    <option value="0">Please select</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                    <option value="3">Option #3</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="select" id="select" class="form-control-sm form-control">
                                    <option value="0">Please select</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                    <option value="3">Option #3</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="table-data__tool-right">
                        @yield('desired_create_route')
                    </div>

            </div>                
        </div>
    </div>
    </div>
</section>
<!-- END DATA TABLE-->
