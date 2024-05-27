<!DOCTYPE html>
<html class="js" lang="fr">
<meta content="text/html;charset=utf-8" http-equiv="content-type">

<head>
    <meta charset="utf-8">
    <meta content="Softnio" name="author">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers." name="description">
    <link href="images/logo.png" rel="shortcut icon">
    <title>Fiche Cause</title>
    <link href="assets/css/dashlite0226.css?" rel="stylesheet">
    <link href="assets/css/theme0226.css" rel="stylesheet">
    <script src="{{asset('chart.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('pusher.min.js') }}"></script>
    </link>
    </link>
    </link>
    </meta>
    </meta>
    </meta>
    </meta>
</head>


<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <div class="nk-wrap ">
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-between g-3">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">
                                            Numéro : <strong class="text-primary small">{{ $cause->id }}</strong>
                                        </h3>
                                        <div class="nk-block-des text-soft">
                                            <ul class="list-inline">
                                                <li>
                                                    Date de création :
                                                    <span class="text-base">
                                                        {{ \Carbon\Carbon::now()->translatedFormat('j F Y H:i') }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" id="btn_download">
                                                        <em class="icon ni ni-printer-fill"></em>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="{{ route('liste_cause') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Retour</span>
                                        </a>
                                        <a href="{{ route('liste_cause') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="nk-block mt-3 col-lg-8 ms-auto me-auto"  >
                                <div class="bg-white">

                                    <div class=" row g-gs" id="cadre" style="margin-top: -30px; ">

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: +2px;">
                                            <div class="card" style="background: transparent;">
                                                <div class="card-inner text-center">
                                                    <img src="images/logo.png" height="100" width="120">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: -40px;">
                                            <div class="card" style="background: transparent;">
                                                <div class="card-inner text-center">
                                                    <h5 class="text-dark">Fiche Cause </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-xxl-12" style="margin-top: -20px;">
                                            <div class="card" style="background: transparent; ">
                                                <div class="card-inner">
                                                    <div class="gy-3">
                                                        <div class="row g-1 align-center">
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Cause probable :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ $cause->nom }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3" >
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Risque :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ $cause->risque }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 row">
                                                                <div class="col-lg-3" >
                                                                    <div class="form-group ">
                                                                        <label class="form-label" style="font-size: 14px;">
                                                                            Processus :
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="form-group ">
                                                                        <span class="fw-normal text-dark" style="font-size: 14px;">
                                                                            {{ $cause->processus }}
                                                                        </span>
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
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>
    <script src="{{asset('assets/js/libs/datatable-btns0226.js')}}"></script>

    <link href="{{asset('notification/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('notification/toastr.min.js')}}"></script>

    <style>
        .form-label{
            color: black;
            font-size:17px;
        }
        .form-note{
            color: black;
            font-size:15px;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script>
        window.onload = function() {
            document.getElementById('btn_download').addEventListener('click', function() {
                // Sélection du formulaire à imprimer
                const form = document.getElementById('cadre');

                // Configuration pour la génération PDF
                const opt = {
                    margin: 10,
                    filename: 'Fiche cause.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }, // Gestion des sauts de page
                    header: [
                        {
                            content: 'Mon Header',
                            height: '50mm',
                            styles: {
                                textAlign: 'center',
                            },
                        }
                    ],
                    footer: [
                        {
                            content: 'Page {page}/{total}',
                            height: '50mm',
                            styles: {
                                textAlign: 'center',
                            },
                        }
                    ],
                };

                // Génération du PDF à partir du formulaire
                const pdf = html2pdf().from(form).set(opt).save();
            });
        };
    </script>

</body>

</html>

