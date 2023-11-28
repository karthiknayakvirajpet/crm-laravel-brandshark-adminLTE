@extends('base')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Edit Company</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('company.index') }}">
                                <button type="button" class="btn btn-danger float-right">Back</button>
                            </a>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('company.update', $company->id) }}" method="post" enctype="multipart/form-data" id="companyForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ $company->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ $company->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="logo" class="form-control-label">Logo (Min 100x100px): <span style="font-style: italic;font-size: 11px;"> (*Leave blank if no change)</span></label>
                                    <input type="file" id="logo" class="form-control" name="logo" accept="image/*"><br>
                                    <small id="logoError" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                @if(@$company->logo)
                                <div id="preview">
                                    <label for="image_preview" class="form-control-label">Image Preview</label>
                                    <br/>
                                    <img id="image_preview" width="80%" height="65%" src="{{ asset('storage/' . $company->logo) }}"/>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website" class="form-control-label">Website</label>
                                    <input type="text" class="form-control" name="website" value="{{ $company->website }}" pattern="^(https:\/\/)?([a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?)?$" title="Please enter a valid website URL">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Update Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script type="text/javascript">

//******************************************************
//Validation for Logo size is > 100*100
//******************************************************
document.getElementById('companyForm').addEventListener('submit', function(event) {
    var logoInput = document.getElementById('logo');
    var logoError = document.getElementById('logoError');

    if (logoInput && logoInput.files.length > 0) {
        var file = logoInput.files[0];

        if (file.type.match('image.*')) {
            var img = new Image();

            img.onload = function() {
                if (img.width < 100 || img.height < 100) {
                    logoError.textContent = 'Logo must be at least 100x100 pixels.';
                    event.preventDefault();
                } else {
                    logoError.textContent = '';
                }
            };

            img.src = URL.createObjectURL(file);
        } else {
            logoError.textContent = 'Please select a valid image file.';
            event.preventDefault();
        }
    } 
    // else {
    //     logoError.textContent = 'Please select an image file.';
    //     event.preventDefault();
    // }
});
//******************************************************

</script>
@stop