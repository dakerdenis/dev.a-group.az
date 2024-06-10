<x-app-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('assets/css/vendors/price-range.css') }}">
    </x-slot>
    <section class="section-b-space ratio_asos">
        <form class="force-submit-form" method="get" id="filter-form" action="">
            <input type="hidden" name="q" value="{{ $filters->getSearchQuery() }}">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 collection-filter">
                        <!-- side-bar colleps block stat -->
                        <div class="collection-filter-block">
                                <!-- brand filter start -->
                                <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                                                                                 aria-hidden="true"></i> {{ __('site.back') }}</span></div>
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">{{ __('site.gender') }}</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            @foreach($genders->alphabetSort() as $gender)
                                                <div class="form-check collection-filter-checkbox">
                                                    <input name="genders[]" {{ in_array($gender->id, $filters->getGenders()) ? 'checked' : '' }} value="{{ $gender->id }}" type="checkbox" class="form-check-input" id="gender-{{ $gender->id }}">
                                                    <label class="form-check-label" for="gender-{{ $gender->id }}">{{ $gender->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @if($sizes->filter(function ($item) {
                                            return $item->type === \App\Models\Size::FOR_CLOTHES;
                                        })->count())
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">{{ __('site.size_fro_clothes') }}</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            @foreach($sizes->filter(function ($item) {
                                                return $item->type === \App\Models\Size::FOR_CLOTHES;
                                            })->alphabetSort() as $size)
                                                <div class="form-check collection-filter-checkbox">
                                                    <input name="sizes[]" {{ in_array($size->id, $filters->getSizes()) ? 'checked' : '' }} value="{{ $size->id }}" type="checkbox" class="form-check-input" id="size-{{ $size->id }}">
                                                    <label class="form-check-label" for="size-{{ $size->id }}">{{ $size->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($sizes->filter(function ($item) {
                                            return $item->type === \App\Models\Size::FOR_SHOES;
                                        })->count())
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">{{ __('site.size_fro_shoes') }}</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            @foreach($sizes->filter(function ($item) {
                                                return $item->type === \App\Models\Size::FOR_SHOES;
                                            })->alphabetSort() as $size)
                                                <div class="form-check collection-filter-checkbox">
                                                    <input name="sizes[]" {{ in_array($size->id, $filters->getSizes()) ? 'checked' : '' }} value="{{ $size->id }}" type="checkbox" class="form-check-input" id="size-{{ $size->id }}">
                                                    <label class="form-check-label" for="size-{{ $size->id }}">{{ $size->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="collection-collapse-block open">
                                <h3 class="collapse-block-title">{{ __('site.color') }}</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        @foreach($colors->alphabetSort() as $color)
                                            <div class="form-check collection-filter-checkbox">
                                                <input name="colors[]" {{ in_array($color->id, $filters->getColors()) ? 'checked' : '' }} value="{{ $color->id }}" type="checkbox" class="form-check-input" id="color-{{ $color->id }}">
                                                <label class="form-check-label" for="color-{{ $color->id }}">{{ $color->title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">{{ __('site.brand') }}</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            @foreach($brands->alphabetSort() as $brand)
                                                <div class="form-check collection-filter-checkbox">
                                                    <input name="brands[]" {{ in_array($brand->id, $filters->getBrands()) ? 'checked' : '' }} value="{{ $brand->id }}" type="checkbox" class="form-check-input" id="brand-{{ $brand->id }}">
                                                    <label class="form-check-label" for="brand-{{ $brand->id }}">{{ $brand->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="collection-collapse-block open">
                                    <h3 class="collapse-block-title">{{ __('site.discount') }}</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                                <div class="form-check collection-filter-checkbox">
                                                    <input name="conditions[]" {{ in_array('discount-with', $filters->getConditions()) ? 'checked' : '' }} value="discount-with" type="checkbox" class="form-check-input" id="discount-with">
                                                    <label class="form-check-label" for="discount-with">{{ __("site.has_discount") }}</label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @if($minPrice !== $maxPrice)
                                <div class="collection-collapse-block border-0 open">
                                    <h3 class="collapse-block-title">{{ __('site.price') }}</h3>
                                    <div class="collection-collapse-block-content">
                                        <div class="wrapper mt-3">
                                            <div class="range-slider">
                                                <input data-postfix="₼" data-prefix=" " data-step="1" data-from="{{ $filters->getPriceFrom() }}" data-to="{{ $filters->getPriceTo() }}"
                                                       data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}" name="price" type="text" class="js-range-slider" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- price filter start here -->

                            <div class="collection-collapse-block border-0 d-flex">
                                <button onclick="resetForm()" type="button" title="{{ __('site.clear') }}" class="clear btn btn-solid">{{ __('site.clear') }}</button>
                            </div>
                        </div>

                        @foreach($blocks as $block)
                            <x-dynamic-component :component="'site.blocks.category.'.Str::studly($block->block->type)" :block="$block->block" class="mt-4"/>
                        @endforeach
                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="filter-main-btn"><span
                                                            class="filter-btn btn btn-theme"><i class="fa fa-filter"
                                                                                                aria-hidden="true"></i> Filter</span></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-filter-content">
                                                        <div class="search-count" id="results-line">
                                                            @include('site.partials.results-line', compact('products'))
                                                        </div>
                                                        <div class="product-page-per-view">
                                                            <select class="force-submit" name="per_page">
                                                                @foreach(\App\Models\Product::PER_PAGE as $perPage)
                                                                    <option {{ $filters->getPerPage() === $perPage ? 'selected' : '' }} value="{{ $perPage }}"> {{ __('site.per_page', compact('perPage')) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="product-page-filter">
                                                            <select class="force-submit" name="order_by" >
                                                                @foreach(\App\Models\Product::ORDER_BY as $key => $orderBy)
                                                                    <option {{ $filters->getOrderBy() === $key ? 'selected' : '' }} value="{{ $key }}">{{ __('site.sort.' . $key) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-wrapper-grid">
                                            <div class="row margin-res" id="content-products-load">
                                                @foreach($products as $product)
                                                    <x-site.product-card :product="$product"/>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div id="pager-line">
                                            {{ $products->links('site.partials.pager') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>


    <x-slot name="scripts">
        <script src="{{ asset('assets/js/price-range.js') }}?v=44"></script>
    </x-slot>
</x-app-layout>
