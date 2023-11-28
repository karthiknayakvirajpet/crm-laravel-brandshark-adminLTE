@extends('base')

@section('content')
<div class="container p-3">
    <div class="justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Employee List</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('employee.create') }}">
                                <button type="button" id="add-expense" class="btn btn-success float-right">Add Employee</button>
                            </a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
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

                <div class="table-responsive pr-3 pl-3 pb-3 pt-3">
                    <table id="employeeTable" class="table table-striped table-bordered table-hover" style="background-color: #FCFCFC;">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--  Data will be dynamically loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    //Loading Data Table
    $('#employeeTable').DataTable({
        //processing: true,
        //serverSide: true,
        ajax: '{{ route('employee.index') }}',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'company.name', name: 'company' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <a href="/edit-employee/${row.id}">
                            <button type="button" class="btn btn-info" data-original-title="" title="Edit" name="edit">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </a>

                        <button type="button" rel="tooltip" class="delete-button btn btn-danger" data-original-title="" title="Delete" name="delete" value="${row.id}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    `;
                }
            }
        ]
    });

    //Delete Employee
    $('#employeeTable').on('click', '.delete-button', function() {
        var value = $(this).val();
        
        swal("Are you sure you want to delete?", {
          dangerMode: true,
          buttons: true,
        }).then((Delete) => 
        {
            if (Delete)
            {
                $.ajax({
                      url: "/delete-employee/" + value,
                      type: 'GET',
                      success: function(){
                          swal({
                            title: "Employee deleted successfully!",
                          }).then(function(){ 
                              location.reload();
                             }
                          );
                      }
                });
            }    
        }).catch(swal.noop);
    });


    //Time out for flash message
    setTimeout(function(){
       $("div.alert.alert-success").remove();
    }, 5000 ); // 8 secs
});
</script>
@stop