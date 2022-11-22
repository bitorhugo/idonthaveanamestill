<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Add route name prefix to identify data table -->
                <h3 class="title-5 m-b-35"> {{  current(explode('.', Route::currentRouteName())) }} data table</h3>

                <div class="table-data__tool">
                                         
                    <div class="table-data__tool-right">
                        @yield('desired_create_route')
                    </div>
                </div>                
                <div class="table-responsive table-responsive-data2">
                    @yield('table-data')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END DATA TABLE-->
