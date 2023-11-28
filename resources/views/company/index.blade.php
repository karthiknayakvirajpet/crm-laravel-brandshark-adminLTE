@extends('base')

@section('content')
<div class="container p-3">
    <div class="justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Company List</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('company.create') }}">
                                <button type="button" id="add-expense" class="btn btn-success float-right">Add Company</button>
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
                    <table id="companyTable" class="table table-striped table-bordered table-hover" style="background-color: #FCFCFC;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be dynamically loaded here -->
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
    $('#companyTable').DataTable({
        //processing: true,
        //serverSide: true,
        ajax: '{{ route('company.index') }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            {
                data: 'logo',
                name: 'logo',
                render: function (data, type, full, meta) {
                    if (type === 'display') {
                        return '<img src="storage/' + data + '" width="100%" height="100%">';
                    }
                    return data;
                }
            },
            { data: 'website', name: 'website' },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <a href="/edit-company/${row.id}">
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

    //Delete Company
    $('#companyTable').on('click', '.delete-button', function() {
        var value = $(this).val();
        
        swal("Are you sure you want to delete?", {
          dangerMode: true,
          buttons: true,
        }).then((Delete) => 
        {
            if (Delete)
            {
                $.ajax({
                      url: "/delete-company/" + value,
                      type: 'GET',
                      success: function(){
                          swal({
                            title: "Company deleted successfully!",
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