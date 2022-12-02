<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Add route name prefix to identify data table -->

                
                <!-- <h3 class="title-5 m-b-35"> {{  current(explode('.', Route::currentRouteName())) }} data table</h3> -->
                
                
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                <option selected="selected">All Properties</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 125px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-property-mw-container"><span class="select2-selection__rendered" id="select2-property-mw-container" title="All Properties">All Properties</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2 select2-hidden-accessible" name="time" tabindex="-1" aria-hidden="true">
                                <option selected="selected">Today</option>
                                <option value="">3 Days</option>
                                <option value="">1 Week</option>
                            </select><span class="select2 select2-container select2-container--default select2-container--focus" dir="ltr" style="width: 75px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-time-2e-container"><span class="select2-selection__rendered" id="select2-time-2e-container" title="Today">Today</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter">
                            <i class="zmdi zmdi-filter-list"></i>filters</button>
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
