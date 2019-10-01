@extends('layouts.admindek')

@section('breadcrumbs')
    <?php   $breadcrumb_title = 'Create Tenant';
            $breadcrumb_subtitle = 'lorem ipsum dolor sit amet, consectetur adipisicing elit'; ?>
    {{ Breadcrumbs::render('tenant-create') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Create Tenant</h5>
            </div>
            <div class="card-block">
                <form id="create-tenant" method="POST" action="{{ route('tenant.store') }}">
                    @CSRF
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Last Name</label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">First Name</label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Middle Name</label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input type="text" class="form-control" name="middlename" required>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact</label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="text" class="form-control" name="contact">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Address</label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <textarea type="text" class="form-control" name="address"></textarea>
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