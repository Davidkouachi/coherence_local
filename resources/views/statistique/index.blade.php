@extends('app')

@section('titre', 'Statistique')

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
                                <span>Statistique</span>
                                <em class="icon ni ni-bar-chart-alt"></em>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">

                        <div class="col-md-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-0">
                                        <div class="card-title">
                                            <h5>
                                                Données
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="invest-data mt-2">
                                        <div class="invest-data-amount row g-2">
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Processus
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_processus }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Risques
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_risque }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Causes
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_cause }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Incidents
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_am }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Actions préventives
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_ap }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Actions correctives
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_ac }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Utilisateurs
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_user }}
                                                </div>
                                            </div>
                                            <div class="invest-data-history col-md">
                                                <div class="amount ">
                                                    Postes
                                                </div>
                                                <div class="amount mt-1 ">
                                                    {{ $nbre_poste }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php 
                            $maxProgress = 0;
                        @endphp

                        @foreach ($statistics as $type => $stat)
                            @php 
                                $maxProgress = max($maxProgress, $stat['progres']);
                            @endphp
                        @endforeach

                        <div class="col-lg-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner row g-gs">
                                    <div class="card-amount">
                                        <h5>
                                            <span class="me-2" >
                                                Type d'incidents
                                            </span>
                                            <em class="ni ni-share-alt"></em>
                                        </h5>
                                    </div>
                                @foreach ($statistics as $type => $stat)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner">
                                                <div class="card-amount">
                                                    <h5 class="">
                                                        @if ($type === 'non_conformite_interne')
                                                            Non conformité Interne
                                                        @endif
                                                        @if ($type === 'reclamation')
                                                            Réclamation
                                                        @endif
                                                        @if ($type === 'contentieux')
                                                             Contentieux
                                                        @endif
                                                        <span class="currency currency-usd ">
                                                            {{$stat['total']}} 
                                                            <span class="{{ $stat['progres'] === $maxProgress ? 'text-danger' : '' }} " >
                                                                ({{$stat['progres']}}%)
                                                            </span>
                                                        </span>
                                                    </h5>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title text-center">
                                                                Cause(s)
                                                            </div>
                                                            <div class="amount text-center">
                                                                {{ $stat['causes'] }}
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title text-center">
                                                                Risque(s)
                                                            </div>
                                                            <div class="amount text-center">
                                                                {{ $stat['risques'] }}
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title text-center">
                                                                Néant
                                                            </div>
                                                            <div class="amount text-center">
                                                                {{ $stat['causes_risques_nt'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <canvas id="myChart{{$type}}"></canvas>
                                                </div>

                                                <script>
                                                    var ctx{{ $type }} = document.getElementById('myChart{{ $type }}').getContext('2d');
                                                    var myChart{{ $type }} = new Chart(ctx{{ $type }}, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: ['Causes', 'Risques', 'Néant'],
                                                            datasets: [{
                                                               label: 'Histogramme',
                                                                data: [{{ $stat['causes'] }}, {{ $stat['risques'] }}, {{ $stat['causes_risques_nt'] }}],
                                                                backgroundColor: [
                                                                    'blue',
                                                                    'red',
                                                                    'orange'], // Couleur de remplissage du graphique
                                                                borderColor: 'white', // Couleur de la bordure du graphique
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true,
                                                                    ticks: {
                                                                        stepSize: 10 // L'intervalle entre chaque étiquette sur l'axe Y
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner row g-gs">
                                    <div class="card-amount">
                                        <h5>
                                            <span class="me-2" >
                                                Recherche
                                            </span>
                                            <em class="ni ni-search"></em>
                                        </h5>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="cf-full-name">Processus</label>
                                                    <select name="processus_id" class="form-select text-center" id="selectProcessus">
                                                        @foreach ($processus as $processus)
                                                        <option value="{{$processus->id}}">
                                                            {{$processus->nom}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="camenber"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="cf-full-name">Risque</label>
                                                    <select name="risque_id" class="form-select text-center" id="selectRisque">
                                                        @foreach ($risques as $risque)
                                                        <option value="{{$risque->id}}">
                                                            {{$risque->nom}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="camenber_risk"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner">
                                                <div class="form-group text-center">
                                                    <label class="form-label">Choisir un interval de date</label>
                                                    <div class="form-control-wrap">
                                                        <div class="input-daterange date-picker-range input-group">
                                                            <input data-date-format="yyyy-mm-dd" name="date1" id="date1" type="text" class="form-control"  value="{{ \Carbon\Carbon::now()->subMonth()->format('m/d/Y') }}"/>
                                                            <div class="input-group-addon">au</div>
                                                            <input data-date-format="yyyy-mm-dd" name="date2" id="date2" type="text" class="form-control me-2"  value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}"/>
                                                            <button id="btn_rech" class="btn btn-outline-success">
                                                                <em class="ni ni-search"></em>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="camenber2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group mb-1">
                                        <div class="card-title">
                                            <h6 class="title">
                                                Vue d'ensemble des incidents ({{ $nbre_am }})
                                            </h6>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#type">
                                                Type 
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#incident">
                                                Statuts 
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-0">
                                        <div class="tab-pane active" id="type" >
                                            <div class="invest-ov gy-2" >
                                                <div class="card-inner d-flex flex-column ">
                                                    <div class="progress-list gy-3">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Non conformité Interne ({{$nbre_am_nci}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($nbre_am_nci / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $tam_nci = number_format(($nbre_am_nci / $nbre_am)*100 , 0);
                                                                    }else{ $tam_nci = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-primary" data-progress="{{$tam_nci}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Réclamations ({{$nbre_am_r}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($nbre_am_r / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $tam_r = number_format(($nbre_am_r / $nbre_am)*100 , 0);
                                                                    }else{ $tam_r = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-danger" data-progress="{{$tam_r}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Contentieux ({{$nbre_am_c}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($nbre_am_c / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $tam_c = number_format(($nbre_am_c / $nbre_am)*100 , 0);
                                                                    }else{ $tam_c = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-warning" data-progress="{{$tam_c}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="incident" >
                                            <div class="invest-ov gy-2" >
                                                <div class="card-inner d-flex flex-column ">
                                                    <div class="progress-list gy-3">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Soumis ({{$staut_am_soumis}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($staut_am_soumis / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $sam_soumis = number_format(($staut_am_soumis / $nbre_am)*100 , 0);
                                                                    }else{ $sam_soumis = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-warning" data-progress="{{$sam_soumis}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Rejeter ({{$staut_am_rejeter}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($staut_am_rejeter / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $sam_rejeter = number_format(($staut_am_rejeter / $nbre_am)*100 , 0);
                                                                    }else{ $sam_rejeter = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-danger" data-progress="{{$sam_rejeter}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Valider ({{$staut_am_valider}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($staut_am_valider / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $sam_valider = number_format(($staut_am_valider / $nbre_am)*100 , 0);
                                                                    }else{ $sam_valider = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-primary" data-progress="{{$sam_valider}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Evaluation éfficacitée en cours  ({{$staut_am_eff}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($staut_am_eff / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $sam_eff = number_format(($staut_am_clotu / $nbre_am)*100 , 0);
                                                                    }else{ $sam_eff = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-warning" data-progress="{{$sam_eff}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Clôturé ({{$staut_am_clotu}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_am != 0)
                                                                        {{ number_format(($staut_am_clotu / $nbre_am)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_am != 0) {
                                                                       $sclotu = number_format(($staut_am_clotu / $nbre_am)*100 , 0);
                                                                    }else{ $sclotu = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-success" data-progress="{{$sclotu}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group mb-1">
                                        <div class="card-title">
                                            <h6 class="title">
                                                Vue d'ensemble des risques ({{ $nbre_risque }})
                                            </h6>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#statutr">
                                                Statuts
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-bs-toggle="tab" href="#ap">
                                                Action préventives ({{ $nbre_ap }})
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-0">
                                        <div class="tab-pane active" id="statutr">
                                            <div class="invest-ov gy-2" >
                                                <div class="card-inner d-flex flex-column ">
                                                    <div class="progress-list gy-3">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Soumis ({{$nbre_ris_soumis}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_risque != 0)
                                                                        {{ number_format(($nbre_ris_soumis / $nbre_risque)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_risque != 0) {
                                                                       $sris_soumis = number_format(($nbre_ris_soumis / $nbre_risque)*100 , 0);
                                                                    }else{ $sris_soumis = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-warning" data-progress="{{$sris_soumis}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Rejeter ({{$nbre_ris_n_valider}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_risque != 0)
                                                                        {{ number_format(($nbre_ris_n_valider / $nbre_risque)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_risque != 0) {
                                                                       $sris_n_valider = number_format(($nbre_ris_n_valider / $nbre_risque)*100 , 0);
                                                                    }else{ $sris_n_valider = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-danger" data-progress="{{$sris_n_valider}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Valider ({{$nbre_ris_valider}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_risque != 0)
                                                                        {{ number_format(($nbre_ris_valider / $nbre_risque)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_risque != 0) {
                                                                       $sris_valider = number_format(($nbre_ris_valider / $nbre_risque)*100 , 0);
                                                                    }else{ $sris_valider = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-success" data-progress="{{$sris_valider}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="tab-pane " id="ap">
                                            <div class="invest-ov gy-2" >
                                                <div class="card-inner d-flex flex-column ">
                                                    <div class="progress-list gy-3">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Suivi non éffectuée ({{$nbre_action_neff}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_action != 0)
                                                                        {{ number_format(($nbre_action_neff / $nbre_action)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_action != 0) {
                                                                       $naction_neff = number_format(($nbre_action_neff / $nbre_action)*100 , 0);
                                                                    }else{ $naction_neff = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-warning" data-progress="{{$naction_neff}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">
                                                                    Suivi éffectuée ({{$nbre_action_eff}})
                                                                </div>
                                                                <div class="progress-amount">
                                                                    @if($nbre_action != 0)
                                                                        {{ number_format(($nbre_action_eff / $nbre_action)*100 , 2) }} %
                                                                    @else
                                                                        0.00 %
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                @php
                                                                    if ($nbre_action != 0) {
                                                                       $naction_eff = number_format(($nbre_action_eff / $nbre_action)*100 , 0);
                                                                    }else{ $naction_eff = '0';  }
                                                                @endphp
                                                                <div class="progress-bar bg-success" data-progress="{{$naction_eff}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card card-bordered h-100">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">
                                                Historiques
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="timeline">
                                        <h6 class="timeline-head">
                                            10 dernières actions
                                        </h6>
                                        <ul class="timeline-list" style="height: 250px;" data-simplebar="" >
                                            @foreach ($his as $hi)
                                            <li class="timeline-item">
                                                <em class="icon ni ni-calendar-alt text-primary "></em>
                                                <div class="timeline-date">
                                                    {{ \Carbon\Carbon::parse($hi->created_at)->translatedFormat('j F Y') }}
                                                </div>
                                                <div class="timeline-data">
                                                    <h6 class="timeline-title">
                                                        {{$hi->nom_formulaire}}
                                                    </h6>
                                                    <div class="timeline-des">
                                                        <p>
                                                            <span class="timeline-title" >
                                                                Action :
                                                            </span>
                                                            {{$hi->nom_action}}.
                                                        </p>
                                                        <span class="time">
                                                            <em class="icon ni ni-alarm-alt"></em>
                                                            {{ \Carbon\Carbon::parse($hi->created_at)->translatedFormat('H:i:s') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group mb-1">
                                        <div class="card-title">
                                            <h6 class="title">
                                                Nombre d'apparition des processus, risques et causes en fontion des types d'incidents
                                            </h6>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#pro">
                                                Processus
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#ris">
                                                Risques
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#cau">
                                                Causes
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-0">
                                        <div class="tab-pane active" id="pro">
                                            <div class="card-inner">
                                                <table class="datatable-init table">
                                                    <thead>
                                                        <tr>
                                                            <th>Processus</th>
                                                            <th>Non conformité interne</th>
                                                            <th>Réclamation</th>
                                                            <th>Contentieux</th>
                                                            <th class="text-danger">
                                                                Evaluation globale
                                                            </th>
                                                            <th>Couleur</th>
                                                            <th>Date de création</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($types_processus as $types_pro)
                                                        <tr>
                                                            <td>{{$types_pro->nom}}</td>
                                                            <td>{{$types_pro->nbre_nci}}</td>
                                                            <td>{{$types_pro->nbre_r}}</td>
                                                            <td>{{$types_pro->nbre_c}}</td>
                                                            <td>
                                                                {{ $types_pro->evag }}
                                                            </td>
                                                            @php
                                                                $colorMatchFound = false;
                                                            @endphp

                                                            @foreach($color_intervals as $color_interval)
                                                                @if($color_interval->nbre1 <= $types_pro->evag  && $color_interval->nbre2 >= $types_pro->evag )
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
                                                                {{ \Carbon\Carbon::parse($types_pro->created_at)->translatedFormat('j F Y '.' à '.' H:i:s') }}
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger " data-bs-toggle="dropdown" aria-expanded="true">
                                                                                <em class="icon ni ni-more-h"></em>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" data-popper-reference-hidden="">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li>
                                                                                        <a data-bs-toggle="modal" data-bs-target="#modalRisque{{$types_pro->id}}">
                                                                                            <em class="icon ni ni-hot-fill"></em>
                                                                                            <span>Risques associés</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a data-bs-toggle="modal" data-bs-target="#modalDetail{{$types_pro->id}}">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Voir détails</span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="ris">
                                            <div class="card-inner">
                                                <table class="datatable-init table">
                                                    <thead>
                                                        <tr>
                                                            <th>Risque</th>
                                                            <th>Non conformité interne</th>
                                                            <th>Réclamation</th>
                                                            <th>Contentieux</th>
                                                            <th class="text-danger">
                                                                Evaluation
                                                            </th>
                                                            <th>Coût</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($types_risque as $value)
                                                        <tr>
                                                            <td>{{$value->nom}}</td>
                                                            <td>{{$value->nbre_nci}}</td>
                                                            <td>{{$value->nbre_r}}</td>
                                                            <td>{{$value->nbre_c}}</td>
                                                            @php
                                                                $colorMatchFound = false;
                                                            @endphp

                                                            @foreach($color_intervals as $color_interval)
                                                                @if($color_interval->nbre1 <= $value->evaluation_residuel && $color_interval->nbre2 >= $value->evaluation_residuel)
                                                                    <td>
                                                                        <div class="user-avatar sm" style="background-color:{{$color_interval->code_color}}" ></div>
                                                                    </td>
                                                                    @php
                                                                        $colorMatchFound = true;
                                                                    @endphp

                                                                    @break

                                                                @endif

                                                            @endforeach

                                                            @if(!$colorMatchFound)
                                                                <td>
                                                                    <div class="user-avatar sm" style="background-color:#8e8e8e;"></div>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @php
                                                                    $cout = $value->cout_residuel;
                                                                    $formatcommande = number_format($cout, 0, '.', '.');
                                                                @endphp
                                                                {{ $formatcommande }} Fcfa
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger " data-bs-toggle="dropdown" aria-expanded="true">
                                                                                <em class="icon ni ni-more-h"></em>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" data-popper-reference-hidden="">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li>
                                                                                        <a data-bs-toggle="modal" data-bs-target="#modalDetailrisque{{$value->id}}">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Voir détails</span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="cau">
                                            <div class="card-inner">
                                                <table class="datatable-init table">
                                                    <thead>
                                                        <tr>
                                                            <th>Cause</th>
                                                            <th>Non conformité interne</th>
                                                            <th>Réclamation</th>
                                                            <th>Contentieux</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($types_cause as $value)
                                                        <tr>
                                                            <td>{{$value->nom}}</td>
                                                            <td>{{$value->nbre_nci}}</td>
                                                            <td>{{$value->nbre_r}}</td>
                                                            <td>{{$value->nbre_c}}</td>
                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger " data-bs-toggle="dropdown" aria-expanded="true">
                                                                                <em class="icon ni ni-more-h"></em>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" data-popper-reference-hidden="">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li>
                                                                                        <a data-bs-toggle="modal" data-bs-target="#modalDetailcause{{$value->id}}">
                                                                                            <em class="icon ni ni-eye"></em>
                                                                                            <span>Voir détails</span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($types_processus as $types_pro)
<div class="modal fade zoom" tabindex="-1" id="modalRisque{{$types_pro->id}}">
    <div class="modal-dialog modal-sm" role="document" style="width: 75%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="nk-block">
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
                                                    Processus : {{$types_pro->nom}}
                                                </label>
                                                <div class="form-control-wrap">
                                                    @php
                                                    $colorMatchFound0 = false;
                                                    @endphp
                                                    @foreach($color_intervals as $color_interval)
                                                    @if($color_interval->nbre1 <= $types_pro->evag && $color_interval->nbre2 >= $types_pro->evag)
                                                        <input value="{{ $types_pro->evag }}" disabled type="text" class="form-control border-white text-center " id="Cause" style="background-color:{{$color_interval->code_color}}">
                                                        @php
                                                        $colorMatchFound0 = true;
                                                        @endphp
                                                        @break
                                                        @endif
                                                        @endforeach
                                                        @if(!$colorMatchFound0)
                                                        <input value="{{ $types_pro->evag }}" disabled type="text" class="form-control border-white text-center " id="Cause" style="background-color:#8e8e8e;">
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
                                        @if ($types_pro->evag > 0 )
                                        @foreach ($risqsData[$types_pro->id] as $risqueData)
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
                                                        <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" class="form-control border-white text-center " id="Cause" style="background-color:{{$color_interval->code_color}}">
                                                        @php
                                                        $colorMatchFound1 = true;
                                                        @endphp
                                                        @break
                                                        @endif
                                                        @endforeach
                                                        @if(!$colorMatchFound1)
                                                        <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" class="form-control border-white text-center " id="Cause" style="background-color:#8e8e8e;">
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @elseif ($types_pro->evag === 0 )
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

@foreach ($types_processus as $types_pro)
<div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $types_pro->id }}">
    <div class="modal-dialog modal-md" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
            </div>
            <div class="modal-body">
                <form class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-12 col-xxl-12" id="groupesContainer">
                            <div class="">
                                <div class="card-inner">
                                    <div class="gy-3">
                                        <div class="row g-1 align-center">
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-3">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Processus
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            : {{ $types_pro->nom }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-3">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Finalité
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            : {{ $types_pro->finalite }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($objectifData[$types_pro->id] as $key => $objectifDat)
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-3">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Objectif {{$key+1}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            : {{ $objectifDat['objectif'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-3">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Description
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            : {{ $types_pro->description }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

@foreach ($types_risque as $value)
<div class="modal fade zoom" tabindex="-1" id="modalDetailrisque{{ $value->id }}">
    <div class="modal-dialog modal-md" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
            </div>
            <div class="modal-body">
                <form class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card" style="background: transparent; ">
                                <div class="card-inner">
                                    <div class="gy-3">
                                        <div class="row g-1 align-center">
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Risque :
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            {{ $value->nom }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Processus :
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            {{ $value->nom_processus }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="page-break-inside: avoid; margin-top: -10px;">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card" style="background: transparent;">
                                    <div class="card-inner">
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 17px;">
                                                                Evaluation risque sans dispositif de contrôle interne ou dispositif antérieur
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Vraisemblence :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->vraisemblence }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Gravité :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->gravite }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Evaluation :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->evaluation }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Coût :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $cout = $value->cout;
                                                    $formatcommande = number_format($cout, 0, '.', '.');
                                                    @endphp
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $formatcommande }} Fcfa
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                @php
                                                                $colorFound = false;
                                                                @endphp
                                                                @foreach($color_intervals as $color_interval)
                                                                @if($color_interval->nbre1 <= $value->evaluation && $value->evaluation <= $color_interval->nbre2)
                                                                        <div class="user-avatar" style="background-color:{{$color_interval->code_color}}"></div>
                                                                        @php
                                                                        $colorFound = true;
                                                                        break;
                                                                        @endphp
                                                                        @endif
                                                                        @endforeach
                                                                        @if(!$colorFound)
                                                                        <div class="user-avatar" style="background-color:#8e8e8e"></div>
                                                                        @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($causesData[$value->id] as $key => $causesDatas)
                        <div style="page-break-inside: avoid; margin-top: -10px;">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card" style="background: transparent;">
                                    <div class="card-inner">
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 17px;">
                                                                Cause Probable {{$key+1}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Cause :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $causesDatas['cause'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Dispositif :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $causesDatas['dispositif'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div style="page-break-inside: avoid; margin-top: -10px;">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card" style="background: transparent;">
                                    <div class="card-inner">
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 17px;">
                                                                Evaluation risque avec dispositif de contrôle interne actuel
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Vraisemblence :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->vraisemblence_residuel }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Gravité :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->gravite_residuel }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Evaluation :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->evaluation_residuel }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Coût :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $cout2 = $value->cout_residuel;
                                                    $formatcommande2 = number_format($cout2, 0, '.', '.');
                                                    @endphp
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $formatcommande2 }} Fcfa
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Traitement :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->traitement }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                @php
                                                                $colorFound = false;
                                                                @endphp
                                                                @foreach($color_intervals as $color_interval)
                                                                @if($color_interval->nbre1 <= $value->evaluation_residuel && $value->evaluation_residuel <= $color_interval->nbre2)
                                                                        <div class="user-avatar" style="background-color:{{$color_interval->code_color}}"></div>
                                                                        @php
                                                                        $colorFound = true;
                                                                        break;
                                                                        @endphp
                                                                        @endif
                                                                        @endforeach
                                                                        @if(!$colorFound)
                                                                        <div class="user-avatar" style="background-color:#8e8e8e"></div>
                                                                        @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($actionsDatap[$value->id] as $key => $actionsDatas)
                        <div style="page-break-inside: avoid; margin-top: -10px;">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card" style="background: transparent;">
                                    <div class="card-inner">
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 17px;">
                                                                Action Preventive {{$key+1}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Action :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $actionsDatas['action'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Délai de traitement :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ \Carbon\Carbon::parse($actionsDatas['delai'])->translatedFormat('j F Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Responsable :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $actionsDatas['responsable'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($actionsDatas['suivi'] === 'oui')
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Statut :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            @if($actionsDatas['date_action'] != null)
                                                            @if($actionsDatas['date_action'] <= $actionsDatas['delai']) <span class="fw-normal text-success" style="font-size: 14px;">
                                                                Action réaliser dans le délai
                                                                </span>
                                                                @else
                                                                <span class="fw-normal text-warning" style="font-size: 14px;">
                                                                    Action réaliser hors délai
                                                                </span>
                                                                @endif
                                                                @else
                                                                <span class="fw-normal text-danger" style="font-size: 14px;">
                                                                    Action non réaliser
                                                                </span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @foreach ($actionsDatac[$value->id] as $key => $actionsDatas)
                        <div style="page-break-inside: avoid; margin-top: -10px;">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card" style="background: transparent;">
                                    <div class="card-inner">
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 17px;">
                                                                Action Corrective {{$key+1}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Action :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $actionsDatas['action'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Responsable :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $actionsDatas['responsable'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div style="page-break-inside: avoid; margin-top: -10px;">
                            <div class="col-lg-12 col-xxl-12" style="margin-top: -20px;">
                                <div class="card" style="background: transparent; ">
                                    <div class="card-inner">
                                        <div class="gy-3">
                                            <div class="row g-1 align-center">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <label class="form-label" style="font-size: 14px;">
                                                                Validateur :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group ">
                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                {{ $value->validateur }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

@foreach ($types_cause as $value)
<div class="modal fade zoom" tabindex="-1" id="modalDetailcause{{ $value->id }}">
    <div class="modal-dialog modal-md" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
            </div>
            <div class="modal-body">
                <form class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card" style="background: transparent; ">
                                <div class="card-inner">
                                    <div class="gy-3">
                                        <div class="row g-1 align-center">
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Cause probable :
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            {{ $value->nom }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Risque :
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            {{ $value->risque }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 row">
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" style="font-size: 14px;">
                                                            Processus :
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group ">
                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                            {{ $value->processus }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Appeler la fonction de recherche au chargement de la page
        searchProcessus();

        // Écouteur pour le changement de sélection
        document.getElementById('selectProcessus').addEventListener('change', function(){
            searchProcessus();
        });

        function searchProcessus() {
            var selectedProcessus = document.getElementById('selectProcessus').value;
            if (selectedProcessus !== '') {
                $.ajax({
                    url: '/get_processus/' + selectedProcessus,
                    method: 'GET',
                    success: function (data) {
                        addGroups(selectedProcessus, data);
                    },
                    /*error: function () {
                        toastr.info("Aucune données n'a été trouver.");
                    }*/
                });
            } /*else {
                toastr.warning("Veuillez selectionner un processus.");
            }*/
        }

        function addGroups(selectedProcessus, data) {
            var dynamicFields = document.getElementById("camenber");

            // Supprimer le contenu existant
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = "";
            groupe.innerHTML = `
                <canvas id="myChart"></canvas>
            `;

            var groupe2 = document.createElement("div");
            groupe2.className = "invest-data mt-2";
            groupe2.innerHTML = `
                <div class="invest-data-amount row g-2">
                    <div class="invest-data-history col-md">
                        <div class="title">
                            Non conformité Interne
                        </div>
                        <div class="amount">
                            ${data.data[0]}
                        </div>
                    </div>
                    <div class="invest-data-history col-md">
                        <div class="title ">
                            Réclamation
                        </div>
                        <div class="amount ">
                            ${data.data[1]}
                        </div>
                    </div>
                    <div class="invest-data-history col-md">
                        <div class="title ">
                            Contentieux
                        </div>
                        <div class="amount ">
                            ${data.data[2]}
                        </div>
                    </div>
                </div>
            `;

            document.getElementById("camenber").appendChild(groupe);
            document.getElementById("camenber").appendChild(groupe2);

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Non conformite interne', 'Réclamation', 'Contentieux'],
                    datasets: [{
                        data: data.data,
                        backgroundColor: ['orange', 'skyblue', 'red'],
                        borderColor: 'white',
                        borderWidth: 1
                    }],
                    hoverOffset: 4
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        searchRisque();

        document.getElementById('selectRisque').addEventListener('change', function(){
            searchRisque();
        });

        function searchRisque() {
            var selectRisque =  document.getElementById('selectRisque').value;
            if (selectRisque !== '') {
                $.ajax({
                    url: '/get_risque/' + selectRisque,
                    method: 'GET',
                    success: function (data) {
                        addGroups(selectRisque, data);
                    },
                    /*error: function () {
                        toastr.info("Aucune données n'a été trouver.");
                    }*/
                });
            } /*else {
                toastr.warning("Veuillez selectionner un risque.");
            }*/
        }

        function addGroups(selectRisque, data) {

            var dynamicFields = document.getElementById("camenber_risk");

            // Supprimer le contenu existant
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = "";
            groupe.innerHTML = `
                <canvas id="myChart_risk"></canvas>
            `;

            var groupe2 = document.createElement("div");
            groupe2.className = "invest-data mt-2";
            groupe2.innerHTML = `
                <div class="invest-data-amount row g-2">
                                                <div class="invest-data-history col-md">
                                                    <div class="title ">
                                                        Non conformité interne
                                                    </div>
                                                    <div class="amount ">
                                                        ${data.data[0]}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history col-md">
                                                    <div class="title ">
                                                        Réclamation
                                                    </div>
                                                    <div class="amount ">
                                                        ${data.data[1]}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history col-md">
                                                    <div class="title ">
                                                        Contentieux
                                                    </div>
                                                    <div class="amount ">
                                                        ${data.data[2]}
                                                    </div>
                                                </div>
                                            </div>
            `;

            document.getElementById("camenber_risk").appendChild(groupe);
            document.getElementById("camenber_risk").appendChild(groupe2);

            var ctx = document.getElementById('myChart_risk').getContext('2d');
            var myChart_risk = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Non conformite interne', 'Réclamation', 'Contentieux'],
                    datasets: [{
                        data: data.data,
                        backgroundColor: ['orange', 'skyblue', 'red'],
                        borderColor: 'white',
                        borderWidth: 1
                    }],
                    hoverOffset: 4
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        searchDate();

        document.getElementById('btn_rech').addEventListener('click', function(){
            searchDate();
        });

        function searchDate() {
            var date1 = document.getElementById('date1').value;
            var date2 = document.getElementById('date2').value;

            $.ajax({
                url: '/get_date',
                method: 'GET',
                data: { date1: date1, date2: date2 }, // Pass date1 and date2 to the server
                success: function (data) {
                    addGroups(data);
                },
                /*error: function () {
                    toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                }*/
            });
        }

        function addGroups(data) {
            var dynamicFields = document.getElementById("camenber2");

            // Supprimer le contenu existant
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = "";
            groupe.innerHTML = `
                <canvas id="myChart2"></canvas>
            `;

            var groupe2 = document.createElement("div");
            groupe2.className = "invest-data mt-2";
            groupe2.innerHTML = `
                <div class="invest-data-amount row g-2">
                                                <div class="invest-data-history col-md">
                                                    <div class="title ">
                                                        Non conformité interne
                                                    </div>
                                                    <div class="amount ">
                                                        ${data.data[0]}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history col-md">
                                                    <div class="title ">
                                                        Réclamation
                                                    </div>
                                                    <div class="amount ">
                                                        ${data.data[1]}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history col-md">
                                                    <div class="title ">
                                                        Contentieux
                                                    </div>
                                                    <div class="amount ">
                                                        ${data.data[2]}
                                                    </div>
                                                </div>
                                            </div>
            `;

            document.getElementById("camenber2").appendChild(groupe);
            document.getElementById("camenber2").appendChild(groupe2);

            var ctx = document.getElementById('myChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Non conformite interne', 'Réclamation', 'Contentieux'],
                    datasets: [{
                        data: [data.data[0],data.data[1],data.data[2]],
                        backgroundColor: ['orange', 'skyblue', 'red'],
                        borderColor: 'white',
                        borderWidth: 1
                    }],
                    hoverOffset: 4
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        }
    });
</script>

@endsection

