<!DOCTYPE html>
<html class="js" lang="fr">
<meta content="text/html;charset=utf-8" http-equiv="content-type">

<head>
    <meta charset="utf-8">
    <meta content="Softnio" name="author">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers." name="description">
    <link href="images/logo.png" rel="shortcut icon">
    <title>Fiche Risque</title>
    <link href="assets/css/dashlite0226.css?" rel="stylesheet">
    <link href="assets/css/theme0226.css" rel="stylesheet">
    <script src="{{asset('chart.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('pusher.min.js') }}"></script>
    </link>
    </link>
    </link>
    </meta>
    </meta>
    </meta>
    </meta>
</head>


<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <div class="nk-wrap ">
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-between g-3">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">
                                            Numéro : <strong class="text-primary small">{{ $risque->id }}</strong>
                                        </h3>
                                        <div class="nk-block-des text-soft">
                                            <ul class="list-inline">
                                                <li>
                                                    Date de création :
                                                    <span class="text-base">
                                                        {{ \Carbon\Carbon::now()->translatedFormat('j F Y H:i') }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" id="btn_download">
                                                        <em class="icon ni ni-printer-fill"></em>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="{{ route('index_liste_risque') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Retour</span>
                                        </a>
                                        <a href="{{ route('index_liste_risque') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="nk-block mt-3 col-lg-8 ms-auto me-auto"  >
                                <div class="bg-white">

                                    <div class=" row g-gs" id="cadre" style="margin-top: -30px; ">

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: +2px;">
                                            <div class="card" style="background: transparent;">
                                                <div class="card-inner text-center">
                                                    <img src="images/logo.png" height="100" width="120">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: -40px;">
                                            <div class="card" style="background: transparent;">
                                                <div class="card-inner text-center">
                                                    <h5 class="text-dark">Fiche Risque </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: -30px;">
                                            <div class="card" style="background: transparent;">
                                                <div class="card-inner">
                                                    <div class="gy-3">
                                                        <div class="row g-3 align-center text-center">
                                                            @if( $risque->statut === 'soumis')
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Statut
                                                                        </label>
                                                                        <span class="form-note text-warning fw-bold">
                                                                            En attente de validation
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Date d'enregistrement :
                                                                        </label>
                                                                        <span class="form-note">
                                                                            {{ \Carbon\Carbon::parse($risque->created_at)->translatedFormat('j F Y H:i ') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @elseif( $risque->statut === 'valider')
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Statut
                                                                        </label>
                                                                        <span class="form-note text-success fw-bold">
                                                                            Valider
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Date de validation :
                                                                        </label>
                                                                        <span class="form-note">
                                                                            {{ \Carbon\Carbon::parse($risque->date_validation)->translatedFormat('j F Y ') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Date d'enregistrement :
                                                                        </label>
                                                                        <span class="form-note">
                                                                            {{ \Carbon\Carbon::parse($risque->created_at)->translatedFormat('j F Y H:i ') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @elseif( $risque->statut === 'non_valider' || $risque->statut === 'update')
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Statut
                                                                        </label>
                                                                        <span class="form-note text-danger fw-bold">
                                                                            Non Valider
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="site-name">
                                                                            Date d'enregistrement :
                                                                        </label>
                                                                        <span class="form-note">
                                                                            {{ \Carbon\Carbon::parse($risque->created_at)->translatedFormat('j F Y H:i ') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: -20px;">
                                            <div class="card" style="background: transparent; ">
                                                <div class="card-inner">
                                                    <div class="gy-3">
                                                        <div class="row g-1 align-center">
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Risque :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ $risque->nom }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3" >
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Processus :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ $risque->nom_processus }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="page-break-inside: avoid; margin-top: -10px;" >
                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card" style="background: transparent;">
                                                    <div class="card-inner" >
                                                        <div class="gy-3">
                                                            <div class="row g-1 align-center">
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-12" >
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
                                                                    <div class="col-lg-3" >
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Vraisemblence :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->vraisemblence }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Gravité :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->gravite }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Evaluation :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->evaluation }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Coût :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $cout = $risque->cout;
                                                                        $formatcommande = number_format($cout, 0, '.', '.');
                                                                    @endphp
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $formatcommande }} Fcfa
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                @php
                                                                                    $colorFound = false;
                                                                                @endphp
                                                                                @foreach($color_intervals as $color_interval)
                                                                                    @if($color_interval->nbre1 <= $risque->evaluation && $risque->evaluation <= $color_interval->nbre2)
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

                                        @foreach ($causesData[$risque->id] as $key => $causesDatas)
                                        <div style="page-break-inside: avoid; margin-top: -10px;" >
                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card" style="background: transparent;">
                                                    <div class="card-inner" >
                                                        <div class="gy-3">
                                                            <div class="row g-1 align-center">
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-12" >
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
                                                                    <div class="col-lg-3" >
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Cause :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $causesDatas['cause'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Dispositif :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
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

                                        <div style="page-break-inside: avoid; margin-top: -10px;" >
                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card" style="background: transparent;">
                                                    <div class="card-inner" >
                                                        <div class="gy-3">
                                                            <div class="row g-1 align-center">
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-12" >
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
                                                                    <div class="col-lg-3" >
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Vraisemblence :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->vraisemblence_residuel }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Gravité :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->gravite_residuel }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Evaluation :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->evaluation_residuel }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Coût :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $cout2 = $risque->cout_residuel;
                                                                        $formatcommande2 = number_format($cout2, 0, '.', '.');
                                                                    @endphp
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $formatcommande2 }} Fcfa
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Traitement :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->traitement }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                @php
                                                                                    $colorFound = false;
                                                                                @endphp
                                                                                @foreach($color_intervals as $color_interval)
                                                                                    @if($color_interval->nbre1 <= $risque->evaluation_residuel && $risque->evaluation_residuel <= $color_interval->nbre2)
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

                                        @foreach ($actionsDatap[$risque->id] as $key => $actionsDatas)
                                        <div style="page-break-inside: avoid; margin-top: -10px;" >
                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card" style="background: transparent;">
                                                    <div class="card-inner" >
                                                        <div class="gy-3">
                                                            <div class="row g-1 align-center">
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-12" >
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
                                                                    <div class="col-lg-3" >
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Action :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $actionsDatas['action'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Délai de traitement :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ \Carbon\Carbon::parse($actionsDatas['delai'])->translatedFormat('j F Y') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Responsable :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $actionsDatas['responsable'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($actionsDatas['suivi'] === 'oui')
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Statut :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            @if($actionsDatas['date_action'] != null)
                                                                                @if($actionsDatas['date_action'] <= $actionsDatas['delai'])
                                                                                    <span class="fw-normal text-success" style="font-size: 14px;">
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

                                        @foreach ($actionsDatac[$risque->id] as $key => $actionsDatas)
                                        <div style="page-break-inside: avoid; margin-top: -10px;" >
                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card" style="background: transparent;">
                                                    <div class="card-inner" >
                                                        <div class="gy-3">
                                                            <div class="row g-1 align-center">
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-12" >
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
                                                                    <div class="col-lg-3" >
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Action :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $actionsDatas['action'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Responsable :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
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

                                        <div style="page-break-inside: avoid; margin-top: -10px;" >
                                            <div class="col-lg-12 col-xxl-12" style="margin-top: -20px;">
                                                <div class="card" style="background: transparent; ">
                                                    <div class="card-inner">
                                                        <div class="gy-3">
                                                            <div class="row g-1 align-center">
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Validateur :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $risque->validateur }}
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>
    <script src="{{asset('assets/js/libs/datatable-btns0226.js')}}"></script>

    <link href="{{asset('notification/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('notification/toastr.min.js')}}"></script>

    <style>
        .form-label{
            color: black;
            font-size:17px;
        }
        .form-note{
            color: black;
            font-size:15px;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script>
        window.onload = function() {
            document.getElementById('btn_download').addEventListener('click', function() {
                // Sélection du formulaire à imprimer
                const form = document.getElementById('cadre');

                // Configuration pour la génération PDF
                const opt = {
                    margin: 10,
                    filename: 'Fiche risque.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }, // Gestion des sauts de page
                    header: [
                        {
                            content: 'Mon Header',
                            height: '50mm',
                            styles: {
                                textAlign: 'center',
                            },
                        }
                    ],
                    footer: [
                        {
                            content: 'Page {page}/{total}',
                            height: '50mm',
                            styles: {
                                textAlign: 'center',
                            },
                        }
                    ],
                };

                // Génération du PDF à partir du formulaire
                const pdf = html2pdf().from(form).set(opt).save();
            });
        };
    </script>

</body>

</html>

