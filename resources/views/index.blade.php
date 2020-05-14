<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Laravel</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
        <style>
            html,
            body {
                background-color: #fff;
                color: #636b6f;
                font-family: "Raleway", sans-serif;
                font-weight: 800;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .row {
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row"></div>
        </div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <!-- Message -->
                @if(Session::has('message'))
                <div class="alert alert-info" role="alert">
                    {{ Session::get('message') }}
                </div>
                @endif
                <h3 id="ShowDays">0</h3>

                <div class="row">
                    <form method="post" action="http://localhost/dre/laravel/public/save">
                        <div class="row">
                            {{ csrf_field() }}

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Start Date:</strong>
                                    @if($userData['edit'])
                                    <input type="date" class="form-control" id="date1" onchange="checkDate()" placeholder="Enter Start Date" name="date1" value='{{ $userData["editData"]->date1 }}' />
                                    @else
                                    <input type="date" class="form-control" id="date1" onchange="checkDate()" placeholder="Enter Start Date" name="date1" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>End Date:</strong>
                                    @if($userData['edit'])
                                    <input type="date" class="form-control" id="date2"  onchange="checkDate()" placeholder="Enter End Date" name="date2" value='{{ $userData["editData"]->date2 }}' />
                                    @else
                                    <input type="date" class="form-control" id="date2"  onchange="checkDate()" placeholder="Enter End Date" name="date2" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                @if($userData['edit'])
                                <input type="hidden" value='{{ $userData["edit"] }}' name="editid" />
                                <input class="btn btn-primary" type="submit" name="submit" id="butsave" value="Update" />
                                @else
                                <input class="btn btn-primary" type="submit" name="submit" id="butsave" value="Submit" />
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <!-- Add/List records -->
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Start</th>
                                <th>End</th>
                                <th>Days</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- List -->
                            @foreach($userData['data'] as $dates)
                            <tr>
                                <td>{{ $dates->date1 }}</td>
                                <td>{{ $dates->date2 }}</td>
                                <td>{{ $dates->day_amt }}</td>
                                <td>
                                    <a class="btn btn-info" href="http://localhost/dre/laravel/public/{{ $dates->id }}"><i class="fa fa-edit"></i></a>
                                    <a href="http://localhost/dre/laravel/public/deleteUser/{{ $dates->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function checkDate() {
                var dt1 = new Date($("#date1").val());
                var dt2 = new Date($("#date2").val());
				var days = diff_hours(dt1, dt2);
				var fieldNameElement= document.getElementById('ShowDays');
               
			   if(isNaN(days)){
				   fieldNameElement.innerHTML =0;
					
			   }else{
				   fieldNameElement.innerHTML =days;
			   }
					
					
					
            }
			
            function diff_hours(dt2, dt1) {
                var diff = (dt2.getTime() - dt1.getTime()) / 1000;
                diff /= 60 * 60;

                var hrs = Math.abs(Math.round(diff));
                var days = hrs / 24;

                return days;
            }

            $(document).ready(function () {
                $("#butsave").on("click", function () {
                    var date1 = $("#date1").val();
                    var date2 = $("#date2").val();
                    if (date1 == "" && date2 == "") {
                        alert("Please fill all the field !");
                    }
                });
            });
        </script>
    </body>
</html>
