@extends('app')

@section('titre', 'Liste des Processus')

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
                        <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Suivi des Incidents</span>
                                            <em class="icon ni ni-list-index"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-12 col-xxl-12">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Type</th>
                                                    <th>Date de réception</th>
                                                    <th>Non conformité</th>
                                                    <!--<th>Nombre d'actions</th>-->
                                                    <th>Statut</th>
                                                    <th>Date de création</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ams as $key => $am)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            @if ($am->type === 'contentieux')
                                                                Contentieux
                                                            @endif
                                                            @if ($am->type === 'reclamation')
                                                                Réclamation
                                                            @endif
                                                            @if ($am->type === 'non_conformite_interne')
                                                                Non conformité
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($am->date_fiche)->translatedFormat('j F Y ') }}</td>
                                                        <td>{{ $am->non_conformite }}</td>
                                                        <!--<td>{{ $am->nbre_action }}</td>-->
                                                        @if ($am->statut === 'soumis')
                                                            <td>
                                                                <span class="badge badge-dim bg-warning">
                                                                    <em class="icon ni ni-stop-circle"></em>
                                                                    <span class="fs-12px" >En attente de validation</span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'valider')
                                                            <td>
                                                                <span class="badge badge-dim bg-primary">
                                                                    <em class="icon ni ni-check"></em>
                                                                    <span class="fs-12px" >Validé</span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'non-valider' || $am->statut === 'modif' || $am->statut === 'update')
                                                            <td>
                                                                <span class="badge badge-dim bg-danger">
                                                                    <em class="icon ni ni-alert"></em>
                                                                    <span class="fs-12px" >Non Validé</span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'date_efficacite' )
                                                            <td>
                                                                <span class="badge badge-dim bg-warning">
                                                                    <em class="icon ni ni-stop-circle"></em>
                                                                    <span class="fs-12px" >
                                                                        En attente de l'évaluation de l'éfficacité
                                                                    </span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'cloturer' )
                                                            <td>
                                                                <span class="badge badge-dim bg-success">
                                                                    <em class="icon ni ni-check"></em>
                                                                    <span class="fs-12px" >
                                                                        Clôturer
                                                                    </span>
                                                                </span>
                                                            </td>
                                                        @endif
                                                        <td>{{ \Carbon\Carbon::parse($am->created_at)->translatedFormat('j F Y '.' à '.' H:i:s') }}</td>
                                                        <td >
                                                            <div class="d-flex" >
                                                                <form method="post" action="{{ route('index_etat_am') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{ $am->id }}" style="display: none;">
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalDetail{{ $am->id }}"
                                                                        class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                    <button href="{{ route('index_etat_am') }}"
                                                                    class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                        <em class="icon ni ni-printer-fill"></em>
                                                                    </button>
                                                                    @if ($am->statut !== 'cloturer')
                                                                        @if ($am->nbre_action_non === 0 )
                                                                            <a data-bs-toggle="modal"
                                                                                data-bs-target="#modalDate{{ $am->id }}"
                                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                                <em class="icon ni ni-calendar"></em>
                                                                            </a>
                                                                        @endif
                                                                        @if ($am->date1 !== null && $am->date1 <= \Carbon\Carbon::now()->toDateString() && $am->date2 >= \Carbon\Carbon::now()->toDateString() )
                                                                            <a data-bs-toggle="modal"
                                                                                data-bs-target="#modalEfficacite{{ $am->id }}"
                                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                                <em class="icon ni ni-focus"></em>
                                                                            </a>
                                                                        @endif
                                                                    @endif
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
                </div>
            </div>
        </div>
    </div>

    @foreach($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Détails
                            @if ($am->statut === 'soumis')
                                <span class="text-warning"> ( En attente de validation )</span>
                            @elseif ($am->statut === 'valider' )
                                <span class="text-primary"> ( Validé )</span>
                            @elseif ($am->statut === 'non-valider' || $am->statut === 'update' || $am->statut === 'modif')
                                <span class="text-danger"> (Non Validé )</span>
                            @elseif ($am->statut === 'date_efficacite' )
                                <span class="text-warning"> ( En attente de l'évaluation de l'éfficacité )</span>
                            @elseif ($am->statut === 'cloturer' )
                                <span class="text-success"> ( Clôturer )</span>
                            @endif
                        </h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block">
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Type
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input @if ($am->type === 'contentieux')
                                                                value="Contentieux"
                                                            @endif
                                                            @if ($am->type === 'reclamation')
                                                                value="Réclamation"
                                                            @endif
                                                            @if ($am->type === 'non_conformite_interne')
                                                                value="Non conformité"
                                                            @endif
                                                            readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Date de reception
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($am->date_fiche)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Date Limite de traitement
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($am->date_limite)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Nombres de jours
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->nbre_jour }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Lieu
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->lieu }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Détecteur
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->detecteur }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Non-conformité
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->non_conformite }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Conséquences
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $am->consequence }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Causes
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $am->cause }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach($actionsData[$am->id] as $key => $actions)
                                            <div class="card-head mt-3">
                                                <h5 class="card-title">
                                                    Action Corrective {{ $key+1 }}
                                                </h5>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Action
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['action'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            risque
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['risque'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['processus'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @if ($actions['statut'] === 'realiser')
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Délai
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['delai'])->translatedFormat('j F Y ') }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Date de realisation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['date_action'])->translatedFormat('j F Y ') }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Date du Suivi
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['date_suivi'])->translatedFormat('j F Y '.' à '.' H:i:s') }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Statut
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="Action Réaliser" readonly type="text" class="form-control text-center bg-success" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                    @if($actions['efficacite'] === 'oui')
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Efficacité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="Oui" readonly type="text" class="form-control text-center bg-success" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Efficacité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="Non" readonly type="text" class="form-control text-center bg-danger" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Délai
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['delai'])->translatedFormat('j F Y ') }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Statut
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="Action non réaliser" readonly type="text" class="form-control text-center bg-danger" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Commentaire
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $actions['commentaire'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="row g-4" >
                                                @if($am->date1 !== null)
                                                    <div class="col-md-12 col-xxl-122" id="groupesContainer">
                                                        <div class="card ">
                                                            <div class="card-inner">
                                                                <div class="card-head">
                                                                    <h5 class="card-title">
                                                                        Efficacité
                                                                    </h5>
                                                                </div>
                                                                <div class="row g-4">
                                                                    @if($am->date1 !== null)
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Du
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ \Carbon\Carbon::parse($am->date1)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                au
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ \Carbon\Carbon::parse($am->date2)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $startDate = \Carbon\Carbon::parse($am->date1);
                                                                        $endDate = \Carbon\Carbon::parse($am->date2);
                                                                        $daysDifference = $startDate->diffInDays($endDate);
                                                                    @endphp
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Nombre de jour(S)
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $daysDifference }}" readonly type="text" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @if($am->efficacite !== null)
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Action efficace
                                                                            </label>
                                                                            @if ($am->efficacite === 'oui')
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $am->efficacite }}" readonly type="text" class="form-control bg-success text-center" id="Cause">
                                                                            </div>
                                                                            @endif
                                                                            @if ($am->efficacite === 'non')
                                                                            <div class="form-control-wrap">
                                                                                <input value="{{ $am->efficacite }}" readonly type="text" class="form-control bg-danger text-center" id="Cause">
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                        @if ($am->date_eff !== null)
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Date de verification de l'éfficacité
                                                                            </label>
                                                                            @if ($am->date1 <= $am->date_eff && $am->date2 >= $am->date_eff)
                                                                                <div class="form-control-wrap">
                                                                                    <input value="{{ \Carbon\Carbon::parse($am->eff)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control text-center bg-success" id="Cause">
                                                                                </div>
                                                                            @elseif ($am->date1 > $am->date_eff && $am->date2 >= $am->date_eff || $am->date1 <= $am->date_eff && $am->date2 < $am->date_eff)
                                                                                <div class="form-control-wrap">
                                                                                    <input value="{{ \Carbon\Carbon::parse($am->eff)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control text-center bg-danger" id="Cause">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        @else
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Date de verification de l'éfficacité
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input value="Néant" readonly type="text" class="form-control" id="Cause">
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Commentaire
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $am->commentaire_eff }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if ($am->date1 <= $am->date_eff && $am->date2 >= $am->date_eff)
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group text-center">
                                                                                <div class="form-control-wrap">
                                                                                    <input value="Vérification éffectuée dans les delais" readonly type="text" class="form-control text-center bg-success" id="Cause">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($am->date1 > $am->date_eff && $am->date2 >= $am->date_eff || $am->date1 <= $am->date_eff && $am->date2 < $am->date_eff)
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group text-center">
                                                                                <div class="form-control-wrap">
                                                                                    <input value="Vérification éffectuée hors delais" readonly type="text" class="form-control text-center bg-warning" id="Cause">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @endif
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalEfficacite{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Suivi</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form id="form" class="row g-gs" method="post" action="{{ route('eff_recla') }}">
                                @csrf
                                <input type="text" name="amelioration_id" value="{{ $am->id }}" style="display: none;">
                                <div class="col-lg-12 col-xxl-12">
                                    <div class="card">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-address-1">
                                                            Action éfficace
                                                        </label>
                                                        <select required name="efficacite" class="form-select ">
                                                            <option value="">
                                                                Choisir
                                                            </option>
                                                            <option value="oui">
                                                                oui
                                                            </option>
                                                            <option value="non">
                                                                non
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="Coût">
                                                            Date de vérification de l'éfficacité
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input readonly name="date_eff" type="date" class="form-control" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="description">
                                                            Commentaire
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea name="commentaire" class="form-control no-resize" id="default-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                            <em class="ni ni-check me-2 "></em>
                                                            <em>Enregistrer</em>
                                                        </button>
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
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalDate{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Date</h5>
                        <a class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form id="form" class="row g-gs" method="post" action="{{ route('date_recla') }}">
                                @csrf
                                <input type="text" name="amelioration_id" value="{{ $am->id }}" style="display: none;">
                                <div class="col-lg-12 col-xxl-12">
                                    <div class="card">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Début
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input id="date1_{{ $am->id }}" name="date1" type="date" class="form-control text-center" value="{{ \Carbon\Carbon::now()->toDateString() }}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Nombre de jours
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <select id="nbre_jour_eff_{{ $am->id }}" class="form-select ">
                                                                @for ($i = 1; $i <= 31; $i++) 
                                                                    <option {{ $i === 1 ? 'selected' : '' }} value="{{ $i }}">
                                                                        {{ $i }} Jour(s)
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Fin
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input readonly id="date2_{{ $am->id }}" name="date2" type="text" class="form-control text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xxl-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                            <em class="ni ni-check me-2 "></em>
                                                            <em>Valider</em>
                                                        </button>
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
        </div>
    @endforeach

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Écoute des changements sur le champ de date et le champ du nombre de jours pour chaque élément du foreach
            var ams = document.querySelectorAll('[id^=date1_]'); // Sélection de tous les champs de date1
            var nbreJoursElements = document.querySelectorAll('[id^=nbre_jour_eff_]'); // Sélection de tous les champs de nbre_jour_eff

            ams.forEach(function(element, index) {
                var dateInput = element;
                var nbreJourInput = nbreJoursElements[index];

                dateInput.addEventListener('change', function() {
                    updateDateLimite(dateInput, nbreJourInput);
                });

                nbreJourInput.addEventListener('change', function() {
                    updateDateLimite(dateInput, nbreJourInput);
                });

                function updateDateLimite(dateInput, nbreJourInput) {
                    var dateDebut = dateInput.value;
                    var nbreJours = parseInt(nbreJourInput.value);

                    var date2Id = dateInput.id.replace('date1_', 'date2_'); // Générer l'ID pour le champ 'date2'

                    if (dateDebut && !isNaN(nbreJours)) {
                        var dateLimite = new Date(dateDebut);
                        dateLimite.setDate(dateLimite.getDate() + nbreJours);

                        var jour = ('0' + dateLimite.getDate()).slice(-2);
                        var mois = ('0' + (dateLimite.getMonth() + 1)).slice(-2);
                        var annee = dateLimite.getFullYear();

                        var formattedDate = jour + '/' + mois + '/' + annee;

                        document.getElementById(date2Id).value = formattedDate;
                    }
                }

                // Appel initial pour mettre à jour la date limite lors du chargement de la page
                updateDateLimite(dateInput, nbreJourInput);
            });
        });
    </script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-am-valider');
        channel.bind('my-event-am-valider', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouvelle(s) Fiche(s) d'amélioration(s) Validée(s)",
                        icon: "info",
                        confirmButtonColor: "#00d819",
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
        });
    </script>


@endsection
