@extends('app')

@section('titre', 'Nouveau Processus')

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
                            <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Liste des Postes</span>
                                            <em class="icon ni ni-list"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Poste</th>
                                                    <th>Disponibilité</th>
                                                    <th>Date de Création</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($postes as $key => $poste)
                                                    <tr>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $poste->nom}}</td>
                                                        <td class=" @php  if($poste->occupe === 'oui'){ echo 'text-danger'; } else{ echo 'text-success'; } @endphp " > 
                                                            @if($poste->occupe === 'oui')
                                                                Non
                                                            @else
                                                                Oui
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($poste->created_at)->translatedFormat('j F Y '.' à '.' h:i:s') }}</td>
                                                        <td>
                                                            <div class="d-flex" >
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#modalModif{{ $poste->id }}"
                                                                    href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info">
                                                                    <em class="icon ni ni-edit"></em>
                                                                </a>
                                                                @if($poste->occupe === 'non')
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalDelete{{ $poste->id }}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                        <em class="icon ni ni-trash"></em>
                                                                    </a>
                                                                @endif
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

    @foreach($postes as $key => $poste)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $poste->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modification </h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form id="form" method="post" action="{{ route('index_modif_poste_traitement') }}">
                            @csrf
                            <div class="row g-4 mb-4">
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <label class="form-label" for="poste">
                                            Poste
                                        </label>
                                        <div class="form-control-wrap">
                                            <input placeholder="Saisie obligatoire" required type="text" class="form-control text-center poste" value="{{ $poste->nom }}" name="nom" oninput="this.value = this.value.toUpperCase()">
                                            <input type="text" name="poste_id" value="{{ $poste->id }}" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-gs">
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-dim">
                                            <em class="ni ni-edit me-2"></em>
                                            <em>Mise à jour</em>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($postes as $key => $poste)
        <div class="modal fade" tabindex="-1" id="modalDelete{{ $poste->id  }}" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em
                            class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-trash bg-danger"></em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span> Voulez-vous vraiment supprimer ce Poste ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a id="form_click" href="/poste_delete/{{ $poste->id }}" class="btn btn-lg btn-mw btn-success me-2">
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


@endsection
