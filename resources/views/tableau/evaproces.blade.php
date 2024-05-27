@extends('app')

@section('titre', 'Tableau evaluation')

@section('option_btn')

    <li class="dropdown chats-dropdown">
        <a href="{{ route('index_accueil') }}" class="dropdown-toggle nk-quick-nav-icon">
            <div class="icon-status icon-status-na">
                <em class="icon ni ni-home"></em>
            </div>
        </a>
    </li>

@endsection

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content" style="margin:0px auto;">
                                <h3 class="text-center">
                                    <span>Tableau d'evaluation</span>
                                    <em class="icon ni ni-list-index"></em>
                                </h3>
                            </div>
                        </div>
                    </div>

                    @if( intval($color_para->nbre_color) > intval($color_interval_nbre) )
                        <div class="nk-block">
                            <div class="row g-gs">
                                <div class="col-lg-12 col-xxl-12 bg-white">
                                    <div class="modal-content">
                                        <div class="modal-body modal-body-lg text-center">
                                            <div class="nk-modal">
                                                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning"></em>
                                                <h4 class="nk-modal-title">
                                                    Paraméttrage des couleurs non complet
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $isOutOfRange = false;
                            $maxValue = ($color_para->operation === 'addition') ? (intval($color_para->nbre2) + intval($color_para->nbre2)) : (intval($color_para->nbre2) * intval($color_para->nbre2));
                        @endphp

                        @for ($i = 1; $i <= $maxValue; $i++)
                            @php
                                $isInInterval = false;
                            @endphp

                            @foreach($color_intervals as $color_interval)
                                @if ($i >= $color_interval->nbre1 && $i <= $color_interval->nbre2)
                                    @php
                                        $isInInterval = true;
                                        break; // Sortir de la boucle dès qu'un intervalle correspond
                                    @endphp
                                @endif
                            @endforeach

                            @unless($isInInterval)
                                @if($i)
                                    @php
                                        $isOutOfRange = true;
                                    @endphp
                                @endif
                            @endunless
                        @endfor

                        @if($isOutOfRange)
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-lg-12 col-xxl-12 bg-white">
                                        <div class="modal-content">
                                            <div class="modal-body modal-body-lg text-center">
                                                <div class="nk-modal">
                                                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning"></em>
                                                    <h4 class="nk-modal-title">
                                                        Paraméttrage des couleurs non complet
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <table class="datatable-init table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Processus</th>
                                                            <th>nombre de risques</th>
                                                            <th>Evaluation Gbobale</th>
                                                            <th>Couleur</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($processus as $key => $processu)
                                                            <tr>
                                                                <td>{{ $key+1}}</td>
                                                                <td>{{ $processu->nom}}</td>
                                                                <td>{{ $processu->nbre_risque}}</td>
                                                                <td>
                                                                    {{ $processu->evag }}
                                                                </td>
                                                                @php
                                                                    $colorMatchFound = false;
                                                                @endphp

                                                                @foreach($color_intervals as $color_interval)
                                                                    @if($color_interval->nbre1 <= $processu->evag  && $color_interval->nbre2 >= $processu->evag )
                                                                        <td>
                                                                            <div class="user-avatar" style="background-color:{{$color_interval->code_color}}">
                                                                            </div>
                                                                        </td>
                                                                        @php
                                                                            $colorMatchFound = true;
                                                                        @endphp
                                                                        @break
                                                                    @endif
                                                                @endforeach

                                                                @if(!$colorMatchFound)
                                                                    <td>
                                                                        <div class="user-avatar" style="background-color:#8e8e8e;">
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalDetail{{$processu->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

@foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{$processu->id}}">
            <div class="modal-dialog modal-sm" role="document" style="width: 75%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block" >
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">Evaluation Globale</h5>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label " for="Cause">
                                                                Processus : {{$processu->nom}}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                @php
                                                                    $colorMatchFound0 = false;
                                                                @endphp

                                                                @foreach($color_intervals as $color_interval)
                                                                    @if($color_interval->nbre1 <= $processu->evag && $color_interval->nbre2 >= $processu->evag)
                                                                        <input value="{{ $processu->evag }}" disabled type="text"
                                                                            class="form-control border-white text-center " id="Cause" style="background-color:{{$color_interval->code_color}}" >
                                                                        @php
                                                                            $colorMatchFound0 = true;
                                                                        @endphp
                                                                        @break
                                                                    @endif
                                                                @endforeach

                                                                @if(!$colorMatchFound0)
                                                                    <input value="{{ $processu->evag }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause" style="background-color:#8e8e8e;" >
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">Evaluation des Risques</h5>
                                                </div>
                                                <div class="row g-4">
                                                    @if ($processu->evag > 0 )
                                                        @foreach ($risquesData[$processu->id] as $risqueData)
                                                        <div class="col-lg-12">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="Cause">
                                                                    Risque : {{ $risqueData['nom'] }}
                                                                </label>
                                                                <div class="form-control-wrap">

                                                                    @php
                                                                        $colorMatchFound1 = false;
                                                                    @endphp

                                                                    @foreach($color_intervals as $color_interval)
                                                                        @if($color_interval->nbre1 <= $risqueData['evaluation_residuel'] && $color_interval->nbre2 >= $risqueData['evaluation_residuel'])
                                                                            <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" class="form-control border-white text-center " id="Cause" style="background-color:{{$color_interval->code_color}}" >
                                                                            @php
                                                                                $colorMatchFound1 = true;
                                                                            @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach

                                                                    @if(!$colorMatchFound1)
                                                                        <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" class="form-control border-white text-center " id="Cause" style="background-color:#8e8e8e;" >
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @elseif ($processu->evag === 0 )
                                                        <div class="col-lg-12">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="Cause">
                                                                    Aucun risque
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endforeach

@endsection
