@extends('layouts.user_type.auth')

@section('content')
<style>
    body {
        overflow-y: hidden;
    }
  main {
    background-image: url("../assets/img/g.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    font-weight: bold;

}

    footer{
        margin-top: 350px;
        height: 70px;
        background-color: rgba(245, 244, 242, 0.932);
        border-radius: 4px;
        font-weight: bold;
    }
    #container{
        position: relative;
        left: 10%;
    }
    #container input{
        height: 50px;
        width: 70%;
        border-radius: 10px;

    }
    #container button{
        height: 50px;
        border-radius: 10px;
    }
    #container button{
        background-image: linear-gradient(to right, green 0%, lightgreen 100%);
        color:white;
        padding: 0.375rem 0.75rem;
        /*border-radius: 0.2rem;*/
        border: none;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    #container button:hover {
        background-image: linear-gradient(to right, lightgreen 0%, green 100%);
        color: #ffffff;
        text-decoration: none;
    }

    #container button:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.5);
    }
    #bar {
        height: auto;
        border-radius: 5px;
        background-color: rgba(160, 157, 160, 0.945);
        list-style-type: none;
    }
    #bar a {
        color: rgb(177, 10, 10);
        font-weight: bold;
    }
 
    ul li{
        list-style-type: none;
        color:black
    }
</style>
<h1 style="text-align:center;color:red">Search results</h1>
    <div id="container">
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query"  placeholder="search medicine..........">
            <button type="submit" name="search-btn"  >SEARCH</button>
        </form>
    </div>
    @if (!isset($_GET["search-btn"]) || $pharmacies->isEmpty())
        </br>
        <p style="text-align:center;color:red;font-weight:bold">No pharmacy available</p>
    @else
        @foreach($pharmacies as $pharmacie)
            <br><div id=bar>
                    <ul>
                        <li>
                            <a href="{{ route('infos', ['pharmacie_nom' => $pharmacie->name]) }}">
                                {{ $pharmacie->name }}
                            </a>
                            <ul>
                                @foreach($files as $file)     
                                    <li>
                                        {{ $file->name }}: {{ $file->presentation }}
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
            </div>
        @endforeach
    @endif
@endsection