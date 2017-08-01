<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

      

        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- BootStrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <!-- RiotJS -->
        <script src="https://cdn.jsdelivr.net/g/riot@2.0.12(riot.min.js)"></script>
        <script src="{{ URL::asset('tag/riottable.tag') }}" type="riot/tag" ></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                /* color: #636b6f; */
                color:black;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                /* color: #636b6f; */
                color:black;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="">


            <!-- TABLE -->
            <div class="container">

                <div class="row">
                    <div class="col-md-12">

                       <h1>Address Book</h1>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <!-- BUTTON -->
                        <button onclick="add_address()" class="" style="">Add</button><br/><br/>
                        <!-- BUTTON END -->

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <riottable></riottable>

                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-12">

                      &nbsp;

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <ul class="pagination">
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                        </ul> 

                    </div>
                </div>
            </div>

             
            
            <!-- TABLE END -->

            <br/>
            
        </div>

      
    <!-- RiotJS -->
    <script src="/tag/riottable.tag" type="riot/tag"></script>
    <script src="https://rawgit.com/riot/riot/master/riot%2Bcompiler.min.js"></script>
    <script> riot.mount('riottable') </script>

        <script>

            function add_address()
            {
                window.location.href = '/addressbook/add/';
            }

            function add_row(id, first_name, last_name, address, email, contact)
            {
                var row = '';
                row += '<tr>';
                row += '<td><input type="checkbox" class="checkthis" /></td>';
                row += '<td>' + first_name + '</td>';
                row += '<td>' + last_name + '</td>';
                row += '<td>' + address + '</td>';
                row += '<td>' + email + '</td>';
                row += '<td>' + contact + '</td>';
                row += '<td><a href="/addressbook/change/' + first_name + '/"><span class="glyphicon glyphicon-edit" style="color:blue;"></span></a></td>';
                row += '<td><a href="/addressbook/delete/' + first_name + '/"><span class="glyphicon glyphicon-trash" style="color:red;"></span></a></td>';
                row += '</tr>';

                $('#table_addressbook > tbody:last-child').append( row );
            }       

            var gresponse;

            function list_addressbook()
            {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function() { 
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                    {
                        string_response = xmlHttp.responseText;
                        json_response = JSON.parse(string_response);

                        gresponse  = json_response;

                        for (var i=0;i<json_response.length;i++)
                        {
                            arow = json_response[i];
                            add_row('0', arow['first_name'], arow['last_name'], arow['address'], arow['email'], arow['contact']);
                        }
                        gresponse = json_response ;
                    }
                    
                }
                xmlHttp.open("GET", "/addressbook/", true); // true for asynchronous 
                xmlHttp.send(null);
            }

            
           
            $( document ).ready(function() {

                $("#table_addressbook #checkall").click(function () {
                    if ($("#table_addressbook #checkall").is(':checked')) {
                        $("#table_addressbook input[type=checkbox]").each(function () {
                            $(this).prop("checked", true);
                        });

                    } else {
                        $("#table_addressbook input[type=checkbox]").each(function () {
                            $(this).prop("checked", false);
                        });
                    }
                });

                // RiotJS
                riot.mount("riottable");

                // Initialisation
                list_addressbook();
                
            });

            
        </script>
</html>
