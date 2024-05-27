@extends('app')

@section('titre', 'Tableau de Suivi')

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
                                            <span>Tableau de suivi des actions correctives</span>
                                            <em class="icon ni ni-list-index "></em>
                                        </h3>
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
                                                    <th>Action</th>
                                                    <th>Responsable</th>
                                                    <th>Risque</th>
                                                    <th>Processus</th>
                                                    <th>Fiche d'incident</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ams as $key => $am)
                                                    @if($am->nbre_am > 0)
                                                    <tr>
                                                        <td>{{ $am->action }}</td>
                                                        <td>{{ $am->poste }}</td>
                                                        <td>{{ $am->risque }}</td>
                                                        <td>{{ $am->delai }}</td>
                                                        <td>{{ $am->nbre_am }}</td>
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalAm{{ $am->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                <em class="icon ni ni-notice"></em>
                                                            </a>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $am->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endif
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
        <div class="modal fade zoom" tabindex="-1" id="modalAm{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Fiche(s) d'incident(s)</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block">
                            <div class="row g-gs">
                                @foreach($amData[$am->id] as $key => $amDatas)
                                <div class="col-md-12 col-xxl-12">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="card-head">
                                                        <h5 class="card-title">{{ $key+1 }}</h5>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Type
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input @if ($amDatas['type'] === 'contentieux')
                                                                value="Contentieux"
                                                            @elseif ($amDatas['type'] === 'reclamation')
                                                                value="Réclamation"
                                                            @elseif ($amDatas['type'] === 'non_conformite_interne')
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
                                                            <input value="{{ \Carbon\Carbon::parse($amDatas['date_fiche'])->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Date Limite de traitement
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($amDatas['date_limite'])->translatedFormat('j F Y ') }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Nombres de jours
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $amDatas['nbre_jour'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Lieu
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $amDatas['lieu'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Détecteur
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $amDatas['detecteur'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Non-conformité
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $amDatas['non_conformite'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Conséquences
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $amDatas['consequence'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Causes
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $amDatas['cause'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Suivi</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form id="form" class="row g-gs" method="post" action="/Suivi_actionc/{{ $am->id }}">
                                @csrf
                                <div class="col-lg-12 col-xxl-12" >
                                    <div class="card">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Action Corrective
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input disabled value="{{ $am->action }}" type="text" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Coût">
                                                                Responsable
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input disabled value="{{ $am->poste }}" type="text" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Efficacitée
                                                            </label>
                                                            <select required name="efficacite" class="form-select ">
                                                                <option value="">
                                                                    Choisir
                                                                </option>
                                                                <option value="oui">
                                                                    Oui
                                                                </option>
                                                                <option value="non">
                                                                    Non
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label" for="Coût">
                                                                Date de réalisation
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input name="date_action" id="date_action" type="date" class="form-control" max="{{ \Carbon\Carbon::now()->toDateString() }}" onchange="checkDate0()" >
                                                                <script>
                                                                    function checkDate0() {
                                                                        var dateInput = document.getElementById('date_action');
                                                                        // Récupérer la date entrée
                                                                        var inputDate = new Date(document.getElementById('date_action').value);

                                                                        // Récupérer la date de validation (convertie en objet Date)
                                                                        var validationDate = new Date("{{ $am->date_validation }}");

                                                                        // Comparer les dates
                                                                        if (inputDate < validationDate.setDate(validationDate.getDate() - 0)) {
                                                                            dateInput.value = "";
                                                                            toastr.info("La date d'action ne doit pas être supérieur a la date de validation de la fiche d'incident.");
                                                                        }
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
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
                                                                <em >Enregistrer</em>
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
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-am-act-c');
        channel.bind('my-channel-am-act-c', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouvelle(s) action(s) corrective(s)",
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
