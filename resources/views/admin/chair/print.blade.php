<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Report PDF</title>
    @include('admin.layouts.style')
</head>

<body id="page-top">
    <div class="container py-4">
        <div class="row text-center mb-3">
            <h1 class="mb-2">{{ $title }}</h1>
            <h3>Total Data = {{ $chairs->count() }}</h3>
        </div>
        <div class="row">
            <div class="col-md-{{ $column }} mx-auto">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <style>
                            table.table thead tr th:nth-child(1)    , 
                            table.table tbody tr td:nth-child(1){
                                text-align: center
                            }
            
                            table.table tbody tr td{
                                vertical-align: middle !important;
                            }
                        </style>
                        <thead>
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Chair Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chairs as $chair)                
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $chair->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.scriptjs')
</body>

</html>