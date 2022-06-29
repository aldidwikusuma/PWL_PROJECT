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
            <h3>Total Data = {{ $schedules->count() }}</h3>
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
                                <th scope="col">Nomer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time - End Playing</th>
                                <th scope="col">Film</th>
                                <th scope="col">Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)                
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ $schedule->time }} - {{ $schedule->endtime }}</td>
                                    <td>{{ $schedule->film->title }}</td>
                                    <td>{{ $schedule->room->name }}</td>
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