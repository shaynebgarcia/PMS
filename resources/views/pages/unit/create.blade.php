@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Create Unit';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('unit-create', $property) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create Unit</h5>
                    <h6 class="sub-title">{{ $property->name }}</h6>
                </div>
                <div class="card-block">
                    <form id="create-unit" method="POST" action="{{ route('unit.store', $property->id) }}">
                        @CSRF
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Number</label>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <input type="text" class="form-control" name="number" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Floor No</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="number" class="form-control" name="lease_price" required>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Type</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select class="select2" name="type" style="width: 100%">
                                        <option value="#" disabled selected>Select Type</option>
                                        @foreach($unit_types as $utype)
                                            <option value="{{ $utype->id }}">{{ $utype->name }} ({{ $utype->size }})</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                <button type="submit" class="btn waves-effect waves-light btn-info btn-round">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
