<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content={{ csrf_token() }}>
    <title>LagerApp - @yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- CSS -->

    <!--fehlenden Bootstrap stylesheet-link hinzugefügt. Muss vor allen anderen stylesheets stehen! -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="icon"
    type="image/png"
    href="/images/favicon.png">

    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>


{{-- Damit die Navigationsleiste Oben auf der Seite angezeigt wird--}}
     <div id="app" {{$shopId=NULL}}>
<!--center>Maintenance Mode...</center-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><img src="/images/LagerLogoklein.png"></a>
               <!-- Dropdown-Menü für die Optionen: Login, Register,Logout,offene Bestellungen,Versenden,Wareneingang,Reporting,Finance,Configuration und User Management -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar now in the center with mx-auto -->
                    <ul class="navbar-nav mx-auto">
                         <ul class="navbar-nav">
                             {{-- Alle Dropdowns und Buttons der Navbar --}}
                            

                              @can('Orders')
                            <li class="nav-item dropdown btn-outline-info">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        offene Bestellungen
                                    </a>
                                                                         
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($menudata as $menuitem)   
                                            <a class="dropdown-item " href="/menu/{{$menuitem->pickliste}}">{{$menuitem->pickliste}}</a>
                                            <div class="dropdown-divider"></div>
                                        @endforeach
                                            
                                 </div>
                            </li>@endcan


                             @can('Quality')
                             <li class="nav-item dropdown btn-outline-info" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Versenden
                                </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <!--<a class="dropdown-item" href="/quality">Einzelpacket</a>
                                        <div class="dropdown-divider"></div>-->
                                        <a class="dropdown-item" href="/qualitynew">Einzelversand</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/multibox">Mehrpaket</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/shipment-print-again">Label nochmal drucken</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/repair">Reperaturlabel erstellen</a>

                                    </div>
                            </li>@endcan
                            @can('ReceiptB2X')
                            <li class="nav-item dropdown btn-outline-info">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Wareneingang
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/receipt/b2creturn">B2C Retoure</a>
                                     <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/receipt/b2breturn">B2B Retoure</a>
                                    <div class="dropdown-divider"></div>
                                    @endcan
                                    @can('ReceiptInbound')
                                    <a class="dropdown-item" href="/receipt/wareneingang">Wareneingang</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/receipt/umbuchen">Umbuchung</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/receipt/recycle">Entsorgung</a>
                                    <div class="dropdown-divider"></div>
                                    @endcan
                                    @can('ReceiptB2X')
                                    <a class="dropdown-item" href="/receipt/return">Retoure</a>
                                </div>
                            </li>
                              @endcan
                              @can('Inventory')
                              <li class="nav-item dropdown btn-outline-info">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Reporting
                                </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     @can('Inventory') <a class="dropdown-item" href="/inventory">Bestand Hamburg</a> @endcan
                                    @can('Inventory') <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="/inventoryComplete"> Gesamt Bestand</a>@endcan
                                    @can('InventoryAdmin')  <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/receiptexport" >Wareneingang Export</a> @endcan
                                      @can('InventoryAdmin') <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="/sync">Bestellung Synchronisieren</a>@endcan
                                    </div>
                            </li>@endcan

                            @can('Finance')
                              <li class="nav-item dropdown btn-outline-info" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Finance
                                </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/finance">Factoring Export</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/payout">Shopify Payout</a>
                                    </div>
                            </li> @endcan
                              @can('B2B')
                               <li class="nav-item dropdown btn-outline-info" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   B2B
                                </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @endcan
                                        @can('B2BUpload')
                                        <a class="dropdown-item" href="/b2borderform">B2B OrderForm</a>
                                        @endcan
                                        @can('B2BSync')
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/b2bsyncindex">B2B Order Sync</a>
                                    </div>
                             </li>@endcan
                               {{-- @can('Lager')
                              <li class="nav-item">
                                <a class="nav-link btn-outline-info text-dark" href="/reklaportal">Retourenportal</a>
                              </li>@endcan --}}

                        </ul>
                     </ul>
                 </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                          <!-- Logout Config und User Management links-->
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   @can('UserAdmin')
                                    <a class="dropdown-item" href="{{route('admin.users.index')}}">User Management</a>
                                    <div class="dropdown-divider"></div>@endcan
                                    @can('User')
                                    <a class="dropdown-item" href="{{route('admin.druckereinstellungen')}}">Druckereinstellungen</a>
                                    <div class="dropdown-divider"></div>@endcan
                                    @can('UserAdmin')
                                    <a class="dropdown-item" href="/configuration">LagerApp Einstellungen</a>
                                    <div class="dropdown-divider"></div>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                            {{-- <div class="input-box mb-2">
                                <select id="reason" onchange="handleUpdateShopId(event)">
                                    <option value="b2c">B2C </option>
                                    <option value="b2b">B2B </option>
                                    <option value="amazon">Amazon</option>
                                    <option value="reklamation">Reklamation</option>
                                </select>
                            </div> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</head>
<body>
    {{-- puts the Dropdown-menus into hover mode --}}
    <style>
        .dropdown:hover>.dropdown-menu{
            display: block;
        }
    </style>
    <div class="container">
        @yield('content')
    </div>
    <div class="loader d-none" id="loader">
        <img src="/images/loader.svg" />
    </div>
    <div id="content_info">

    </div>

<!-- Govinder 03-04-20 start -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/js/app.js"></script>
<script src="/js/reklaportal.js"></script>
    @stack('scripts')

    @yield('scripts')
</body>
</html>

