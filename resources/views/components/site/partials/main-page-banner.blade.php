<div class="banner">
    <div class="mainBannerSwiper-container">
        <div class="swiper-container mainBannerSwiper">
            <div class="swiper-wrapper">
                @foreach($slides as $slide)
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="{{ $slide->getFirstMediaUrl('preview', 'minWebp') }}" media="(max-width: 500px)">
                            <source srcset="{{ $slide->getFirstMediaUrl('preview', 'mdWebp') }}" media="(max-width: 767px)">
                            <source srcset="{{ $slide->getFirstMediaUrl('preview', 'lgWebp') }}" media="(max-width: 800px)">
                            <source srcset="{{ $slide->getFirstMediaUrl('preview', 'xlWebp') }}" media="(max-width: 1023px)">
                            <source srcset="{{ $slide->getFirstMediaUrl('preview', 'xxlWebp') }}" media="(max-width: 1440px)">
                            <img class="img-in-picture" src="{{ $slide->getFirstMediaUrl('preview', 'webp') }}" width="1349" height="780" alt="{{ $slide->title }}">
                        </picture>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="navigation">
            <div class="menu">

                @foreach($slides as $slide)
                    <div class="menu-item">
                        @if($slide->link)
                            <a class="title" title="{{ $slide->title }}" href="{{ LaravelLocalization::getLocalizedURL(\Illuminate\Support\Facades\App::getLocale(), $slide->link) }}">{{ $slide->title }}</a>
                        @else
                            <span class="title">{{ $slide->title }}</span>
                        @endif
                        <div class="collapsed mainBanner-collapsed">
                            <div class="row">
                                @if($loop->first)
                                    @foreach($slide->slideLinks()->ordered()->get()->chunk(round($slide->slideLinks->count() / 2)) as $chunk)
                                        <div class="col col-50">
                                            @foreach($chunk as $slideLink)
                                                <a class="li-link" title="{{ $slide->title }}" href="{{ $slideLink->link }}">{{ $slideLink->title }}</a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @else
                                        <div class="col">
                                            @foreach($slide->slideLinks()->ordered()->get() as $link)
                                            <a class="li-link" title="{{ $link->title }}" href="{{ $link->link }}">{{ $link->title }}</a>
                                            @endforeach
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                @foreach($slides as $slide)
                    <div class="pagination-item"><div class="progress"></div></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
