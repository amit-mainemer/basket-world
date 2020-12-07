
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('images/admin1.ico') }}"/>
    <title>Bakset World | Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/cms_style.css') }}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
      <div class="row">
        <div class="col-6">
          <div class="navbar-brand col-sm-3 bg-danger col-md-2 mr-0">
            BASKET </span><i class="fas fa-basketball-ball text-white"></i><span> WORLD <i class="ml-2">Admin Panel</i> 
          </div>
        </div>
        <div class="col-6 mobile-menu">
          <div class="dropdown show rounded text-right pr-1 ml-auto"  id="topnav-menu">
            <a class="btn btn-outline-dark mr-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bars"></i>
            </a>
            <div class="dropdown-menu shadow dropdown-menu-right" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;" 
              href="{{ url('cms/dashboard') }}">
              <i class="fas fa-home mr-2 text-danger"></i> Dashboard
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('cms/menu') }}">
              <i class="fas fa-compass mr-2 text-danger"></i> Menu
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('cms/content') }}">
              <i class="fas fa-file-alt mr-2 text-danger"></i> Content
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('cms/users') }}">
              <i class="fas fa-user mr-2 text-danger"></i> Users
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('cms/categories') }}">
              <i class="fas fa-list mr-2 text-danger"></i> Categories
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('cms/products') }}">
              <i class="fas fa-shopping-cart mr-2 text-danger"></i> Products
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('cms/orders') }}">
              <i class="fas fa-money-check-alt mr-2 text-danger"></i> Orders
              </a>
              <a class="dropdown-item font-title" 
              style="color: black; text-decoration: none;"  
              href="{{ url('') }}">
              <i class="fas fa-sign-out-alt mr-2 text-danger"></i> Back to Site
              </a>
            </div>
          </div>
        </div>
 
      </div>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    

    </li>

    <li class="navbar-nav px-3" style="display: flex;">
      <a class="nav-link text-white" href="{{ url('user/logout') }}"> Logout</a>
    </li>

  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item py-2">
            <a class="nav-link" href="{{ url('cms/dashboard') }}">
              <div class="float-left" style="width: 44px;">
                 <i class="fas fa-home mr-2 fa-lg"></i> 
              </div>
                <div class="float-left ml-auto dash-side">
                  Dashboard
                </div>
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="{{ url('cms/menu') }}">
              <div class="float-left" style="width: 44px;">
                <i class="fas fa-compass mr-2 fa-lg"></i> 
              </div>
                <div class="float-left ml-auto dash-side" >
                  Menu
                </div>
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="{{ url('cms/content') }}">
              <div class="float-left" style="width: 44px;">
                <i class="fas fa-file-alt mr-2 fa-lg"></i> 
              </div>
                <div class="float-left ml-auto dash-side">
                  Content
                </div>
              </a>
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="{{ url('cms/users') }}">
              <div class="float-left" style="width: 44px;">
                <i class="fas fa-user mr-2 fa-lg"></i>
              </div>
                <div class="float-left ml-auto dash-side">
                  Users
                </div>
            </a>
          </li>
          <li class="nav-item py-2" href="{{ url('cms/categories') }}">
            <a class="nav-link" href="{{ url('cms/categories') }}">
              <div class="float-left" style="width: 44px;">
              <i class="fas fa-list mr-2 fa-lg"></i>
            </div>
              <div class="float-left ml-auto dash-side">
                Categories
              </div>
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="{{ url('cms/products') }}">
              <div class="float-left" style="width: 44px;">
                <i class="fas fa-shopping-cart mr-2 fa-lg"></i>
              </div>
              <div class="float-left ml-auto dash-side">
                  Products
              </div>
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="{{ url('cms/orders') }}">
              <div class="float-left" style="width: 44px;">
                <i class="fas fa-money-check-alt mr-2 fa-lg"></i>
              </div>
               <div class="float-left ml-auto dash-side">
                  Orders
              </div>   
            </a>
          </li>
          <div class="mt-1">
          <hr>
         </div>
          <li class="nav-item py-2">
            <a target="_blank" class="nav-link" href="{{ url('') }}">
                
                <div class="float-left" style="width: 44px;">
                  <i class="fas fa-sign-out-alt mr-2 fa-lg"></i> 
                </div>
                <div class="float-left ml-auto dash-side">
                    Back to Site
                </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
   @yield('cms_content')
    </main>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('js/cms_script.js') }}"></script>
@if(Session::has('sm'))
<script>
  toastr.options.positionClass = 'toast-top-right';
  toastr.success('', "{{ Session::get('sm') }}");
</script>
@endif
    </body>
</html>
