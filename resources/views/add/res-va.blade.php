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
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Nouveau Utilisateur</span>
                                            <em class="icon ni ni-user-add"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    <div class="nk-block">
                        <form id="form_login" class="row g-gs" method="post" action="{{ route('add_user') }}">
                            @csrf
                            <div class="col-md-8" style="margin: 20px auto;">
                                <div class="row g-gs" >
                                    <div class="col-lg-12 " id="groupesContainer">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Nom et Prénoms
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" id="nom" autocomplete="off" required name="np" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="corectif">
                                                                    Email
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="email" type="email" class="form-control" id="email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <div class="form-label-group">
                                                                    <label class="form-label" for="password">
                                                                        Mot de passe
                                                                    </label>
                                                                </div>
                                                                <div class="form-control-wrap">
                                                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch " data-target="password">
                                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off">
                                                                        </em>
                                                                    </a>
                                                                    <input name="mdp" autocomplete="new-password" type="password" class="form-control " required="" id="password" value="12345">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="preventif">
                                                                    Contact
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="tel" type="tel" class="form-control" id="tel">
                                                                </div>
                                                                <script>
                                                                    var inputElement = document.getElementById('tel');
                                                                    inputElement.addEventListener('input', function() {
                                                                        // Supprimer tout sauf les chiffres
                                                                        this.value = this.value.replace(/[^0-9]/g, '');

                                                                        // Limiter la longueur à 10 caractères
                                                                        if (this.value.length > 10) {
                                                                            this.value = this.value.slice(0, 10);
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address-1">
                                                                    Poste
                                                                </label>
                                                                <select required name="poste_id" class="form-select js-select2">
                                                                    <option value="" > Choisir </option>
                                                                    @foreach ($postes as $poste)
                                                                    <option value="{{ $poste->id }}">
                                                                       {{ $poste->nom }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Matricule
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="le matricule est génerer automatiquement" id="matricule" autocomplete="off" required name="matricule" type="text" class="form-control" id="Cause" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8" style="margin: 20px auto;">
                                <div class="row g-gs" >
                                    <div class="col-lg-12 ">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Autorisation des différentes fenêtres
                                                    </h5>
                                                </div>
                                                    <div class="row g-4">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    ADMINISTRATION
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Utilisateur</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio1" name="new_user" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio1">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio2" name="new_user" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio2">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Lise des Utilisateurs</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio1l" name="list_user" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio1l">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio2ll" name="list_user" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio2ll">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Poste</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio3" name="new_poste" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio3">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio4" name="new_poste" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio4">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Lise des Postes</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio33" name="list_poste" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio33">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio44" name="list_poste" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio44">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Historique</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio5" name="historiq" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio5">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio6" name="historiq" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio6">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Statistique</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio7" name="stat" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio7">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio8" name="stat" checked class="custom-control-input" value="non">
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
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Processus</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio9" name="new_proces" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio9">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio10" name="new_proces" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio10">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des Processus</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio11" name="list_proces" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio11">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio12" name="list_proces" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio12">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Evaluation des Processus</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio11ev" name="eva_proces" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio11ev">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio12evv" name="eva_proces" checked class="custom-control-input" value="non">
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
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau Risque</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio13" name="new_risk" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio13">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio14" name="new_risk" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio14">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des Risques</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio15" name="list_risk" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio15">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio16" name="list_risk" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio16">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Validation des risques</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0" name="val_risk" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00" name="val_risk" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Risques non validés</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0n" name="act_n_val" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0n">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00n" name="act_n_val" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00n">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Paramettrage des couleurs</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0nc" name="color_para" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0nc">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00nc" name="color_para" checked class="custom-control-input" value="non">
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
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des causes</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio17lc" name="list_cause" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio17lc">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio18lc" name="list_cause" checked class="custom-control-input" value="non">
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
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Suivis des actions préventives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio17sp" name="suivi_actp" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio17sp">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio18sp" name="suivi_actp" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio18sp">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des actions préventives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio17spp" name="list_actp" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio17spp">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio18spp" name="list_actp" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio18spp">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Suivi des actions correctives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio19sa" name="suivi_actc" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio19sa">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio20sa" name="suivi_actc" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio20sa">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Actions correctives éffectuées</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio19saf" name="list_actc_eff" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio19saf">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio20saf" name="list_actc_eff" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio20saf">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des actions correctives</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio19safl" name="list_actc" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio19safl">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio20safl" name="list_actc" checked class="custom-control-input" value="non">
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
                                                                    Incidents
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Nouveau incident</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio13am" name="fiche_am" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio13am">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio14am" name="fiche_am" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio14am">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Suivi des incidents</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio15am" name="list_am" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio15am">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio16am" name="list_am" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio16am">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Validation des incidents</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0vm" name="val_am" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0vm">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00vm" name="val_am" checked class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio00vm">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Incidents non validés</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio0nnv" name="am_n_val" class="custom-control-input" value="oui" >
                                                                                <label class="custom-control-label" for="customRadio0nnv">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio00nnv" name="am_n_val" checked class="custom-control-input" value="non">
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
                            <div class="col-lg-8" style="margin: 20px auto;">
                                <div class="row g-gs" >
                                    <div class="col-md-12">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner row g-gs">
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                            <em class="ni ni-check me-2 "></em>
                                                            <em >Soumettre</em>
                                                        </button>
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

    <script>
        function generateMatricule(length) {
          const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
          let matricule = "";
          for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            matricule += charset.charAt(randomIndex);
          }
          return matricule;
        }

        document.addEventListener("DOMContentLoaded", function () {
          const nameInput = document.querySelector('#nom');
          const matriculeInput = document.querySelector('#matricule');
          const passwordInput = document.querySelector('#password');

          nameInput.addEventListener('input', function () {
            const matricule = generateMatricule(10);
            matriculeInput.value = matricule;
          });
        });
    </script>

    <script>
        document.getElementById("form_login").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche la soumission par défaut du formulaire

            // Récupération des valeurs des champs
            var email = document.getElementById("email").value;
            var password1 = document.getElementById("password").value;

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expression régulière pour valider l'e-mail
            if (!emailRegex.test(email)) {
                NioApp.Toast("<h5>Information</h5><p>Veuillez saisir une adresse e-mail valide.</p>", "info", {position: "top-right"});
                return false;
            }
            
            if (!verifierMotDePasse(password1)) {
                // Afficher un message d'erreur
                NioApp.Toast("<h5>Information</h5><p>Le mot de passe doit comporter au moins 8 caractères, une lettre majuscule, une lettre minuscule et un chiffre.</p>", "info", {position: "top-right"});
                return false;
            }

            $('.modal').modal('hide');
            $(`#modalt`).modal('hide');
            $(`#modalt`).modal('show');

            // Si toutes les validations passent, soumettre le formulaire
            this.submit();

            function verifierMotDePasse(motDePasse) {
                // Vérification de la longueur
                if (motDePasse.length < 8) {
                    return false;
                }

                // Vérification s'il contient au moins une lettre majuscule
                if (!/[A-Z]/.test(motDePasse)) {
                    return false;
                }

                // Vérification s'il contient au moins une lettre minuscule
                if (!/[a-z]/.test(motDePasse)) {
                    return false;
                }

                // Vérification s'il contient au moins un chiffre
                if (!/\d/.test(motDePasse)) {
                    return false;
                }

                // Si toutes les conditions sont satisfaites, le mot de passe est valide
                return true;
            }

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const passwordInput = document.getElementById('password');
            const generatedPassword = generatePassword();
            passwordInput.value = generatedPassword;

            function generatePassword() {
                const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
                const numericChars = '0123456789';

                let password = '';

                password += uppercaseChars[Math.floor(Math.random() * uppercaseChars.length)];
                password += lowercaseChars[Math.floor(Math.random() * lowercaseChars.length)];
                password += numericChars[Math.floor(Math.random() * numericChars.length)];

                for (let i = 0; i < 7; i++) {
                    const allChars = uppercaseChars + lowercaseChars + numericChars;
                    password += allChars[Math.floor(Math.random() * allChars.length)];
                }

                password = password.split('').sort(function() {
                    return 0.5 - Math.random();
                }).join('');

                return password;
            }
        });
    </script>

@endsection
