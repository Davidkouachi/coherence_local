@extends('app')

@section('titre', 'Liste des Risques')

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
                                    <span>Liste des Risques</span>
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
                                                            <th>Risque</th>
                                                            <th>Evaluation</th>
                                                            <th>Coût</th>
                                                            <th>Statut</th>
                                                            <th>Taux</th>
                                                            <th>Date de crèation</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php 
                                                            $maxProgress = 0;
                                                        @endphp

                                                        @foreach ($risques as $risque)
                                                            @php 
                                                                $maxProgress = max($maxProgress, $risque->progess);
                                                            @endphp
                                                        @endforeach

                                                        @foreach ($risques as $key => $risque)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ $risque->nom }}</td>
                                                                @php
                                                                    $colorMatchFound = false;
                                                                @endphp

                                                                @foreach($color_intervals as $color_interval)
                                                                
                                                                    @if($color_interval->nbre1 <= $risque->evaluation_residuel && $color_interval->nbre2 >= $risque->evaluation_residuel)
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
                                                                    <!-- Afficher un message si aucune correspondance n'a été trouvée -->
                                                                    <td>
                                                                        <div class="user-avatar sm" style="background-color:#8e8e8e;"></div>
                                                                    </td>
                                                                @endif

                                                                <td>
                                                                    {{ $risque->cout_residuel }} Fcfa
                                                                </td>
                                                                @if ($risque->statut === 'soumis')
                                                                    <td>
                                                                        <span class="badge badge-dim bg-warning">
                                                                            <em class="icon ni ni-stop-circle"></em>
                                                                            <span class="fs-12px" >En attente de validation</span>
                                                                        </span>
                                                                    </td>
                                                                @elseif ($risque->statut === 'valider')
                                                                    <td>
                                                                        <span class="badge badge-dim bg-success">
                                                                            <em class="icon ni ni-check"></em>
                                                                            <span class="fs-12px" >Validé</span>
                                                                        </span>
                                                                    </td>
                                                                @elseif ($risque->statut === 'non_valider')
                                                                    <td>
                                                                        <span class="badge badge-dim bg-danger">
                                                                            <em class="icon ni ni-alert"></em>
                                                                            <span class="fs-12px" >Non Validé</span>
                                                                        </span>
                                                                    </td>
                                                                @elseif ($risque->statut === 'update')
                                                                    <td>
                                                                        <span class="badge badge-dim bg-info">
                                                                            <em class="icon ni ni-info"></em>
                                                                            <span class="fs-12px" >Modification éffectuée</span>
                                                                        </span>
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    <div class="project-list-progress">
                                                                        <div class="progress progress-pill progress-md bg-light">
                                                                            <div class="progress-bar {{$risque->progess === $maxProgress ? 'bg-danger' : '' }}" data-progress="{{$risque->progess}}" style="width: 100%;"></div>
                                                                        </div>
                                                                        <div class="project-progress-percent {{$risque->progess === $maxProgress ? 'text-danger' : '' }}">
                                                                            {{$risque->progess}}%
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($risque->created_at)->translatedFormat('j F Y'.' à '.'H:i:s') }}</td>
                                                                <td>
                                                                    <div class="d-flex" >
                                                                        <form method="post" action="{{ route('index_etat_risque') }}">
                                                                            @csrf
                                                                            <input type="text" name="id" value="{{ $risque->id }}" style="display: none;">
                                                                            <a data-bs-toggle="modal"
                                                                                data-bs-target="#modalDetail{{ $risque->id }}"
                                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                                <em class="icon ni ni-eye"></em>
                                                                            </a>
                                                                            @if($risque->pdf_nom)
                                                                            <a href="{{ asset('storage/pdf/' . $risque->pdf_nom) }}" 
                                                                                target="_bank" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                                <em class="icon ni ni-download"></em>
                                                                            </a>
                                                                            @endif
                                                                            <button class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                                <em class="icon ni ni-printer-fill"></em>
                                                                            </button>
                                                                        </form>
                                                                    </div>
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

    @foreach ($risques as $risque)
        <div class="modal fade zoom" tabindex="-1" id="modalFile{{ $risque->id }}">
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content" data-simplebar>
                    @if ($risque->pdf_nom != '')
                        <embed src="{{ asset('storage/pdf/' . $risque->pdf_nom) }}" type="application/pdf" width="100%" height="1100px">
                    @else
                        <p class="text-center mt-2"  >Aucun fichier </p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($risques as $risque)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $risque->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block" >
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-122" id="groupesContainer">
                                    <div class="card ">
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
                                                                @if ($risque->statut === 'soumis')
                                                                    <span class="text-warning"> ( En attente de validation )</span>
                                                                @elseif ($risque->statut === 'valider')
                                                                    <span class="text-success"> ( Validé )</span>
                                                                @elseif ($risque->statut === 'non_valider')
                                                                    <span class="text-danger"> (Non Validé )</span>
                                                                @elseif ($risque->statut === 'update')
                                                                    <span class="text-info"> (Modification éffectuée )</span>
                                                                @endif
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
                                            $colorMatchFound0 = false;
                                        @endphp

                                        @foreach($color_intervals as $color_interval)
                                            @if($color_interval->nbre1 <= $risque->evaluation && $color_interval->nbre2 >= $risque->evaluation)
                                                <div class="card card-bordered h-100 border-white" style="background-color:{{$color_interval->code_color}}">
                                                @php
                                                    $colorMatchFound0 = true;
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach

                                        @if(!$colorMatchFound0)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#8e8e8e;">
                                        @endif
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Evaluation risque sans dispositif de contrôle interne ou dispositif antérieur
                                                    </h5>
                                                </div>
                                                <form action="#">
                                                    <div class="row g-4">
                                                        <div class="col-lg-2 text-center">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="Cause">
                                                                    Vraisemblence
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->vraisemblence }}" readonly type="text" class="form-control text-center" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="controle">
                                                                    gravite
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->gravite }}" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="controle">
                                                                    Evaluation
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->evaluation }}" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <label class="form-label " for="controle">
                                                                    Coût
                                                                </label>
                                                                <div class="form-control-wrap ">
                                                                    <input value="{{ $risque->cout }} Fcfa" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($causesData[$risque->id] as $key => $causesDatas)
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="Cause">
                                                                Cause {{ $key+1 }}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $causesDatas['cause'] }}" readonly type="text" class="form-control text-center" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="controle">
                                                                Dispositif de Contrôle
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $causesDatas['dispositif'] }}" readonly type="text" class="form-control text-center" id="controle">
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
                                            <div class="card card-bordered h-100 border-white" style="background-color:#8e8e8e;">
                                        @endif
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Evaluation risque avec dispositif de contrôle interne actuel
                                                    </h5>
                                                </div>
                                                <form action="#">
                                                    <div class="row g-4">
                                                        <div class="col-lg-2">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="Cause">
                                                                    Vraisemblence
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->vraisemblence_residuel }}" readonly type="text" class="form-control text-center" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="controle">
                                                                    gravite
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->gravite_residuel }}" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="controle">
                                                                    Evaluation
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->evaluation_residuel }}" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="controle">
                                                                    Coût
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->cout_residuel }} Fcfa" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="controle">
                                                                    Traitement
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $risque->traitement }}" readonly type="text" class="form-control text-center" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($actionsDatap[$risque->id] as $key => $actionsDatas)
                                <div class="col-md-12 col-xxl-12" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="preventif">
                                                                Action préventive {{ $key+1 }}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionsDatas['action'] }}" readonly type="text" class="form-control text-center" id="preventif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="preventif">
                                                                Délai
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ \Carbon\Carbon::parse($actionsDatas['date_suivip'])->translatedFormat('j F Y') }}" readonly type="text" class="form-control text-center" id="preventif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="email-address-1">
                                                                Responsabilité
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actionsDatas['responsable'] }}" readonly type="text" class="form-control text-center">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @foreach ($actionsDatac[$risque->id] as $key => $actionsDatas)
                                <div class="col-md-12 col-xxl-12" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="preventif">
                                                                Action corrective {{ $key+1 }}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionsDatas['action'] }}" readonly type="text" class="form-control text-center" id="preventif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="email-address-1">
                                                                Responsabilité
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actionsDatas['responsable'] }}" readonly type="text" class="form-control text-center">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-12 col-xxl-12">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner row g-gs">
                                            <div class="col-lg-12">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="email-address-1">
                                                        Validateur
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $risque->validateur }}" readonly type="text" class="form-control text-center">
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


@endsection
