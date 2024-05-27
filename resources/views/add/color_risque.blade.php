@extends('app')

@section('titre', 'Paramettrage')

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
                                <span>Paramettrage des couleurs</span>
                                <em class="icon ni ni-setting-alt"></em>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="nk-block ">
                    <div class="row g-gs">
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">
                                                Paraméttrage des intervalles
                                            </h5>
                                        </div>
                                        @if($color_para->nbre_color > $color_interval_nbre )
                                        <div class="card-tools">
                                            <ul>
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#modalColor_interval_plus" href="#" class="btn btn-sm btn-success rounded">
                                                            <em class="icon ni ni-plus"></em>
                                                        </a>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-inner pt-0">
                                    <div class="card-title-group align-items-center justify-content-center row g-gs pt-0">
                                        <div class="row g-gs col-lg-12">
                                            <div class="col-lg-3">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="Cause">
                                                        De
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{ $color_para->nbre1 }}" readonly type="text" class="form-control text-center">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="Cause">
                                                        à
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{ $color_para->nbre2 }}" readonly type="text" class="form-control text-center">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="Cause">
                                                        Nombre de couleurs
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <input value="{{ $color_para->nbre_color }}" readonly type="text" class="form-control text-center">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group text-center">
                                                    <label class="form-label" for="Cause">
                                                        Opération
                                                    </label>
                                                    <div class="form-control-wrap d-flex">
                                                        <input value="{{ $color_para->operation }}" readonly type="text" class="form-control text-center me-2">
                                                        <a data-bs-toggle="modal" data-bs-target="#modalColor_para" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                            <em class="icon ni ni-edit"></em>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-gs col-lg-12">
                                            @if( intval($color_para->nbre_color) > intval($color_interval_nbre) )
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label">
                                                            <em class="nk-modal-icon icon icon-circle icon-circle-md ni ni-alert bg-warning"></em>
                                                            <em class="text-warning" >
                                                                Paraméttrage non complet
                                                            </em>
                                                        </label>
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
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label">
                                                                <em class="nk-modal-icon icon icon-circle icon-circle-md ni ni-alert bg-warning"></em>
                                                                <em class="text-warning" >
                                                                    Paraméttrage non complet
                                                                </em>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label">
                                                                <em class="nk-modal-icon icon icon-circle icon-circle-md ni ni-check bg-success"></em>
                                                                <em class="text-success" >
                                                                    Paraméttrage complet
                                                                </em>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">
                                                Couleurs et intervalles
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-activity" style="margin: 0 auto;">
                                    @if( $color_interval_nbre > 0 )
                                        @foreach($color_intervals as $key => $color_interval )
                                        <li class="nk-activity-item border-0">
                                            @if( $color_interval->color === 'vert' )
                                                <div class="nk-activity-media user-avatar" style="background-color:{{$color_interval->code_color}};"></div>
                                            @elseif( $color_interval->color === 'jaune' )
                                                <div class="nk-activity-media user-avatar" style="background-color:{{$color_interval->code_color}};"></div>
                                            @elseif( $color_interval->color === 'orange' )
                                                <div class="nk-activity-media user-avatar" style="background-color:{{$color_interval->code_color}};"></div>
                                            @elseif( $color_interval->color === 'rouge' )
                                                <div class="nk-activity-media user-avatar" style="background-color:{{$color_interval->code_color}};"></div>
                                            @endif
                                            <div class="nk-activity-data" style="width: 100px;">
                                                <div class="label">
                                                    De {{ $color_interval->nbre1 }} à {{ $color_interval->nbre2 }}
                                                </div>
                                            </div>
                                            <div class="nk-activity-media">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalConfirme{{$color_interval->id}}" class="btn btn-icon btn-white btn-dim btn-sm btn-danger border border-1 border-white rounded">
                                                        <em class="icon ni ni-trash"></em>
                                                    </a>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="modalColor_para">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mise à jour</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block">
                    <form method="POST" action="{{ route('color_para_traitement') }}" class="row g-gs align-items-center justify-content-center">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="row g-4 mb-4" id="objectifs-container">
                                        <div class="col-lg-2">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    De
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input name="nbre1" value="{{ $color_para->nbre1 }}" readonly type="number" class="form-control text-center">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    a
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select required name="nbre2" class="form-select text-center">
                                                        @for ($i = 2; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ $color_para->nbre2 == $i ? 'selected' : '' }} >
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    Nombre de couleur
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select required name="nbre_color" class="form-select text-center">
                                                        @for ($i = 2; $i <= 4; $i++) <option value="{{ $i }}" {{ $color_para->nbre_color == $i ? 'selected' : '' }}>
                                                            {{ $i }}
                                                            </option>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    Opération
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select required name="operation" class="form-select text-center">
                                                        <option value="addition" {{ $color_para->operation == 'addition' ? 'selected' : '' }}>
                                                            Addition
                                                        </option>
                                                        <option value="multiplication" {{ $color_para->operation == 'multiplication' ? 'selected' : '' }}>
                                                            Multiplication
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-lg btn-primary btn-dim">
                                                    <em class="ni ni-check me-2"></em>
                                                    <em>Terminé</em>
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

<div class="modal fade zoom" tabindex="-1" id="modalColor_interval_plus">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Couleur</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-block">
                    <form method="POST" action="{{ route('color_interval_add_traitement') }}" class="row g-gs align-items-center justify-content-center">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="row g-4 mb-4" id="objectifs-container">
                                        <div class="col-lg-3">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    De
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select required name="nbre1" class="form-select text-center">
                                                        @if( $color_interval_nbre > 0 )
                                                            @if( $color_para->operation === 'addition' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) * intval($color_para->nbre2)); $i++)
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
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endunless
                                                                @endfor

                                                            @elseif( $color_para->operation === 'multiplication' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) * intval($color_para->nbre2)); $i++)
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
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endunless
                                                                @endfor
                                                            @endif
                                                        @else
                                                            @if( $color_para->operation === 'addition' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) + intval($color_para->nbre2)); $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            @elseif( $color_para->operation === 'multiplication' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) * intval($color_para->nbre2)); $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            @endif
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    a
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select required name="nbre2" class="form-select text-center">
                                                        @if( $color_interval_nbre > 0 )
                                                            @if( $color_para->operation === 'addition' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) + intval($color_para->nbre2)); $i++)
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
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endunless
                                                                @endfor
                                                            @elseif( $color_para->operation === 'multiplication' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) * intval($color_para->nbre2)); $i++)
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
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endunless
                                                                @endfor
                                                            @endif
                                                        @else
                                                            @if( $color_para->operation === 'addition' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) + intval($color_para->nbre2)); $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            @elseif( $color_para->operation === 'multiplication' )
                                                                @for ($i = 1; $i <= (intval($color_para->nbre2) * intval($color_para->nbre2)); $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            @endif
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    Couleur
                                                </label>
                                                <div class="form-control-wrap">
                                                    <select required name="color" class="form-select text-center">
                                                        <option value="">Choisir une couleur</option>
                                                        @php
                                                            $colors = ['vert', 'jaune', 'orange', 'rouge'];
                                                            $intervalColors = $color_intervals->pluck('color')->toArray();
                                                        @endphp

                                                        @foreach($colors as $color)
                                                            @unless(in_array($color, $intervalColors))
                                                                <option value="{{ $color }}">
                                                                    {{ ucfirst($color) }}
                                                                </option>
                                                            @endunless
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                    <em class="ni ni-check me-2"></em>
                                                    <em>Ajouter</em>
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

@foreach($color_intervals as $key => $color_interval )
<div class="modal fade" tabindex="-1" id="modalConfirme{{$color_interval->id}}" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross"></em></a>
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal"><em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
                    <h4 class="nk-modal-title">Confirmation</h4>
                    <div class="nk-modal-text">
                        <div class="caption-text">
                            <span>Voulez-vous vraiment supprimé cet interval ?</span>
                        </div>
                    </div>
                    <div class="nk-modal-action">
                        <a href="/Color_interval_delete_traitement/{{$color_interval->id}}" class="btn btn-lg btn-mw btn-success me-2">
                            oui
                        </a>
                        <a href="#" class="btn btn-lg btn-mw btn-danger" data-bs-dismiss="modal">
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


