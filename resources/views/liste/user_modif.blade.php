@extends('app')

@section('titre', 'Nouveau Utilisateur')

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
                                    <div class="nk-block-head-content" style="margin: 0px auto;">
                                        <h3 class="text-center">
                                            <span>Modification des autorisation</span>
                                            <em class="icon ni ni-edit"></em>
                                        </h3>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="{{ route('index_liste_user') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Retour</span>
                                        </a>
                                        <a href="{{ route('index_liste_user') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <div class="nk-block">
                        <form id="form" class="nk-block" method="post" action="{{ route('index_modif_auto') }}">
                            @csrf
                            <div class="row g-gs">
                                <div class="col-lg-12">
                                    <div class="row g-gs">
                                        <div class="col-lg-12 ">
                                            <div class="card">
                                                <div class="card-inner">
                                                    <input style="display: none" name="user_id" type="text" value="{{ $user->id }}">
                                                    <div class="row g-4">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    ADMINISTRATION
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Utilisateur</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio1" name="new_user"
                                                                                @php 
                                                                                    if ($user->new_user === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp
                                                                                 class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio1">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio2" name="new_user" 
                                                                                @php 
                                                                                    if ($user->new_user === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio2">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Lise des Utilisateurs</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio1l" name="list_user"
                                                                                @php 
                                                                                    if ($user->list_user === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp
                                                                                class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio1l">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio2ll" name="list_user" @php 
                                                                                    if ($user->list_user === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio2ll">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Poste</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio3" name="new_poste"
                                                                                @php 
                                                                                    if ($user->new_poste === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp
                                                                                 class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio3">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio4" name="new_poste" @php 
                                                                                    if ($user->new_poste === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio4">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Lise des Postes</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio33" name="list_poste"
                                                                                @php 
                                                                                    if ($user->list_poste === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp
                                                                                 class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio33">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio44" name="list_poste" @php 
                                                                                    if ($user->list_poste === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio44">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Historique</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio5" name="historiq"
                                                                                @php 
                                                                                    if ($user->historiq === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp
                                                                                class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio5">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio6" name="historiq" @php 
                                                                                    if ($user->historiq === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio6">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Statistique</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio7" @php 
                                                                                    if ($user->stat === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="stat" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio7">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio8" @php 
                                                                                    if ($user->stat === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="stat" class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio8">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    PROCESSUS
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Processus</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio9" @php 
                                                                                    if ($user->new_proces === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="new_proces" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio9">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio10" name="new_proces" @php 
                                                                                    if ($user->new_proces === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio10">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des Processus</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio11" @php 
                                                                                    if ($user->list_proces === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_proces" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio11">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio12" name="list_proces" @php 
                                                                                    if ($user->list_proces === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp  class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio12">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Evaluation des Processus</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio11ev" @php 
                                                                                    if ($user->eva_proces === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp  name="eva_proces" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio11ev">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio12evv" name="eva_proces" @php 
                                                                                    if ($user->eva_proces === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp  class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio12evv">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Risque
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Risque</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio13" @php 
                                                                                    if ($user->new_risk === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp  name="new_risk" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio13">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio14" name="new_risk" @php 
                                                                                    if ($user->new_risk === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio14">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des Risques</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio15" @php 
                                                                                    if ($user->list_risk === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_risk" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio15">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio16" name="list_risk" @php 
                                                                                    if ($user->list_risk === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio16">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Validation des risques</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0" @php 
                                                                                    if ($user->val_risk === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="val_risk" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00" name="val_risk" @php 
                                                                                    if ($user->val_risk === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Risques non validés</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0n" @php 
                                                                                    if ($user->act_n_val === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="act_n_val" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0n">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00n" name="act_n_val" @php 
                                                                                    if ($user->act_n_val === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00n">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Paramettrage des couleurs</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0nc" @php 
                                                                                    if ($user->color_para === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="color_para" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0nc">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00nc" name="color_para" @php 
                                                                                    if ($user->color_para === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00nc">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Cause
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des causes</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio17lc" @php 
                                                                                    if ($user->list_cause === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_cause" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio17lc">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio18lc" name="list_cause" @php 
                                                                                    if ($user->list_cause === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio18lc">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    ACTIONS
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Suivis des actions préventives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio17sp" @php 
                                                                                    if ($user->suivi_actp === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="suivi_actp" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio17sp">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio18sp" name="suivi_actp" @php 
                                                                                    if ($user->suivi_actp === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio18sp">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des actions préventives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio17spp" @php 
                                                                                    if ($user->list_actp === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_actp" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio17spp">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio18spp" name="list_actp" @php 
                                                                                    if ($user->list_actp === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio18spp">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Suivi des actions correctives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio19sa" @php 
                                                                                    if ($user->suivi_actc === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="suivi_actc" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio19sa">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio20sa" name="suivi_actc" @php 
                                                                                    if ($user->suivi_actc === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio20sa">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Actions correctives éffectuées</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio19saf" @php 
                                                                                    if ($user->list_actc_eff === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_actc_eff" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio19saf">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio20saf" name="list_actc_eff" @php 
                                                                                    if ($user->list_actc_eff === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio20saf">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des actions correctives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio19safl" @php 
                                                                                    if ($user->list_actc === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_actc" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio19safl">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio20safl" name="list_actc" @php 
                                                                                    if ($user->list_actc === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio20safl">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    INCIDENTS
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouvel incident</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio13am" @php 
                                                                                    if ($user->fiche_am === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="fiche_am" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio13am">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio14am" name="fiche_am" @php 
                                                                                    if ($user->fiche_am === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio14am">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Suivis des incidents</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio15am" @php 
                                                                                    if ($user->list_am === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="list_am" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio15am">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio16am" name="list_am" @php 
                                                                                    if ($user->list_am === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio16am">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Validation des incidents</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0vm" @php 
                                                                                    if ($user->val_am === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="val_am" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0vm">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00vm" name="val_am" @php 
                                                                                    if ($user->val_am === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00vm">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Incidents non validés</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0nnv" @php 
                                                                                    if ($user->am_n_val === 'oui') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp name="am_n_val" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0nnv">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00nnv" name="am_n_val" @php 
                                                                                    if ($user->am_n_val === 'non') {
                                                                                        echo "checked";
                                                                                    }
                                                                                @endphp class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00nnv">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-gs">
                                        <div class="col-md-12">
                                            <div class="card card-preview">
                                                <div class="card-inner row g-gs">
                                                    <div class="col-md-12">
                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-lg btn-primary btn-dim">
                                                                <em class="ni ni-edit me-2 "></em>
                                                                <em>Mise à jour</em>
                                                            </button>
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
    </div>



@endsection
