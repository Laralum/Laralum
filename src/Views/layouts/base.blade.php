<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="icon" href="{{Aitor24\Linker\Facades\Linker::asset('vendor/laralum/laralum/laralum.ico')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Material design icons -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/1.8.36/css/materialdesignicons.min.css">
    <style>
        .navbar {
            background-color: #3F51B5;
        }
        .sidebar {
            width: 240px;
            background-color: red;
            overflow-y: auto;
            height: calc(100% - 54.5px);
            position: fixed;
            z-index: 400 !important;
        }

        .content {
            margin-top: 54.5px;
        }

        .menu-button {
            font-size: 30px;
            color: black;
        }

        /* Medium and down */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
            .menu-button {
                display: block;
            }
        }

        /* Large and up */
        @media (min-width: 992px) {
            .sidebar {
                display: block !important;
            }
            .menu-button {
                display: none;
            }

            .content {
                margin-left: 240px;
            }
        }

        .sidebar > .sidebar-tabs {
            margin: 20px;
        }

        .sidebar > .sidebar-tabs > .tab {
            display: block;
            margin: 10px 0px 10px 0px;
            color: white;
        }

        .sidebar > .sidebar-tabs > .tab:hover {
            color: white;
            text-decoration: none;
        }

        .sidebar > .sidebar-tabs > .tab:focus {
            color: white;
            text-decoration: none;
        }
    </style>

    @yield('css')

  </head>
  <body>
      <header>
        <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#">
            <img src="{{Aitor24\Linker\Facades\Linker::asset('vendor/laralum/laralum/laralum.ico')}}" width="30" height="30" class="d-inline-block align-top" alt="">
            Laralum
          </a>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <i class="mdi mdi-menu menu-button"></i>
            </ul>
            <span class="navbar-text">
              Navbar text with an inline element

            </span>
          </div>
        </nav>
      </header>
      <div class="sidebar">
          <div class="sidebar-tabs">
              @yield('sidebar-tabs')
          </div>
      </div>
      <div class="content">
          @yield('content')
      </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script>
        $(function() {

            $('.menu-button').click(function() {
                if ($('.sidebar').hasClass('displaying')) {

                        $('.sidebar').removeClass('displaying');
                        $('.sidebar').hide();
                } else {
                    $('.sidebar').show();
                    $('.sidebar').addClass('displaying')
                }
            });
        });
    </script>
    @yield('js')
  </body>
</html>
