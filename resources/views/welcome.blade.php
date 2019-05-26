<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coding Challenge</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
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
        <div class="flex-center position-ref full-height">
           

            <div class="content">
                <div class="title m-b-md">
                   <form id="import-form" method="post" action="">
                        <input type="file" id="file" name="csv-file" />
                        <input type="submit" value="IMPORT">
                   </form>
                </div>
                <div class="title m-b-md">
                    <form id="export-form" method="get" action="">
                        <input type="submit" value="EXPORT">
                   </form>
                </div>

            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js" ></script>
        <script>
            $('#import-form').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData($("#import-form")[0]);
                $.ajax(
                    {
                    url: "http://localhost:8000/api/import/entities", 
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        console.log(data);
                    }
                });
            })
            
            $('#export-form').on('submit', function(e){
                e.preventDefault();
                window.location = 'http://localhost:8000/api/export/entities';
            })
        
        </script>
    </body>
</html>
