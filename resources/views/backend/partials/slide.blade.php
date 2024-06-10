<div class="card" id="slide-{{$id}}">
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                <li class="nav-item">
                    <a class="nav-link {{$loop->first ? 'active' : ''}}"
                       id="{{ $localeCode }}-tab-{{$id}}" data-bs-toggle="tab"
                       href="#{{ $localeCode }}-{{$id}}" role="tab"
                       aria-controls="{{ $localeCode }}-{{$id}}"
                       aria-selected="true">{{ mb_convert_case($properties['native'], MB_CASE_TITLE, "UTF-8") }}</a>
                </li>
            @endforeach
            <button class="handle btn btn-outline-info border-0" style="margin-left: auto; cursor: move" type="button" title="" >Hold to drag</button>
            <button data-id="{{$id}}" class="remove-additional_info btn btn-outline-danger border-0"
                    style="margin-left: auto" type="button" title="" data-bs-original-title="btn btn-outline-danger"
                    data-original-title="btn btn-outline-danger">Remove
            </button>
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}"
                     id="{{$localeCode}}-{{$id}}" role="tabpanel"
                     aria-labelledby="{{$localeCode}}-tab-{{$id}}">
                    <div class="mb-0 m-t-30">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="slides[{{$id}}][title:{{$localeCode}}]" class="col-form-label">Title<sup style="color: red">*</sup></label>
                                <input id="slides[{{$id}}][title:{{$localeCode}}]"
                                       class="@error('slides.'.$id.'.title:'.$localeCode)is-invalid @enderror form-control"
                                       name="slides[{{$id}}][title:{{$localeCode}}]"
                                       value="{{old('slides.'.$id.'title:'.$localeCode, (isset($slide) && $slide->translate($localeCode)) ? $slide->translate($localeCode)->title : '')}}">
                                @error('slides.' . $id . '.title:'.$localeCode)
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="slides[{{$id}}][link:{{$localeCode}}]" class="col-form-label">Link</label>
                                <input id="slides[{{$id}}][link:{{$localeCode}}]"
                                       class="@error('slides.'.$id.'.link:'.$localeCode)is-invalid @enderror form-control"
                                       name="slides[{{$id}}][link:{{$localeCode}}]"
                                       value="{{old('slides.'.$id.'link:'.$localeCode, (isset($slide) && $slide->translate($localeCode)) ? $slide->translate($localeCode)->link : '')}}">
                                @error('slides.'.$id.'link:'.$localeCode)
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        <div class="row mt-3">
            <div class="col">
                <div class="card card-absolute">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Slide Links</h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 slide-links">
                                @isset($slide)
                                    @foreach($slide->slideLinks()->ordered()->get() as $block)
                                        @include('backend.partials.slide-links', ['slideId' => $slide->id, 'id' => $block->id, 'slideLink' => $block])
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-2 text-center">
                                <button class="add-slide-link btn btn-outline-success" type="button"
                                        data-link="{{route('backend.slide.get-link-block', ['slideId' => isset($slide) ? $slide->id : $id])}}"
                                        id="add_deffscripion2" data-original-title="btn btn-outline-success">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug" class="col-form-label">Image<sup style="color: red">*</sup></label>
                    <input type="hidden" name="delete_images[]" id="deleteImages">
                    <input type="hidden" class="url" name="slides[{{$id}}][preview_url]" id="preview_url-{{$id}}">
                    <input type="file"
                           data-file-id="{{isset($slide) && $slide->getFirstMedia('preview') ? $slide->getFirstMedia('preview')->id : '' }}"
                           name="slides[{{$id}}][preview]" id="input-file-now-{{$id}}" class="dropify"
                           data-default-file="{{isset($slide) && $slide->getFirstMediaUrl('preview') ? $slide->getFirstMediaUrl('preview') : '' }}"
                           data-show-remove="false"/>
                </div>
            </div>
        </div>
    </div>
</div>
