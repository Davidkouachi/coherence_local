@extends('app')

@section('titre', "Fiche d'incident")

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
                                <span>Fiche de résolution d'incident</span>
                                <em class="icon ni ni-reports"></em>
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
                            <form class="nk-block" id="form" method="post" action="{{ route('index_add') }}">
                                @csrf
                                <div class="row g-gs">

                                    <div class="col-lg-6 col-xxl-6">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Type 
                                                        <em class="ni ni-block-over" ></em>
                                                    </h5>
                                                </div>
                                                <div class="row g-4 ">
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="type" id="customRadio7" value="non_conformite_interne">
                                                                <label class="custom-control-label" for="customRadio7">
                                                                    Non conformité interne
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="type" id="customRadio6" value="reclamation">
                                                                <label class="custom-control-label" for="customRadio6">
                                                                    Reclamation
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group ">
                                                            <div class="custom-control custom-radio">
                                                                <input required type="radio" class="custom-control-input" name="type" id="customRadio5" value="contentieux">
                                                                <label class="custom-control-label" for="customRadio5">
                                                                    Contentieux
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xxl-6">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Date 
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input id="date" name="date_fiche" type="date" class="form-control" value="{{ \Carbon\Carbon::now()->toDateString() }}" onchange="checkDate()" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Nombre de jours
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <select id="nbre_jour" required name="nbre_jour" class="form-select " >
                                                                    @for ($i = 1; $i <= 31; $i++)
                                                                        <option {{ $i === 5 ? 'selected' : '' }} value="{{ $i }}" >
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Date limite
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input readonly id="date_limite" name="date_limite" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-xxl-12">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Lieu
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input required placeholder="Saisie obligatoire" name="lieu" type="text" class="form-control" id="controle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Détecteur (Agent / Client)
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input required placeholder="Saisie obligatoire" name="detecteur" type="text" class="form-control" id="controle">
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
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Non conformité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input required placeholder="Saisie obligatoire" name="non_conformite" id="inputMots" type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Conséquence(s)
                                                            </label>
                                                            <div class="form-control-wrap" id="resultat">
                                                                <textarea required name="consequence" class="form-control no-resize" id="default-textarea"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Cause(s)
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <textarea required name="cause" class="form-control no-resize" id="default-textarea"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xxl-12" >
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Recherche 
                                                        <em class="ni ni-search" ></em>
                                                    </h5>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap d-flex">
                                                                <select class="form-select js-select2 select_rech" id="causeSelect" data-search="on" data-placeholder="Recherche Cause" name="causeSelect_id" style="margin-right: 10px;">
                                                                    <option value="">
                                                                    </option>
                                                                    @foreach($causes_selects as $causes_select)
                                                                    <option value="{{$causes_select->id}}">
                                                                        {{$causes_select->nom}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <a class="btn btn-outline-warning " id="vue_cause">
                                                                    <em class="icon ni ni-eye"></em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap d-flex">
                                                                <select class="form-select js-select2 select_rech" id="risqueSelect" data-search="on" data-placeholder="Recherche Risque" name="risqueSelect_id">
                                                                    <option value="">
                                                                    </option>
                                                                    @foreach($risques as $risque)
                                                                    <option value="{{$risque->id}}">
                                                                        {{$risque->nom}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <a class="btn btn-outline-warning " id="vue_risque">
                                                                    <em class="icon ni ni-eye"></em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xxl-12" >
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Résultat de la recherche
                                                    </h5>
                                                </div>
                                                <div class="row g-gs">
                                                    <div class="col-lg-12" id="div_choix">
                                                        <div class="row g-2">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio">
                                                                        <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixcause" value="cause">
                                                                        <label class="custom-control-label" for="choixcause">
                                                                            Cause trouvé
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio">
                                                                        <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixrisque" value="risque">
                                                                        <label class="custom-control-label" for="choixrisque">
                                                                            Risque trouvé
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio">
                                                                        <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixnt" value="cause_risque_nt">
                                                                        <label class="custom-control-label" for="choixnt">
                                                                            Cause / Risque non-trouvé
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

                                    <div id="dynamic-fields">

                                    </div>

                                    <div class="col-lg-12 col-xxl-12 " id="btn_enrg" style="display: none;">
                                        
                                        <div class="row g-gs" >

                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card card-bordered card-preview">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <h5 class="card-title">
                                                                <span>Notification</span>
                                                            </h5>
                                                        </div>
                                                        <div class="row g-gs">
                                                            <div class="col-lg-4 text-left">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input name="choix_alert_alert" value="alert" required type="checkbox" checked class="custom-control-input" id="customCheck1">
                                                                    <label class="custom-control-label" for="customCheck1">Alert à l'écran</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 text-left">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input name="choix_alert_email" value="email" type="checkbox" class="custom-control-input" id="customCheck2">
                                                                    <label class="custom-control-label" for="customCheck2">Par Email</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 text-left">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input name="choix_alert_sms" value="sms" disabled type="checkbox" class="custom-control-input" id="customCheck3">
                                                                    <label class="custom-control-label" for="customCheck3">Par Sms</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-xxl-12">
                                                <div class="card card-bordered card-preview">
                                                    <div class="card-inner row g-gs">
                                                        <div class="col-lg-12 col-xxl-12">
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn btn-lg btn-success btn-dim ">
                                                                    <em class="ni ni-check me-2"></em>
                                                                    <em>Soumettre</em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div> 
                                </div>
                            </form>
                        @endif
                    @endif
            </div>
        </div>
    </div>
</div>

<ul class="nk-sticky-toolbar" id="groupes_btn" >
    <li class="demo-thumb" id="btn-afficher" style="display: none;">
        <a data-type="afficher" class="toggle tipinfo action-afficher" aria-label="Aficher les actions" data-bs-original-title="Aficher les actions">
            <em class="icon ni ni-eye">
            </em>
        </a>
    </li>
    <li class="demo-settings" id="btn-new-action" style="display: none;"> 
        <a class="toggle tipinfo action-new" aria-label="Nouvelle Action" data-bs-original-title="Nouvelle Action" data-type="nouvelle-action">
            <em class="icon ni ni-plus">
            </em>
        </a>
    </li>
</ul>

    @foreach($risques as $risque)
        <div class="modal fade" id="modalVurisque{{$risque->id}}" tabindex="-1" aria-labelledby="modalVuLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body modal-body-lg">
                        <form class="nk-block">
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $risque->nom_processus }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Risque
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $risque->nom }}" readonly type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 row g-2" style="margin-left:1px;">
                                    <div class="col-md-12">

                                        @php
                                            $colorMatchFound = false;
                                        @endphp

                                        @foreach($color_intervals as $color_interval)
                                                                        
                                            @if($color_interval->nbre1 <= $risque->evaluation && $color_interval->nbre2 >= $risque->evaluation)
                                                <div class="card card-bordered h-100 border-white" style="background-color:{{$color_interval->code_color}}">
                                                @php
                                                    $colorMatchFound = true;
                                                @endphp

                                                @break

                                            @endif

                                        @endforeach

                                        @if(!$colorMatchFound)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#8e8e8e">
                                        @endif
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <h5 class="card-title">Evaluation risque sans dispositif de contrôle interne ou dispositif antérieur</h5>
                                                            </div>
                                                            <form action="#">
                                                                <div class="row g-4">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Vraisemblence
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->vraisemblence }}" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                gravite
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->gravite }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Evaluation
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->evaluation }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Coût
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->cout }} Fcfa" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                    </div>
                                </div>
                                @foreach ($causesData[$causes_select->risque_id] as $causesDatas)
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Cause
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $causesDatas['cause'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Dispositif de Contrôle
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $causesDatas['dispositif'] }}" readonly type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-12 row g-2" style="margin-left:1px;">
                                    <div class="col-md-12">
                                        @php
                                            $colorMatchFound0 = false;
                                        @endphp

                                        @foreach($color_intervals as $color_interval)
                                                                        
                                            @if($color_interval->nbre1 <= $risque->evaluation_residuel && $color_interval->nbre2 >= $risque->evaluation_residuel)
                                                <div class="card card-bordered h-100 border-white" style="background-color:{{$color_interval->code_color}}">
                                                @php
                                                    $colorMatchFound0 = true;
                                                @endphp

                                                @break

                                            @endif

                                        @endforeach

                                        @if(!$colorMatchFound0)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#8e8e8e">
                                        @endif
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <h5 class="card-title">Evaluation risque avec dispositif de contrôle interne actuel</h5>
                                                            </div>
                                                            <form action="#">
                                                                <div class="row g-4">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Vraisemblence
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->vraisemblence_residuel }}" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                gravite
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->gravite_residuel }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Evaluation
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->evaluation_residuel }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Coût
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->cout_residuel }} Fcfa" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Traitement
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $risque->traitement }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                    </div>
                                </div>
                                @foreach ($actionsData[$causes_select->risque_id] as $actionsDatas)
                                @if ($actionsDatas['type'] === 'preventive')
                                <div class="col-md-12 col-xxl-12" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="preventif">
                                                            Action préventive
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actionsDatas['action'] }}" readonly type="text" class="form-control" id="preventif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-address-1">
                                                            Responsabilité
                                                        </label>
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionsDatas['responsable'] }}" readonly type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($actionsDatas['type'] === 'corrective')
                                <div class="col-md-12 col-xxl-12" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="corectif">
                                                            Action corrective
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actionsDatas['action'] }}" readonly type="text" class="form-control" id="corectif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-address-1">
                                                            Responsabilité
                                                        </label>
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionsDatas['responsable'] }}" readonly type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="col-md-12 col-xxl-12">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner row g-gs">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email-address-1">
                                                        Validateur
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input value="{{$risque->validateur}}" readonly type="text" class="form-control">
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

    @foreach($causes_selects as $causes_select)
        <div class="modal fade" id="modalVucause{{$causes_select->id}}" allowOutsideClick="false" tabindex="-1" aria-labelledby="modalVuLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body modal-body-lg">
                        <form class="nk-block">
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $causes_select->nom_processus }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Risque
                                                            @if ($causes_select->statut === 'soumis')
                                                            <span class="text-danger"> ( Non validé )</span>
                                                            @endif
                                                            @if ($causes_select->statut === 'valider')
                                                            <span class="text-success"> ( Validé )</span>
                                                            @endif
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $causes_select->nom_risque }}" readonly type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 row g-2" style="margin-left:1px;">
                                    <div class="col-md-12">
                                        @php
                                            $colorMatchFound1 = false;
                                        @endphp

                                        @foreach($color_intervals as $color_interval)
                                                                        
                                            @if($color_interval->nbre1 <= $causes_select->evaluation && $color_interval->nbre2 >= $causes_select->evaluation)
                                                <div class="card card-bordered h-100 border-white" style="background-color:{{$color_interval->code_color}}">
                                                @php
                                                    $colorMatchFound1 = true;
                                                @endphp

                                                @break

                                            @endif

                                        @endforeach

                                        @if(!$colorMatchFound1)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#8e8e8e">
                                        @endif
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <h5 class="card-title">Evaluation risque sans dispositif de contrôle interne ou dispositif antérieur</h5>
                                                            </div>
                                                            <form action="#">
                                                                <div class="row g-4">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Vraisemblence
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->vraisemblence }}" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                gravite
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->gravite }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Evaluation
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->evaluation }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Coût
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->cout }} Fcfa" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                    </div>
                                </div>
                                @foreach ($causesData2[$causes_select->risque_id] as $causeData2)
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Cause
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $causeData2['cause'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Dispositif de Contrôle
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $causeData2['dispositif'] }}" readonly type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-12 row g-2" style="margin-left:1px;">
                                    <div class="col-md-12">
                                        @php
                                            $colorMatchFound2 = false;
                                        @endphp

                                        @foreach($color_intervals as $color_interval)
                                                                        
                                            @if($color_interval->nbre1 <= $causes_select->evaluation_residuel && $color_interval->nbre2 >= $causes_select->evaluation_residuel)
                                                <div class="card card-bordered h-100 border-white" style="background-color:{{$color_interval->code_color}}">
                                                @php
                                                    $colorMatchFound2 = true;
                                                @endphp

                                                @break

                                            @endif

                                        @endforeach

                                        @if(!$colorMatchFound2)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#8e8e8e">
                                        @endif
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <h5 class="card-title">Evaluation risque avec dispositif de contrôle interne actuel</h5>
                                                            </div>
                                                            <form action="#">
                                                                <div class="row g-4">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Vraisemblence
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->vraisemblence_residuel }}" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                gravite
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->gravite_residuel }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Evaluation
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->evaluation_residuel }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Coût
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->cout_residuel }} Fcfa" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Traitement
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $causes_select->traitement }}" readonly type="text" class="form-control" id="controle">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                    </div>
                                </div>
                                @foreach ($actionsData2[$causes_select->risque_id] as $actionData2)
                                @if ($actionData2['type'] === 'preventive')
                                <div class="col-md-12 col-xxl-12" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="preventif">
                                                            Action préventive
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actionData2['action'] }}" readonly type="text" class="form-control" id="preventif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-address-1">
                                                            Responsabilité
                                                        </label>
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionData2['responsable'] }}" readonly type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($actionData2['type'] === 'corrective')
                                <div class="col-md-12 col-xxl-12" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="corectif">
                                                            Action corrective
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actionData2['action'] }}" readonly type="text" class="form-control" id="corectif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-address-1">
                                                            Responsabilité
                                                        </label>
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionData2['responsable'] }}" readonly type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="col-md-12 col-xxl-12">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner row g-gs">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email-address-1">
                                                        Validateur
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input value="{{$causes_select->validateur}}" readonly type="text" class="form-control">
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
    $(document).ready(function() {
        // Écoutez l'événement de changement de l'élément select
        $('#risqueSelect').on('change', function() {
            
            var selectedValue = $(this).val();
            $('.modal').modal('hide');
            $(`#modalVurisque${selectedValue}`).modal('show');

            var dynamicFields = document.getElementById("dynamic-fields");
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }
            document.getElementById("btn_enrg").style.display = "none";
        });
    });
</script>

<script>
    document.getElementById("vue_cause").addEventListener("click", function(event) {
        event.preventDefault();
            var id_cause = $("#causeSelect").val();

            if (id_cause == '') {
                NioApp.Toast("<h5>Alert</h5><p>Veuillez sélectionner une cause.</p>.", "warning", {position: "top-right"});
            }else{
                $('.modal').modal('hide');
                $(`#modalVucause${id_cause}`).modal('show'); 
            }
        });
</script>

<script>
    $(document).ready(function() {
        // Écoutez l'événement de changement de l'élément select
        $('#causeSelect').on('change', function() {
            
            var selectedValu = $(this).val();
            $('.modal').modal('hide');
            $(`#modalVucause${selectedValu}`).modal('show');

            var dynamicFields = document.getElementById("dynamic-fields");
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }
            document.getElementById("btn_enrg").style.display = "none";
        });
    });
</script>

<script>
    document.getElementById("vue_risque").addEventListener("click", function(event) {
        event.preventDefault();
            var id_risque = $("#risqueSelect").val();

            if (id_risque == '') {
                NioApp.Toast("<h5>Alert</h5><p>Veuillez sélectionner un risque.</p>.", "warning", {position: "top-right"});
            }else{
                $('.modal').modal('hide');
                $(`#modalVurisque${id_risque}`).modal('show'); 
            }
        });
</script>

<script>
    var postes = @json($postes);
    var processuss = @json($processuss);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".action-new").forEach(function(button) {
            button.addEventListener("click", function() {
                var type = this.getAttribute("data-type");
                var selectedCause = $("#causeSelect").val();
                var selectedRisque = $("#risqueSelect").val();
                var choixSelect = $("input[name='choix_select']:checked").val();

                    if (choixSelect === "cause") {
                        if (selectedCause === '') {
                            NioApp.Toast("<h5>Alert</h5><p>Veuillez sélectionner une cause.</p>.", "warning", {position: "top-right"});
                        }else{
                            var type_new = this.getAttribute("data-type");
                            addGroup(type_new);
                        }
                    } else if (choixSelect === "risque") {
                        if (selectedRisque === '') {
                            NioApp.Toast("<h5>Alert</h5><p>Veuillez sélectionner un risque.</p>.", "warning", {position: "top-right"});
                        }else{
                            var type_new = this.getAttribute("data-type");
                            addGroup(type_new);
                        }
                    } else if (choixSelect === "cause_risque_nt") {
                        var type_new = this.getAttribute("data-type");
                        addGroup(type_new);
                    }
            });
        });
    });

    function addGroup(type_new) {

        document.getElementById("btn_enrg").style.display = "block";

        var groupe = document.createElement("div");
        groupe.className = "card card-bordered";
        groupe.innerHTML = `
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12 col-xxl-12" >
                                                    <div class="card">
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <span class="badge badge-dot bg-primary">
                                                                    Nouveau
                                                                </span>
                                                            </div>
                                                                <div class="row g-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Processus
                                                                            </label>
                                                                            <input required style="display:none;" name="nature[]" value="new" type="text" >
                                                                            <select required id="responsable_idc" required name="processus_id[]" class="form-select">
                                                                                <option selected value="">
                                                                                    Choisir un processus
                                                                                </option>
                                                                                ${processuss.map(processus => `<option value="${processus.id}">${processus.nom}</option>`).join('')}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Risque
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input required placeholder="Saisie obligatoire" name="risque[]" type="text" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Résumé des causes
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input required placeholder="Saisie obligatoire" name="resume[]" type="text" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                            <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Action Corrective
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input required placeholder="Saisie obligatoire" name="action[]" type="text" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Coût">
                                                                                        Responsable
                                                                                    </label>
                                                                                    <select required id="responsable_idc" required name="poste_id[]" class="form-select">
                                                                                        <option selected value="">
                                                                                            Choisir un responsable
                                                                                        </option>
                                                                                        ${postes.map(poste => `<option value="${poste.id}">${poste.nom}</option>`).join('')}
                                                                                    </select>
                                                                                </div>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group text-center">
                                                                            <label class="form-label" for="description">
                                                                                Commentaire
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea required name="commentaire[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group text-center">
                                                                            <a class="btn btn-outline-danger btn-dim " id="suppr_nouvelle_action" >
                                                                                Supprimer
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                `;

        groupe.querySelector("#suppr_nouvelle_action").addEventListener("click", function(event) {
            event.preventDefault();

            groupe.remove();

            checkAndHideSubmitButton();
        });

        document.getElementById("dynamic-fields").appendChild(groupe);
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".action-afficher").forEach(function(button) {
            button.addEventListener("click", function() {
                var type = this.getAttribute("data-type");
                var selectedCause = $("#causeSelect").val();
                var selectedRisque = $("#risqueSelect").val();
                var choixSelect = $("input[name='choix_select']:checked").val();

                if (choixSelect !== undefined) {
                    // Faites quelque chose avec la valeur sélectionnée
                    if (choixSelect === "cause") {
                        if (selectedCause !== '') {
                            $.ajax({
                                url: '/get-cause-info/' + selectedCause,
                                method: 'GET',
                                success: function(data) {
                                    var nbre = data.nbre;
                                    NioApp.Toast("<h5>Information</h5><p>" + nbre + " Action(s) trouvée(s).</p>", "info", {position: "top-right"});
                                    addGroups_non_accepte(type, data);
                                },
                                error: function() {
                                    NioApp.Toast("<h5>Erreur</h5><p>Une erreur s'est produite lors de la récupération des informations.</p>", "error", {position: "top-right"});
                                }
                            });
                        } else {
                            NioApp.Toast("<h5>Alert</h5><p>Veuillez sélectionner une cause.</p>", "warning", {position: "top-right"});
                        }
                    } else if (choixSelect === "risque") {
                        if (selectedRisque !== '') {
                            $.ajax({
                                url: '/get-risque-info/' + selectedRisque,
                                method: 'GET',
                                success: function(data) {
                                    var nbre = data.nbre;
                                    NioApp.Toast("<h5>Information</h5><p>"+nbre+" Action(s) trouvée(s).</p>", "info", {position: "top-right"});
                                    addGroups_non_accepte(type, data);
                                },
                                error: function() {
                                    NioApp.Toast("<h5>Erreur</h5><p>Une erreur s'est produite lors de la récupération des informations.</p>", "error", {position: "top-right"});
                                }
                            });
                        } else {
                            NioApp.Toast("<h5>Alert</h5><p>Veuillez sélectionner un risque.</p>", "warning", {position: "top-right"});
                        }
                    }
                } else {
                    NioApp.Toast("<h5>Erreur</h5><p>Veuillez préciser le choix de sélection.</p>", "error", {position: "top-right"});
                }
            });
        });

    });

    function addGroups_non_accepte(type, data) {
        // Récupérer l'élément qui contient les groupes
        var dynamicFields = document.getElementById("dynamic-fields");

        // Supprimer le contenu existant
        while (dynamicFields.firstChild) {
            dynamicFields.removeChild(dynamicFields.firstChild);
        }

        document.getElementById("btn_enrg").style.display = "block";

        data.actions.forEach(function(action) {
            var groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12 col-xxl-12" >
                                                    <div class="card">
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <span class="badge badge-dot bg-success">
                                                                    Action trouvé
                                                                </span>
                                                            </div>
                                                                <div class="row g-4">

                                                                    <input required style="display:none;" name="trouve[]" value="${action.trouve}" type="text">
                                                                    <input required style="display:none;" name="trouve_id[]" value="${action.trouve_id}" type="int">

                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Statut
                                                                            </label>
                                                                            <select name="nature[]" class="form-select">
                                                                                <option selected value="accepte">
                                                                                    Accepté
                                                                                </option>
                                                                                <option value="non-accepte">
                                                                                    Non accepté
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Processus
                                                                            </label>

                                                                            <div class="form-control-wrap">
                                                                                <input style="display:none;" name="processus_id[]" value="${action.processus_id}" type="int" class="form-control">
                                                                                <input value="${action.processus}" type="text" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Risque
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="${action.risque}" type="text" class="form-control" readonly>
                                                                                <input style="display:none;" required name="risque[]" value="${action.risque_id}" type="int" class="form-control" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input required style="display:none;" name="resume[]" value="0" type="text" >
                                                                    <div class="col-lg-7">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Action Corrective
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input placeholder="Saisie obligatoire" name="action[]"  type="text" readonly value="${action.action}" class="form-control" >
                                                                                <input placeholder="Saisie obligatoire" name="naction[]"  type="text" required style="display:none;" class="form-control" value="neant">
                                                                                <input style="display:none;" name="action_id[]" value="${action.id}" type="int" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Coût">
                                                                                        Responsable
                                                                                    </label>
                                                                                    <select required id="responsable_idc" required name="poste_id[]" class="form-select">
                                                                                        ${postes.filter(poste => poste.id == action.poste_id).map(poste => `<option value="${poste.id}" selected>${poste.nom}</option>`).join('')}
                                                                                    </select>
                                                                                </div>  

                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group text-center">
                                                                            <label class="form-label" for="description">
                                                                                Commentaire
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea required name="commentaire[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group text-center">
                                                                            <a class="btn btn-outline-danger btn-dim " id="suppr_action" >
                                                                                Supprimer
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    `;

            groupe.querySelector("#suppr_action").addEventListener("click", function(event) {
                event.preventDefault();
                
                groupe.remove();

                checkAndHideSubmitButton();
            });

            document.getElementById("dynamic-fields").appendChild(groupe);

            document.querySelectorAll("select[name='nature[]']").forEach(function(natureSelect) {
                natureSelect.addEventListener("change", function() {
                    var selectedNature = this.value;
                    var correspondingActionInput = this.closest(".card").querySelector("input[name='action[]']");
                    var correspondingActionInput2 = this.closest(".card").querySelector("input[name='naction[]']");

                    // Si la nature est "non-accepte", vider l'input action
                    if (selectedNature === "non-accepte") {
                        correspondingActionInput.style.display = "none";
                        correspondingActionInput2.style.display = "block";
                        correspondingActionInput2.value = "";
                    } else {
                        // Sinon, rétablir la valeur initiale
                        correspondingActionInput.style.display = "block";
                        correspondingActionInput2.style.display = "none";
                        correspondingActionInput2.value = "neant";
                    }
                });
            });
    
        });

    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initial setup
        var selectedCause = $("#causeSelect").val();
        var selectedRisque = $("#risqueSelect").val();

        document.querySelectorAll(".choix_select").forEach(function(radio) {
            radio.addEventListener("change", function() {
                var selectedValue = this.value;
                if (selectedValue === "cause" || selectedValue === "risque") {

                    document.getElementById("btn-afficher").style.display = "block";
                    document.getElementById("btn-new-action").style.display = "block";
                    document.getElementById("btn_enrg").style.display = "none";

                    var dynamicFields = document.getElementById("dynamic-fields");
                    // Supprimer le contenu existant
                    while (dynamicFields.firstChild) {
                        dynamicFields.removeChild(dynamicFields.firstChild);
                    }

                } else if (selectedValue === "cause_risque_nt") {

                    document.getElementById("btn-afficher").style.display = "none";
                    document.getElementById("btn-new-action").style.display = "block";
                    document.getElementById("btn_enrg").style.display = "none";

                    var dynamicFields = document.getElementById("dynamic-fields");
                    // Supprimer le contenu existant
                    while (dynamicFields.firstChild) {
                        dynamicFields.removeChild(dynamicFields.firstChild);
                    }
                }
            });
        });
    });
</script>

<script>
    function checkAndHideSubmitButton() {
    var dynamicFields = document.getElementById("dynamic-fields");
    var btnEnrg = document.getElementById("btn_enrg");

    if (dynamicFields.innerHTML.trim() === "") {
        // Si vide, cacher le bouton "Soumettre"
        btnEnrg.style.display = "none";
    } else {
        // Sinon, afficher le bouton "Soumettre"
        btnEnrg.style.display = "block";
    }
}
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Écoute des changements sur le champ de date et le champ du nombre de jours
            document.getElementById('date').addEventListener('change', updateDateLimite);
            document.getElementById('nbre_jour').addEventListener('change', updateDateLimite);

            function updateDateLimite() {
                var dateDebut = document.getElementById('date').value;
                var nbreJours = parseInt(document.getElementById('nbre_jour').value);

                // Vérification si la date de début est sélectionnée et le nombre de jours est valide
                if (dateDebut && !isNaN(nbreJours)) {
                    var dateLimite = new Date(dateDebut);
                    dateLimite.setDate(dateLimite.getDate() + nbreJours);

                    // Extraction des éléments de date individuels
                    var jour = ('0' + dateLimite.getDate()).slice(-2); // Jour
                    var mois = ('0' + (dateLimite.getMonth() + 1)).slice(-2); // Mois (ajouter +1 car les mois commencent à 0)
                    var annee = dateLimite.getFullYear(); // Année

                    // Formatage de la date au format dd/mm/aaaa
                    var formattedDate = jour + '/' + mois + '/' + annee;

                    // Mettre à jour la valeur du champ "Date limite de traitement"
                    document.getElementById('date_limite').value = formattedDate;
                }
            }

            // Appel initial pour mettre à jour la date limite lors du chargement de la page
            updateDateLimite();
        });
    </script>

@endsection
