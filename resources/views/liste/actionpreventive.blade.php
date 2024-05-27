@extends('app')

@section('titre', 'Liste des actions preventives')

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
                                            <span>Liste des actions preventives</span>
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
                                                    <th>Action</th>
                                                    <th>Responsable</th>
                                                    <th>Délai</th>
                                                    <th>Statut</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($actions as $key => $action)
                                                    <tr>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $action->action}}</td>
                                                        <td>{{ $action->poste}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($action->date)->translatedFormat('j F Y ') }}</td>
                                                        @if($action->suivi === 'non')
                                                        <td>
                                                            <span class="badge badge-dim bg-info">
                                                                <em class="icon ni ni-info"></em>
                                                                <span class="fs-12px" >Risque non valider</span>
                                                            </span>
                                                        </td>
                                                        @else
                                                            @if ($action->date_action !== null && $action->date>= $action->date_action)
                                                                <td>
                                                                    <span class="badge badge-dim bg-success">
                                                                        <em class="icon ni ni-check"></em>
                                                                        <span class="fs-12px" >Realiser dans le delai</span>
                                                                    </span>
                                                                </td>
                                                            @elseif ($action->date_action !== null && $action->date < $action->date_action)
                                                                <td>
                                                                    <span class="badge badge-dim bg-danger">
                                                                        <em class="icon ni ni-alert"></em>
                                                                        <span class="fs-12px" >Realiser hors delai</span>
                                                                    </span>
                                                                </td>
                                                            @elseif ($action->date_action === null)
                                                                <td>
                                                                    <span class="badge badge-dim bg-warning">
                                                                        <em class="icon ni ni-stop-circle"></em>
                                                                        <span class="fs-12px" >Non Realiser</span>
                                                                    </span>
                                                                </td>
                                                            @endif
                                                        @endif
                                                        <td>
                                                            <div class="d-flex" >
                                                                <form method="post" action="{{ route('index_etat_actionp') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{$action->id}}" style="display: none;">
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalDetail{{$action->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                    <!--<a data-bs-toggle="modal"
                                                                        data-bs-target="#modalModif{{$action->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                        <em class="icon ni ni-edit"></em>
                                                                    </a>-->
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
                </div>
            </div>
        </div>
    </div>

    @foreach ($actions as $action)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $action->id }}">
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
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Action
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->action }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Risque
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->risque }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Processus
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->processus }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($action->suivi != 'non')
                                                        @if ($action->date_action !== null)
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Délai
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ \Carbon\Carbon::parse($action->date)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Date d'action
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ \Carbon\Carbon::parse($action->date_action)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Efficacitée
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    @if($action->efficacite === 'oui')
                                                                        <input value="{{ $action->efficacite }}" readonly type="text" class="form-control bg-success" id="Cause">
                                                                    @else
                                                                        <input value="{{ $action->efficacite }}" readonly type="text" class="form-control bg-danger" id="Cause">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    @if ($action->date >= $action->date_action)
                                                                        <input value="Realiser dans le delai" readonly type="text" class="form-control text-center bg-success" id="Cause">
                                                                    @else
                                                                        <input value="Realiser hors delai" readonly type="text" class="form-control text-center bg-danger" id="Cause">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" >
                                                                    Commentaire
                                                                </label>
                                                                <div class="form-control-wrap" >
                                                                    <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $action->commentaire }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Délai
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ \Carbon\Carbon::parse($action->date)->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="Non Realiser" readonly type="text" class="form-control text-center bg-warning" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @else
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input value="Risque non valider" readonly type="text" class="form-control text-center bg-info" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Contrôleur
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->poste }}" readonly type="text" class="form-control" id="Cause">
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

    @foreach ($actions as $action)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $action->id }}">
            <div class="modal-dialog modal-md" role="document" style="width: 100%;">
                <div class="modal-content">
                    @if($action->suivi === 'oui')
                        <div class="modal-body modal-body-lg text-center">
                            <div class="nk-modal">
                                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning"></em>
                                <h4 class="nk-modal-title">Mise à jour impossible</h4>
                                <div class="nk-modal-text">
                                    <div class="caption-text">
                                        <span>L'action préventive que vous essayez de mettre a jour a déjà été réaliser</span>
                                    </div>
                                </div>
                                <div class="nk-modal-action">
                                    <a href="#" class="btn btn-lg btn-mw btn-warning"data-bs-dismiss="modal">
                                        ok
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="modal-header">
                            <h5 class="modal-title">Mise à jour</h5>
                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                    class="icon ni ni-cross"></em></a>
                        </div>
                        <div class="modal-body">
                            <div class="nk-block" >
                                <div class="row g-gs align-items-center justify-content-center" >
                                        <div class="col-lg-12 col-xxl-12 "  >
                                            <div class="card">
                                                <div class="card-inner">
                                                    <form method="post" action="{{ route('actionp_modif') }}" >
                                                        @csrf
                                                        <input name="id" value="{{ $action->id }}" type="text" class="form-control" style="display: none;">
                                                        <div class="row g-4 mb-4" id="objectifs-container" >
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="description">
                                                                        Action
                                                                    </label>
                                                                    <div class="form-control-wrap">
                                                                        <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control " name="action" value="{{ $action->action}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="Coût">
                                                                        Responsable
                                                                    </label>
                                                                    <select name="poste_id" class="form-select js-select2">
                                                                        @foreach($postes as $poste)
                                                                        <option {{ $action->poste_id === $poste->id ? 'selected' : '' }} value="{{$poste->id}}">
                                                                            {{$poste->nom}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-gs">
                                                            <div class="col-lg-12">
                                                                <div class="form-group text-center">
                                                                    <button type="submit" class="btn btn-lg btn-primary">
                                                                        <em class="ni ni-check me-2"></em>
                                                                        <em>Mise àjour</em>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
    @endforeach

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-ap');
        channel.bind('my-event-ap', function(data) {
            Swal.fire({
                        title: "Alert!",
                    text: "Nouvelle(s) Action(s)",
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
