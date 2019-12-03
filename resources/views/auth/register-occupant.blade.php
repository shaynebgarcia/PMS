<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('auth-wizard/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('auth-wizard/css/style.css') }}">
</head>
<body>

    <div class="main">

        <div class="container">
            <h2>Occupant Form</h2>
            <form method="POST" id="signup-form" class="signup-form" enctype="multipart/form-data">
                <h3>
                    Tenant
                </h3>
                <fieldset>
                    <div class="form-group">
                        <label for="job" class="label-radio">Request for a tenant code</label>
                            <div class="form-group">
                                <input type="text" name="tenant_code" id="tenant_code" placeholder="Tenant Code" />
                            </div>
                        </div>
                </fieldset>
                <h3>
                    Personal
                </h3>
                <fieldset>
                    <div class="form-row">
                        <div class="form-file">
                            <input type="file" class="inputfile" name="your_picture" id="your_picture"  onchange="readURL(this);" data-multiple-caption="{count} files selected" multiple />
                            <label for="your_picture">
                                <figure>
                                    <img src="{{ asset('auth-wizard/images/your-picture.png') }}" alt="" class="your_picture_image">
                                </figure>
                                <span class="file-button">choose picture</span>
                            </label>
                        </div>
                        <div class="form-group-flex">
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" />
                            </div>
                            {{-- <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Email" />
                            </div> --}}
                        </div>
                    </div>
                </fieldset>

                <h3>
                    Address
                </h3>
                <fieldset>
                    <div class="form-row form-input-flex">
                        <div class="form-input">
                            <input type="text" name="street_name" id="street_name" placeholder="Street Name" />
                        </div>
                        <div class="form-input">
                            <input type="text" name="street_number" id="street_number" placeholder="Street Number" />
                        </div>
                    </div>
                    <div class="form-row form-input-flex">
                        <div class="form-input">
                            <input type="text" name="city" id="city" placeholder="City" />
                        </div>
                        <div class="form-input">
                            <select name="country" id="country">
                                <option value="">Country</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="USA">USA</option>
                            </select>
                            <span class="select-icon"><i class="zmdi zmdi-caret-down"></i></span>
                        </div>
                    </div>
                </fieldset>

                <h3>
                    Employer
                </h3>
                <fieldset>
                    <div class="form-radio">
                        <label for="job" class="label-radio">What are you doing ?</label>
                        <div class="form-flex">
                            <div class="form-radio">
                                <input type="radio" name="job" value="designer" id="designer" />
                                <label for="designer">
                                    <figure>
                                        <img src="{{ asset('auth-wizard/images/icon-1.png') }}" alt="">
                                    </figure>
                                    <span>Designer</span>
                                </label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" name="job" value="coder" id="coder" checked="checked" />
                                <label for="coder">
                                    <figure>
                                        <img src="{{ asset('auth-wizard/images/icon-2.png') }}" alt="">
                                    </figure>
                                    <span>Coder</span>
                                </label>
                            </div>

                            <div class="form-radio">
                                <input type="radio" name="job" value="developer" id="developer" />
                                <label for="developer">
                                    <figure>
                                        <img src="{{ asset('auth-wizard/images/icon-3.png') }}" alt="">
                                    </figure>
                                    <span>Developer</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h3>
                    Relative
                </h3>
                <fieldset>
                </fieldset>

                <h3>
                   Education
                </h3>
                <fieldset>
                </fieldset>

                <h3>
                   Credit Check
                </h3>
                <fieldset>
                </fieldset>

                <h3>
                   Other
                </h3>
                <fieldset>
                </fieldset>

                <h3>
                   Question
                </h3>
                <fieldset>
                </fieldset>

            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('auth-wizard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/js/main.js') }}"></script>
</body>
</html>