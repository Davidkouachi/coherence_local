<!DOCTYPE html>
<html lang="zxx" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link href="images/logo.png" rel="shortcut icon">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashlite0226.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('.assets/css/theme0226.css')}}">

</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-0 text-center">
                            <div class="card-inner text-center">
                                <img height="35%" width="35%" src="{{asset('images/logo.png')}}" alt="">
                            </div>
                        </div>
                        <div class="card pt-0">
                            <div class="card-inner card-inner-sm">
                                <div class="nk-block-head text-center mt-0">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Se connecter</h4>
                                    </div>
                                </div>
                                <form id="login" action="/auth_user" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input required type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Entrer votre email"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Mot de passe</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input required type="password" value="{{ old('password') }}" name="password" class="form-control form-control-lg" id="password" placeholder="Entrer votre Mot de passe">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-success btn-block">Connexion</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modalL" aria-modal="true" style="position: fixed;" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <h5 class="nk-modal-title text-success">Connexion en cours</h5>
                        <div class="nk-modal-text">
                            <div class="text-center">
                                <div class="spinner-border text-success" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>
    <script src="{{asset('assets/js/example-toastr0226.js') }}"></script>

    <script>
        document.getElementById("login").addEventListener("submit", function(event) {
            event.preventDefault(); 

            var email = document.getElementById("email").value;
            var password1 = document.getElementById("password").value;

            if (!email || !password1 ) {
                NioApp.Toast("<h5>Alert</h5><p>Veuillez remplir tous les champs.</p>", "warning", {position: "top-right"});
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                NioApp.Toast("<h5>Information</h5><p>Veuillez saisir une adresse e-mail valide.</p>", "info", {position: "top-right"});
                return false;
            }

            var password = document.getElementById("password").value;
            if (!verifierMotDePasse(password)) {
                event.preventDefault();
                NioApp.Toast("<h5>Erreur</h5><p>Le mot de passe doit comporter au moins 8 caractères, une lettre majuscule, une lettre minuscule et un chiffre.</p>", "error", {position: "top-right"});
                return false;
            }

            $('.modal').modal('hide');
            $(`#modalL`).modal('hide');
            $(`#modalL`).modal('show');

            this.submit();

            function verifierMotDePasse(motDePasse) {
                if (motDePasse.length < 8) {
                    return false;
                }

                if (!/[A-Z]/.test(motDePasse)) {
                    return false;
                }

                if (!/[a-z]/.test(motDePasse)) {
                    return false;
                }

                if (!/\d/.test(motDePasse)) {
                    return false;
                }

                return true;
            }
        });
    </script>

    @if (session('error_login'))
        <script>
            NioApp.Toast("<h5>Erreur</h5><p>{{ session('error_login') }}.</p>", "error", {position: "top-right"});
        </script>
        {{ session()->forget('error_login') }}
    @endif
    @if (session('info'))
        <script>
            NioApp.Toast("<h5>Information</h5><p>{{ session('info') }}.</p>", "info", {position: "top-right"});
        </script>
        {{ session()->forget('info') }}
    @endif
    @if (session('success'))
        <script>
            NioApp.Toast("<h5>Succès</h5><p>{{ session('success') }}.</p>", "success", {position: "top-right"});
        </script>
        {{ session()->forget('success') }}
    @endif

</html>
