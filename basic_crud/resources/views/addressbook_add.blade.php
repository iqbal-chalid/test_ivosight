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

            <form action="/addressbook/exec_add/" method="POST">
                {{ csrf_field() }}

                <div class="container">

                    <div class="row">
                        <div class="col-md-12">

                           <h1>Add Address</h1>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            First Name
                        </div>
                        <div class="col-md-10">
                            : <input name="first_name" value="" type="text">
                        </div>

                        <div class="col-md-2">
                            Last Name
                        </div>
                        <div class="col-md-10">
                            : <input name="last_name" value="" type="text">
                        </div>

                        <div class="col-md-2">
                            Address
                        </div>
                        <div class="col-md-10">
                            : <input name="address" value="" type="textarea">
                        </div>

                        <div class="col-md-2">
                            Email
                        </div>
                        <div class="col-md-10">
                            : <input name="email" value="" type="text">
                        </div>

                        <div class="col-md-2">
                            Contact
                        </div>
                        <div class="col-md-10">
                            : <input name="contact" value="" type="text">
                        </div>

                        <div class="col-md-2">
                            &nbsp;
                        </div>
                        <div class="col-md-10">
                            &nbsp;
                        </div>

                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <button type="button"  onclick="go_back();">Cancel</button>&nbsp;
                            <button type="submit">Save</button>
                        </div>

                    </div>

                   

                </div>

            </form>

            <br/>
            
        </div>

      

        <script>

            function go_back() {
                window.history.back();
            }

            function add_row(param1, param2)
            {
                var row = '';
                row += '<tr>';
                row += '<td><input type="checkbox" name="vehicle" value="Bike" ></td>';
                row += '<td>' + param1 + '</td>';
                row += '<td>' + param2 + '</td>';
                row += '<td>Edit</td>';
                row += '<td>Delete</td>';
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

                        for (var i=0;i<json_response.length;i++)
                        {
                            arow = json_response[i];
                            add_row(arow['nama'], arow['address']);
                        }
                        gresponse = json_response ;

                        // console.log(json_response);
                        // add_row('test', 'parser');


                        
                        


                        
                    }
                    
                }
                xmlHttp.open("GET", "/addressbook/", true); // true for asynchronous 
                xmlHttp.send(null);
            }

            
           
            $( document ).ready(function() {

                // RiotJS
                riot.mount("riottable");

                // Initialisation
                list_addressbook();
                
            });

            
        </script>
</html>
