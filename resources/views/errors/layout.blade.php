<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
      <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="text-center">
          <div class="error mx-auto" data-text="404">@yield('code')</div>
          <p class="lead text-gray-800 mb-5">@yield('message')</p>
          <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
          <a href="{{route('admin.index')}}">&larr; Back to Dashboard</a>
        </div>
      </div>
    </body>
</html>
