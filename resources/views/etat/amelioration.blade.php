<!DOCTYPE html>
<html class="js" lang="fr">
<meta content="text/html;charset=utf-8" http-equiv="content-type">

<head>
    <meta charset="utf-8">
    <meta content="Softnio" name="author">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers." name="description">
    <link href="images/logo.png" rel="shortcut icon">
    <title>Fiche d'incident</title>
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
                                            Numéro : <strong class="text-primary small">{{ $am->id }}</strong>
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
                                        <a href="{{ route('index_amelioration_liste') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Retour</span>
                                        </a>
                                        <a href="{{ route('index_amelioration_liste') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
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
                                                    <h5 class="text-dark">Fiche d'incident </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: -30px;">
                                            <div class="card" style="background: transparent;">
                                                <div class="card-inner">
                                                    <div class="gy-3">
                                                        <div class="row g-3 align-center text-center">
                                                                @if($am->statut === 'valider')
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Statut :
                                                                            </label>
                                                                            <span class="form-note text-primary">
                                                                                Validé
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Date de validation :
                                                                            </label>
                                                                            <span class="form-note">
                                                                                {{ \Carbon\Carbon::parse($am->date_fiche)->translatedFormat('j F Y ') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @elseif($am->statut === 'non-valider' || $am->statut === 'update' || $am->statut === 'modif')
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Statut :
                                                                            </label>
                                                                            <span class="form-note text-danger">
                                                                                Non Validé
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @elseif($am->statut === 'soumis')
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Statut :
                                                                            </label>
                                                                            <span class="form-note text-danger">
                                                                                En attente de validation
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @elseif($am->statut === 'date_efficacite')
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Statut :
                                                                            </label>
                                                                            <span class="form-note text-warning">
                                                                                En attente d'évaluation de l´éfficacité
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @elseif($am->statut === 'cloturer')
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Statut :
                                                                            </label>
                                                                            <span class="form-note text-success">
                                                                                Clôturé
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="site-name">
                                                                                Date de Clôture :
                                                                            </label>
                                                                            <span class="form-note">
                                                                                {{ \Carbon\Carbon::parse($am->date_eff)->translatedFormat('j F Y ') }}
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
                                                                <div class="col-lg-3" >
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Date de réception :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ \Carbon\Carbon::parse($am->date_fiche)->translatedFormat('j F Y ') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3" >
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Date limite de traitement :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ \Carbon\Carbon::parse($am->date_limite)->translatedFormat('j F Y ') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3" >
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Nombres de jours :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ $am->nbre_jour }} Jour(s)
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Type :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            @if($am->type === 'contentieux')
                                                                                Contentieux
                                                                            @elseif($am->type === 'reclamation')
                                                                                Réclamation
                                                                            @else
                                                                                Non Conformité Interne
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Lieux :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{$am->lieu}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Détecteur :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{$am->detecteur}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Non conformité :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{$am->non_conformite}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Conséquence(s) :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{$am->consequence}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Cause(s) :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{$am->cause}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($actionsData[$am->id] as $key => $actions)
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
                                                                                Action {{ $key+1 }}
                                                                                @if($actions['date_action'] === null)
                                                                                    ( <span class="text-danger"> Non Réaliser </span> )
                                                                                @else
                                                                                    ( <span class="text-success"> Réaliser </span> )
                                                                                @endif
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
                                                                                {{ $actions['action'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                                {{ $actions['risque'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Processus :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $actions['processus'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 row">
                                                                @if($actions['statut'] === 'realiser')
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Date de réalisation :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                    @if($actions['delai'] >= $actions['date_action'])
                                                                        <div class="col-lg-9">
                                                                            <div class="form-group ">
                                                                                <span class="fw-normal text-success" style="font-size: 14px;">
                                                                                    {{ \Carbon\Carbon::parse($actions['date_action'])->translatedFormat('j F Y ') }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-lg-9">
                                                                            <div class="form-group ">
                                                                                <span class="fw-normal text-danger" style="font-size: 14px;">
                                                                                    {{ \Carbon\Carbon::parse($actions['date_action'])->translatedFormat('j F Y ') }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Date du suivi :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ \Carbon\Carbon::parse($actions['date_suivi'])->translatedFormat('j F Y H:i') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                    <div class="col-lg-12 row">
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group ">
                                                                                <label class="form-label" style="font-size: 14px;">
                                                                                    Efficacitée :
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        @if($actions['efficacite'] === 'oui')
                                                                        <div class="col-lg-9">
                                                                            <div class="form-group ">
                                                                                <span class="fw-normal text-success" style="font-size: 14px;">
                                                                                    Oui
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        <div class="col-lg-9">
                                                                            <div class="form-group ">
                                                                                <span class="fw-normal text-danger" style="font-size: 14px;">
                                                                                    Non
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-lg-12 row">
                                                                        <div class="col-lg-3">
                                                                            <div class="form-group ">
                                                                                <label class="form-label" style="font-size: 14px;">
                                                                                    Commentaire :
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <div class="form-group ">
                                                                                <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                    {{ $actions['commentaire'] }}
                                                                                </span>
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

                                        @if($am->date1 !== null)
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
                                                                                Evaluation de l'éfficacité
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
                                                                                Du :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ \Carbon\Carbon::parse($am->date1)->translatedFormat('j F Y ') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                au :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ \Carbon\Carbon::parse($am->date2)->translatedFormat('j F Y ') }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @if ($am->date_eff !== null)
                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Délai de traitement :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                        @if ($am->date1 <= $am->date_eff && $am->date2 >= $am->date_eff)
                                                                            <div class="col-lg-9">
                                                                                <div class="form-group ">
                                                                                    <span class="fw-normal text-success" style="font-size: 14px;">
                                                                                        {{ \Carbon\Carbon::parse($am->date_eff)->translatedFormat('j F Y ') }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            @elseif ($am->date1 > $am->date_eff && $am->date2 >= $am->date_eff || $am->date1 <= $am->date_eff && $am->date2 < $am->date_eff)
                                                                            <div class="col-lg-9">
                                                                                <div class="form-group ">
                                                                                    <span class="fw-normal text-danger" style="font-size: 14px;">
                                                                                        {{ \Carbon\Carbon::parse($am->date_eff)->translatedFormat('j F Y ') }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                </div>
                                                                @elseif ($am->date_eff === null)
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
                                                                                Néant
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                

                                                                @if($am->efficacite !== null)

                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Action éfficace :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                        @if ($am->efficacite === 'oui')
                                                                            <div class="col-lg-9">
                                                                                <div class="form-group ">
                                                                                    <span class="fw-normal text-success" style="font-size: 14px;">
                                                                                        Oui
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-lg-9">
                                                                                <div class="form-group ">
                                                                                    <span class="fw-normal text-danger" style="font-size: 14px;">
                                                                                        Non
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                </div>

                                                                <div class="col-lg-12 row">
                                                                    <div class="col-lg-3" >
                                                                        <div class="form-group ">
                                                                            <label class="form-label" style="font-size: 14px;">
                                                                                Commentaire :
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="form-group ">
                                                                            <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                                {{ $am->commentaire_eff }}
                                                                            </span>
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
                                        @endif

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
                    filename: 'Fiche d\'incident.pdf',
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
