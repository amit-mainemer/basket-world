<!doctype html>
<html lang="en">
  <head>
    <title>
     {{ $page_title ?? '' }}
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/glider.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <script> const BASE_URL = "{{ url('') }}";</script>
  </head>
  <body>
      <header>
        <nav class="navbar navbar-light bg-white pr-2 border-sm py-0 px-0">
          @if(! Session::has('user_id'))
          <a class="border py-1 px-4"  href="{{ url('user/signup') }}" style="text-decoration: none; color:black;">
            <span>Join Us</span>
          </a>
          @else
          <a class="border py-1 px-4" data-toggle="tooltip" 
          data-placement="bottom"
          title="My Profile"  href="{{ url('user/profile') }}" style="text-decoration: none; color:rgb(32, 31, 31);">
            <i class="fas fa-user"></i>
          </a>
          @endif
          @if(! Session::has('user_id'))
          <a class="border py-1 px-4 ml-auto"  href="{{ url('user/signin') }}" style="text-decoration: none; color:black;">
            <span>Sign In</span>
          </a>
          @else
          <div class="dropdown ml-auto pr-1">
            <button class="btn btn-white text-dark p-0 m-0" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Session::get('user_name') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dropdownMenu2">
              @if(Session::has('is_admin'))
              <a class="dropdown-item" href="{{ url('cms/dashboard') }}" type="button">
                <i class="far fa-chart-bar text-danger mr-2"></i>
                Admin panel
              </a>
              @endif
              <a class="dropdown-item"  href="{{ url('user/profile') }}" type="button">
                <i class="fas fa-user text-danger mr-2"></i>
                My Profile
              </a>
              <a class="dropdown-item"  href="{{ url('user/logout') }}" type="button">
                <i class="fas fa-sign-out-alt text-danger mr-2"></i>
                Logout
              </a>
            </div>
          </div>
          @endif
          <a class="cart-link text-dark px-3" data-toggle="tooltip" 
          data-placement="bottom"
          title="Go to cart" href="{{ url('shop/cart')}} ">
            @if(!Cart::isEmpty())
          <div class="total-items-in-cart">{{ Cart::getTotalQuantity() }}</div>
            @endif
          <i class="fas fa-shopping-cart"></i>
          </a>
        </nav>

      <nav class="border bg-white text-dark">
        <div class="row py-3 px-0 m-0">
          <div class="col-lg-2 col-8">
            <a 
              style="color: black; text-decoration: none;"
              class="navbar-brand font-title pl-3"
              href="{{ url('/') }}">
              <span>
                 BASKET </span><i class="fas fa-basketball-ball text-danger"></i><span> WORLD
              </span> 
            </a>   
          </div>
          <div class="col-lg-8 col-1">
              <ul style="display: flex;
                align-items: center;
                justify-content: center;
                text-align:center;
                flex-direction: row;
                align-content: space-evenly;
                list-style-type: none;
                margin: 0 auto;
                padding: 8px 0;"
                id="topnav-ul">
                <li class="px-4">
                <a 
                class="font-title" 
                style="color: black; text-decoration: none;"
                href="{{ url('shop') }}">
                <b>Shop</b>
                </a>
                </li>
                @if(!empty($categories))
                @foreach($categories as $category)
                <li class="px-4">
                  <a 
                  class="font-title"
                  style="color: black; text-decoration: none;"
                  href="{{ url('shop/' . $category['curl']) }}">
                  <b>{{$category['ctitle']}}</b>
                  </a>
                  </li>
                @endforeach
                @endif
                @if(!empty($menu))
                @foreach($menu as $menu_item)
                <li class="px-4">
                  <a class="font-title" style="color: black; text-decoration: none;" href="{{ url($menu_item['url']) }}">
                  <b>{{ $menu_item['link'] }}</b>
                  </a>
                  </li>
                @endforeach
                @endif
              </ul>
          </div>
          <div class="col-lg-2 col-3">
            <div class="form-inline my-2 my-lg-0 mr-2" id="topnav-search">
              <div class="input-group" id="search-div">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="search" id="search-bar" class="form-control" placeholder="Search Proudct" aria-label="Username" aria-describedby="basic-addon1">
              </div>
            </div>
              <div class="dropdown show rounded text-right pr-1"  id="topnav-menu">
                <a class="btn btn-outline-dark mr-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bars"></i>
                </a>
                <div class="dropdown-menu shadow dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                  @if(!empty($categories))
                  @foreach($categories as $category)
                  <a class="dropdown-item font-title" 
                  style="color: black; text-decoration: none;" 
                  href="{{ url('shop/' . $category['ctitle']) }}">
                  {{ $category['ctitle'] }}</a>
                  @endforeach
                  @endif
                  @if(!empty($menu))
                  @foreach($menu as $menu_item)
                    <a class="dropdown-item font-title" 
                    style="color: black; text-decoration: none;"  
                    href="{{ url($menu_item['url']) }}">
                    {{ $menu_item['link'] }}</a>
                  @endforeach
                  @endif
                </div>
              </div>
          </div>
        </div>  
      </nav>
      </header>
      <main style="min-height: 900px;">
      @yield('main_content')
      </main>
      <footer class="bg-white border-top p-3 mt-5">
      <p class="mb-0 text-center"> BASKET WORLD &copy; {{ date('Y') }} </p>
      </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('js/glider.min.js')}}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @if(Session::has('sm'))
    <script>
      toastr.options.positionClass = 'toast-top-right';
      toastr.success(null, "{{ Session::get('sm') }}", { timeOut: 2500, fadeAway: 500 });
    </script>
    @endif
  </body>
</html>