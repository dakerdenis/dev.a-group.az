<x-app-layout>
    <section class="section sitemap-section pt-0">
        <div class="container">
            <div class="sitemap-section__content">
                <div class="sitemap">
                    <div class="sitemap__list">
                        @foreach($menu->chunk(ceil($menu->count() / 2)) as $col)
                            <div class="sitemap__col">
                                @foreach($col as $item)
                                    <div class="sitemap__item">
                                        @if($item->slug === '#')
                                            <div>{{$item->title}}</div>
                                        @else
                                            <a href="{{LaravelLocalization::getLocalizedURL(App::getLocale(), $item->slug)}}" title="{{$item->title . ($item->seo_keywords ? ' ' . $item->seo_keywords : '')}}" class="sitemap__item-link">{{$item->title}}</a>
                                        @endif
                                        @if(count($item->children))
                                            <ul class="sitemap__subitem">
                                                @foreach($item->children as $child)
                                                    <li>
                                                        <a title="{{$child->title . ($child->seo_keywords ? ' ' . $child->seo_keywords : '')}}" href="{{$child->slug != '#' ? LaravelLocalization::getLocalizedURL(App::getLocale(), $child->slug) : 'javascript:void();'}}">{{$child->title}}</a>
                                                        @if(count($child->children))
                                                            <ul class="sitemap__subitem">
                                                                @foreach($child->children as $last_child)
                                                                    <li>
                                                                        <a title="{{$last_child->title . ($last_child->seo_keywords ? ' ' . $last_child->seo_keywords : '')}}" href="{{LaravelLocalization::getLocalizedURL(App::getLocale(), $last_child->slug)}}">{{$last_child->title}}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
