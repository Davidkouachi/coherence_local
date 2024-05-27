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
                                            <span>Liste des Causes</span>
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
                                                    <th>Cause probable</th>
                                                    <th>Risque</th>
                                                    <th>Processus</th>
                                                    <th>Taux</th>
                                                    <th>Date de Création</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php 
                                                    $maxProgress = 0;
                                                @endphp

                                                @foreach ($causes as $cause)
                                                    @php 
                                                        $maxProgress = max($maxProgress, $cause->progess);
                                                    @endphp
                                                @endforeach

                                                @foreach ($causes as $key => $cause)
                                                    <tr>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $cause->nom}}</td>
                                                        <td>{{ $cause->risque}}</td>
                                                        <td>{{ $cause->processus}}</td>
                                                        <td>
                                                            <div class="project-list-progress">
                                                                <div class="progress progress-pill progress-md bg-light">
                                                                    <div class="progress-bar {{$cause->progess === $maxProgress ? 'bg-danger' : '' }}" data-progress="{{$cause->progess}}" style="width: 100%;"></div>
                                                                </div>
                                                                <div class="project-progress-percent {{$cause->progess === $maxProgress ? 'text-danger' : '' }}">
                                                                    {{$cause->progess}}%
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($cause->created_at)->translatedFormat('j F Y '.' à '.' h:i:s') }}</td>
                                                        <td>
                                                            <div class="d-flex" >
                                                                <form method="post" action="{{ route('index_etat_cause') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{$cause->id}}" style="display: none;">
                                                                    <!--<a data-bs-toggle="modal" data-bs-target="#modalModif{{ $cause->id }}" class="btn btn-icon btn-white btn-dim btn-sm btn-info">
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

    @foreach ($causes as $key => $cause)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $cause->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    @if($cause->suivi != 'valider')
                        <div class="modal-body modal-body-lg text-center">
                            <div class="nk-modal">
                                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning"></em>
                                <h4 class="nk-modal-title">Mise à jour impossible</h4>
                                <div class="nk-modal-text">
                                    <div class="caption-text">
                                        <span>La cause que vous essayez de mettre a jour a déjà été valider</span>
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
                            <h5 class="modal-title">Mise à jour </h5>
                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('cause_modif') }}">
                                @csrf
                                <div class="row g-4 mb-4" >
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" >
                                                Cause probable
                                            </label>
                                            <div class="form-control-wrap">
                                                <input placeholder="Saisie obligatoire" required type="text" class="form-control" value="{{ $cause->nom }}" name="cause" >
                                                <input type="text" name="id" value="{{ $cause->id }}" style="display: none;">
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
                    @endif
                </div>
            </div>
        </div>
    @endforeach

@endsection
