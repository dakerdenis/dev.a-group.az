@extends('layouts.backend')
@section('content')

    @include('backend.partials.title_breadcrumbs', ['title' => 'Edit Settings', 'breadcrumbs' => [], 'buttons' => null])
        <form
            class="content-form"
            action="{{route('backend.settings.update')}}"
            method="post" enctype='multipart/form-data'>
        @method('put')
        @csrf
        <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('message'))
                            <div class="alert alert-{!! strtolower(Session::get('message')['type']) !!} dark alert-dismissible fade show" role="alert">
                                <strong>{!! Session::get('message')['type'] !!}
                                    ! </strong> {!! Session::get('message')['message'] !!}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                        data-original-title="" title=""><span aria-hidden="true"></span></button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
{{--                                    <div class="card-body">--}}
{{--                                        <ul class="nav nav-tabs" id="myTab" role="tablist">--}}
{{--                                            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)--}}
{{--                                                <li class="nav-item">--}}
{{--                                                    <a class="nav-link {{$loop->first ? 'active' : ''}}"--}}
{{--                                                       id="{{ $localeCode }}-tab" data-bs-toggle="tab"--}}
{{--                                                       href="#{{ $localeCode }}" role="tab"--}}
{{--                                                       aria-controls="{{ $localeCode }}"--}}
{{--                                                       aria-selected="true">{{ mb_convert_case($properties['native'], MB_CASE_TITLE, "UTF-8") }}</a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                        <div class="tab-content" id="myTabContent">--}}
{{--                                            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)--}}
{{--                                                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}"--}}
{{--                                                     id="{{$localeCode}}" role="tabpanel"--}}
{{--                                                     aria-labelledby="{{$localeCode}}-tab">--}}
{{--                                                    <div class="mb-0 m-t-30">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="name" class="col-form-label">Title</label>--}}
{{--                                                            <input--}}
{{--                                                                class="form-control @error('title:'.$localeCode)is-invalid @enderror "--}}
{{--                                                                type="text" name="title:{{$localeCode}}"--}}
{{--                                                                placeholder="Title"--}}
{{--                                                                value="{{old('title:'.$localeCode, (isset($contact) && $contact->translate($localeCode)) ? $contact->translate($localeCode)->title : '')}}"--}}
{{--                                                                id="title">--}}
{{--                                                            @error('title:'.$localeCode)--}}
{{--                                                            <div class="invalid-feedback">--}}
{{--                                                                {{$message}}--}}
{{--                                                            </div>@enderror--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group mt-3">--}}
{{--                                                            <label for="address:{{$localeCode}}"--}}
{{--                                                                   class="col-form-label">Address</label>--}}
{{--                                                            <textarea id="address:{{$localeCode}}"--}}
{{--                                                                      class="@error('address:'.$localeCode)is-invalid @enderror form-control"--}}
{{--                                                                      name="address:{{$localeCode}}" cols="30"--}}
{{--                                                                      rows="3">{{old('address:'.$localeCode, (isset($contact) && $contact->translate($localeCode)) ? $contact->translate($localeCode)->address : '')}}</textarea>--}}
{{--                                                            @error('address:'.$localeCode)--}}
{{--                                                            <div class="invalid-feedback">--}}
{{--                                                                {{$message}}--}}
{{--                                                            </div>@enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="card-footer">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="logo" class="col-form-label">Site Logo</label>
                                                    <input type="hidden" name="delete_images[]" id="deleteImages">
                                                    <input type="hidden" name="logo_url" class="url" id="logo_url">
                                                    <input type="file" name="logo" data-file-id="logo" id="logo" class="dropify" data-default-file="{{ $settings->logo }}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner" class="col-form-label">Main page banner</label>
                                                    <input type="hidden" name="delete_images[]" id="deleteImages">
                                                    <input type="hidden" name="banner_url" class="url" id="banner_url">
                                                    <input type="file" data-file-id="banner" name="banner" id="banner" class="dropify" data-default-file="{{ $settings->banner }}"/>
                                                    @error('preview')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="access_price" class="col-form-label">Advert document access price</label>
                                                    <input
                                                        class="form-control @error('access_price')is-invalid @enderror "
                                                        type="text" name="access_price"
                                                        value="{{old('access_price', isset($settings) ? $settings->access_price / 100 : '')}}"
                                                        id="access_price">
                                                    @error('access_price')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="refresh_price" class="col-form-label">Advert refresh price</label>
                                                    <input
                                                        class="form-control @error('refresh_price')is-invalid @enderror "
                                                        type="text" name="refresh_price"
                                                        value="{{old('refresh_price', isset($settings) ? $settings->refresh_price / 100 : '')}}"
                                                        id="refresh_price">
                                                    @error('refresh_price')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button
                                            class="btn btn-primary">Update</button>
                                        <a style="color: white" href="{{route('backend.dashboard')}}"
                                           class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </form>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('backend/assets/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/dragula.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/vendors/select2.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('backend/assets/js/slugify.js')}}"></script>
    <script src="{{asset('backend/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('backend/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{ asset('backend/assets') }}/js/dragula.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/editor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('backend/assets') }}/js/editor/ckeditor/adapters/jquery.js"></script>
    <script src="{{ asset('backend/assets') }}/js/editor/ckeditor/styles.js"></script>
    <script src="{{ asset('backend/assets') }}/js/dropify.min.js"></script>
    <script src="{{ asset('backend/assets/js/select2/select2.full.min.js') }}"></script>
@endsection
