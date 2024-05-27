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
                                    <span>Risque(s) non Validé(es)</span>
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
                                                            <th>Date de création</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
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
                                                                            <div class="user-avatar" style="background-color:{{$color_interval->code_color}}" ></div>
                                                                        </td>
                                                                        @php
                                                                            $colorMatchFound = true;
                                                                        @endphp

                                                                        @break

                                                                    @endif

                                                                @endforeach

                                                                @if(!$colorMatchFound)
                                                                    <td>
                                                                        <div class="user-avatar" style="background-color:#8e8e8e;"></div>
                                                                    </td>
                                                                @endif
                                                                <td>{{ \Carbon\Carbon::parse($risque->updated_at)->translatedFormat('j F Y'.' à '.' H:i') }}</td>
                                                                <td class="d-flex" >
                                                                    <a data-bs-toggle="modal" data-bs-target="#modalMotif{{ $risque->id }}" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                        <em class="icon ni ni-cc-alt"></em>
                                                                    </a>
                                                                    <form method="post" action="{{ route('index_risque_actionup2') }}">
                                                                    @csrf
                                                                        <input type="text" name="id" value="{{ $risque->id }}" style="display: none;">
                                                                        <button type="submit" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                            <em class="icon ni ni-edit"></em>
                                                                        </button>
                                                                    </form>
                                                                    <a data-bs-toggle="modal" data-bs-target="#modalDelete{{ $risque->id }}" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                    <em class="icon ni ni-trash"></em>
                                                                </a>
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
        <div class="modal fade" tabindex="-1" id="modalDelete{{ $risque->id }}" aria-modal="true" role="dialog">
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
                                <a id="form_click" href="/risque_delete/{{ $risque->id }}" class="btn btn-lg btn-mw btn-success me-2">
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

    @foreach($risques as $risque)
        <div class="modal fade zoom" tabindex="-1" id="modalMotif{{ $risque->id }}">
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
                                            <textarea disabled  class="form-control no-resize" id="default-textarea">{{ $risque->motif }}</textarea>
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

        var channel = pusher.subscribe('my-channel-action-non-valider');
        channel.bind('my-event-action-non-valider', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouveau(x) Risque(s) à Modifier",
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
