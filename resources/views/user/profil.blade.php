@extends('app')

@section('titre', 'Securite')

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
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-12">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="team">
                                        <div class="user-card user-card-s2">
                                            <div class="user-avatar md bg-primary">
                                                <span><em class="ni ni-user-alt"></em></span>
                                                <div class="status dot dot-lg dot-success"></div>
                                            </div>
                                            <div class="user-info">
                                                <h6>{{ Auth::user()->name }}</h6>
                                                <span class="sub-text">{{ Auth::user()->email }}</span>
                                            </div>
                                        </div>
                                        <!--<ul class="team-statistics">
                                            <li>
                                                <span>213</span>
                                                <span>Projects</span>
                                            </li>
                                            <li>
                                                <span>87.5%</span>
                                                <span>Performed</span>
                                            </li>
                                            <li>
                                                <span>587</span>
                                                <span>Tasks</span>
                                            </li>
                                        </ul>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-bordered">
                                <div class="card-aside-wrap">
                                    <div class=" card card-inner card-inner-lg">
                                        <!--<ul class="nav nav-tabs nav-tabs-s2">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">
                                                    <em class="icon ni ni-user"></em>
                                                    <span>Informations Personnelles</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">
                                                    <em class="icon ni ni-lock-alt"></em>
                                                    <span>Paramette de Sécurité</span>
                                                </a>
                                            </li>
                                        </ul>-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem1">
                                                <div class="card-aside-wrap">
                                                    <div class="card-inner card-inner-lg">
                                                        <div class="nk-block-head nk-block-head-lg">
                                                            <div class="nk-block-between">
                                                                <div class="nk-block-head-content">
                                                                    <h4 class="nk-block-title">
                                                                        Informations Personnelles
                                                                    </h4>
                                                                </div>
                                                                <!--<div class="nk-block-head-content align-self-start d-lg-none">
                                                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
                                                                        <em class="icon ni ni-menu-alt-r"></em>
                                                                    </a>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                        <div class="nk-block">
                                                            <div class="nk-data data-list">
                                                                <!--<div class="data-head">
                                                                    <h6 class="overline-title">Basics</h6>
                                                                </div>-->
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Poste</span>
                                                                        <span class="data-value">
                                                                            {{ session('user_poste')->nom }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Nom et Prémons</span>
                                                                        <span class="data-value">
                                                                            {{ Auth::user()->name }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Email</span>
                                                                        <span class="data-value">
                                                                            {{ Auth::user()->email }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Téléphone</span>
                                                                        <span class="data-value">
                                                                            {{ Auth::user()->tel }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Matricule</span>
                                                                        <span class="data-value">
                                                                            {{ Auth::user()->matricule }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                                    <div class="data-col">
                                                                        <span class="data-label">Mise à jour</span>
                                                                        <span class="data-value"> </span>
                                                                    </div>
                                                                    <div class="data-col data-col-end">
                                                                        <span class="data-more">
                                                                            <em class="icon ni ni-edit"></em>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--<div class="nk-data data-list">
                                                                <div class="data-head">
                                                                    <h6 class="overline-title">Preferences</h6>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col"><span class="data-label">Language</span><span class="data-value">English (United State)</span></div>
                                                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change Language</a></div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col"><span class="data-label">Date Format</span><span class="data-value">M d, YYYY</span></div>
                                                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                                                </div>
                                                                <div class="data-item">
                                                                    <div class="data-col"><span class="data-label">Timezone</span><span class="data-value">Bangladesh (GMT +6)</span></div>
                                                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                        <div class="nk-block-head nk-block-head-lg">
                                                            <div class="nk-block-between">
                                                                <div class="nk-block-head-content">
                                                                    <h4 class="nk-block-title">Securité</h4>
                                                                </div>
                                                                <!--<div class="nk-block-head-content align-self-start d-lg-none"><a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a></div>-->
                                                            </div>
                                                        </div>
                                                        <div class="nk-block">
                                                            <div class="card card-bordered">
                                                                <div class="card-inner-group">
                                                                    <div class="card-inner">
                                                                        <div class="between-center flex-wrap g-3">
                                                                            <div class="nk-block-text">
                                                                                <h6>Changer le mot de passe</h6>
                                                                                <p>
                                                                                    Définissez un mot de passe unique pour protéger votre compte.
                                                                                </p>
                                                                            </div>
                                                                            <div class="nk-block-actions flex-shrink-sm-0">
                                                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                                                    <li class="order-md-last">
                                                                                        <a data-bs-toggle="modal" data-bs-target="#profile-edit-mdp" class="btn btn-primary">Changer le mot de passe</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <em class="text-soft text-date fs-12px">Derniére modification:
                                                                                            <span>{{ \Carbon\Carbon::parse(Auth::user()->mdp_date)->translatedFormat('j F Y '. ' à '.'H:i:s') }}</span>
                                                                                        </em>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-inner">
                                                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                                            <div class="nk-block-text">
                                                                                <h6>
                                                                                    Suivis des activitées
                                                                                    @if (Auth::user()->suivi_active === 'non' ) 
                                                                                    <span class="text-soft">
                                                                                        (Fonctionnalité indisponible)
                                                                                    </span>
                                                                                    @endif
                                                                                    @if (Auth::user()->suivi_active === 'oui' )
                                                                                    <span class="text-soft">
                                                                                        (Fonctionnalité indisponible)
                                                                                    </span>
                                                                                    @endif
                                                                                </h6>
                                                                                <p>Vous pouvez enregistrer toutes vos activitées, y compris les activités inhabituelles détectées.</p>
                                                                            </div>
                                                                            <div class="nk-block-actions">
                                                                                <ul class="align-center gx-3">
                                                                                    <li class="order-md-last">
                                                                                        <div class="custom-control custom-switch me-n2">
                                                                                            <input disabled type="checkbox" class="custom-control-input"
                                                                                            @php
                                                                                                if (Auth::user()->suivi_active === 'oui') {
                                                                                                    echo "checked";
                                                                                                }
                                                                                            @endphp
                                                                                            id="activity-log">
                                                                                            <label class="custom-control-label" for="activity-log"></label>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-inner">
                                                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                                            <div class="nk-block-text">
                                                                                <h6>
                                                                                    Authentification à 2 facteurs &nbsp;
                                                                                    @if (Auth::user()->fa === 'non' ) 
                                                                                    <span class="text-soft">
                                                                                        (Fonctionnalité indisponible)
                                                                                    </span>
                                                                                    @endif
                                                                                    @if (Auth::user()->fa === 'oui' )
                                                                                    <span class="text-soft">
                                                                                        (Fonctionnalité indisponible)
                                                                                    </span>
                                                                                    @endif
                                                                                    <span class="badge badge-success ms-0">Enabled</span>
                                                                                </h6>
                                                                                <p>Sécurisez votre compte avec la sécurité 2FA. Lorsqu'il est activé, vous devrez saisir non seulement votre mot de passe, mais également saisir le code qui vous sera envoyé par email. </p>
                                                                            </div>
                                                                            <div class="nk-block-actions">
                                                                                @if (Auth::user()->fa === 'non' ) 
                                                                                <a hidden href="#" class="btn btn-success">Activé</a>
                                                                                @endif
                                                                                @if (Auth::user()->fa === 'oui' )
                                                                                <a hidden href="#" class="btn btn-danger">Désactivé</a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabItem2">
                                                <div class="card-aside-wrap">
                                                    <div class="card-inner card-inner-lg">
                                                        
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
    </div>
</div>


<div class="modal fade" role="dialog" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Mise à jour</h5>
                <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Informations</a></li>
                    <!--<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#address">Address</a></li>-->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="personal">
                        <div class="row gy-4">
                            <div class="col-lg-12">
                                <div class="form-group"><label class="form-label" for="display-name">Nom et Prénoms</label><input type="text" class="form-control form-control-lg" value="{{ Auth::user()->name }}" id="name" placeholder="Saisie votre nom et prénoms"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group"><label class="form-label" for="phone-no">Téléphone</label><input type="text" class="form-control form-control-lg" id="tel" value="{{ Auth::user()->tel }}" placeholder="Saisie votre numéro de téléphone"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group"><label class="form-label" for="birth-day">Email</label><input type="email" id="email" class="form-control form-control-lg" value="{{ Auth::user()->email }}" placeholder="Saisie Email"></div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button id="btn_change_info" class="btn btn-lg btn-success btn-dim">
                                            <em class="ni ni-check me-2 "></em>
                                            <em >Enregistrer</em>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--<div class="tab-pane" id="address">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-l1">Address Line 1</label><input type="text" class="form-control form-control-lg" id="address-l1" value="2337 Kildeer Drive"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-l2">Address Line 2</label><input type="text" class="form-control form-control-lg" id="address-l2" value=""></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-st">State</label><input type="text" class="form-control form-control-lg" id="address-st" value="Kentucky"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label" for="address-county">Country</label><select class="form-select js-select2" id="address-county" data-ui="lg">
                                        <option>Canada</option>
                                        <option>United State</option>
                                        <option>United Kindom</option>
                                        <option>Australia</option>
                                        <option>India</option>
                                        <option>Bangladesh</option>
                                    </select></div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li><a href="#" class="btn btn-lg btn-primary">Update Address</a></li>
                                    <li><a href="#" data-bs-dismiss="modal" class="link link-light">Cancel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="profile-edit-mdp">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Mise à jour</h5>
                <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Securité</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="personal">
                        <form id="form_password" class="row gy-4" method="post" action="{{ route('mdp_update') }}" >
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input required type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Nouveau Mot de passe">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password2">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input required type="password" name="password2" class="form-control form-control-lg" id="password2" placeholder="Confirmer le mot de passe">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-lg btn-success btn-dim">
                                            <em class="ni ni-check me-2 "></em>
                                            <em >Enregistrer</em>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById("form_password").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche la soumission par défaut du formulaire

            var password = document.getElementById("password").value;
            var password2 = document.getElementById("password2").value;

            if (password !== password2){
                toastr.error("Mot de passe incorrect.");
                return false;
            }

            if (!verifierMotDePasse(password) || !verifierMotDePasse(password2)) {
                // Empêcher la soumission du formulaire si le mot de passe est invalide
                event.preventDefault();
                // Afficher un message d'erreur
                toastr.warning("Le mot de passe doit comporter au moins 8 caractères, une lettre majuscule, une lettre minuscule et un chiffre.");
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

<script>
    const checkbox = document.getElementById('activity-log');
    var userId  = {{ Auth::user()->id }};

    checkbox.addEventListener('change', function(event) {
        event.preventDefault();

        if (this.checked) {
            $.ajax({
                url: '/suiviactiveoui',
                method: 'GET',
                success: function() {
                    toastr.success("Paramettre Activé.");
                },
                error: function() {
                    checkbox.checked = false;
                    toastr.error("L'activation a échoué.");
                }
            });
        } else {
            $.ajax({
                url: '/suiviactivenon',
                method: 'GET',
                success: function() {
                    toastr.info("Paramettre Désactivé.");
                },
                error: function() {
                    checkbox.checked = true;
                    toastr.error("La désactivation a échoué.");
                }
            });
        }
    });
</script>

<script>
    const btn0 = document.getElementById('btn_change_info');

    btn0.addEventListener('click', function(event) {
        event.preventDefault();

        const name = document.getElementById('name');
        const tel = document.getElementById('tel');
        const email = document.getElementById('email');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (name.value ==='' || tel.value ==='' || email.value ==='') {

            toastr.warning("Veuillez remplir tous les champs.");

        } else {

            if (tel.value.length !== 10) {

                toastr.warning("Verifier le numéro de téléphone.");
            } else {

                if (!emailPattern.test(email.value)) {

                    toastr.warning("Verifier l'email saisie.");
                } else {

                    $.ajax({
                        url: '/info_update',
                        method: 'GET',
                        data: {name: name.value, tel: tel.value, email: email.value},
                        success: function() {

                            const modal = document.getElementById('profile-edit');
                            const bootstrapModal = bootstrap.Modal.getInstance(modal); // Obtenez l'instance du modal
                            if (bootstrapModal) {
                                bootstrapModal.hide(); // Masquer le modal
                            }

                            toastr.success("Modification éffectuée.");

                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function() {
                            toastr.error("La modification a échouée.");
                        }
                    });
                }
            }
        }
    });
</script>


@endsection
