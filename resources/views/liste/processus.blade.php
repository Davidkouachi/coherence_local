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
                                            <span>Liste des Processus</span>
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
                                                    <th>Approvisionnement</th>
                                                    <!--<th>Finalié</th>-->
                                                    <th>Nombre de risques</th>
                                                    <th>Nombre d'objectif</th>
                                                    <th>Pourcentage</th>
                                                    <th>Date de création</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processus as $key => $processu)
                                                    <tr>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $processu->nom}}</td>
                                                        <!--<td>{{ $processu->finalite}}</td>-->
                                                        <td>{{ $processu->nbre_risque}}</td>
                                                        <td>{{ $processu->nbre_objectif}}</td>
                                                        <td>
                                                            <div class="project-list-progress">
                                                                <div class="progress progress-pill progress-md bg-light">
                                                                    <div class="progress-bar" data-progress="{{$processu->progress}}" style="width: 100%;"></div>
                                                                </div>
                                                                <div class="project-progress-percent">
                                                                    {{$processu->progress}}%
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($processu->created_at)->translatedFormat('j F Y '.' à '.' H:i:s') }}</td>
                                                        <td>
                                                            <div class="d-flex" >
                                                                <form method="post" action="{{ route('index_etat_processus') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{$processu->id}}" style="display: none;">
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalDetail{{$processu->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                    @if($processu->nbre_risque > 0)
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalRisque{{$processu->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger border border-1 border-white rounded">
                                                                        <em class="icon ni ni-list-thumb"></em>
                                                                    </a>
                                                                    @endif
                                                                    @if($processu->pdf_nom != null)
                                                                    <a href="{{ asset('/storage/app/'.$processu->pdf_chemin) }}" 
                                                                        target="_bank" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                        <em class="icon ni ni-download"></em>
                                                                    </a>
                                                                    @endif
                                                                    <button class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                        <em class="icon ni ni-printer-fill"></em>
                                                                    </button>
                                                                </form>
                                                                <form method="post" action="{{ route('index_processus_modif') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{$processu->id}}" style="display: none;">
                                                                    <button class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                        <em class="icon ni ni-edit"></em>
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

    @foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $processu->id }}">
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
                                                                Processus
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $processu->nom }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Finalité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $processu->finalite }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach ($objectifData[$processu->id] as $key => $objectifDat)
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Objectif {{ $key+1 }}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $objectifDat['objectif'] }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" >
                                                                Description
                                                            </label>
                                                            <div class="form-control-wrap" >
                                                                <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $processu->description }}</textarea>
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

    @foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalRisque{{ $processu->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Risques</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block" >
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12">
                                    <div class="">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    @foreach ($risqueData[$processu->id] as $key => $risqueDat)
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Risque {{ $key+1 }}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $risqueDat['risque'] }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
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

    @foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalFile{{ $processu->id }}">
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content" data-simplebar>
                    @if ($processu->pdf_nom != '')
                        <embed src="{{ asset('storage/pdf/'.$processu->pdf_nom) }}" type="application/pdf" width="100%" height="1100px">
                    @endif

                    @if ($processu->pdf_nom == '')
                        <p class="text-center mt-2" > Aucun fichier </p>
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

        var channel = pusher.subscribe('my-channel-processus');
        channel.bind('my-event-processus', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouveau Processus",
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
