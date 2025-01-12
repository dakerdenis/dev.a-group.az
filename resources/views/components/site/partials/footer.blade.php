<footer class="animate-on-scroll animate__animated" data-animation="footerSlideInDown">
    <div class="main-container">
        <div class="top">
            <div class="main-block">
                <a class="logo" href="{{ route('index') }}" title="{{ __('site.home_page') }}" aria-label="{{ __('site.home_page') }}">
                    <img width="67" height="66" src="{{ asset('assets/images/company_logo.svg') }}" alt="{{ __('site.home_page') }}" loading="lazy">
                </a>
            </div>

            <div class="main-block">
                <div class="header">{{ __('site.any_questions') }}</div>
                <a href="tel:{{ $contacts->short_number }}" class="tel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <path
                            d="M3.59766 5.40156C3.59766 4.92417 3.7873 4.46634 4.12486 4.12877C4.46243 3.7912 4.92027 3.60156 5.39766 3.60156H9.27306C9.69913 3.60176 10.1113 3.75309 10.4363 4.02863C10.7613 4.30417 10.978 4.68606 11.0479 5.10636L12.3799 13.0894C12.4435 13.4696 12.3834 13.8601 12.2084 14.2036C12.0334 14.5471 11.7528 14.8253 11.4079 14.9974L8.62146 16.3888C9.62065 18.8649 11.1088 21.1143 12.9969 23.0024C14.8849 24.8905 17.1343 26.3786 19.6105 27.3778L21.0037 24.5914C21.1756 24.2467 21.4535 23.9663 21.7966 23.7914C22.1398 23.6164 22.5299 23.5561 22.9099 23.6194L30.8929 24.9514C31.3132 25.0212 31.695 25.2379 31.9706 25.5629C32.2461 25.8879 32.3975 26.3001 32.3977 26.7262V30.6016C32.3977 31.079 32.208 31.5368 31.8704 31.8744C31.5329 32.2119 31.075 32.4016 30.5977 32.4016H26.9977C14.0737 32.4016 3.59766 21.9256 3.59766 9.00156V5.40156Z"
                            fill="#BE111D" />
                    </svg>
                    <span>{{ $contacts->short_number }}</span>
                </a>
                @php
                    $phoneFirst = explode(',', $contacts->phones)[0] ?? null
                @endphp
                @if($phoneFirst)
                    <a href="tel:{{ filter_var($phoneFirst, FILTER_SANITIZE_NUMBER_INT) }}" class="full-tel">{{ $phoneFirst }}</a>
                @endif
            </div>

            <div class="main-block app-stores-block">
                <div class="header">{{ __('site.apps_section') }}</div>
                <div class="row app-stores-row">
                    @if($contacts->google_play_link)
                        <a href="{{ $contacts->google_play_link }}" target="_blank" aria-label="Google Play">
                            <img width="170" height="50" class="googleplay" src="{{ asset('assets/images/googleplay.svg') }}" alt="" loading="lazy">
                        </a>
                    @endif
                    @if($contacts->app_store_link)
                        <a href="{{ $contacts->app_store_link }}" target="_blank" aria-label="App Store">
                            <img width="175" height="50" class="appstore" src="{{ asset('assets/images/appstore.svg') }}" alt="" loading="lazy">
                        </a>
                    @endif
                </div>
            </div>

            <div class="main-block social-block">
                <div class="header">{{ __('site.social_media') }}</div>
                <div class="row social-icons-row">
                    @if($contacts->social_networks?->facebook)
                        <a href="{{ $contacts->social_networks->facebook }}" target="_blank" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13.397 20.9972V12.8012H16.162L16.573 9.59217H13.397V7.54817C13.397 6.62217 13.655 5.98817 14.984 5.98817H16.668V3.12717C15.8487 3.03936 15.0251 2.99696 14.201 3.00017C11.757 3.00017 10.079 4.49217 10.079 7.23117V9.58617H7.33203V12.7952H10.085V20.9972H13.397Z" fill="#BE111D"/>
                            </svg>
                        </a>
                    @endif
                    @if($contacts->social_networks?->youtube)
                            <a href="{{ $contacts->social_networks->youtube }}" target="_blank" aria-label="Youtube">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21.5953 7.20301C21.4814 6.78041 21.2588 6.39501 20.9497 6.08517C20.6405 5.77534 20.2556 5.55187 19.8333 5.43701C18.2673 5.00701 12.0023 5.00001 12.0023 5.00001C12.0023 5.00001 5.73828 4.99301 4.17128 5.40401C3.74921 5.52415 3.3651 5.75078 3.05585 6.06214C2.74659 6.3735 2.52257 6.75913 2.40528 7.18201C1.99228 8.74801 1.98828 11.996 1.98828 11.996C1.98828 11.996 1.98428 15.26 2.39428 16.81C2.62428 17.667 3.29928 18.344 4.15728 18.575C5.73928 19.005 11.9873 19.012 11.9873 19.012C11.9873 19.012 18.2523 19.019 19.8183 18.609C20.2408 18.4943 20.626 18.2714 20.9359 17.9622C21.2458 17.653 21.4697 17.2682 21.5853 16.846C21.9993 15.281 22.0023 12.034 22.0023 12.034C22.0023 12.034 22.0223 8.76901 21.5953 7.20301ZM9.99828 15.005L10.0033 9.00501L15.2103 12.01L9.99828 15.005Z" fill="#BE111D"/>
                                </svg>
                            </a>
                    @endif
                        @if($contacts->social_networks?->instagram)
                            <a href="{{ $contacts->social_networks->instagram }}" target="_blank" aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.999 7.375C10.7726 7.375 9.59651 7.86217 8.72934 8.72934C7.86217 9.59651 7.375 10.7726 7.375 11.999C7.375 13.2254 7.86217 14.4015 8.72934 15.2687C9.59651 16.1358 10.7726 16.623 11.999 16.623C13.2254 16.623 14.4015 16.1358 15.2687 15.2687C16.1358 14.4015 16.623 13.2254 16.623 11.999C16.623 10.7726 16.1358 9.59651 15.2687 8.72934C14.4015 7.86217 13.2254 7.375 11.999 7.375ZM11.999 15.002C11.2023 15.002 10.4382 14.6855 9.87485 14.1221C9.31149 13.5588 8.995 12.7947 8.995 11.998C8.995 11.2013 9.31149 10.4372 9.87485 9.87385C10.4382 9.31049 11.2023 8.994 11.999 8.994C12.7957 8.994 13.5598 9.31049 14.1231 9.87385C14.6865 10.4372 15.003 11.2013 15.003 11.998C15.003 12.7947 14.6865 13.5588 14.1231 14.1221C13.5598 14.6855 12.7957 15.002 11.999 15.002Z" fill="#BE111D"/>
                                    <path d="M16.8046 8.281C17.3999 8.281 17.8826 7.79836 17.8826 7.203C17.8826 6.60764 17.3999 6.125 16.8046 6.125C16.2092 6.125 15.7266 6.60764 15.7266 7.203C15.7266 7.79836 16.2092 8.281 16.8046 8.281Z" fill="#BE111D"/>
                                    <path d="M20.5349 6.11381C20.3034 5.51599 19.9496 4.97309 19.4962 4.51987C19.0428 4.06665 18.4998 3.71308 17.9019 3.48181C17.2022 3.21917 16.4631 3.07715 15.7159 3.06181C14.7529 3.01981 14.4479 3.00781 12.0059 3.00781C9.56391 3.00781 9.25091 3.00781 8.29591 3.06181C7.5493 3.07637 6.81066 3.21841 6.11191 3.48181C5.51384 3.71281 4.97067 4.06628 4.51724 4.51954C4.06381 4.9728 3.71013 5.51584 3.47891 6.11381C3.21621 6.81342 3.07452 7.55265 3.05991 8.29981C3.01691 9.26181 3.00391 9.56681 3.00391 12.0098C3.00391 14.4518 3.00391 14.7628 3.05991 15.7198C3.07491 16.4678 3.21591 17.2058 3.47891 17.9068C3.71078 18.5046 4.0648 19.0474 4.51834 19.5006C4.97188 19.9538 5.51497 20.3074 6.11291 20.5388C6.81034 20.812 7.54928 20.9642 8.29791 20.9888C9.26091 21.0308 9.56591 21.0438 12.0079 21.0438C14.4499 21.0438 14.7629 21.0438 15.7179 20.9888C16.465 20.9736 17.2041 20.8319 17.9039 20.5698C18.5017 20.338 19.0445 19.9841 19.4979 19.5308C19.9512 19.0774 20.3051 18.5346 20.5369 17.9368C20.7999 17.2368 20.9409 16.4988 20.9559 15.7508C20.9989 14.7888 21.0119 14.4838 21.0119 12.0408C21.0119 9.59781 21.0119 9.28781 20.9559 8.33081C20.9443 7.57308 20.8018 6.82306 20.5349 6.11381ZM19.3169 15.6458C19.3105 16.2221 19.2053 16.793 19.0059 17.3338C18.8557 17.7227 18.6258 18.0758 18.331 18.3705C18.0361 18.6652 17.6829 18.8949 17.2939 19.0448C16.7591 19.2433 16.1943 19.3484 15.6239 19.3558C14.6739 19.3998 14.4059 19.4108 11.9699 19.4108C9.53191 19.4108 9.28291 19.4108 8.31491 19.3558C7.74483 19.3488 7.18023 19.2436 6.64591 19.0448C6.25559 18.8958 5.90091 18.6665 5.6048 18.3718C5.30868 18.077 5.07774 17.7234 4.92691 17.3338C4.73035 16.7989 4.62522 16.2346 4.61591 15.6648C4.57291 14.7148 4.56291 14.4468 4.56291 12.0108C4.56291 9.57381 4.56291 9.32481 4.61591 8.35581C4.62237 7.77983 4.72756 7.20923 4.92691 6.66881C5.23191 5.87981 5.85691 5.25881 6.64591 4.95681C7.1805 4.75895 7.74493 4.65378 8.31491 4.64581C9.26591 4.60281 9.53291 4.59081 11.9699 4.59081C14.4069 4.59081 14.6569 4.59081 15.6239 4.64581C16.1943 4.65267 16.7593 4.75788 17.2939 4.95681C17.6828 5.10708 18.036 5.33701 18.3309 5.63184C18.6257 5.92667 18.8556 6.27988 19.0059 6.66881C19.2025 7.20376 19.3076 7.76797 19.3169 8.33781C19.3599 9.28881 19.3709 9.55581 19.3709 11.9928C19.3709 14.4288 19.3709 14.6908 19.3279 15.6468H19.3169V15.6458Z" fill="#BE111D"/>
                                </svg>
                            </a>
                        @endif
                        @if($contacts->social_networks?->skype)
                            <a href="{{ $contacts->social_networks->skype }}" target="_blank" aria-label="Skype">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.857 17.417C8.90996 17.417 7.56296 15.893 7.56296 14.776C7.56296 14.51 7.67096 14.255 7.86096 14.071C7.95473 13.9805 8.0662 13.9103 8.18838 13.8648C8.31056 13.8194 8.44081 13.7997 8.57096 13.807C9.83196 13.807 9.50196 15.727 11.857 15.727C13.06 15.727 13.767 14.991 13.767 14.302C13.767 13.887 13.533 13.413 12.739 13.223L10.11 12.55C7.99896 12.005 7.63096 10.813 7.63096 9.70801C7.63096 7.41501 9.69896 6.58401 11.667 6.58401C13.481 6.58401 15.637 7.60001 15.637 8.97501C15.637 9.56701 15.149 9.88501 14.582 9.88501C13.504 9.88501 13.685 8.34901 11.519 8.34901C10.442 8.34901 9.87396 8.86201 9.87396 9.57901C9.87396 10.296 10.713 10.539 11.448 10.702L13.389 11.147C15.515 11.633 16.08 12.898 16.08 14.11C16.08 15.975 14.657 17.415 11.854 17.415M19.993 13.473C20.079 12.983 20.121 12.487 20.121 11.991C20.1278 10.7624 19.8673 9.54699 19.3575 8.42908C18.8478 7.31118 18.101 6.31752 17.169 5.51701C16.2458 4.72391 15.1578 4.14595 13.9839 3.82496C12.8099 3.50397 11.5792 3.44797 10.381 3.66101C9.6392 3.2264 8.79466 2.99817 7.93496 3.00001C7.06467 3.00781 6.21179 3.24474 5.46219 3.68695C4.71258 4.12917 4.09271 4.76106 3.66496 5.51901C3.23167 6.28244 3.00265 7.14473 3.00002 8.02254C2.9974 8.90035 3.22125 9.764 3.64996 10.53C3.40912 11.8643 3.49056 13.2367 3.8875 14.5331C4.28444 15.8295 4.98539 17.0123 5.93196 17.983C6.86949 18.9438 8.02782 19.6608 9.30598 20.0712C10.5841 20.4817 11.9433 20.5733 13.265 20.338C14.0058 20.7722 14.8492 21.0008 15.708 21C16.578 20.9921 17.4306 20.7553 18.18 20.3133C18.9294 19.8712 19.5492 19.2396 19.977 18.482C20.4108 17.7192 20.6402 16.8572 20.643 15.9796C20.6458 15.102 20.4219 14.2386 19.993 13.473Z" fill="#BE111D"/>
                                </svg>
                            </a>
                        @endif
                        @if($contacts->social_networks?->twitter)
                            <a href="{{ $contacts->social_networks->twitter }}" target="_blank" aria-label="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19.633 7.99363C19.646 8.16863 19.646 8.34263 19.646 8.51663C19.646 13.8416 15.593 19.9776 8.186 19.9776C5.904 19.9776 3.784 19.3166 2 18.1686C2.324 18.2056 2.636 18.2186 2.973 18.2186C4.78599 18.223 6.54764 17.6168 7.974 16.4976C7.13342 16.4824 6.31858 16.2051 5.64324 15.7044C4.9679 15.2036 4.46578 14.5045 4.207 13.7046C4.456 13.7416 4.706 13.7666 4.968 13.7666C5.329 13.7666 5.692 13.7166 6.029 13.6296C5.11676 13.4454 4.29647 12.951 3.70762 12.2303C3.11876 11.5096 2.79769 10.6073 2.799 9.67663V9.62663C3.336 9.92562 3.959 10.1126 4.619 10.1376C4.06609 9.77021 3.61272 9.27165 3.29934 8.68642C2.98596 8.10118 2.82231 7.44748 2.823 6.78363C2.823 6.03563 3.022 5.34963 3.371 4.75163C4.38314 5.99665 5.6455 7.01519 7.07633 7.74128C8.50717 8.46738 10.0746 8.88484 11.677 8.96663C11.615 8.66663 11.577 8.35562 11.577 8.04362C11.5767 7.51459 11.6807 6.99068 11.8831 6.50187C12.0854 6.01305 12.3821 5.5689 12.7562 5.19481C13.1303 4.82073 13.5744 4.52404 14.0632 4.3217C14.5521 4.11937 15.076 4.01536 15.605 4.01563C16.765 4.01563 17.812 4.50163 18.548 5.28763C19.4498 5.11324 20.3145 4.78405 21.104 4.31463C20.8034 5.24544 20.1738 6.03473 19.333 6.53463C20.1328 6.4434 20.9144 6.23308 21.652 5.91063C21.1011 6.71372 20.4185 7.41797 19.633 7.99363Z" fill="#BE111D"/>
                                </svg>
                            </a>
                        @endif
                </div>
            </div>

            <div class="main-block email-block">
                <div class="header">{{ __('site.write_to_us') }}</div>
                <a class="email-link" href="mailto:{{ explode(',', $contacts->email)[0] ?? '' }}">
                    {{ (explode(',', $contacts->email)[0] ?? '') }}
                </a>
            </div>

            <div class="main-block payments-block">
                <div class="header">{{ __('site.footer_column_title') }}</div>
                <div class="row payments-row">
                    <a href="https://yigim.az/" target="_blank" aria-label="Yigim">
                        <img width="336" height="87" class="yigim" src="{{ asset('assets/images/yigim.png') }}" alt="" loading="lazy">
                    </a>
                    <img width="146" height="91" class="mastercard" src="{{ asset('assets/images/mastercard.png') }}" alt="" loading="lazy">
                    <img width="210" height="67" class="visa" src="{{ asset('assets/images/visa.png') }}" alt="" loading="lazy">
                </div>
            </div>
        </div>
{{--        @php--}}
{{--            $firstColumn = $menu->first();--}}
{{--            $secondColumn = $menu->slice(1, 2);--}}
{{--            $lastColumn = $menu->slice(3);--}}
{{--        @endphp--}}
{{--        <div class="middle">--}}
{{--            <div class="main-blocks-container first-blocks-container">--}}
{{--                <div class="main-block">--}}
{{--                    <div class="inner">--}}
{{--                        <div class="header">{{ $firstColumn->title }}</div>--}}

{{--                        @foreach($firstColumn->children as $firstColumnItem)--}}
{{--                            <a title="{{$firstColumnItem->title . ($firstColumnItem->seo_keywords ? ' ' . $firstColumnItem->seo_keywords : '')}}" class="sub" href="{{$firstColumnItem->slug != '#' ? LaravelLocalization::getLocalizedURL(App::getLocale(), $firstColumnItem->slug) : 'javascript:void(0);'}}">{{ $firstColumnItem->title }}</a>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="main-block">--}}
{{--                    @foreach($secondColumn as $secondColumnColumn)--}}
{{--                        <div class="inner">--}}
{{--                            <a title="{{$secondColumnColumn->title . ($secondColumnColumn->seo_keywords ? ' ' . $secondColumnColumn->seo_keywords : '')}}" class="header" href="{{$secondColumnColumn->slug != '#' ? LaravelLocalization::getLocalizedURL(App::getLocale(), $secondColumnColumn->slug) : 'javascript:void(0);'}}">{{ $secondColumnColumn->title }}</a>--}}

{{--                            @foreach($secondColumnColumn->children as $secondColumnColumnItem)--}}
{{--                                <a title="{{$secondColumnColumnItem->title . ($secondColumnColumnItem->seo_keywords ? ' ' . $secondColumnColumnItem->seo_keywords : '')}}" class="sub-header" href="{{$secondColumnColumnItem->slug != '#' ? LaravelLocalization::getLocalizedURL(App::getLocale(), $secondColumnColumnItem->slug) : 'javascript:void(0);'}}">{{ $secondColumnColumnItem->title }}</a>--}}
{{--                                @foreach($secondColumnColumnItem->children as $secondColumnColumnItemChild)--}}
{{--                                    <a title="{{$secondColumnColumnItemChild->title . ($secondColumnColumnItemChild->seo_keywords ? ' ' . $secondColumnColumnItemChild->seo_keywords : '')}}" class="sub" href="{{$secondColumnColumnItemChild->slug != '#' ? LaravelLocalization::getLocalizedURL(App::getLocale(), $secondColumnColumnItemChild->slug) : 'javascript:void(0);'}}">{{ $secondColumnColumnItemChild->title }}</a>--}}
{{--                                @endforeach--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="main-blocks-container second-blocks-container">--}}
{{--                @foreach($lastColumn->chunk($lastColumn->count() / 2) as $lastColumnChunk)--}}
{{--                    <div class="main-block">--}}
{{--                    @foreach($lastColumnChunk as $lastColumnChunkItem)--}}
{{--                            <div class="inner">--}}
{{--                                <div class="header">{{ $lastColumnChunkItem->title }}</div>--}}
{{--                                @foreach($lastColumnChunkItem->children as $lastColumnChunkItemChild)--}}
{{--                                    <a title="{{$lastColumnChunkItemChild->title . ($lastColumnChunkItemChild->seo_keywords ? ' ' . $lastColumnChunkItemChild->seo_keywords : '')}}" class="sub" href="{{$lastColumnChunkItemChild->slug != '#' ? LaravelLocalization::getLocalizedURL(App::getLocale(), $lastColumnChunkItemChild->slug) : 'javascript:void(0);'}}">{{ $lastColumnChunkItemChild->title }}</a>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                    @endforeach--}}
{{--                        </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="bottom">
            <div class="copyright">
                <span>
                    © {{ \Carbon\Carbon::now()->year }} {{ __('site.all_rights_reserved_copyright') }}
                </span>
                <a href="https://infobank.az" target="_blank">
                    <img src="{{ asset('assets/images/infobank_az_logo.svg') }}" alt="infobank" width="172" height="42">
                </a>
            </div>
            <div class="creator">
                {!! __('site.created_by_MD') !!}
            </div>
        </div>
    </div>
</footer>

<div class="sidebar-drawer">
    <div class="sidebar-drawer-wrapper">
        <div class="sidebar-drawer-content">
            <div class="sidebar-close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="19" viewBox="0 0 24 19" fill="none">
                    <path d="M3.51555 0.511794C3.90607 0.12127 4.53924 0.12127 4.92976 0.511794L20.4861 16.0681C20.8766 16.4587 20.8766 17.0918 20.4861 17.4824C20.0956 17.8729 19.4624 17.8729 19.0719 17.4824L3.51555 1.92601C3.12503 1.53548 3.12503 0.902319 3.51555 0.511794Z" fill="#242323"/>
                    <path d="M3.51375 17.4884C3.12322 17.0978 3.12322 16.4647 3.51375 16.0741L19.0701 0.517794C19.4606 0.12727 20.0938 0.12727 20.4843 0.517794C20.8748 0.908319 20.8748 1.54148 20.4843 1.93201L4.92796 17.4884C4.53744 17.8789 3.90427 17.8789 3.51375 17.4884Z" fill="#242323"/>
                </svg>
            </div>
            <div class="actions">
                <button class="primary-outline">Onlayn ödəniş</button>
                <button class="primary-outline">Daxil ol</button>
            </div>
            <div class="langs-search">
                <div class="langs">
                    <a href="#">AZ</a>
                    <a href="#" class="active">RU</a>
                    <a href="#">EN</a>
                </div>
                <div class="search">
                    <input type="text" placeholder="Search...">
                    <div class="search-magnifier">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7669 16.7224C20.1178 14.9808 20.7545 12.7899 20.5474 10.5955C20.3403 8.40117 19.305 6.36811 17.6521 4.90998C15.9993 3.45185 13.853 2.67817 11.6499 2.74634C9.44683 2.81451 7.35248 3.71941 5.79292 5.27695C4.23201 6.83557 3.32415 8.93073 3.25434 11.1355C3.18454 13.3402 3.95806 15.4886 5.41725 17.1428C6.87645 18.7971 8.91151 19.8327 11.1077 20.0386C13.3039 20.2444 15.496 19.6052 17.2373 18.251L17.2838 18.2997L21.8793 22.8963C21.98 22.9969 22.0995 23.0768 22.231 23.1313C22.3625 23.1857 22.5035 23.2138 22.6458 23.2138C22.7881 23.2138 22.9291 23.1857 23.0606 23.1313C23.1921 23.0768 23.3116 22.9969 23.4123 22.8963C23.5129 22.7956 23.5928 22.6761 23.6472 22.5446C23.7017 22.4131 23.7297 22.2722 23.7297 22.1298C23.7297 21.9875 23.7017 21.8465 23.6472 21.715C23.5928 21.5835 23.5129 21.464 23.4123 21.3634L18.8157 16.7679C18.7998 16.7523 18.7836 16.7371 18.7669 16.7224ZM16.5179 6.80987C17.1296 7.41164 17.616 8.12856 17.9492 8.91927C18.2824 9.70998 18.4558 10.5588 18.4593 11.4169C18.4628 12.2749 18.2963 13.1252 17.9696 13.9186C17.6428 14.712 17.1622 15.4328 16.5555 16.0395C15.9488 16.6463 15.2279 17.1269 14.4345 17.4536C13.6411 17.7804 12.7909 17.9468 11.9328 17.9433C11.0748 17.9398 10.2259 17.7665 9.43524 17.4333C8.64453 17.1001 7.92761 16.6136 7.32584 16.002C6.12325 14.7796 5.45238 13.1316 5.45936 11.4169C5.46635 9.70215 6.15061 8.05965 7.36312 6.84715C8.57562 5.63465 10.2181 4.95038 11.9328 4.9434C13.6476 4.93641 15.2956 5.60728 16.5179 6.80987Z" fill="#BE111D"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="menu-sections">
                <div class="col">
                    <div class="menu-section">
                        <div class="menu-section-title submenu-trigger">
                            <span class="text">Dəstək xidməti</span>
                            <span class="arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <rect width="28" height="28" rx="14" fill="black" fill-opacity="0.05" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.70136 12.2047C8.96985 11.9318 9.40515 11.9318 9.67364 12.2047L14 16.6023L18.3264 12.2047C18.5948 11.9318 19.0302 11.9318 19.2986 12.2047C19.5671 12.4776 19.5671 12.9201 19.2986 13.193L14.9723 17.5906C14.4353 18.1365 13.5647 18.1365 13.0277 17.5906L8.70136 13.193C8.43288 12.9201 8.43288 12.4776 8.70136 12.2047Z"
                                              fill="#242323" />
                                    </svg>
                                </span>
                        </div>
                        <div class="submenu">
                            <a href="#">Tətbiq haqqında ümuni məlumat</a>
                            <a href="#">API vasitasilə axtarış</a>
                            <a href="#">Həkimlərin API vasitasilə axtarışı</a>
                            <a href="#">Telemetriya haqqında</a>
                        </div>
                    </div>
                    <div class="menu-section">
                        <div class="menu-section-title">
                            <a href="#" class="text">Mobil tətbiq</a>
                            <span class="arrow submenu-trigger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <rect width="28" height="28" rx="14" fill="black" fill-opacity="0.05" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.70136 12.2047C8.96985 11.9318 9.40515 11.9318 9.67364 12.2047L14 16.6023L18.3264 12.2047C18.5948 11.9318 19.0302 11.9318 19.2986 12.2047C19.5671 12.4776 19.5671 12.9201 19.2986 13.193L14.9723 17.5906C14.4353 18.1365 13.5647 18.1365 13.0277 17.5906L8.70136 13.193C8.43288 12.9201 8.43288 12.4776 8.70136 12.2047Z"
                                              fill="#242323" />
                                    </svg>
                                </span>
                        </div>
                        <div class="submenu">
                            <a href="#">Tətbiq haqqında ümuni məlumat</a>
                            <a href="#">API vasitasilə axtarış</a>
                            <a href="#">Həkimlərin API vasitasilə axtarışı</a>
                            <a href="#">Telemetriya haqqında</a>
                        </div>
                    </div>
                    <div class="menu-section">
                        <div class="menu-section-title">
                            <a href="#" class="text">Şikayətlər və onların baxılması</a>
                            <span class="arrow submenu-trigger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <rect width="28" height="28" rx="14" fill="black" fill-opacity="0.05" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.70136 12.2047C8.96985 11.9318 9.40515 11.9318 9.67364 12.2047L14 16.6023L18.3264 12.2047C18.5948 11.9318 19.0302 11.9318 19.2986 12.2047C19.5671 12.4776 19.5671 12.9201 19.2986 13.193L14.9723 17.5906C14.4353 18.1365 13.5647 18.1365 13.0277 17.5906L8.70136 13.193C8.43288 12.9201 8.43288 12.4776 8.70136 12.2047Z"
                                              fill="#242323" />
                                    </svg>
                                </span>
                        </div>
                        <div class="submenu">
                            <a href="#">Tətbiq haqqında ümuni məlumat</a>
                            <a href="#">API vasitasilə axtarış</a>
                            <a href="#">Həkimlərin API vasitasilə axtarışı</a>
                            <a href="#">Telemetriya haqqında</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="menu-section">
                        <div class="menu-section-title submenu-trigger">
                            <span class="text">Xəbərlər</span>
                            <span class="arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <rect width="28" height="28" rx="14" fill="black" fill-opacity="0.05" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.70136 12.2047C8.96985 11.9318 9.40515 11.9318 9.67364 12.2047L14 16.6023L18.3264 12.2047C18.5948 11.9318 19.0302 11.9318 19.2986 12.2047C19.5671 12.4776 19.5671 12.9201 19.2986 13.193L14.9723 17.5906C14.4353 18.1365 13.5647 18.1365 13.0277 17.5906L8.70136 13.193C8.43288 12.9201 8.43288 12.4776 8.70136 12.2047Z"
                                              fill="#242323" />
                                    </svg>
                                </span>
                        </div>
                        <div class="submenu">
                            <a href="#">Tətbiq haqqında ümuni məlumat</a>
                            <a href="#">API vasitasilə axtarış</a>
                            <a href="#">Həkimlərin API vasitasilə axtarışı</a>
                            <a href="#">Telemetriya haqqında</a>
                        </div>
                    </div>
                    <div class="menu-section">
                        <div class="menu-section-title">
                            <a href="#" class="text">Əlaqə</a>
                            <span class="arrow submenu-trigger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <rect width="28" height="28" rx="14" fill="black" fill-opacity="0.05" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8.70136 12.2047C8.96985 11.9318 9.40515 11.9318 9.67364 12.2047L14 16.6023L18.3264 12.2047C18.5948 11.9318 19.0302 11.9318 19.2986 12.2047C19.5671 12.4776 19.5671 12.9201 19.2986 13.193L14.9723 17.5906C14.4353 18.1365 13.5647 18.1365 13.0277 17.5906L8.70136 13.193C8.43288 12.9201 8.43288 12.4776 8.70136 12.2047Z"
                                              fill="#242323" />
                                    </svg>
                                </span>
                        </div>
                        <div class="submenu">
                            <a href="#">Tətbiq haqqında ümuni məlumat</a>
                            <a href="#">API vasitasilə axtarış</a>
                            <a href="#">Həkimlərin API vasitasilə axtarışı</a>
                            <a href="#">Telemetriya haqqında</a>
                        </div>
                    </div>
                    <div class="menu-section">
                        <div class="menu-section-title">
                            <a href="#" class="text">Karyera</a>
                            <!-- <span class="arrow submenu-trigger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                    <rect width="28" height="28" rx="14" fill="black" fill-opacity="0.05" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.70136 12.2047C8.96985 11.9318 9.40515 11.9318 9.67364 12.2047L14 16.6023L18.3264 12.2047C18.5948 11.9318 19.0302 11.9318 19.2986 12.2047C19.5671 12.4776 19.5671 12.9201 19.2986 13.193L14.9723 17.5906C14.4353 18.1365 13.5647 18.1365 13.0277 17.5906L8.70136 13.193C8.43288 12.9201 8.43288 12.4776 8.70136 12.2047Z"
                                        fill="#242323" />
                                </svg>
                            </span> -->
                        </div>
                        <!-- <div class="submenu">
                            <a href="#">Tətbiq haqqında ümuni məlumat</a>
                            <a href="#">API vasitasilə axtarış</a>
                            <a href="#">Həkimlərin API vasitasilə axtarışı</a>
                            <a href="#">Telemetriya haqqında</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
