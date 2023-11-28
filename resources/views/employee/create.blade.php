@extends('base')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Add Employee</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('employee.index') }}">
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

                <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data" id="employeeForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-control-label">First Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-control-label">Last Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company" class="form-control-label">Company<span style="color: red;">*</span></label>
                                    <select class="form-control" name="company_id" required>
                                        <option value="">Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" pattern="[0-9]{10}" title="Please enter exactly 10 numeric characters.">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Create Employee</button>
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

// 

</script>
@stop