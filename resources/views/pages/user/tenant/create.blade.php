@extends('layouts.admindek')

@section('breadcrumbs')
    @php
        $breadcrumb_icon = config('pms.breadcrumbs.user.icon');
        $breadcrumb_title = config('pms.breadcrumbs.user.tenant-create.title');
        $breadcrumb_subtitle = config('pms.breadcrumbs.user.tenant-create.subtitle');
    @endphp
    {{ Breadcrumbs::render('tenant-create', $property) }}
@endsection

@section('content')
    <form id="create-tenant" enctype="multipart/form-data" method="POST" action="{{ route('tenant.store') }}">
    @CSRF
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Tenant Information</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Photo</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="file" class="form-control" name="user_photo" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                            @error('user_photo')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Last Name*</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="lastname" required>
                            @error('lastname')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">First Name*</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="firstname" required>
                            @error('firstname')
                                @include('errors.validation')
                            @enderror
                        </div>
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Middle Name</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="middlename">
                            @error('middlename')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="contact">
                            @error('contact')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Birthdate</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="date" class="form-control" name="birthdate">
                            @error('birthdate')
                                @include('errors.validation')
                            @enderror
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Age</label>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="text" class="form-control" name="age">
                            @error('age')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Birthplace</label>
                        <div class="col-lg-10 col-md-10 col-sm-4">
                            <textarea type="text" class="form-control" name="birthplace"></textarea>
                            @error('birthplace')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Tenant Address</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Previous Address</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <textarea type="text" class="form-control" name="address"></textarea>
                            @error('address')
                                @include('errors.validation')
                            @enderror
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Tel.</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="address_tel">
                            @error('address_tel')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Provincial Address</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <textarea type="text" class="form-control" name="address2"></textarea>
                            @error('address2')
                                @include('errors.validation')
                            @enderror
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Tel.</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="address2_tel">
                            @error('address2_tel')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Manila Address</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">    
                            <textarea type="text" class="form-control" name="address3"></textarea>
                            @error('address3')
                                @include('errors.validation')
                            @enderror
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Tel.</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="address3_tel">
                            @error('address3_tel')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Employer's Information</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Employer's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="emp_name">
                            @error('emp_name')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Occupation</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="occupation">
                            @error('occupation')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Office Address</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <textarea type="text" class="form-control" name="office_address"></textarea>
                            @error('office_address')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Office Tel.</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="office_tel">
                            @error('office_tel')
                                @include('errors.validation')
                            @enderror
                        </div>
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Years w/ Employer</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="yrs_w_employer">
                            @error('yrs_w_employer')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Previous Employer's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="prev_emp_name">
                            @error('prev_emp_name')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Previous Office Address</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <textarea type="text" class="form-control" name="prev_emp_address"></textarea>
                            @error('prev_emp_address')
                                @include('errors.validation')
                            @enderror
                        </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Relative's Information</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Spouse's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="spouse_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Spouse's Occupation</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="spouse_occupation">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Spouse's Employer's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="spouse_emp_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Spouse's Employer's Address</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <textarea type="text" class="form-control" name="spouse_emp_address"></textarea>
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Tel.</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="spouse_emp_tel">
                        </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Father's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="rel1_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Father's Occupation</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="rel1_occupation">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Father's Employer's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="rel1_emp_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Father's Employer's Address</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <textarea type="text" class="form-control" name="rel1_emp_address"></textarea>
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Tel.</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="rel1_emp_tel">
                        </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Mother's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="rel2_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Mother's Occupation</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="rel2_occupation">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Mother's Employer's Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="rel2_emp_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Mother's Employer's Address</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <textarea type="text" class="form-control" name="rel2_emp_address"></textarea>
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Tel.</label>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input type="text" class="form-control" name="rel2_emp_tel">
                        </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Person to Contact In Case of Emergency</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Full Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="em_name">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Relation</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="em_rel">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Home Phone</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="em_contact_home">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Work Phone</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="em_contact_work">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Mobile Phone</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="em_contact_phone">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Address</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <textarea type="text" class="form-control" name="em_address"></textarea>
                        </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Educational Attainment</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">College Name</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="college_uni">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">College Course</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="college_yr">
                        </div>
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Year Graduated</label>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="text" class="form-control" name="college_course">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Highschool Name</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="hs_name">
                        </div>
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Year Graduated</label>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="text" class="form-control" name="hs_yr">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Grade School Name</label>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="gs_name">
                        </div>
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Year Graduated</label>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="text" class="form-control" name="gs_yr">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Masters</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="masters">
                        </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Credit Check</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Bank Name</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="bank_name">
                        </div>
                    <label class="col-lg-1 col-md-1 col-sm-1 col-form-label">Branch</label>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <input type="text" class="form-control" name="bank_branch">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Credit Card</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="cc_card">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Government ID#</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="gov_id">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CCT #</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <input type="text" class="form-control" name="cct_no">
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CCT Place Issued</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="cct_location">
                        </div>
                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CCT Date Issued</label>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="date" class="form-control" name="cct_date">
                        </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Questions</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Where did you find about our apartment?</label>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <textarea rows="5" type="text" class="form-control" name="survey_question"></textarea>
                        </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Upload Documents/ID</h5>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <input multiple="multiple" name="documents[]" type="file">
                        <small id="fileHelp" class="form-text text-muted">Select photos and/or documents to be uploaded. Size of file should not be more than 2MB.</small>
                        @error('documents')
                            @include('errors.validation')
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                <button type="submit" class="btn waves-effect waves-light btn-primary btn-round btn-block">Submit</button>
            </div>
        </div>
    </div>
    </form>
@endsection