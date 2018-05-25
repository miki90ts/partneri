@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <article>
            <header>
                <h1 class="pb-2 ">{{$lecture->name}}</h1>
                <table class="table w-25">
                    <tr class="table-info">
                        <td>Vreme</td>
                        <td>{{$lecture->date->toFormattedDateString()}} {{$lecture->time}}
                        </td>
                    </tr>
                    <tr class="table-info">
                        <td>Predavac</td>
                        <td>{{$lecture->fullName}}</td>
                    </tr>
                    <tr class="table-info">
                        <td>Mesto</td>
                        <td>{{$lecture->classroom}}</td>
                    </tr>
                </table>
            </header>
            <div>
                <p>{{$lecture->description}}</p>
            </div>

            @if ($lecture->cv)
            <div>
                <h3>Biografija predavaca</h3>
                <p>
                    @if ($lecture->picture)
                    <img class="float-left p-2" src="{{$lecture->picture}}" alt="slika">
                    @endif
                    {{$lecture->cv}}
                </p>
            </div> 
            @endif
            
        </article>
      
    </div>
</div>
@endsection