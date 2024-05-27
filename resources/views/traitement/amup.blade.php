@extends('app')

@section('titre', 'Tableau de validation')

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
                                            <span>Fiche d'incident non validé</span>
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
                                                    <th>Date</th>
                                                    <th>Non-conformité</th>
                                                    <th>Statut</th>
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
                                                        @if ($am->statut === 'non-valider')
                                                            <td>
                                                                <span class="badge badge-dim bg-warning">
                                                                    <em class="icon ni ni-stop-circle"></em>
                                                                    <span class="fs-12px" >Acune modification détecter</span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'modif')
                                                            <td>
                                                                <span class="badge badge-dim bg-info">
                                                                    <em class="icon ni ni-check"></em>
                                                                    <span class="fs-12px" >Modification détecter</span>
                                                                </span>
                                                            </td>
                                                        @endif
                                                        <td >
                                                            <div class="d-flex" >
                                                                <a data-bs-toggle="modal" data-bs-target="#modalMotif{{ $am->id }}" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                    <em class="icon ni ni-cc-alt"></em>
                                                                </a>
                                                                <form method="post" action="{{ route('index_amup2') }}">
                                                                @csrf
                                                                    <input type="text" name="id" value="{{ $am->id }}" style="display: none;">
                                                                    <button type="submit" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                        <em class="icon ni ni-edit"></em>
                                                                    </button>
                                                                </form>
                                                                <form method="post" action="{{ route('index_amup_add') }}">
                                                                @csrf
                                                                    <input type="text" name="id" value="{{ $am->id }}" style="display: none;">
                                                                    <button type="submit" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                        <em class="icon ni ni-search"></em>
                                                                    </button>
                                                                </form>
                                                                @if ($am->statut !== 'non-valider')
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalConfirme{{ $am->id }}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-success">
                                                                        <em class="icon ni ni-check"></em>
                                                                    </a>
                                                                @endif
                                                                <a data-bs-toggle="modal" data-bs-target="#modalDelete{{ $am->id }}" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                    <em class="icon ni ni-trash"></em>
                                                                </a>
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

    @foreach ($ams as $am)
        <div class="modal fade" tabindex="-1" id="modalConfirme{{ $am->id }}" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em
                            class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span> Mise à jour terminée ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a id="form_click" href="/am_update/{{ $am->id }}" class="btn btn-lg btn-mw btn-success me-2">
                                    oui
                                </a>
                                <a href="#" class="btn btn-lg btn-mw btn-danger"data-bs-dismiss="modal">
                                    non
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade" tabindex="-1" id="modalDelete{{ $am->id }}" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em
                            class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-trash bg-danger"></em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span> Voulez-vous vraiment supprimer cet incident ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a id="form_click" href="/am_delete/{{ $am->id }}" class="btn btn-lg btn-mw btn-success me-2">
                                    oui
                                </a>
                                <a href="#" class="btn btn-lg btn-mw btn-danger"data-bs-dismiss="modal">
                                    non
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalMotif{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails Motif</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Cause">
                                            Motif(s)
                                        </label>
                                        <div class="form-control-wrap">
                                            <textarea disabled  class="form-control no-resize" id="default-textarea">{{ $am->motif }}</textarea>
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
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-am-rejet');
        channel.bind('my-channel-am-rejet', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouvelle(s) fiche(s) détectée(s)",
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
