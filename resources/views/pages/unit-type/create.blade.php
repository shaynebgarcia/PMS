@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Create Unit Type';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('property-show', $property) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Unit Type</h5>
                <h6 class="sub-title">{{ $property->name }}</h6>
            </div>
            <div class="card-block">
                <form id="create-type" method="POST" action="{{ route('type.store', $property->id) }}">
                    @CSRF
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Unit Type Name</label>
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Size</label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="text" class="form-control" name="size">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Lease Price</label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="text" class="form-control" name="lease_price" required>
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