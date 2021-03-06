@extends('backend.layouts.main')
@section('title', __('Create Hotel'))
@section('content')
  <div class="content-wrapper">
    <section class="content">
    <h1 class="title-page">{{__('Create hotel')}}</h1>
       @include('flash::message')
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data" >
              {{csrf_field()}}
              <div class="box-body"> 
                {{-- input hotel name --}}
                <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>
                  <input type="text" class="form-control" name="name" placeholder="{{ __('Hotel name') }}" value="{{ old('name') }}">
                  @if($errors->first('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                
                {{-- select place adn star --}}
                <div class="form-inline">
                  {{-- place select --}}
                  <div class="form-group" {{ $errors->has('place') ? ' has-error' : '' }}>
                    <select class="form-control place-id-choose" name="place_id">
                      <option value="">Choose Place</option>
                      @foreach($places as $place)
                        <option value="{{ $place->id }}" {{$place->id == old('place_id')? "selected": ""}}>{{ $place->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->first('place_id'))
                      <span class="text-danger">{{ $errors->first('place_id') }}</span>
                    @endif
                  </div>
                   {{-- select star --}}
                  <div class="form-group" {{ $errors->has('star') ? ' has-error' : '' }}>
                    <select class="form-control" name="star">
                      <option value="">Star</option>
                      @for($i = App\Model\Hotel::STAR_MIN; $i <= App\Model\Hotel::STAR_MAX; $i++ )
                        <option value="{{ $i }}" {{$i == old('star')? "selected": ""}}>{{ $i }}</option>
                      @endfor
                    </select>
                    @if($errors->first('star'))
                      <span class="text-danger">{{$errors->first('star')}}</span>
                    @endif
                  </div>
                </div>
                <div>
                  {{-- input actual_address --}}
                  <div class="form-group col-md-4" {{ $errors->has('actual_address') ? ' has-error' : '' }}>
                    <input type="text" class="form-control" name="actual_address" placeholder="{{ __('Actual address') }} {{'(Ex: '. __('Number 50').')'}}" value="{{ old('actual_address') }}" >
                    @if($errors->first('actual_address'))
                      <span class="text-danger">{{ $errors->first('actual_address') }}</span>
                    @endif
                  </div>
                  {{-- input street --}}
                  <div class="form-group col-md-8" {{ $errors->has('street') ? ' has-error' : '' }}>
                    <input type="text" class="form-control  street-suggest" name="street" placeholder="{{ __('Street') }} {{ '(Ex:'. __('Xuan Thuy street, Cau Giay District').')'}}" value="{{ old('street') }}" data-url="{{ route('home.hintStreets') }}">
                    @if($errors->first('street'))
                      <span class="text-danger">{{ $errors->first('street') }}</span>
                    @endif
                    <div class="widgetStreetResult" hidden>
                    </div>
                  </div>
                </div>
                {{-- introduce --}}
                <label></label>
                <div class="form-group" {{ $errors->has('introduce') ? ' has-error' : '' }}>
                  <textarea class="form-control" name="introduce" placeholder="{{ __('Introduction about hotel') }}" value="{{ old('introduce') }}"></textarea>
                  @if($errors->first('introduce'))
                    <span class="text-danger">{{$errors->first('introduce')}}</span>
                  @endif
                </div>
                {{-- Services --}}
                <div class="form-group">
                <p><b>{{ __('Choose Services') }}</b></p>
                  @foreach($services as $service)
                    <div class="checkbox-inline">
                      <label><input type="checkbox" name="services[]"  onclick="" value="{{ $service->id }}"
                        {{(is_array(old('services')) && in_array($service->id, old('services')))? "checked": ""}}>{{ $service->name }}</label>
                    </div>
                  @endforeach
                </div>
                <div class="form-group {{ $errors->has('images.*') || $errors->has('images') ? ' has-error' : '' }}"> 
                  <label for="input-file">{{ __("Images") }}</label>
                  <input type="file" class="form-control" name="images[]" id="multiple-image" multiple>
                  <small class=" text-danger">{{ $errors->first('images.*') . $errors->first('images') }}</small>
                  <div id="showImage" class="mt-20">
                    <img class="img-place" id="default-image" src="{{ asset(config('image.default_thumbnail')) }}">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <a class="btn btn-default btn-custom" href="javascript:history.back()">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning btn-custom">
                  {{ __('Reset') }}
                </button>
                <button type="submit" class="btn btn-primary btn-custom pull-right" id="js-bt-submit">
                  {{ __('Submit') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection